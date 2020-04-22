@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                   {{-- <div class="card-header">
                        <h3 class="card-title">Responsive Hover Table</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Email</th>
                                <th>Birth Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->birth_date }}</td>
                                <td>
                                    {{--<form id="form_delete" action="{{ route('admin.user.destroy', ['user'=>$user->id]) }}" method="post" style="display: none">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Go</button>
                                    </form>--}}
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.user.show', ['user'=>$user->id]) }}" class="btn btn-info" style="max-height: 30px"><i class="fas fa-eye"></i></a>
                                        <form id="form_delete" action="{{ route('admin.user.destroy', ['user'=>$user->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="margin-left: -2px;"><i class="fas fa-trash"></i></button>
                                        </form>
{{--                                        <a id="a_delete" href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>--}}
                                    </div>
                                    @verbatim
                                    <script>
                                        function del() {
                                            $('#a_delete').on("click", ".prevent", function (e) {
                                                if (e.metaKey || e.ctrlKey || e.altKey || e.shiftKey) {
                                                    return true;
                                                }
                                                e.preventDefault();
                                                $('#form_delete').submit()
                                            });
                                        }

                                    </script>
                                        @endverbatim
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
