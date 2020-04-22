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
                                       value="{{ $user->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email адрес</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                       value="{{ $user->email }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="birth_date">Роли</label>
                                @foreach($user->roles as $role)
                                    <div style="display: inline-block; margin-right: 30px;">
                                        <h5 title="{{ $role->description }}"><span class="badge badge-primary">{{ $role->name }}</span></h5>

                                    </div>

                                @endforeach
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.user_role.edit', ['user_role' => $user->id]) }}" class="btn btn-primary">Редактировать</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

