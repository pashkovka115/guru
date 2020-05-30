@extends('layouts.app')

@section('styles')
    @include('pages.cabinet.styles')
@endsection

@section('scripts')
    @include('pages.cabinet.scripts')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            @include('parts.cabinet.menu')
            <div class="personal_events">
                <h1 class="user-title">Редактируем отзыв</h1>
            </div>
            <div class="personal_events">
<<<<<<< HEAD
                <h2 class="user-subtitle">Мероприятия: <a href="{{ route('site.catalog.tour.show', ['event' => $comment->tour->id]) }}" target="_blank">{{ $comment->tour->title }}</a></h2>
=======
                <h3>На мероприятие: <a href="{{ route('site.catalog.tour.show', ['event' => $comment->tour->id]) }}" target="_blank">{{ $comment->tour->title }}</a></h3>
>>>>>>> d63db8a9f68ee92f24965588c7b99b82d66061d8
            </div>
            <form action="{{ route('site.cabinet.review.update', ['review' => $comment->id]) }}" method="post">
                @csrf
                @method('PUT')
<<<<<<< HEAD
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
                <div class="form-reviews-block">
                    <label for="title">Заголовок отзыва:</label>
                    <input type="text" id="title" name="title" value="{{ $comment->title }}">
                </div>
                <div class="form-reviews-block">
                    <label for="comment">Текст отзыва:</label>
                    <textarea id="comment" rows="7" name="comment">{{ $comment->comment }}</textarea>
                </div>
                <button type="submit" class="btn-personal">Обновить отзыв</button>
=======
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $comment->title }}">
                </div>
                <div class="form-group">
                    <label for="comment">Текст</label>
                    <textarea class="form-control" id="comment" rows="7" name="comment">{{ $comment->comment }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
>>>>>>> d63db8a9f68ee92f24965588c7b99b82d66061d8
            </form>
        </div>
    </div>
</div>
@endsection
