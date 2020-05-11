@extends('layouts.app')
@section('content')
    <div class="block_autor_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="block_autor_info">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="owl-carousel owl-theme slide-autor">
                                    <div class="item">
                                        <div class="event-gallery-small__block">
                                            <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg_new.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg_new.jpg') }}');"></div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="event-gallery-small__block">
                                            <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg.png') }}');"></div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="event-gallery-small__block">
                                            <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg_new.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg_new.jpg') }}');"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="event-gallery-none">
                                    <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg_new.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg_new.jpg') }}');">Другие фото</div>
                                    <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg.png') }}');"></div>
                                    <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg_new.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg_new.jpg') }}');"></div>
                                    <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg.png') }}');"></div>
                                    <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg_new.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg_new.jpg') }}');"></div>
                                    <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg.png') }}');"></div>
                                    <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg_new.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg_new.jpg') }}');"></div>
                                    <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg.png') }}');"></div>
                                    <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg_new.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg_new.jpg') }}');"></div>
                                    <div data-fancybox="gallery" href="{{ asset('assets/site/images/home_bg.jpg') }}" style="background-image: url('{{ asset('assets/site/images/home_bg.png') }}');"></div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="autor_info__elem">
                                    <h1 class="title-autor">{{ $user->name }}</h1>
                                    <div class="rating-autor">
                                        <div class="rating">
                                            {!! get_raiting_template($rating_leader, false) !!}
                                            <a href="#reviews" class="review-count">{{ Lang::choice('Отзыв|Отзыва|Отзывов', $comments->count()) }} - <span>{{ $comments->count() }}</span></a>
                                        </div>
                                    </div>
                                    <div class="country-autor">
                                        <i class="fa fa-home"></i>
                                        <span>{{ $user->profile->country ?? null }}, {{ $user->profile->city ?? null }}</span>
                                        <a href="#" class="link-location"><i class="fa fa-location-arrow"></i></a>
                                    </div>
                                    <div class="about-autor">
                                        <h2 class="event-subtitle">Об авторе</h2>
                                        <p class="text-normal">{{ $user->profile->description ?? null }}</p>
                                    </div>
                                    <div class="tags-autor">
                                        @php
                                            $tours = $user->tours_with_category;
                                            if ($tours){
                                                $cats = [];
                                                foreach ($tours as $tour) {
                                                      if (!in_array($tour->category->id, $cats)){
                                                          echo "<a href=\"".route('site.catalog.category.name', ['id' => $tour->category->id])."\">{$tour->category->title}</a>";
                                                      }
                                                    $cats[] = $tour->category->id;
                                                }
                                            }
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-details-accordion">
                        <div class="event-accordion accordion-autor-retreat">
                            <div class="accordion-btn">Мероприятия:</div>
                            <div class="panel article">
                                <ul class="list_similar_events">

                                    @foreach($user->tours_with_category as $tour)
                                        @php
                                            $start = \Carbon\Carbon::create($tour->date_start);
                                            $end = \Carbon\Carbon::create($tour->date_end);
                                            $diff = $start->diffInDays($end);
                                        @endphp
                                    <li class="similar_events_elem">
                                        <a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}" class="similar-link">
                                            <img src="{{ asset('assets/site/images/home_bg_new.jpg') }}" alt="" class="img-fluid">
                                            <p>{{ $tour->title }}</p>
                                            <p class="dates-event">
                                                <span>
                                                    {{ $start->formatLocalized('%e %B') }}
                                                    - {{ $end->formatLocalized('%e %B %Y') }}
                                                    ( {{ $diff }} {{ Lang::choice('День|Дня|Дней', $diff) }} )
                                                </span>
                                            </p>
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="event-details-accordion" id="reviews">
                        <div class="event-accordion accordion-reviews">
                            <div class="accordion-btn">Отзывы клиентов:</div>
                            <div class="panel reviews-read">
                                @if($rating_leader > 0)
                                <div class="rating-accordion-block">
                                    <div class="rating-accordion">
                                        <div class="rating">

                                            {!! get_raiting_template($rating_leader) !!}
                                            <span class="review-text">Средний рейтинг {{ $rating_leader }} из 5.0</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <p class="title-shedule">Отзывов - {{ $comments->count() }}</p>
                                <div class="block-reviews">
                                    @foreach($comments as $comment)
                                    <article class="block-reviews_elem article">
                                        <div class="review_header">
                                            <p class="title-review">{{ $comment->title }}</p>
                                            <div class="rating">
                                                {!! get_raiting_template($comment->rating) !!}
                                            </div>
                                        </div>
                                        <div class="review_main">
                                            <p class="text-review">{{ $comment->comment }}</p>
                                        </div>
                                        <div class="review_footer">
                                            <span class="review-autor">{{ $comment->user->name }}</span> -
                                            <span class="review-date">{{ $comment->created_at->formatLocalized('%e %B %Y') }}</span>
                                        </div>
                                    </article>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="block-question-autor">
                        <div class="question-autor">
                            <p class="note-schedule">Вы можете задать вопрос автору <span>мероприятия</span>, а также оставить отзыв!</p>
                            <a href="" class="btn-booking" data-src="#form-autor" data-fancybox="">Задать вопрос</a>
{{--                            <div class="review-aut">Чтобы задать вопрос <a href="{{ route('login') }}">авторизуйтесь</a>.</div>--}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('popap_form')
    <div class="fancybox-content" id="form-autor" style="display: none;">
        <div class="form-autor-content">
            <div class="form-autor-block">
                <div class="form-title">Связаться с автором мероприятия</div>
                <form action="{{ route('site.send-message-to-leader') }}" autocomplete="off" method="post">
                    @csrf
                    <input type="hidden" name="leader" value="{{ $user->id }}">
                    <div class="form-reviews-block"><span>Ваше имя*</span><input type="text" name="name" required/></div>
                    <div class="form-reviews-block"><span>Email*</span><input type="email" name="email" required/></div>
                    <div class="form-reviews-block"><span>Телефон*</span><input type="tel" name="phone" required/></div>
                    <div class="form-reviews-block"><span>Ваше сообщение*</span><textarea type="text" name="message" required></textarea></div>
                    <div class="form-reviews-block"><button type="submit">Отправить сообщение</button></div>
                </form>
            </div>
            <div class="form-autor-block">
                <div class="form-autor_photo">
                    <img src="{{ asset('assets/site/images/slider_img_autor.jpg') }}" alt="" class="img-fluid">
                    <p class="form-autor_name">{{ $user->name }}</p>
                    <div class="country-autor">
                        <i class="fa fa-home"></i>
                        <span>{{ $user->profile->country ?? null }}, {{ $user->profile->city ?? null }}</span>
                        <a href="#" class="link-location"><i class="fa fa-location-arrow"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
