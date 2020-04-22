@extends('layouts.app')
@section('content')
    <div class="block_category">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Каталог</h1>
                </div>
                <div class="col-lg-12">
                    <div class="block_seo_cat">
                        <img src="{{ $category->img }}" alt="" class="img-fluid img-cat-seo">
                        {{ $category->description }}
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="cat_nav">
                        <ul class="cat_nav__menu">
                            <li><a href="#" class="active">Мероприятия (777)</a></li>
                            <li><a href="#">Учителя и Авторы (888)</a></li>
                            <li><a href="#">Организации (999)</a></li>
                        </ul>
                        <div class="sort">
                            <span>Сортировать по:</span>
                            <select id="sortby">
                                <option value="popular">Популярности</option>
                                <option value="date-start">Дате начала</option>
                                <option value="price-low">Цена(по возрастанию)</option>
                                <option value="price-high">Цена(по убыванию)</option>
                            </select>
                        </div>
                    </div>
                    <div class="cat_container">
                        <div class="row">
                            @foreach($category->tours_with_variants as $tour)
                            <div class="col-lg-12">
                                <div class="event_list">
                                    <div class="owl-carousel owl-theme slide-cat event_list_photo">
                                        @php
                                        $gallery = json_decode($tour->gallery);
                                        //var_dump($gallery, '===========');
                                        @endphp
                                        @foreach($gallery as $src)
                                        <div class="item">
                                            <a href="" class="event_list__link">
                                                @php
                                                    //var_dump($src);
                                                @endphp
                                                <img src="{{ $src }}" alt="" class="img-fluid event_list_img">
                                            </a>
                                        </div>
                                        @endforeach
                                        <div class="item">
                                            <a href="" class="event_list__link">
                                                <img src="{{ asset('assets/site/images/home_bg_new.jpg') }}" alt="" class="img-fluid event_list_img">
                                            </a>
                                        </div>
                                        <div class="item">
                                            <a href="" class="event_list__link">
                                                <img src="{{ asset('assets/site/images/home_bg_new.jpg') }}" alt="" class="img-fluid event_list_img">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="event_list__autor">
                                        <a href="#" title="Имя автора">
                                            <img src="{{ asset('assets/site/images/slider_img_autor.jpg') }}" alt="аватар" class="img-fluid">
                                        </a>
                                        <a href="#" title="Имя автора">
                                            <img src="{{ asset('assets/site/images/slider_img_autor.jpg') }}" alt="аватар" class="img-fluid">
                                        </a>
                                        <a href="#" title="Имя автора">
                                            <img src="{{ asset('assets/site/images/slider_img_autor.jpg') }}" alt="аватар" class="img-fluid">
                                        </a>
                                        <em>Ваш гиды</em>
                                    </div>
                                    <div class="event__list_block">
                                        <a href="{{ route('site.catalog.tour.show', ['tour' => $tour->id]) }}" class="title-event">
                                            @php
                                                $start = \Carbon\Carbon::create($tour->date_start);
                                                $end = \Carbon\Carbon::create($tour->date_end);
                                                $diff = $start->diffInDays($end);
                                            @endphp
                                            {{ $tour->title }}, {{ $start->formatLocalized('%e %B %Y') }}
                                        </a>
                                        <a href="#" class="location-event">
                                            {{ $tour->city }}, {{ $tour->country }}
                                        </a>
                                        <p class="dates-event">
                                            <span>
                                {{ $start->formatLocalized('%e %B') }}
                                - {{ $end->formatLocalized('%e %B %Y') }}
                                ( {{ $diff }} {{ Lang::choice('День|Дня|Дней', $diff) }} )
                                            </span>
                                            <a class="toggle-dates-event">Другие даты</a>
                                        </p>
                                        <ul class="event-highlights">
                                            @if($tour->info_excerpt)
                                            <li class="event-highlights-icon">
                                                <img src="{{ asset('assets/site/images/event-highlights-icon-events-01.svg') }}" alt="" class="img-fluid">
                                                <span>{{ mb_strimwidth($tour->info_excerpt, 0, 70, '...') }}</span>
                                            </li>
                                            @endif
                                            @if($tour->transfer_free or $tour->transfer_fee)
                                            <li class="event-highlights-icon">
                                                <img src="{{ asset('assets/site/images/event-highlights-icon-transfer-02.svg') }}" alt="" class="img-fluid">
                                                <span>
                                                    @if($tour->transfer_free) Бесплатный трансфер @endif
                                                    @if($tour->transfer_fee) Трансфер за дополнительную плату @endif
                                                </span>
                                            </li>
                                            @endif
                                            @if($tour->count_person)
                                            <li class="event-highlights-icon">
                                                <img src="{{ asset('assets/site/images/event-highlights-icon-people-03.svg') }}" alt="" class="img-fluid">
                                                <span>{{ $tour->count_person }}</span>
                                            </li>
                                            @endif
                                            @if($tour->meals_desc)
                                            <li class="event-highlights-icon">
                                                <img src="{{ asset('assets/site/images/event-highlights-icon-meals-04.svg') }}" alt="" class="img-fluid">
                                                <span>{{ mb_strimwidth($tour->meals_desc, 0, 70, '...') }}</span>
                                            </li>
                                            @endif
                                            @if($tour->private_room or $tour->dormitory_room or $tour->separate_house)
                                            <li class="event-highlights-icon">
                                                <img src="{{ asset('assets/site/images/event-highlights-icon-room-05.svg') }}" alt="" class="img-fluid">
                                                <span>
                                                    @if($tour->private_room) Отдельный номер @endif
                                                    @if($tour->dormitory_room) Общий номер @endif
                                                    @if($tour->separate_house) Отдельный домик @endif
                                                </span>
                                            </li>
                                            @endif
                                        </ul>
                                        <div class="rating-event">
                                            <div class="rating">
												{!! get_raiting_template($tour->rating) !!}
                                                <span class="review-count">(32 отзывов)</span>
                                            </div>
                                        </div>
                                        <div class="event-footer">
                                            <div class="event-tags">
                                                <a href="#">Категория1</a>
                                            </div>
                                            <div class="event-cost">
                                                {{ number_format($tour->price_base / 100) }} RUB
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="event_list_more">
                                    <p class="text-normal">Другие даты:</p>
                                    <ul class="list_more_events">
                                        @foreach($tour->variants as $variant)
                                        <li class="more_events_elem">
                                            @php
                                                $var_start = \Carbon\Carbon::create($variant->date_start_variant);
                                                $var_end = \Carbon\Carbon::create($variant->date_end_variant);
                                                $var_diff = $var_start->diffInDays($var_end);
                                            @endphp
                                            <img src="{{ asset('assets/site/images/home_bg_new.jpg') }}" alt="" class="img-fluid">
                                            <div class="more_events_info">
                                                <a href="#" class="more-title-event">
                                                    {{ $tour->title }}
                                                </a>
                                                <p class="more-dates-event">
                                                    <span>
{{ $var_start->formatLocalized('%e %B %Y') }}
- {{ $var_end->formatLocalized('%e %B %Y') }}
( {{ $var_diff }} {{ Lang::choice('День|Дня|Дней', $var_diff) }} )
                                                    </span>
                                                </p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts_footer')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
