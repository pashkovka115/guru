<p>Заказ № {{$order->id}}</p>
<div>
    <div>
        <p><span>Ваше имя:</span> {{ $order->customer_name }}</p>
        <p><span>Ваш телефон:</span> {{$order->customer_phone}}</p>
    </div>
    <div>
        <p><span>Ваш email:</span> {{$order->customer_email}}</p>
        <p><span>Оплата мероприятия:</span> {{$order->payment_desc}}</p>
    </div>
</div>