<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\Order;

class UnitPayController extends Controller
{
    /**
     * Взаимодействует с сервисом UnitPay
     */
    public function handler(Request $request)
    {
        $unitPay = new UnitPay(env('UNITPAY_DOMAIN'), env('UNITPAY_SECRET_KEY'));

        try {
            // Validate request (check ip address, signature and etc)
            $unitPay->checkHandlerRequest();

//            list($method, $params) = array($_GET['method'], $_GET['params']);
            list($method, $params) = array($request->input('method'), $request->input('params'));

            if (!isset($params['account'])){
                throw new InvalidArgumentException('No order number!');
            }



            // временно, удалить после отладки
            if (count($params) > 0){
                $str_params = implode(' | ', $params);
                if ($str_params){
                    file_put_contents(
                        'log_payment.txt',
                        '[ ' . date('d-m-Y H:i:s') . ' ]' . "method: $method | " . $str_params . "\n",
                        FILE_APPEND
                    );
                }
            }


            $order = Order::where('id', $params['account'])->firstOrFail();


// My item Info
            $itemName = $order->tour_title;

// My Order Data
            $orderId        = (int)$order->id;
            $orderSum       = (int)$order->price_variant;
            $orderDesc      = env('UNITPAY_DESC') . '"'.$itemName.'"';
            $orderCurrency  = 'RUB';
            ////////////////////////////////////////////





            // Очень важно! Подтвердите запрос с данными вашего заказа, до завершения заказа
            if (
            ((int)$params['orderSum']) != $orderSum ||
                $params['desc'] != $orderDesc ||
                $params['orderCurrency'] != $orderCurrency ||
                ((int)$params['account']) != $orderId ||
                $params['projectId'] != env('UNITPAY_PROJECT_ID')
            ) {
                // logging data and throw exception
                throw new InvalidArgumentException('Order validation Error!');
            }

            switch ($method) {
                // Просто проверьте заказ (check server status, check order in DB and etc)
                case 'check':
                    $order->latest_actions = $method;
                    $order->save();
                    return $unitPay->getSuccessHandlerResponse('Check Success. Ready to pay.');

                // Метод Pay означает, что полученные деньги
                case 'pay':
                    // Пожалуйста, завершите заказ
                    $order->unitpayId = $params['unitpayId'];
                    $order->status = 'paid';
                    $order->latest_actions = $method;
                    $order->save();
                    return $unitPay->getSuccessHandlerResponse('Pay Success');

                // Метод Error означает, что произошла ошибка.
                case 'error':
                    // Пожалуйста, зарегистрируйте текст ошибки.
                    $order->latest_actions = $method;
                    $order->save();
                    return $unitPay->getSuccessHandlerResponse('Error logged');

                // Метод возврата средств означает, что деньги возвращены клиенту
                case 'refund':
                    // Пожалуйста отмените заказ
                    $order->status = 'return_payment';
                    $order->latest_actions = $method;
                    $order->save();
                    return $unitPay->getSuccessHandlerResponse('Order canceled');

                case 'preauth':
                    // средства заблокированы на карте клиента (по умолчанию на 114 часов)
                    $order->status = 'preauth';
                    $order->latest_actions = $method;
                    $order->save();
                    return $unitPay->getSuccessHandlerResponse('Success');

                case 'confirmPayment':
                    // средства списаны с клиента (в случае preauth)
                    $order->status = 'confirmPayment';
                    $order->latest_actions = $method;
                    $order->save();
                    return $unitPay->getSuccessHandlerResponse('Success');

            }
// Oops! Something went wrong.
        } catch (\Exception $e) {
            print $unitPay->getErrorHandlerResponse($e->getMessage());
        }

        return $unitPay->getErrorHandlerResponse('Произошла не предвиденная ошибка. Сообщите об этом администратору.');
    }
}
