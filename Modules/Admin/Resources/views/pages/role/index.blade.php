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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.role.show', ['role'=>$role->id]) }}" class="btn btn-info" style="max-height: 30px"><i class="fas fa-eye"></i></a>
                                        <form id="form_delete" action="{{ route('admin.role.destroy', ['role'=>$role->id]) }}" method="post">
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
                    {{ $roles->links() }}
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
@section('script')
{{--    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>--}}
@endsection
