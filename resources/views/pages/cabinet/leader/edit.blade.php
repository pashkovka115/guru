@extends('layouts.app')

@section('content')
    <div class="block_personal_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('parts.cabinet.menu')
                    <div class="personal_container">
                        <h1 class="user-title">Редактирование: {{ $user->name }}</h1>
                        <div class="user-status">
                            <span>Статус авторизации:</span>
                            @if($user->profile->auth ?? false)
                            <span class="confirm">Подтвержден</span>
                            @else
                            <span class="not-confirm">Не подтвержден</span>
                            @endif
                        </div>
                        <div class="user-email"><span>Email:</span> {{ $user->email }}</div>
                    <form action="{{ route('site.cabinet.leaders.update', ['leader' => $user->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="country">Страна</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ $user->profile->country ?? '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Город</label>
                            <input type="text" class="form-control" id="name" name="city" value="{{ $user->profile->city ?? '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="exception">Кратко о себе</label>
                            <textarea class="form-control" id="exception" rows="3" name="excerpt">{{ $user->profile->excerpt ?? '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">О себе полностью</label>
                            <textarea class="form-control" id="exception" rows="7" name="description">{{ $user->profile->description ?? '' }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
