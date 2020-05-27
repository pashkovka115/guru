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
                        <h1 class="user-title">Мероприятия</h1>
                        <a href="{{ route('site.cabinet.tour.create') }}" class="btn-personal">Добавить мероприятие</a>
                    </div>
                    @if($tours->count() == 0)
                        <div class="personal_status">
                            <p class="text-normal">Пока мероприятий нет!</p>
                            <p class="text-normal">Как только вы добавите свое первое мероприятие, оно отобразиться
                                здесь.</p>
                            <a href="{{ route('site.cabinet.tour.create') }}" class="btn-personal">Добавить
                                мероприятие</a>
                        </div>
                    @else
                        <div class="personal_events">
                            <h2 class="user-subtitle">Ваши мероприятия:</h2>
                        </div>
                    @endif

                    @foreach($tours as $tour)
                        <div class="personal_status_events">
                            <div class="personal_events-public">
                                <?php
                                $gallary = json_decode($tour->gallery);
                                ?>
                                @isset($gallary[0])
                                <img src="{{ $gallary[0] }}" alt="" class="img-fluid">
                                @endisset
                                <div class="block-public">
                                    <p class="public-title">{{ $tour->title }}</p>
                                    @php
                                    $variants = $tour->variants;
                                    if (isset($variants[0])){
                                        $start = \Carbon\Carbon::create($variants[0]->date_start_variant);
                                        $end = \Carbon\Carbon::create($variants[0]->date_end_variant);
                                        $diff = $start->diffInDays($end);
                                    }

                                    @endphp
                                    @if(isset($variants[0]))
                                    <p class="public-date">
                                        {{ $start->formatLocalized('%e %B %Y') }}
                                        - {{ $end->formatLocalized('%e %B %Y') }}
                                        ( {{ $diff }} {{ Lang::choice('День|Дня|Дней', $diff) }} )
                                    </p>
                                    @endif
                                    <p class="public-status">
                                        @if($tour->active and $tour->good)
                                            <span class="confirm">Опубликовано</span>
                                        @else
                                            <span class="not-confirm">Не опубликовано</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="personal_events_btn">
                                <a href="{{ route('site.cabinet.tour.edit', ['tour' => $tour->id]) }}" class="btn-edit">Редактировать</a>
                                <a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}" target="_blank" class="btn-edit btn-view">Посмотреть</a>
                                <a href="{{ route('site.cabinet.tour.destroy', ['tour' => $tour->id]) }}" class="btn-edit btn-delete"
                                   onclick="event.preventDefault(); document.getElementById('delete-tour-form_{{ $loop->index }}').submit();">Удалить</a>
<?php //dump($tour->id); ?>
                                <form id="delete-tour-form_{{ $loop->index }}" action="{{ route('site.cabinet.tour.destroy', ['tour' => $tour->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <div class="">
                        <p class="public-info">* Все добавляемые материалы проходят проверку и подтверждение у наших
                            администраторов. Подтвержление занимает от пары часов до 2-х дней!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
