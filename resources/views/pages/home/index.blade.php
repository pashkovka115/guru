@extends('layouts.home')
@section('content')
    <div class="block_tour">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Подобрать тур</h2>
                </div>
                @foreach($categories as $category)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('site.catalog.category.name', ['id' => $category->id]) }}" class="elem__tour">
                        <img src="{{ $category->img }}" alt="" class="img-fluid">
                        <p class="title__tour">{{ $category->title }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @foreach($our_ideas as $idea)
    <div class="block_idea">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="orange">{{ $idea->title }}</h2>
                    <p class="text_normal">{{ $idea->excerpt }}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @if($recommended_tours->count() > 0)
    <div class="block_featured_tour">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Рекомендуемые туры</h2>
                </div>
            </div>
            <div class="row">
                @foreach($recommended_tours as $tour)
                <div class="col-lg-3 col-md-6">
                    <div class="elem__featured_tour">
                        <a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}" class="elem__featured_more">
                            <?php
                            $gal = json_decode($tour->gallery) ?: [];
                            ?>
                            @isset($gal[0])
                            <img src="{{ $gal[0] }}" alt="" class="img-fluid">
                            @endisset
                            <p class="cost-tour">
                                @if($tour->variants->count() > 0)
                                    {{ number_format($tour->variants[0]->price_variant / 100) }} RUB
                                @else
                                    Цена по запросу
                                @endif
                            </p>
                        </a>
                        <a href="#" class="location-tour">
                            {{ $tour->city }}, {{ $tour->country }}
                        </a>
                        <a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}" class="title-tour">
                            {{ $tour->title }}
                        </a>
                        <p class="dates-tour">
                            <?php
                            $variants = $tour->variants;
                            if (isset($variants[0])){
                                $start = \Carbon\Carbon::create($variants[0]->date_start_variant);
                                $end = \Carbon\Carbon::create($variants[0]->date_end_variant);
                                echo '<span>' . $start->formatLocalized('%e %B') .' - '. $end->formatLocalized('%e %B %Y') . '</span>';
                                }
                            ?>
                        </p>
                        <div class="rating-tour">
                            <div class="rating">
                                @if($tour->rating > 0)
                                {!! get_rating_template($tour->rating, false) !!}
                                @endif
                                @if($tour->comments->count() > 0)
                                <span class="review-count">({{ $tour->comments->count() }} {{ Lang::choice('Отзыв|Отзыва|Отзывов', $tour->comments->count()) }})</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    @endif
    @if($posts->count() > 0)
    <div class="block_news">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Журнал</h2>
                </div>
            </div>
            <div class="row">
                @isset($posts[0])
                <div class="col-lg-8 col-md-12">
                    <div class="elem__news">
                        <img src="{{ $posts[0]->img }}" alt="" class="img-fluid">
                        <a href="{{ route('site.journal.blog.show', ['journal' => $posts[0]->id]) }}" class="title-news">{{ $posts[0]->title }}</a>
                        <p class="description-news">{{ mb_strimwidth($posts[0]->excerpt, 0, 100, '...') }}</p>
                    </div>
                </div>
                @endisset
                @isset($posts[1])
                <div class="col-lg-4 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="elem__news">
                                <img src="{{ $posts[1]->img }}" alt="" class="img-fluid img-news">
                                <a href="{{ route('site.journal.blog.show', ['journal' => $posts[1]->id]) }}" class="title-news">{{ $posts[1]->title }}</a>
                                <p class="description-news">{{ mb_strimwidth($posts[1]->excerpt, 0, 100, '...') }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="elem__news">
                                <a href="{{ route('site.journal.blog.index') }}" class="btn_news">Читать полностью новостную ленту</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </div>
    @endif
    <div class="block_about_us">
        <div class="container">
            <div class="row">
                @foreach($our_progress as $progress)
                <div class="col-md-3">
                    <div class="elem__about">
								<span class="number-about">{{ $progress->title }}</span>
                        <p class="desc-about">{{ $progress->excerpt }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @if ($popular_country->count() > 0)
    <div class="block_country_tour">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Популярные направления</h2>
                </div>
            </div>
            <div class="row">
                @foreach($popular_country as $tour)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('site.catalog.category.name', ['id' => $tour->category_tour_id]) }}" class="elem__tour">
                        <?php
                        $gal = json_decode($tour->gallery) ?? [];
                        ?>
                        @isset($gal[0])
                        <img src="{{ $gal[0] }}" alt="" class="img-fluid">
                        @endisset
                        <p class="title__tour">
                            @if ($tour->country)
                                {{ $tour->country }}
                            @elseif($tour->title)
                                {{ $tour->title }}
                            @endif
                        </p>
                    </a>
                </div>
                    @if($loop->iteration == 6) @break @endif
                @endforeach

            </div>
        </div>
    </div>
    @endif
@endsection
@section('scripts_footer')
    <script src="{{asset('assets/site/js/index.js')}}"></script>
@endsection
