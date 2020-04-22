@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{route('admin.user_role.update', ['user_role' => $user->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $user->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email адрес</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                       value="{{ $user->email }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="birth_date">Роли</label>
                                @php

                                    $current_roles = $user->roles()->get()->keyBy('name')->toArray();
                                @endphp
                                @foreach($roles as $role)
                                    @php
                                        if (isset($current_roles[$role->name])){
                                            $checked = ' checked';
                                        }else{$checked = '';}
                                    @endphp
                                    <div style="display: inline-block; margin-right: 30px;">
                                        <input class="custom-control-input" type="checkbox"
                                               id="Checkbox{{$loop->index}}" name="role_{{ $role->id }}"
                                               value="{{ $role->name }}"{{ $checked }}>
                                        <label for="Checkbox{{$loop->index}}" title="{{ $role->description }}"
                                               class="custom-control-label">{{ $role->name }}</label>
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

