@extends('layouts.app')
@section('content')
    <h1>Предварительный просмотр заказа</h1>
    <p>Заказ № {{$order->id}}</p>
    <p>Организатор: {{$order->organizer_name}}</p>
    <p>Категория: {{$order->category}}</p>
    <p>Покупатель имя: {{ $order->customer_name }}</p>
    <p>Покупатель email: {{$order->customer_email}}</p>
    <p>Покупатель телефон: {{$order->customer_phone}}</p>
    <p>Мероприятие: {{$order->tour_title}}</p>
    <p>{{$order->payment_desc}}</p>
    <p>Полный адрес: {{$order->address}}</p>
    <p>Улица: {{$order->street}}</p>
    <p>Дом: {{$order->house}}</p>
    <p>Область/Штат/Край: {{$order->region}}</p>
    <p>Город: {{$order->city}}</p>
    <p>Страна: {{$order->country}}</p>
    <p>Координаты: {{ $order->latitude }} - {{ $order->longitude }}</p>
    <p>Цена мероприятия: {{ $order->price_variant }}</p>
    <p>Надбавка: {{ $order->deposit }} ({{ $order->rate }}%)</p>
    <p>Начало: {{ $order->date_start_variant }}</p>
    <p>Окончание: {{ $order->date_end_variant }}</p>
    <p>Краткое описание: {{ $order->text_variant }}</p>
    <h6>К оплате: {{ $order->deposit }}</h6>

{{--    <p><a href="{{ route('customer.order.init_payment', ['id' => $order->id]) }}">Перейти на страницу оплаты</a></p>--}}

    <form action="{{ route('customer.order.init_payment', ['id' => $order->id]) }}" method="get">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Способ оплаты</label>
            <select name="paymentType" class="form-control" id="exampleFormControlSelect1">
                <option value="card">Пластиковые карты</option>
                <option value="mc">Мобильный платеж</option>
                <option value="webmoney">WebMoney Z</option>
                <option value="webmoneyWmr">WebMoney R</option>
                <option value="yandex">Яндекс.Деньги</option>
                <option value="qiwi">Qiwi</option>
                <option value="paypal">PayPal</option>
                <option value="alfaClick">Альфа-Клик</option>
                <option value="applepay">Apple Pay</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mb-2">Перейти на страницу оплаты</button>
    </form>

@endsection
