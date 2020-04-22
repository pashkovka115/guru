@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header card-primary">
                        <h6 class="card-title">Некоторые свойства можно редактировать только программно</h6>
                    </div>
                    <form role="form" action="{{ route('admin.permission.update', ['permission'=>$permission->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Ключ</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $permission->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="description">Описание</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       value="{{ $permission->description  }}" required>
                            </div>

                            <div class="form-group">
                                <label for="guard_name">Охранник</label>
                                <input type="text" class="form-control" id="guard_name" name="guard_name"
                                       value="{{ $permission->guard_name }}" disabled>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

