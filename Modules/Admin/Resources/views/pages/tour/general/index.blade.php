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
                                <th>Одобрен/Опубликован</th>
                                <th>Категория</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tours as $tour)
                            <tr>
                                <td>{{ $tour->id }}</td>
                                <td>{{ $tour->title }}</td>
                                <td>
                                    @if($tour->good == '1')  <span class="badge badge-success">Да</span> @else <span class="badge badge-danger">Нет</span> @endif
                                    /
                                        @if($tour->active == '1') <span class="badge badge-success">Да</span> @else <span class="badge badge-danger">Нет</span> @endif
                                </td>
                                <td>{{ $tour->category->title }}</td>
{{--                                <td><b>{{ \Carbon\Carbon::parse($tour->date_start)->format('d.m.Y') }}</b> - <b>{{ \Carbon\Carbon::parse($tour->date_end)->format('d.m.Y') }}</b></td>--}}
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.tour.show', ['tour'=>$tour->id]) }}" class="btn btn-info" style="max-height: 30px"><i class="fas fa-eye"></i></a>
                                        <form id="form_delete" action="{{ route('admin.tour.destroy', ['tour'=>$tour->id]) }}" method="post">
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
                    {{ $tours->links() }}
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection

