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
//        dd($request->all());

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

        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->some_data = $request->input('some_data');
        $customer->save();

//        dd($customer);

//        $customer = Customer::where('id', $customer->id)->first();



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
}








































