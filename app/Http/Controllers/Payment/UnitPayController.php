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
            list($method, $params) = [$request->input('method'), $request->input('params')];
//            dd($params);

            if (!isset($params['account'])) {
                return response($unitPay->getErrorHandlerResponse('No order number!'))
                    ->header('Content-type', 'application/json');
            }


            // временно, удалить после отладки
            if (count($params) > 0) {
                $str_params = '';
                foreach ($params as $key => $param) {
                    $str_params .= "$key=$param\n";
                }
                if ($str_params) {
                    file_put_contents(
                        'log_payment.txt',
                        '=============' . "\n" . '[ ' . date('d-m-Y H:i:s') . ' ]' .
                        "\n" . "method: $method" .
                        "\n" . $str_params .
                        "\n" . '==============' .
                        "\n",
                        FILE_APPEND
                    );
                }
            }


            $order = Order::where('id', $params['account'])->firstOrFail();


// My item Info
            $itemName = $order->tour_title;

// My Order Data
            $orderId = (int)$order->id;
            $orderSum = $order->deposit;
            $orderDesc = env('UNITPAY_DESC') . '"' . $itemName . '"';
            $orderCurrency = 'RUB';
            ////////////////////////////////////////////


            // Очень важно! Подтвердите запрос с данными вашего заказа, до завершения заказа
            if (
                ((int)$params['sum']) != $orderSum ||
//                $params['desc'] != $orderDesc ||
//                $params['orderCurrency'] != $orderCurrency ||
                ((int)$params['account']) != $orderId ||
                $params['projectId'] != env('UNITPAY_PROJECT_ID')
            ) {
                // logging data and throw exception
                return response($unitPay->getErrorHandlerResponse('Order validation Error!'))
                    ->header('Content-type', 'application/json');
            }

            switch ($method) {
                // Просто проверьте заказ (check server status, check order in DB and etc)
                case 'check':
                    $order->latest_actions = $method;
                    $order->save();
                    return response($unitPay->getSuccessHandlerResponse('Check Success. Ready to pay.'))
                        ->header('Content-type', 'application/json');

                // Метод Pay означает, что полученные деньги
                case 'pay':
                    // Пожалуйста, завершите заказ
                    $order->unitpayId = $params['unitpayId'];
                    $order->status = 'paid';
                    $order->latest_actions = $method;
                    $order->save();
                    return response($unitPay->getSuccessHandlerResponse('Pay Success'))
                        ->header('Content-type', 'application/json');

                // Метод Error означает, что произошла ошибка.
                case 'error':
                    // Пожалуйста, зарегистрируйте текст ошибки.
                    $order->latest_actions = $method;
                    $order->save();
                    return response($unitPay->getSuccessHandlerResponse('Error logged'))
                        ->header('Content-type', 'application/json');

                // Метод возврата средств означает, что деньги возвращены клиенту
                case 'refund':
                    // Пожалуйста отмените заказ
                    $order->status = 'return_payment';
                    $order->latest_actions = $method;
                    $order->save();
                    return response($unitPay->getSuccessHandlerResponse('Order canceled'))
                        ->header('Content-type', 'application/json');

                case 'preauth':
                    // средства заблокированы на карте клиента (по умолчанию на 114 часов)
                    $order->status = 'preauth';
                    $order->latest_actions = $method;
                    $order->save();
                    return response($unitPay->getSuccessHandlerResponse('Success'))
                        ->header('Content-type', 'application/json');

                case 'confirmPayment':
                    // средства списаны с клиента (в случае preauth)
                    $order->status = 'confirmPayment';
                    $order->latest_actions = $method;
                    $order->save();
                    return response($unitPay->getSuccessHandlerResponse('Success'))
                        ->header('Content-type', 'application/json');

            }
// Oops! Something went wrong.
        } catch (\Exception $e) {
            return response($unitPay->getErrorHandlerResponse($e->getMessage()))
                ->header('Content-type', 'application/json');
        }

        return response(
            $unitPay->getErrorHandlerResponse(
                'Произошла не предвиденная ошибка. Сообщите об этом администратору.'
            )
        )->header('Content-type', 'application/json');
    }
}
