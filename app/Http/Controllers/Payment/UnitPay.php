<?php
namespace App\Http\Controllers\Payment;

/**
 * Способ оплаты UnitPay
 *
 * @author      UnitPay <support@unitpay.ru>
 */
class UnitPay
{
    private $supportedCurrencies = array('EUR', 'UAH', 'BYR', 'USD', 'RUB');
    private $supportedUnitpayMethods = array('initPayment', 'getPayment');
    private $requiredUnitpayMethodsParams = array(
        'initPayment' => array('desc', 'account', 'sum'),
        'getPayment' => array('paymentId')
    );

    private $supportedPartnerMethods = array('check', 'pay', 'error');

    private $supportedUnitpayIp = array(
        '31.186.100.49',
        '178.132.203.105',
        '52.29.152.23',
        '52.19.56.234',
        '127.0.0.1' // for debug
    );

    private $secretKey;

    private $params = array();

    private $apiUrl;
    private $formUrl;

    public function __construct($domain, $secretKey = null)
    {
        $this->secretKey = $secretKey;
        $this->apiUrl = "https://$domain/api";
        $this->formUrl = "https://$domain/pay/";
    }

    /**
     * Create SHA-256 digital signature
     *
     * @param array $params
     * @param $method
     *
     * @return string
     */
    function getSignature(array $params, $method = null)
    {
        ksort($params);
        unset($params['sign']);
        unset($params['signature']);
        array_push($params, $this->secretKey);

        if ($method) {
            array_unshift($params, $method);
        }

        return hash('sha256', join('{up}', $params));
    }

    /**
     * Return IP address
     *
     * @return string
     */
    protected function getIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Get URL for pay through the form
     *
     * @param string $publicKey
     * @param string|float|int $sum
     * @param string $account
     * @param string $desc
     * @param string $currency
     * @param string $locale
     *
     * @return string
     */
    public function form($publicKey, $sum, $account, $desc, $currency = 'RUB', $locale = 'ru')
    {
        $vitalParams = array(
            'account' => $account,
            'currency' => $currency,
            'desc' => $desc,
            'sum' => $sum
        );

        $this->params = array_merge($this->params, $vitalParams);

        if ($this->secretKey) {
            $this->params['signature'] = $this->getSignature($vitalParams);
        }

        $this->params['locale'] = $locale;

        return $this->formUrl . $publicKey . '?' . http_build_query($this->params);
    }

    /**
     * Set customer email
     *
     * @param string $email
     *
     * @return UnitPay
     */
    public function setCustomerEmail($email)
    {
        $this->params['customerEmail'] = $email;
        return $this;
    }

    /**
     * Set customer phone number
     *
     * @param string $phone
     *
     * @return UnitPay
     */
    public function setCustomerPhone($phone)
    {
        $this->params['customerPhone'] = $phone;
        return $this;
    }

    /**
     * Set list of paid goods
     *
     * @param CashItem[] $items
     *
     * @return UnitPay
     */
    public function setCashItems($items)
    {
        $this->params['cashItems'] = base64_encode(
            json_encode(
                array_map(function ($item) {
                    /** @var CashItem $item */
                    return array(
                        'name' => $item->getName(),
                        'count' => $item->getCount(),
                        'price' => $item->getPrice()
                    );
                }, $items)));

        return $this;
    }

    /**
     * Set callback URL
     *
     * @param string $backUrl
     * @return UnitPay
     */
    public function setBackUrl($backUrl)
    {
        $this->params['backUrl'] = $backUrl;
        return $this;
    }

    /**
     * Call API
     *
     * @param $method
     * @param array $params
     */
    public function api($method, $params = array())
    {
        if (!in_array($method, $this->supportedUnitpayMethods)) {
            return response($this->getErrorHandlerResponse('Method is not supported'))
                ->header('Content-type', 'application/json');
        }

        if (isset($this->requiredUnitpayMethodsParams[$method])) {
            foreach ($this->requiredUnitpayMethodsParams[$method] as $rParam) {
                if (!isset($params[$rParam])) {
                    return response($this->getErrorHandlerResponse('Param ' . $rParam . ' is null'))
                        ->header('Content-type', 'application/json');
                }
            }
        }

        $params['secretKey'] = $this->secretKey;
        if (empty($params['secretKey'])) {
            return response($this->getErrorHandlerResponse('SecretKey is null'))
                ->header('Content-type', 'application/json');
        }

        $requestUrl = $this->apiUrl . '?' . http_build_query([
                'method' => $method,
                'params' => $params
            ], null, '&', PHP_QUERY_RFC3986);

        $response = json_decode(file_get_contents($requestUrl));
        if (!is_object($response)) {
            return response($this->getErrorHandlerResponse('Temporary server error. Please try again later.'))
                ->header('Content-type', 'application/json');
        }

        return $response;
    }

    /**
     * Check request on handler from UnitPay
     */
    public function checkHandlerRequest()
    {
        $ip = $this->getIp();
        if (!isset($_GET['method'])) {
            return response($this->getErrorHandlerResponse('Method is null'))
                ->header('Content-type', 'application/json');
        }

        if (!isset($_GET['params'])) {
            return response($this->getErrorHandlerResponse('Params is null'))
                ->header('Content-type', 'application/json');
        }

        list($method, $params) = array($_GET['method'], $_GET['params']);

        if (!in_array($method, $this->supportedPartnerMethods)) {
            return response($this->getErrorHandlerResponse('Method is not supported'))
                ->header('Content-type', 'application/json');
        }

        if (!isset($params['signature']) || $params['signature'] != $this->getSignature($params, $method)) {
            return response($this->getErrorHandlerResponse('Wrong signature'))
                ->header('Content-type', 'application/json');
        }

        /**
         * IP address check
         * @link http://help.unitpay.ru/article/67-ip-addresses
         * @link http://help.unitpay.money/article/67-ip-addresses
         */
        if (!in_array($ip, $this->supportedUnitpayIp)) {
            return response($this->getErrorHandlerResponse('IP address Error'))
                ->header('Content-type', 'application/json');
        }

        return true;
    }

    /**
     * Response for UnitPay if handle success
     *
     * @param $message
     *
     * @return string
     */
    public function getSuccessHandlerResponse($message)
    {
        return json_encode(array(
            "result" => array(
                "message" => $message
            )
        ));
    }

    /**
     * Response for UnitPay if handle error
     *
     * @param $message
     *
     * @return string
     */
    public function getErrorHandlerResponse($message)
    {
        return json_encode(array(
            "error" => array(
                "message" => $message
            )
        ));
    }
}