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
                                <label for="birth_date">День рождения</label>
                                <input type="text" class="form-control" id="birth_date" name="birth_date"
                                       value="{{ \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Пол</label>
                                <select class="form-control" name="gender" disabled>
                                    @php
                                        $genders = [''=>'', 'm'=>'Мужчина', 'w'=>'Женщина'];
                                        foreach($genders as $key => $gender){
                                            if ($user->gender == $key){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo "<option value='$key'$selected>$gender</option>";
                                        }
                                    @endphp
                                </select>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}" class="btn btn-primary">Редактировать</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

