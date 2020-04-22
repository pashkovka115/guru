@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $role->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Описание</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                       value="{{ $role->description }}" disabled>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.role.edit', ['role' => $role->id]) }}" class="btn btn-primary">Редактировать</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

