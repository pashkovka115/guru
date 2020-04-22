@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.role.update', ['role'=>$role->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $role->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Описание</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="description"
                                       value="{{ $role->description }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 style="padding-left: 20px">Разрешения</h5>
                            <div class="custom-control custom-checkbox" style="padding-left: 2.5rem;">
@php
$current_perms = $role->permissions->keyBy('name')->toArray();
@endphp
                                @foreach($all_perms as $permission)
                                    @php
                                    if (isset($current_perms[$permission->name])){
                                        $checked = ' checked';
                                    }else{$checked = '';}
                                    @endphp
                                    <div style="display: inline-block; margin-right: 30px;">
                                        <input class="custom-control-input" type="checkbox"
                                               id="Checkbox{{$loop->index}}" name="permission_{{ $permission->id }}"
                                               value="{{ $permission->name }}"{{ $checked }}>
                                        <label for="Checkbox{{$loop->index}}" title="{{ $permission->name }}"
                                               class="custom-control-label">{{ $permission->description }}</label>
                                    </div>
                                @endforeach
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
