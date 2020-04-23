@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.user.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email адрес</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password1">Пароль</label>
                                <input type="password" class="form-control" id="password1" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="password2">Повторите пароль</label>
                                <input type="password" class="form-control" id="password2" name="password_confirmation" required>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
