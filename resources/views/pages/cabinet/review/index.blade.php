@extends('layouts.app')

@section('styles')
    @include('pages.cabinet.styles')
@endsection

@section('scripts')
    @include('pages.cabinet.scripts')
@endsection

@section('content')
<div class="block_personal_content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('parts.cabinet.menu')
                <div class="personal_events">
                    <h1 class="user-title">Отзывы</h1>
                </div>

                @if($me_comments->count() == 0 and $my_comments->count() == 0)
                <div class="personal_status">
                    <p class="text-normal">Пока отзывов нет!</p>
                    <p class="text-normal">Как только вы добавите свой первый отзыв, он отобразиться здесь.</p>
                    <p class="text-normal">Как только будет оставлен первый отзыв о вашем мероприятии, он отобразиться здесь.</p>
                </div>
                @endif
                <div class="personal_events">
                    <h2 class="user-subtitle">Ваши отзывы:</h2>
                </div>
                @foreach($my_comments as $my_com)
                <div class="personal_status_events">
                    <div class="personal_events-public">
                        @php
                        $gall = json_decode($my_com->tour->gallery);
                        @endphp
                        @isset($gall[0])
                        <img src="{{ $gall[0] }}" alt="" class="img-fluid">
                        @endisset
                        <div class="block-public">
                            <p class="public-title">{{ $my_com->tour->title }}</p>
                            <div class="rating">
                                {!! get_raiting_template($my_com->rating) !!}
                            </div>
                            <p class="public-status">
                                @if($my_com->tour->active and $my_com->tour->good)
                                <span class="confirm">Опубликовано</span>
                                @else
                                <span class="not-confirm">Не опубликовано</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    {{--<div class="personal_events_btn">
                    todo: для будущей реализации (этот функционал нужен?)
                        <a href="#" class="btn-edit">Редактировать</a>
                        <a href="#" class="btn-edit btn-view">Посмотреть</a>
                    </div>--}}
                </div>
                @endforeach

                <div class="">
                    <p class="public-info">* Все добавляемые материалы проходят проверку и подтверждение у наших администраторов. Подтвержление занимает от пару часов до 2-х дней!</p>
                </div>
                <div class="personal_events">
                    <h2 class="user-subtitle">Отзывы оставленные на ваши мероприятия:</h2>
                </div>
                @foreach($me_comments as $me_comm)
                <div class="personal_status_events">
                    <div class="personal_events-public">
                        @php
                            $gall2 = json_decode($me_comm->tour->gallery);
                        @endphp
                        @isset($gall2[0])
                        <img src="{{ $gall2[0] }}" alt="" class="img-fluid">
                        @endisset
                        <div class="block-public">
                            <p class="public-title">{{ $me_comm->tour->title }}</p>
                            <div class="rating">
                                {!! get_raiting_template($me_comm->tour->rating) !!}
                            </div>
                            <p class="public-status">
                                @if($me_comm->tour->active and $me_comm->tour->good)
                                    <span class="confirm">Опубликовано</span>
                                @else
                                    <span class="not-confirm">Не опубликовано</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    {{--<div class="personal_events_btn">
                        <a href="#" class="btn-edit">Посмотреть</a>
                    </div>--}}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
