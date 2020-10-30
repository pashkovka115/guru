<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Models\Customer;
use Modules\Admin\Models\Order;
use Modules\Admin\Models\Tour;



class PayController extends Controller
{
    use AuthenticatesUsers;


    public function store(Request $request)
    {
        if (!auth()->check()){
            $request->validate([
                'name' => 'required|regex:/[\w\s\-\\\']*/i',
                'email' => 'required|email',
                'phone' => 'sometimes|nullable|regex:/[\d]*/',
                'some_data' => 'sometimes|nullable|regex:/[\w\s\d\_\.\,\-\\\']*/i',
            ]);
        }else{
            $request->validate([
                'phone' => 'sometimes|nullable|regex:/[\d]*/',
                'some_data' => 'sometimes|nullable|regex:/[\w\s\d\_\.\,\-\\\']*/i',
            ]);
        }


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

        // Создаём покупателя
        $customer = Customer::where('email', $request->input('email'))->first();

        if (!$customer){
            $customer = new Customer();
            if (auth()->check()){
                $customer->name = auth()->user()->name;
                $customer->email = auth()->user()->email;
            }else{
                $customer->name = $request->input('name');
                $customer->email = $request->input('email');
            }
            $customer->phone = $request->input('phone');
            $customer->some_data = $request->input('some_data');
            $customer->save();
        }

        // Регистрируем пользователя если нет его
        $user = User::where('email', $request->input('email'))->first();

        if (!$user){
            $data = [];
            $data['password'] = \Illuminate\Support\Str::random(10);
            $request->merge($data);
            if (!auth()->check()){
                $this->register_user($request);
                session(['password_pay' => $request->password]);
            }
        }

        if (!auth()->check()){
            $this->login($request);
        }






        $img = (array)$tour->gallery;
        if (isset($img[0])){
            $img = json_decode($img[0])[0];
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
        $order->img = $img;
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


    protected function register_user($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data->password),
        ]);
    }


    protected function calc_deposit($summ, $rate)
    {
        return round((float)($summ / 100 * $rate));
    }

    // paid
    public function handler_from_pay_system(Request $request)
    {
        $order = Order::where('id', $request->input('invoiceId'))->firstOrFail();
        $order->status = 'paid';
        $order->deposit = $request->input('amount');
        $order->currency = $request->input('currency');
        $order->payment_desc = $request->input('description');
        $accountId = explode('___', $request->input('accountId'));
        $order->customer_email = $accountId[0];
        $order->customer_phone = $accountId[1];
        $order->update();

        $json = json_encode([
            'request' => $request->toArray(),
        ]);

        $template = view('email.order', ['order' => $order])->render();
        $user = User::where('id', auth()->id())->firstOrFail();

        try {
            \Mail::raw('Бронирование места на мероприятии '. env('APP_NAME'), function ($message) use ($user, $template){
                $message->from(env('MAIL_USERNAME'));
                $message->to($user->email);
                $message->setContentType('text/html');
                $message->subject($template);
            });
        }catch (\Swift_TransportException $exception){
            return redirect()->back()->withErrors('Неполадки сети. Позже попробуйте ещё раз.');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('ООПС..! Непредвиденная ошибка.');
        }


        return $json;
    }
}








































