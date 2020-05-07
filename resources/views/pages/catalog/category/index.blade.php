@extends('layouts.app')
@section('content')
    <div class="block_category">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Каталог</h1>
                </div>
                <div class="col-lg-12">
                    @include('parts.category_nav')
                    <div class="cat_container">
                        <div class="row">
                            @foreach($tours as $tour)
                            <div class="col-lg-12">
                                <div class="event_list">
                                    <div class="owl-carousel owl-theme slide-cat event_list_photo">
                                        @php
                                        $gallery = json_decode($tour->gallery);
                                        @endphp
                                        @foreach($gallery as $src)
                                        <div class="item">
                                            <a href="" class="event_list__link">
                                                <img src="{{ $src }}" alt="" class="img-fluid event_list_img">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                    @if($tour->leaders->count() > 0)
                                    <div class="event_list__autor">
                                        @foreach($tour->leaders as $leader)
                                            @if($leader->avatar)
                                                <a href="{{ route('site.author.show', ['id' => $leader->id]) }}" title="{{ $leader->name }}">
                                                    <img src="{{ $leader->avatar }}" alt="аватар" class="img-fluid">
                                                </a>
                                            @endif
                                        @endforeach
                                        <em>Ваш гиды</em>
                                    </div>
                                    @endif
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
                                            @if($tour->variants->count() > 0)
                                            <a class="toggle-dates-event">Другие даты</a>
                                            @endif
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
                                        @if($tour->rating > 0)
                                        <div class="rating-event">
                                            <div class="rating">
												{!! get_raiting_template($tour->rating) !!}
                                                @if($tour->comments->count() > 0)
                                                <span class="review-count">({{ $tour->comments->count() }} {{ Lang::choice('Отзыв|Отзыва|Отзывов', $tour->comments->count()) }})</span>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        <div class="event-footer">
                                            <div class="event-tags">
                                                <?php
                                                if ($tour->tags){
                                                    foreach ($tour->tags as $tag){
                                                        echo "<a href=\"".route('site.catalog.tag.show', ['tag'=>$tag->id])."\">{$tag->tag}</a>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="event-cost">
                                                {{ number_format($tour->price_base / 100) }} RUB
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @if($tour->variants->count() > 0)
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
                                @endif
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <script> var next_url_page = '{{ $tours->nextPageUrl() }}'</script>

            <div class="col-lg-12 after-posts">
                <button type="button" class="btn-load-more">
                    Показать еще
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts_footer')
{{--    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>--}}
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />--}}

    <script>
        $(function() {
            $('.btn-load-more').on('click', function(){
                // $('.after-posts').hide();
                const btn = $(this);
                const loader = btn.find('span');
                if(next_url_page === ''){
                    $('.after-posts').hide();
                    return;
                }
                $.ajax({
                    url: next_url_page,
                    type: 'GET',
                    beforeSend: function(){
                        btn.attr('disabled', true);
                        loader.addClass('d-inline-block');
                    },
                    success: function(response){
                        setTimeout(function(){
                            loader.removeClass('d-inline-block');
                            btn.attr('disabled', false);
                            //console.log(response);
                            $('.after-posts').before(response);
                        }, 1000);
                    },
                    error: function(){
                        alert('Ошибка!');
                        loader.removeClass('d-inline-block');
                        btn.attr('disabled', false);
                    }
                });
            });
        });
    </script>

@endsection
