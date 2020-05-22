@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('admin.tour.tags.create') }}" class="btn btn-success">Добавить новый</a>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                @if($loop->index % 2 == 0)
                                <tr>
                                    <td>{{ $tag->id }}</td>
                                    <td>{{ $tag->tag }}</td>
                                    <td class="project-actions text-right actions">
                                        <a href="{{ route('admin.tour.tags.show', ['tag' => $tag->id]) }}" title="Просмотреть" class="btn btn-info" style="max-height: 30px"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.tour.tags.edit', ['tag' => $tag->id]) }}" title="Редактировать">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form id="form_delete" title="Удалить" action="{{ route('admin.tour.tags.destroy', ['tag' => $tag->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="margin-left: -2px;"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>


            <div class="col-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                @if($loop->index % 2 != 0)
                                <tr>
                                    <td>{{ $tag->id }}</td>
                                    <td>{{ $tag->tag }}</td>
                                    <td class="project-actions text-right actions">
                                        <a href="{{ route('admin.tour.tags.show', ['tag' => $tag->id]) }}" title="Просмотреть" class="btn btn-info" style="max-height: 30px"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.tour.tags.edit', ['tag' => $tag->id]) }}" title="Редактировать">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form id="form_delete" title="Удалить" action="{{ route('admin.tour.tags.destroy', ['tag' => $tag->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="margin-left: -2px;"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>

        </div>
        @if($tags->hasPages())
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
