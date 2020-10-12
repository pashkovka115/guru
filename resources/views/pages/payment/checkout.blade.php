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
                            {{--<div class="customer-block">
                                <p class="customer-text--m"><input type="checkbox" name="order-check"> Отправить мне уведомление, о регистрации на email.</p>
                            </div>--}}
                        </div>
                        <div class="payment__order-details">
                            <p class="payment__number">Мероприятие: <span>{{$order->tour_title}}</span></p>
                            <div class="payment__customer-data">
                                <div class="customer-block">
                                    <p class="customer-text">
                                        <span>Организатор мероприятия:</span> {{$order->organizer_name}}</p>
                                    <p class="customer-text"><span>Категория мероприятия:</span> {{$order->category}}
                                    </p>
                                </div>
                                <div class="customer-block">
                                    <p class="customer-text"><span>Адрес проведения:</span> {{$order->address}}</p>
                                </div>
                                <div class="customer-block">
                                    <p class="customer-text">
                                        <span>Дата начала мероприятия:</span> {{ $order->date_start_variant }}</p>
                                    <p class="customer-text">
                                        <span>Дата окончания мероприятия:</span> {{ $order->date_end_variant }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="payment__order-details">
                            <p class="payment__number">Оплата</p>
                            <div class="payment__customer-data">
                                <div class="customer-block">
                                    <p class="customer-text"><span>Полная стоимость:</span> {{ $order->price_variant }}
                                        RUB</p>
                                    <p class="customer-text"><span>Стоимость бронирования:</span> {{ $order->deposit }}
                                        ({{ $order->rate }}%) RUB</p>
                                </div>
                                <div class="customer-block">
                                    <p class="customer-to-pay"><span>Итого к оплате:</span> {{ $order->deposit }} RUB
                                    </p>
                                    {{--                                    <p class="customer-description">Далее Вам нужно выбрать способ оплаты и нажать кнопку — <span>"Оплатить"</span></p>--}}
                                </div>
                            </div>
                        </div>
                        <div class="payment__form-payment">
                            <button id="payning_btn" type="submit" class="btn-booking">Оплатить картой</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="payment__cancel-return">
                        <p class="payment__subtitle">Отмена и возврат</p>
                        <p class="customer-description">Получите полный возврат средств, если отмените подписку за 30+
                            дней до начала мероприятия. Если вы отмените 15-29 дней до начала мероприятия, 50% вашего
                            депозита будет возвращено. При отмене за 0-14 дней до мероприятия ваш депозит не
                            возвращается.</p>
                        <p class="customer-description">Оставшаяся сумма оплачивается по прибытии на мероприятие.</p>
                        <p class="customer-description">Если лидер отступления отменяет мероприятие, мы вернем вам 100%
                            вашего депозита, без потерь.</p>
                        <p class="customer-description">Пожалуйста, не бронируйте авиабилеты, пока руководитель ретрита
                            не подтвердит ваше бронирование.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts_footer')
    <script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>
    <script>
        var widget = new cp.CloudPayments({googlePaySupport: false, applePaySupport: false});
        this.pay = function () {
            widget.pay('auth', // или 'charge'
                { //options
                    publicId: 'pk_a95a234965acebe9c94777d1473a7', //id из личного кабинета
                    description: 'Оплата мероприятия в GuruFor', //назначение
                    amount: {{ $order->deposit }}, //сумма
                    currency: 'RUB', //валюта
                    invoiceId: {{$order->id}}, //номер заказа  (необязательно)
                    accountId: "{{$order->customer_email}}___{{$order->customer_phone or ''}}", //идентификатор плательщика (необязательно)
                    skin: "classic", //дизайн виджета (необязательно)
                    data: {
                        myProp: 'myProp value'
                    }
                },
            )
        };

        $('#payning_btn').click(pay);
    </script>
@endsection
@endsection
