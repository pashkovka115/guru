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
                                @php

                                    $var_start = \Carbon\Carbon::create($order->date_start_variant);
                                    $var_end = \Carbon\Carbon::create($order->date_end_variant);
//dd($my_purchase);
                                @endphp
                                <div class="customer-block">
                                    <p class="customer-text">
                                        <span>Дата начала мероприятия:</span> {{ $var_start->formatLocalized('%e %B %Y') }}</p>
                                    <p class="customer-text">
                                        <span>Дата окончания мероприятия:</span> {{ $var_end->formatLocalized('%e %B %Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="payment__order-details">
                            <p class="payment__number">Оплата</p>
                            <div class="payment__customer-data">
                                <div class="customer-block">
                                    <p class="customer-text"><span>Полная стоимость:</span> {{ number_format($order->price_variant, 0, ',', ' ') }}
                                        RUB</p>
                                    <p class="customer-text"><span>Стоимость бронирования:</span> {{ number_format($order->deposit, 0, ',', ' ') }}
                                        ({{ $order->rate }}%) RUB</p>
                                </div>
                                <div class="customer-block">
                                    <p class="customer-to-pay"><span>Итого к оплате:</span> {{ number_format($order->deposit, 0, ',', ' ') }} RUB
                                    </p>
                                    {{--                                    <p class="customer-description">Далее Вам нужно выбрать способ оплаты и нажать кнопку — <span>"Оплатить"</span></p>--}}
                                </div>
                            </div>
                        </div>

                        <div class="customer-block bg-danger text-white">
                            @php
                            $pass = session()->get('password_pay', false);
                            @endphp
                            @if($pass)
                            <p class="customer-text p-1"><span>Внимание! </span>Это временный пароль: <b>{{ $pass }}</b> запишите его.</p>
                            @endif
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

    <div id="fail-modal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ошибка платежа</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">Произошла ошибка. Пожалуйста повторите операцию ещё раз.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Попробывать ещё раз</button>
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>

    <div id="site-fail-modal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Платёж совершен успешно, но результат на сайт не дошел.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">
                        Произошла ошибка. Пожалуйста обратитесь к администрации сайта.
                        Платёж совершен успешно, но результат до администрации сайта не дошел.
                        При обращении пожалуйста:
                    </p>
                    <ol>
                        <li>предоставьте ссылку на эту страницу</li>
                        <li>номер заказа</li>
                        <li>сумма оплаты</li>
                        <li>дата оплаты (по возможности и время оплаты)</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Попробывать ещё раз</button>
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>

    <div id="success-modal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Оплата прошла успешно.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-info">Описание что делать покупателю дальше после оплаты.</p>
                    <p>
                        <a href="{{ route('site.main') }}">На главную</a>
                        <a href="{{ route('site.catalog.category.list') }}">В каталог</a>
                        <a href="{{ route('site.cabinet.purchases.index') }}">В личный кабинет</a>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Закрыть</button>
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
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
                {
                    onSuccess: function (options) { // success
                        {{--options["csrf-token"] = "{{ csrf_token() }}"--}}

                        $.ajax({
                            method: "POST",
                            url: "{{ route('customer.paid') }}",
                            data: options,
                            beforeSend: function(request) {
                                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                            },
                            success: function (){
                                $('#success-modal').modal();
                            },
                            error: function (){
                                $('#site-fail-modal').modal();
                            }

                        });
                        // после ajax-запроса выскочит модальное окно
                        // todo: надо сделать анимацию ожидания ответа от сервера
                        // $('#success-modal').modal();
                        //действие при успешной оплате  customer.paid
                        console.log('действие при успешной оплате', options)
                    },
                    onFail: function (reason, options) { // fail
                        $('#fail-modal').modal();
                    },
                    onComplete: function (paymentResult, options) { //Вызывается как только виджет получает от api.cloudpayments ответ с результатом транзакции.
                        //например вызов вашей аналитики Facebook Pixel
                        // console.log('результаты транзакции', paymentResult, options)
                    }
                }
            )
        };

        $('#payning_btn').click(pay);
    </script>
@endsection
@endsection
