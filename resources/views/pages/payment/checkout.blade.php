
<h1>Предварительный просмотр заказа</h1>
<p>Заказ № {{$order->id}}</p>
<p>Организатор: {{$order->organizer_name}}</p>
<p>Категория: {{$order->category}}</p>
<p>Покупатель имя: {{$order->customer_name}}</p>
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
<p>Цена: {{ $order->price_variant }}</p>
<p>Начало: {{ $order->date_start_variant }}</p>
<p>Окончание: {{ $order->date_end_variant }}</p>
<p>Краткое описание: {{ $order->text_variant }}</p>

<form>
    <input type="button" value="Перейти на страницу оплаты">
</form>
