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
                <h3>На мероприятие: <a href="{{ route('site.catalog.tour.show', ['event' => $comment->tour->id]) }}" target="_blank">{{ $comment->tour->title }}</a></h3>
            </div>
            <form action="{{ route('site.cabinet.review.update', ['review' => $comment->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $comment->title }}">
                </div>
                <div class="form-group">
                    <label for="comment">Текст</label>
                    <textarea class="form-control" id="comment" rows="7" name="comment">{{ $comment->comment }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>
@endsection
