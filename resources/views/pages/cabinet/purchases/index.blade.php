@extends('layouts.app')

@section('content')
    <div class="block_personal_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('parts.cabinet.menu')
                    <div class="personal_events">
                        <h1 class="user-title">Покупки (скоро будут)</h1>
                    </div>
                    <div class="personal_status">
                        <p class="text-normal">В данный момент у вас нет покупок!</p>
                        <p class="text-normal">Как только вы сделаете свою первую покупку, она отобразится здесь.</p>
                        <p class="text-normal">Как только будет сделана первая покупка вашего мероприятия, она отобразится здесь.</p>
                    </div>
                    <div class="personal_events">
                        <h2 class="user-subtitle">Ваши покупки:</h2>
                    </div>
                    <div class="sale_status_events">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="elem__featured_tour">
                                    <div class="elem__featured_more">
                                        <img src="{{ asset('assets/site/images/home_bg_new.jpg') }}" alt="" class="img-fluid">
                                        <p class="cost-tour">
                                            33,000 RUB
                                        </p>
                                    </div>
                                    <div class="location-tour">
                                        Флорида, США
                                    </div>
                                    <div class="title-tour">
                                        Пляж Санта-Роза, Апрель 2020
                                    </div>
                                    <p class="dates-tour">
                                        <span>Апрель 30 - Мая 3, 2020</span>
                                    </p>
                                    <div class="rating-tour">
                                        <div class="rating">
													<span class="rating-star-display">
														<span class="rating-star-solid"></span>
														<span class="rating-star-solid"></span>
														<span class="rating-star-solid"></span>
														<span class="rating-star-solid"></span>
														<span class="rating-star-half"></span>
														<span class="rating-value">4.5</span>
													</span>
                                            <span class="review-count">(32 отзывов)</span>
                                        </div>
                                    </div>
                                    <div class="personal_events_paid">
                                        <span>Оплачено</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="elem__featured_tour">
                                    <div class="elem__featured_more">
                                        <img src="{{ asset('assets/site/images/home_bg_new.jpg') }}" alt="" class="img-fluid">
                                        <p class="cost-tour">
                                            33,000 RUB
                                        </p>
                                    </div>
                                    <div class="location-tour">
                                        Флорида, США
                                    </div>
                                    <div class="title-tour">
                                        Пляж Санта-Роза, Апрель 2020
                                    </div>
                                    <p class="dates-tour">
                                        <span>Апрель 30 - Мая 3, 2020</span>
                                    </p>
                                    <div class="rating-tour">
                                        <div class="rating">
													<span class="rating-star-display">
														<span class="rating-star-solid"></span>
														<span class="rating-star-solid"></span>
														<span class="rating-star-solid"></span>
														<span class="rating-star-solid"></span>
														<span class="rating-star-half"></span>
														<span class="rating-value">4.5</span>
													</span>
                                            <span class="review-count">(32 отзывов)</span>
                                        </div>
                                    </div>
                                    <div class="personal_events_paid">
                                        <span>Оплачено</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="personal_events">
                        <h2 class="user-subtitle">Мероприятия купленные у вас:</h2>
                    </div>
                    <div class="sale_status_events">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="elem__featured_tour">
                                    <div class="elem__featured_more">
                                        <img src="{{ asset('assets/site/images/home_bg_new.jpg') }}" alt="" class="img-fluid">
                                        <p class="cost-tour">
                                            33,000 RUB
                                        </p>
                                    </div>
                                    <div class="location-tour">
                                        Флорида, США
                                    </div>
                                    <div class="title-tour">
                                        Пляж Санта-Роза, Апрель 2020
                                    </div>
                                    <p class="dates-tour">
                                        <span>Апрель 30 - Мая 3, 2020</span>
                                    </p>
                                    <div class="rating-tour">
                                        <div class="rating">
													<span class="rating-star-display">
														<span class="rating-star-solid"></span>
														<span class="rating-star-solid"></span>
														<span class="rating-star-solid"></span>
														<span class="rating-star-solid"></span>
														<span class="rating-star-half"></span>
														<span class="rating-value">4.5</span>
													</span>
                                            <span class="review-count">(32 отзывов)</span>
                                        </div>
                                    </div>
                                    <div class="personal_events_paid">
                                        <span>Оплачено</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
