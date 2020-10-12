<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\Customer;
use Modules\Admin\Models\Order;
use Modules\Admin\Models\Tour;

class PayController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/[\w\s\-\\\']*/i',
            'email' => 'required|email',
            'phone' => 'sometimes|nullable|regex:/[\d]*/',
            'some_data' => 'sometimes|nullable|regex:/[\w\s\d\_\.\,\-\\\']*/i',
        ]);

        $tour_id = (int)$request->input('tour_id');
        $variant_id = $request->input('variant_id');

        $tour = Tour::with(['variants', 'user', 'category'])->where('id', $tour_id)->firstOrFail();
        $variant = false;
        foreach ($tour->variants as $var){
            if ($var->id == $variant_id){
                $variant = $var;
                break;
            }
        }

        $customer = Customer::where('email', $request->input('email'))->first();

        if (!$customer){
            $customer = new Customer();
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->some_data = $request->input('some_data');
            $customer->save();
        }

        $order = new Order();
        $order->status = 'new';
        $order->customer_id = $customer->id;
        $order->tour_id = $tour_id;
        $order->variant_id = $variant_id;
        $order->organizer_id = $tour->user->id;
        $order->organizer_name = $tour->user->name;
        $order->category = $tour->category->title;
        $order->customer_name = $customer->name;
        $order->customer_email = $customer->email;
        $order->customer_phone = $customer->phone;
        $order->tour_title = $tour->title;
        $order->payment_desc = env('UNITPAY_DESC') . '"'.$tour->title.'"';
        $order->address = $tour->address;
        $order->street = $tour->street;
        $order->house = $tour->house;
        $order->region = $tour->region;
        $order->city = $tour->city;
        $order->country = $tour->country;
        $order->latitude = $tour->latitude;
        $order->longitude = $tour->longitude;
        $order->price_variant = $variant->price_variant;
        $order->rate = 10; // todo: 10% от стоимомти тура на начальном этапе
        $order->deposit = $this->calc_deposit($order->price_variant, $order->rate);
        $order->date_start_variant = $variant->date_start_variant;
        $order->date_end_variant = $variant->date_end_variant;
        $order->text_variant = $variant->text_variant;
        $order->save();

        return redirect()->route('customer.order.show', ['id' => $order->id]);
    }


    public function show($id)
    {
        $order = Order::where('id', $id)->firstOrFail();
        return view('pages.payment.checkout', ['order' => $order]);
    }

// todo: начало оплаты
   /* public function init_payment(Request $request, $id)
    {
        $request->validate([
            'paymentType' => 'required|regex:/[a-zA-Z]+/'
        ]);

        $order = Order::where('id', $id)->firstOrFail();
        $app_params = [
            'method' => 'initPayment',
            'params[paymentType]' => $request->input('paymentType'),
            'params[account]' => $order->id,
            'params[sum]' => $order->deposit,
            'params[desc]' => $order->payment_desc,
            'params[projectId]' => env('UNITPAY_PROJECT_ID'),
            'params[resultUrl]' => env('APP_URL'),
            'params[ip]' => $_SERVER['REMOTE_ADDR'],
            'params[secretKey]' => env('UNITPAY_SECRET_KEY_TEST'),
            //    'params[signature]' => 'цифровая подпись',
            'params[customerEmail]' => $order->customer_email,
            'params[preauth]' => 1,
            'params[preauthExpireLogic]' => 1,
            'params[test]' => 1
        ];

        $domain = 'https://unitpay.ru/api?';
        $app_params['params[signature]'] = $this->get_form_signature($app_params);
        $url = $domain . http_build_query($app_params);

        $json = json_decode(file_get_contents($url));
//        var_dump($json); exit();

        if (isset($json->result)){
            if (isset($json->result->paymentId)){
                $order->unitpayId = $json->result->paymentId;
                $order->status = 'preauth';
                $order->save();
            }
            if (isset($json->result->redirectUrl)){
                return redirect($json->result->redirectUrl);
            }
        }
        return response(json_encode($json))->header('Content-type', 'application/json'); // todo: удалить после отладки
//        return redirect()->route('payment.fail');
    }*/


    /*public function pay_success(Request $request)
    {
        return response($request->all())->header('Content-type', 'application/json');
    }

    public function pay_fail(Request $request)
    {
        return response($request->all())->header('Content-type', 'application/json');
    }


    protected function get_form_signature(...$params)
    {
        if (isset($params[0])) {
            $params = $params[0];
        }
        ksort($params);
        $str = implode('{up}', $params);
        return hash('sha256', $str);
    }*/

    protected function calc_deposit($summ, $rate)
    {
        return round((float)($summ / 100 * $rate));
    }
}








































