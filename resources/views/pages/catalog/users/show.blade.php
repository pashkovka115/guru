@extends('layouts.app')
@section('content')
    <div class="block_autor_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="block_autor_info">
                        <div class="row">
                            <div class="col-lg-5">
                                <?php
                                $gallery = [];
                                if ($user->profile and isset(json_decode($user->profile->avatar)[0])) {
                                    $gallery[] = json_decode($user->profile->avatar)[0];
                                }
                                if ($user->profile) {
                                    $gallery = array_merge($gallery, (array)json_decode($user->profile->gallery ?: '') ?? []);
                                }
                                ?>
                                <div class="owl-carousel owl-theme slide-autor">
                                    @foreach($gallery as $photo)
                                        <div class="item">
                                            <div class="event-gallery-small__block">
                                                <div data-fancybox="gallery" href="{{ $photo }}"
                                                     style="background-image: url('{{ $photo }}');"></div>
                                            </div>
                                        </div>
                                        @break($loop->iteration == 3)
                                    @endforeach
                                </div>
                                <div class="event-gallery-none">
                                    @foreach($gallery as $photo)
                                        @if($loop->iteration > 3)
                                            <div data-fancybox="gallery" href="{{ $photo }}"
                                                 style="background-image: url('{{ $photo }}');">@if($loop->iteration == 4)
                                                    Другие фото @endif</div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="autor_info__elem">
                                    <h1 class="title-autor">{{ $user->name }}</h1>
                                    <div class="rating-autor">
                                        <div class="rating">
                                            @if($user->profile)
                                                {!! get_rating_template($full_raiting, false) !!}
                                            @endif
                                            @if($comments->count() > 0)
                                                <a href="#reviews"
                                                   class="review-count">{{ Lang::choice('Отзыв|Отзыва|Отзывов', $comments->count()) }}
                                                    - <span>{{ $comments->count() }}</span></a>
                                            @endif
                                        </div>
                                    </div>
                                    @if($user->profile)
                                    <div class="country-autor">
                                        @if($user->profile->country and $user->profile->city)
                                        <i class="fa fa-home"></i>
                                        @endif
                                        <span>
                                            {{ $user->profile->country ?? null }}
                                            @if($user->profile->country and $user->profile->city), @endif
                                            {{ $user->profile->city ?? null }}
                                        </span>
                                            @if($user->profile->country or $user->profile->city)
                                        <a href="#" class="link-location"><i class="fa fa-location-arrow"></i></a>
                                            @endif
                                    </div>
                                    @endif
                                    @if($user->profile and $user->profile->description)
                                    <div class="about-autor">
                                        <h2 class="event-subtitle">
                                            @if($user->profile->type_user == 'organizer')Об организаторе
                                            @elseif($user->profile->type_user == 'leader') Об авторе
                                            @endif
                                        </h2>
                                        <p class="text-normal">{{ $user->profile->description ?? null }}</p>
                                    </div>
                                    @endif
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
                    @if($user->tours_with_category->count() > 0)
                        <div class="event-details-accordion">
                            <div class="event-accordion accordion-autor-retreat">
                                <div class="accordion-btn">Мероприятия:</div>
                                <div class="panel article">
                                    <ul class="list_similar_events">

                                        @foreach($user->tours_with_category as $tour)
                                            @php
                                                $variants = $tour->variants;
                                                if (isset($variants[0])) {
                                                    $date_start = $variants[0]->date_start_variant;
                                                    $date_end = $variants[0]->date_end_variant;

                                                    $start = \Carbon\Carbon::create($date_start);
                                                    $end = \Carbon\Carbon::create($date_end);
                                                    $diff = $start->diffInDays($end);
                                                }

                                            @endphp
                                            <li class="similar_events_elem">
                                                <a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}"
                                                   class="similar-link">
                                                    <img src="{{ asset('assets/site/images/home_bg_new.jpg') }}" alt=""
                                                         class="img-fluid">
                                                    <p>{{ $tour->title }}</p>
                                                    @if(isset($variants[0]))
                                                        <p class="dates-event">
                                                <span>
                                                    {{ $start->formatLocalized('%e %B') }}
                                                    - {{ $end->formatLocalized('%e %B %Y') }}
                                                    ({{ $diff }} {{ Lang::choice('День|Дня|Дней', $diff) }})
                                                </span>
                                                        </p>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($user->profile and $user->profile->type_user == 'organizer' and $user->profile->video_courses)
                        <?php
                        $videos = (array)json_decode($user->profile->video_courses);
                        ?>
                    <div class="event-details-accordion">
                        <div class="event-accordion accordion-autor-retreat">
                            <div class="accordion-btn">Обучающие курсы:</div>
                            <div class="panel article">
                                <ul class="list_similar_events">
                                    @foreach($videos as $video)
                                    <li class="similar_events_elem">
                                        <iframe width="100%" height="150" src="https://www.youtube.com/embed/{{ $video->url }}" allowfullscreen></iframe>
                                        <p class="similar_events_title">{{ $video->title }}</p>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($user->profile and $user->profile->country and $user->profile->city and $user->profile->address)
                        <div class="event-details-accordion" id="location">
                            <div class="event-accordion accordion-place">
                                <div class="accordion-btn">Месторасположение:</div>
                                <div class="panel article">
                                    <div class="event-pin">
                                        <span class="event-pin-icon"></span>
                                        @if($user->profile->country or $user->profile->city)
                                            <span>{{ $user->profile->country }}, {{ $user->profile->city }}</span>
                                        @elseif($user->profile->address)
                                            <span>{{ $user->profile->address }}</span>
                                        @endif
                                    </div>
                                    <div class="block_place">
                                        <div class="article-block">
                                            @php
                                                $link = generate_google_map_link([$user->profile->address]);
                                            @endphp
                                            <iframe width="100%" height="350" frameborder="0" style="border:0"
                                                    src="{{ $link }}" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                    {{--<div class="block_place">
                                       {{ $user->adress_desk }}
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($user->profile and $user->profile->url)
                        <div class="event-details-accordion">
                            <div class="event-accordion accordion-video">
                                <div class="accordion-btn">Видео:</div>
                                <div class="panel article">
                                    <div class="block_place">
                                        <div class="article-block">
                                            <iframe width="100%" height="350" src="https://www.youtube.com/embed/{{ $user->profile->url }}"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
{{--                    @if($user->profile and $user->profile->raiting > 0 or $comments->count() > 0)--}}
                    @if($user->profile and $user->profile->raiting > 0 or $comments->count() > 0)
                        <div class="event-details-accordion" id="reviews">
                            <div class="event-accordion accordion-reviews">
                                <div class="accordion-btn">Отзывы клиентов:</div>
                                <div class="panel reviews-read">
                                    @if($user->profile->raiting > 0)
                                        <div class="rating-accordion-block">
                                            <div class="rating-accordion">
                                                <div class="rating">

                                                    {!! get_rating_template($full_raiting, false) !!}
                                                    <span class="review-text">Средний рейтинг {{ $full_raiting }} из 5.0</span>
                                                </div>
                                            </div>
                                            <div class="rating-feedback">
                                                @auth
                                                    <a class="btn-review" data-src="#form-reviews" data-fancybox="" href="">Добавить отзыв</a>
                                                @else
                                                    <div class="review-aut">Чтобы оставить отзыв <a href="{{ route('login') }}">авторизуйтесь</a>.</div>
                                                @endauth
                                            </div>
                                        </div>
                                    @endif
                                    @if($comments->count() > 0)
                                        <p class="title-shedule">Отзывов - {{ $comments->count() }}</p>
                                    @endif
                                    <div class="block-reviews">
                                        @foreach($comments->reverse() as $comment)
                                            <article class="block-reviews_elem article">
                                                <div class="review_header">
                                                    <p class="title-review">{{ $comment->title }}</p>
                                                    <div class="rating">
                                                        {!! get_rating_template($comment->rating) !!}
                                                    </div>
                                                </div>
                                                <div class="review_main">
                                                    <p class="text-review">{{ $comment->comment }}</p>
                                                </div>
                                                <div class="review_footer">
                                                    <span class="review-autor">{{ $comment->user->name }}</span> -
                                                    <span
                                                        class="review-date">{{ $comment->created_at->formatLocalized('%e %B %Y') }}</span>
                                                </div>
                                            </article>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-3">
                    <div class="block-question-autor">
                        <div class="question-autor">
                            <p class="note-schedule">Вы можете задать вопрос автору <span>мероприятия</span>, а также
                                оставить отзыв!</p>
                            <a href="" class="btn-booking" data-src="#form-autor" data-fancybox="">Задать вопрос</a>
                            {{--                            <div class="review-aut">Чтобы задать вопрос <a href="{{ route('login') }}">авторизуйтесь</a>.</div>--}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @auth
        <div class="fancybox-content" id="form-reviews" style="display: none;">
            <div class="form-title">Оставить отзыв</div>
            <form action="{{ route('site.author.add_comment', ['id' => $user->id]) }}" autocomplete="off" method="post">
                @csrf
                <div class="form-reviews-block">
                    <span>Оценка:</span>
                    <div class="star-rating">
                        <div class="star-rating__wrap">
                            <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
                            <label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 out of 5 stars"></label>
                            <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
                            <label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 out of 5 stars"></label>
                            <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
                            <label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 out of 5 stars"></label>
                            <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
                            <label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 out of 5 stars"></label>
                            <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
                            <label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 out of 5 stars"></label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="form-reviews-block"><span>Заголовок отзыва:</span><input type="text" name="title"></div>
                <div class="form-reviews-block"><span>Текст отзыва:</span><textarea name="comment" id=""></textarea></div>
                <div class="form-reviews-block"><button type="submit">Добавить отзыв</button></div>
            </form>
        </div>
    @endauth

@endsection
@section('popap_form')
    <div class="fancybox-content" id="form-autor" style="display: none;">
        <div class="form-autor-content">
            <div class="form-autor-block">
                <div class="form-title">Связаться с автором мероприятия</div>
                <form action="{{ route('site.send-message-to-leader') }}" method="post">
                    @csrf
                    <input type="hidden" name="leader" value="{{ $user->id }}">
                    <div class="form-reviews-block"><span>Ваше имя*</span><input type="text" name="name" value="{{ old('name') }}" required/>
                    </div>
                    <div class="form-reviews-block"><span>Email*</span><input type="email" name="email" value="{{ old('email') }}" required/></div>
                    <div class="form-reviews-block"><span>Телефон*</span><input type="tel" name="phone" value="{{ old('phone') }}" required/></div>
                    <div class="form-reviews-block"><span>Ваше сообщение*</span><textarea type="text" name="message"
                                                                                          required></textarea></div>
                    <div class="form-reviews-block">
                        <button type="submit">Отправить сообщение</button>
                    </div>
                </form>
            </div>
            <div class="form-autor-block">
                <div class="form-autor_photo">
                    @if($user->profile)
                        <img src="{{ json_decode($user->profile->avatar)[0] ?? '' }}" alt="" class="img-fluid">
                    @endif
                    <p class="form-autor_name">{{ $user->name }}</p>
                    @if($user->profile and ($user->profile->country or $user->profile->city))
                        <div class="country-autor">
                            <i class="fa fa-home"></i>
                            <span>
                                {{ $user->profile->country ?? null }}
                                @if($user->profile->country and $user->profile->city) , @endif
                                {{ $user->profile->city ?? null }}
                            </span>
                            @if($user->profile->country or $user->profile->city)
                            <a href="#" class="link-location"><i class="fa fa-location-arrow"></i></a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
