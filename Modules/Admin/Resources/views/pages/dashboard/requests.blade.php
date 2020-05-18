@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Создан</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($profiles as $profile)
                            <tr>
                                <td>{{ $profile->user->id }}</td>
                                <td>{{ $profile->user->name }}</td>
                                <td>{{ $profile->user->email }}</td>
                                <td>{{ $profile->user->created_at }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a class="btn btn-danger btn-sm" href="{{ route('admin.dashboard.auth.user', ['id' => $profile->id]) }}" onclick="return confirm('Подтвердить статус пользователя?')">
                                            <i class="fab fa-creative-commons-by"></i>
                                            Одобрить
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{ $profiles->links() }}
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
@section('script')
{{--    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>--}}
@endsection
