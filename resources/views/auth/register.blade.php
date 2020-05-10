@extends('layouts.app')

@section('content')
    <div class="block_login">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Регистрация личного кабинета</h1>
                </div>
                <div class="col-md-12 form_signup">
                    <p>Lorem ipsum dolor sit amet.</p>
                    <form class="signup-form" action="{{ route('register') }}" autocomplete="off" method="post">
                        @csrf
                        <label for="name">
                            Ваше Имя
                            <input type="text" id="name" @error('name') class="is-invalid" @enderror name="name" value="{{ old('name') }}" required  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </label>
                        <label for="email">
                            Ваш Email
                            <input type="email" id="email" @error('email') class="is-invalid" @enderror name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </label>
                        <label for="password">
                            Пароль
                            <input type="password" id="password" @error('password') class="is-invalid" @enderror name="password" required autocomplete="password">
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
                    <div class="signup_politics">
                        <p>Регистрируясь, вы принимаете условия <a href="#" target="_blank">политики конфиденциальности</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
