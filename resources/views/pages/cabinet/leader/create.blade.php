@extends('layouts.app')

@section('styles')
    @include('pages.cabinet.styles')
@endsection

@section('scripts')
    @include('pages.cabinet.scripts')
@endsection

@section('content')
    <div class="block_login">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Регистрация ведущего</h1>
                </div>
                <div class="col-md-12 form_signup">
                    <form class="signup-form" action="{{ route('site.cabinet.leaders.store') }}" autocomplete="off" method="post">
                        @csrf
                        <label for="name">
                            Имя
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </label>
                        <label for="email">
                            Email
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </label>
                        <label for="password">
                            Пароль
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </label>
                        <label for="password_confirmation">Повторите пароль
                            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="password_confirmation">
                        </label>
                        <button type="submit" id="signup-button">Зарегистрировать</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
