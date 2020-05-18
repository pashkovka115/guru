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
                    <div class="personal_container">
                        <h1 class="user-title">{{ auth()->user()->name }}</h1>
                        <div class="user-status">
                            <span>Статус авторизации:</span>
                            @if(auth()->user()->profile->auth ?? false)
                            <span class="confirm">Подтвержден</span>
                            @else
                            <span class="not-confirm">Не подтвержден</span>
                            @endif
                        </div>
                        <div class="user-email"><span>Email:</span> {{ auth()->user()->email }}</div>
                    </div>
                    @if(!(auth()->user()->profile->auth ?? false))
                    <div class="personal_status">
                        <p class="text-normal">Спасибо за регистрацию!</p>
                        <p class="text-normal">Чтобы получить возможность создания своих мероприятия, авторов и организаций на нашем сервисе, запросите авторизацию у администрации, нажав кнопку ниже.</p>
                        <div class="user-editing"><a href="" class="btn-personal">Запросить авторизацию</a></div>
                    </div>
                    @elseif((auth()->user()->profile->auth ?? false) and $count_tour == 0)
                        <div class="personal_status">
                            <p class="text-normal">Ваш профиль авторизован!</p>
                            <p class="text-normal">Ваш профиль подтвержден, и вы можете начать добавления мероприятий.</p>
                            <p class="text-normal">Чтобы добавить свое первое мероприятие, нажмите на кнопку ниже, а затем заполните каждый из разделов.</p>
                            <a href="{{ route('site.cabinet.tour.create') }}" class="btn-personal">Добавить мероприятие</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
