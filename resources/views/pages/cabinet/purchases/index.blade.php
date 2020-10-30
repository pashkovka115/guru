@extends('layouts.app')

@section('styles')
    @include('pages.cabinet.styles')
@endsection

@section('scripts')
    @include('pages.cabinet.scripts')
@endsection

@section('content')
    <div class="block_personal_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('parts.cabinet.menu')
                    <div class="personal_events">
                        <h1 class="user-title">Покупки</h1>
                    </div>
                        @if($my_purchases->count() == 0 and $purchases_from_me->count() == 0)
                        <div class="personal_status">
                            <p class="text-normal">В данный момент у вас нет покупок!</p>
                        </div>
                        @endif
                        @if($my_purchases->count() == 0)
                        <div class="personal_status">
                            <p class="text-normal">Как только вы сделаете свою первую покупку, она отобразится
                                здесь.</p>
                        </div>
                        @endif
                    @if($my_purchases->count() > 0)
                        <div class="personal_events">
                            <h2 class="user-subtitle">Ваши покупки:</h2>
                        </div>
                        <div class="sale_status_events">
                            <div class="row">

                                @foreach($my_purchases as $my_purchase)
                                    @php
                                        $var_start = \Carbon\Carbon::create($my_purchase->date_start_variant);
                                        $var_end = \Carbon\Carbon::create($my_purchase->date_end_variant);
                                    @endphp
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <a href="{{ route('site.catalog.tour.show', ['event' => $my_purchase->tour_id]) }}" class="elem__featured_tour">
                                            <div class="elem__featured_more">
                                                <img src="{{ asset('assets/site/images/home_bg_new.jpg') }}" alt=""
                                                     class="img-fluid">
                                                <p class="cost-tour">
                                                    {{ number_format($my_purchase->price_variant, 0, ',', ' ') }} RUB
                                                </p>
                                            </div>
                                            <div class="location-tour">
                                                {{ $my_purchase->city }}, {{ $my_purchase->country }}
                                            </div>
                                            <div class="title-tour">
                                                {{--                                        Пляж Санта-Роза, Апрель 2020--}}
                                                {{ $my_purchase->tour_title }}
                                                , {{ $var_start->formatLocalized('%e %B %Y') }}

                                                {{--                                        {{ $my_purchase->date_start_variant }}--}}
                                            </div>
                                            <p class="dates-tour">
                                                {{--                                        <span>Апрель 30 - Мая 3, 2020</span>--}}
                                                {{--                                        <span>{{ $my_purchase->date_end_variant }}</span>--}}
                                                <span>{{ $var_end->formatLocalized('%e %B %Y') }}</span>
                                            </p>
                                            <div class="personal_events_paid">
                                                {{--                    todo: статус руссифицировать                    --}}
                                                <span>
                                                    @if($my_purchase->status == 'paid')
                                                        Оплачено
                                                    @else
                                                        Не оплачено
                                                    @endif
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif
                    @if($purchases_from_me->count() > 0)
                    <div class="personal_events">
                        <h2 class="user-subtitle">Мероприятия купленные у вас:</h2>
                    </div>
{{--@php dump($purchases_from_me) @endphp--}}
                    <div class="sale_status_events">
                        <div class="row">
                            @foreach($purchases_from_me as $purchase_from_me)
                                @php
                                    $var_start = \Carbon\Carbon::create($purchase_from_me->date_start_variant);
                                    $var_end = \Carbon\Carbon::create($purchase_from_me->date_end_variant);
                                @endphp
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="elem__featured_tour">
                                    <div class="elem__featured_more">
                                        <img src="{{ asset('assets/site/images/home_bg_new.jpg') }}" alt=""
                                             class="img-fluid">
                                        <p class="cost-tour">
{{--                                            33,000 RUB--}}
                                            {{ number_format($purchase_from_me->price_variant, 0, ',', ' ') }} RUB
                                        </p>
                                    </div>
                                    <div class="location-tour">
{{--                                        Флорида, США--}}
                                        {{ $purchase_from_me->city }}, {{ $purchase_from_me->country }}
                                    </div>
                                    <div class="title-tour">
{{--                                        Пляж Санта-Роза, Апрель 2020--}}
                                        {{ $purchase_from_me->tour_title }}, {{ $var_start->formatLocalized('%e %B %Y') }}
                                    </div>
                                    <p class="dates-tour">
{{--                                        <span>Апрель 30 - Мая 3, 2020</span>--}}
                                        <span>{{ $var_end->formatLocalized('%e %B %Y') }}</span>
                                    </p>

                                    <div class="personal_events_paid">
{{--                                        <span>Оплачено</span>--}}
                                        <span>{{ $purchase_from_me->tour_title }}</span>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
