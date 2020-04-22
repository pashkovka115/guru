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
                                <th>User</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                @php
                                //dd($user->roles);
                                @endphp
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>

                                    @foreach($user->roles as $role)
                                        <div style="display: inline-block; margin-right: 30px;">
                                            <h5 title="{{ $role->description }}"><span class="badge badge-primary">{{ $role->name }}</span></h5>

                                        </div>

                                    @endforeach

                                </td>
                                <td>

                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.user_role.show', ['user_role'=>$user->id]) }}" class="btn btn-info" style="max-height: 30px"><i class="fas fa-eye"></i></a>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{ $users->links() }}
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
@section('script')
{{--    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>--}}
@endsection
