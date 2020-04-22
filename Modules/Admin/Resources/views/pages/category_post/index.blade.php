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
                                <th>Категория</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td>

                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.category_post.show', ['category_post'=>$category->id]) }}" class="btn btn-info" style="max-height: 30px"><i class="fas fa-eye"></i></a>
                                        @if($category->title != 'Без категории')
                                        <form id="form_delete{{$loop->index}}" action="{{ route('admin.category_post.destroy', ['category_post'=>$category->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="margin-left: -2px;"><i class="fas fa-trash"></i></button>
                                        </form>
{{--                                        <a id="a_delete" href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>--}}
                                            @endif
                                    </div>

                                    <script>
                                        function del() {
                                            $('#a_delete{{$loop->index}}').on("click", ".prevent", function (e) {
                                                if (e.metaKey || e.ctrlKey || e.altKey || e.shiftKey) {
                                                    return true;
                                                }
                                                e.preventDefault();
                                                $('#form_delete').submit()
                                            });
                                        }

                                    </script>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
@section('script')
{{--    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>--}}
@endsection
