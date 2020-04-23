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
                                <th>Тур</th>
                                <th>Одобрен/Опубликован</th>
                                <th>Цена</th>
{{--                                <th>Категория</th>--}}
                                <th>Дата проведения</th>
                                <th>Краткое описание</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tours as $tour)
                            <tr>
                                <td>{{ $tour->id }}</td>
                                <td>{{ $tour->h1 }}</td>
                                <td>
                                    @if($tour->good == '1')  Да @else Нет @endif
                                    /
                                    @if($tour->active == '1') Да @else Нет @endif
                                </td>
                                <td>{{ $tour->price }}</td>
                                {{--<td>
                                    @foreach($tour->categories as $category)
                                        <div style="display: inline-block; margin-right: 30px;">
                                            <h5><span class="badge badge-primary">{{ $category->title }}</span></h5>

                                        </div>
                                    @endforeach
                                </td>--}}
                                <td><b>{{ \Carbon\Carbon::parse($tour->date_start)->format('d.m.Y') }}</b> - <b>{{ \Carbon\Carbon::parse($tour->date_end)->format('d.m.Y') }}</b></td>
                                <td>{{ $tour->excerpt }}</td>
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

