@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('admin.settings.soc_network.create') }}" class="btn btn-success">Создать новый элемент</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Иконка</th>
                                <th>Адрес</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                    <td>{{ $setting->id }}</td>
                                    <td><img src="{{ $setting->icon }}" alt="icon" style="max-height: 50px"></td>
                                    <td>{{ $setting->url }}</td>
                                    <td class="project-actions text-right">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.settings.soc_network.edit', ['soc_network'=>$setting->id]) }}" class="btn btn-info" style="max-height: 30px"><i class="fas fa-pencil-alt"></i></a>

                                            <form id="form_delete_{{ $loop->index }}" action="{{ route('admin.settings.soc_network.destroy', ['soc_network'=>$setting->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="margin-left: -2px;"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{ $settings->links() }}
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection

