@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Ключ</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $permission->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Описание</label>
                                <input type="text" class="form-control" id="birth_date" name="birth_date"
                                       value="{{ $permission->description }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="email">Охранник</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                       value="{{ $permission->guard_name }}" disabled>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.permission.edit', ['permission' => $permission->id]) }}" class="btn btn-primary">Редактировать</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

