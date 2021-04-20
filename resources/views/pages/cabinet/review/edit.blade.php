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
                <h2 class="user-subtitle">Мероприятия: <a href="{{ route('site.catalog.tour.show', ['event' => $comment->tour->id]) }}" target="_blank">{{ $comment->tour->title }}</a></h2>
            </div>
            <form action="{{ route('site.cabinet.review.update', ['review' => $comment->id]) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="tour_id" value="{{ $comment->tour->id }}">
                <div class="form-reviews-block">
                    <span>Оценка:</span>
                    <div class="star-rating">
                        <div class="star-rating__wrap">
                            <?= get_rating_template_for_form($comment->rating); ?>
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
            </form>
        </div>
    </div>
</div>
@endsection
