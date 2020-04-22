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
                                <th>Заголовок</th>
                                <th>Категория</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->title }}</td>

                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.post.show', ['post'=>$post->id]) }}" class="btn btn-info" style="max-height: 30px"><i class="fas fa-eye"></i></a>
                                        <form id="form_delete" action="{{ route('admin.post.destroy', ['post'=>$post->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="margin-left: -2px;"><i class="fas fa-trash"></i></button>
                                        </form>
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
                    {{ $posts->links() }}
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
@section('script')
{{--    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>--}}
@endsection
