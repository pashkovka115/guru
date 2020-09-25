@extends('layouts.app')
@section('content')
    <div class="payment">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="payment__title">Предварительный просмотр заказа</h1>
                    <div class="payment__info">
                        <p class="payment__number">Заказ № {{$order->id}}</p>
                        <div class="payment__customer-data">
                            <div class="customer-block">
                                <p class="customer-text"><span>Ваше имя:</span> {{ $order->customer_name }}</p>
                                <p class="customer-text"><span>Ваш телефон:</span> {{$order->customer_phone}}</p>
                            </div>
                            <div class="customer-block">
                                <p class="customer-text"><span>Ваш email:</span> {{$order->customer_email}}</p>
                                <p class="customer-text"><span>Оплата мероприятия:</span> {{$order->payment_desc}}</p>
                            </div>
                            <div class="customer-block">
                                <p class="customer-text--m"><input type="checkbox" name="order-check"> Отправить мне уведомление, о регистрации на email.</p>
                            </div>
                        </div>
                        <div class="payment__order-details">
                            <p class="payment__number">Мероприятие: <span>{{$order->tour_title}}</span></p>
                            <div class="payment__customer-data">
                                <div class="customer-block">
                                    <p class="customer-text"><span>Организатор мероприятия:</span> {{$order->organizer_name}}</p>
                                    <p class="customer-text"><span>Категория мероприятия:</span> {{$order->category}}</p>
                                </div>
                                <div class="customer-block">
                                    <p class="customer-text"><span>Адрес проведения:</span> {{$order->address}}</p>
                                </div>
                                <div class="customer-block">
                                    <p class="customer-text"><span>Дата начала мероприятия:</span> {{ $order->date_start_variant }}</p>
                                    <p class="customer-text"><span>Дата окончания мероприятия:</span> {{ $order->date_end_variant }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="payment__order-details">
                            <p class="payment__number">Оплата</p>
                            <div class="payment__customer-data">
                                <div class="customer-block">
                                    <p class="customer-text"><span>Полная стоимость:</span> {{ $order->price_variant }} RUB</p>
                                    <p class="customer-text"><span>Стоимость бронирования:</span> {{ $order->deposit }} ({{ $order->rate }}%) RUB</p>
                                </div>
                                <div class="customer-block">
                                    <p class="customer-to-pay"><span>Итого к оплате:</span> {{ $order->deposit }} RUB</p>
                                    <p class="customer-description">Далее ваш нужно выбрать способ оплаты и нажать кнопку — <span>"Оплатить"</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="payment__form-payment">
                            <form action="{{ route('customer.order.init_payment', ['id' => $order->id]) }}" method="get">
                                <div class="payment__form-select">
                                    <label>Выбрать способ оплаты:</label>
                                    <select name="paymentType">
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
                                <button type="submit" class="btn-booking">Оплатить</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="payment__cancel-return">
                        <p class="payment__subtitle">Отмена и возврат</p>
                        <p class="customer-description">Получите полный возврат средств, если отмените подписку за 30+ дней до начала мероприятия. Если вы отмените 15-29 дней до начала мероприятия, 50% вашего депозита будет возвращено. При отмене за 0-14 дней до мероприятия ваш депозит не возвращается.</p>
                        <p class="customer-description">Оставшаяся сумма оплачивается по прибытии на мероприятие.</p>
                        <p class="customer-description">Если лидер отступления отменяет мероприятие, мы вернем вам 100% вашего депозита, без потерь.</p>
                        <p class="customer-description">Пожалуйста, не бронируйте авиабилеты, пока руководитель ретрита не подтвердит ваше бронирование.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <p><a href="{{ route('customer.order.init_payment', ['id' => $order->id]) }}">Перейти на страницу оплаты</a></p>--}}


@endsection
