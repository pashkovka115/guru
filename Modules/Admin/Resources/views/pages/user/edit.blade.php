@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.user.update', ['user'=>$user->id]) }}" method="post">
                        {{--                        {{ route('admin.user.update', ['id'=>$user->id]) }}--}}
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email адрес</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                       value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password1">Новый пароль</label>
                                <input type="password" class="form-control" id="password1" name="password"
                                       placeholder="Оставьте пустым если не надо менять">
                            </div>
                            <div class="form-group">
                                <label for="password2">Повторите пароль</label>
                                <input type="password" class="form-control" id="password2" name="password_confirmation"
                                       placeholder="Оставьте пустым если не надо менять">
                            </div>
                            <div class="form-group">
                                <label for="birth_date">День рождения</label>
                                <input type="text" class="form-control" id="birth_date" name="birth_date"
                                       value="{{ \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') }}" placeholder="гггг-мм-дд">
                            </div>

                            <div class="form-group">
                                <label>Пол</label>
                                <select class="form-control" name="gender">
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{--    <link rel="stylesheet" href="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.css')}}">--}}
{{--<script src="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>--}}
{{--    <script>$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })</script>--}}
@endsection
