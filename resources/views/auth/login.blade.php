@extends('layouts.app')

@section('content')
    <div class="block_login">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Вход в личный кабинет</h1>
                </div>
                <div class="col-md-12 form_login">
                    <p>Lorem ipsum dolor sit amet.</p>
                    <form id="login-form" class="login-form" action="{{ route('login') }}" autocomplete="off" method="post">
                        @csrf
                        <label for="email">
                            Ваш Email
                            <input type="email" id="email" @error('email') class="is-invalid" @enderror name="email" value="{{ old('email') }}" required  autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </label>
                        <label for="password">
                            Пароль
                            <input type="password" @error('password') class="is-invalid" @enderror id="password" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </label>
                        <button type="submit" id="login-submit-button">Войти</button>
                    </form>
                    @if (Route::has('password.request'))
                    <a href="{{route('password.request')}}" id="forgot-password">Забыли пароль?</a>
                    <div class="create_login">
                        <p>Нет аккаунта?</p>
                        <a href="{{route('register')}}">Зарегистрируйтесь</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
