@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.role.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Роль</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                       placeholder="уникальная строка, например 'Super-puper-admin'" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Краткое описание роли</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       value="{{ old('description') }}" placeholder="необязательное поле">
                            </div>

                            <div class="form-group">
                                <label for="">Назначить разрешения для этой роли:</label>
                                <div class="custom-control custom-checkbox">
                                    @foreach($permissions as $permission)
                                        <div style="display: inline-block; margin-right: 30px;">
                                            <input class="custom-control-input" type="checkbox"
                                                   id="Checkbox{{$loop->index}}" name="permission_{{ $permission->id }}"
                                                   value="{{ $permission->name }}">
                                            <label for="Checkbox{{$loop->index}}" title="{{ $permission->name }}"
                                                   class="custom-control-label">{{ $permission->description }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Создать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
