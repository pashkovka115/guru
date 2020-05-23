@foreach($tours as $tour)
    <div class="col-lg-12">
        <div class="event_list">
            <div class="owl-carousel owl-theme slide-cat event_list_photo">
                @php
                    $gallery = json_decode($tour->gallery) ?? [];
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
                        @if($leader->profile->avatar)
                            <a href="{{ route('site.author.show', ['id' => $leader->id]) }}" title="{{ $leader->name }}">
                                <?php $arr_img = json_decode($leader->profile->avatar);
                                if (isset($arr_img[0])): ?>
                                <img src="{{ $arr_img[0] }}" alt="аватар"
                                     class="img-fluid">
                                <?php endif; ?>
                            </a>
                        @else
                            <a href="{{ route('site.author.show', ['id' => $leader->id]) }}" title="{{ $leader->name }}">
                                <span>{{ $leader->name }}</span>
                            </a>
                        @endif
                    @endforeach
                    <em>Ваши гиды</em>
                </div>
            @endif
            <div class="event__list_block">
                <a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}"
                   class="title-event">
                    @php
                        $variants = $tour->variants;
                        if (isset($variants[0])) {
                            if ((bool)$variants[0]->date_start_variant and (bool)$variants[0]->date_end_variant){
                                $start = \Carbon\Carbon::create($variants[0]->date_start_variant);
                                $end = \Carbon\Carbon::create($variants[0]->date_end_variant);
                                $diff = $start->diffInDays($end);

                                echo $tour->title . ', ' . $start->formatLocalized('%e %B %Y');
                            }
                        }else{
                            echo $tour->title;
                        }
                    @endphp
                </a>
                <a href="#" class="location-event">
                    {{ $tour->city }}, {{ $tour->country }}
                </a>
                @if(isset($variants[0]) and (bool)$variants[0]->date_start_variant and (bool)$variants[0]->date_end_variant)
                    <p class="dates-event">
                        <span>
                            {{ $start->formatLocalized('%e %B') }}
                            - {{ $end->formatLocalized('%e %B %Y') }}
                            ( {{ $diff }} {{ Lang::choice('День|Дня|Дней', $diff) }} )
                        </span>
                        @if($tour->variants->count() > 1)
                            <a class="toggle-dates-event">Другие даты</a>
                        @endif
                    </p>
                @endif
                <ul class="event-highlights">
                    @if($tour->info_excerpt)
                        <li class="event-highlights-icon">
                            <img
                                src="{{ asset('assets/site/images/event-highlights-icon-events-01.svg') }}"
                                alt="" class="img-fluid">
                            <span>{{ mb_strimwidth(strip_tags($tour->info_excerpt), 0, 70, '...') }}</span>
                        </li>
                    @endif
                    @if($tour->transfer_free or $tour->transfer_fee or $tour->not_transfer)
                        <li class="event-highlights-icon">
                            <img
                                src="{{ asset('assets/site/images/event-highlights-icon-transfer-02.svg') }}"
                                alt="" class="img-fluid">
                            <span>
                                                        <?php
                                $prop = [];
                                if ($tour->transfer_free) $prop[] = 'Траснфер бесплатно';
                                if ($tour->transfer_fee) $prop[] = 'Траснфер за доп.плату';
                                if ($tour->not_transfer) $prop[] = 'Добираетесь сами';
                                echo implode(', ', $prop);
                                ?>
                                                </span>
                        </li>
                    @endif
                    @if($tour->count_person)
                        <li class="event-highlights-icon">
                            <img
                                src="{{ asset('assets/site/images/event-highlights-icon-people-03.svg') }}"
                                alt="" class="img-fluid">
                            <span>{{ $tour->count_person }}</span>
                        </li>
                    @endif
                    @if($tour->count_meals)
                        <li class="event-highlights-icon">
                            <img
                                src="{{ asset('assets/site/images/event-highlights-icon-meals-04.svg') }}"
                                alt="" class="img-fluid">
                            <span>{{ $tour->count_meals }}</span>
                        </li>
                    @endif
                    @if($tour->private_room or $tour->dormitory_room or $tour->separate_house)
                        <li class="event-highlights-icon">
                            <img
                                src="{{ asset('assets/site/images/event-highlights-icon-room-05.svg') }}"
                                alt="" class="img-fluid">
                            <span>
                                                        <?php
                                $prop = [];
                                if($tour->private_room) $prop[] = 'Отдельный номер';
                                if($tour->dormitory_room) $prop[] = 'Общий номер';
                                if($tour->separate_house) $prop[] = 'Отдельный домик';
                                echo implode(', ', $prop);
                                ?>
                                                </span>
                        </li>
                    @endif
                </ul>
                @if($tour->rating > 0)
                    <div class="rating-event">
                        <div class="rating">
                            {!! get_raiting_template($tour->rating) !!}
                            @if($tour->comments->count() > 0)
                                <span
                                    class="review-count">({{ $tour->comments->count() }} {{ Lang::choice('Отзыв|Отзыва|Отзывов', $tour->comments->count()) }})</span>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="event-footer">
                    <div class="event-tags">
                        <?php
                        if ($tour->tags) {
                            foreach ($tour->tags as $tag) {
                                echo "<a href=\"" . route('site.catalog.tag.show', ['tag' => $tag->id]) . "\">{$tag->tag}</a>";
                            }
                        }
                        ?>
                    </div>
                    <div class="event-cost">
                        @if($tour->variants->count() > 0)
                            {{ number_format($tour->variants[0]->price_variant / 100) }} RUB
                        @endif
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

<div id="remove_el" class="col-lg-12 after-posts">
    <script>
        $('.slide-cat').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            dots: false,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:1,
                    nav:true
                },
                1000:{
                    items:1,
                    nav:true
                }
            }
        });
    </script>
    <button type="button" class="btn-load-more" id="btn-load-more" data-next-url="{{ $tours->nextPageUrl() }}">
        Показать еще
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
    </button>
</div>
