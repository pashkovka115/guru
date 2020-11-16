@extends('layouts.app')

@section('content')
<div class="block_login">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Сброс пароля</h1>
            </div>
            <div class="col-md-12 form_login">
                <form method="POST" action="{{ route('password.email') }}" class="login-form">
                    @csrf
                    <label for="email">
                        Ваш E-Mail
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                    <button type="submit" id="login-submit-button">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
