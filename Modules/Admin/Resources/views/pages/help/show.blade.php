@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <form role="form" method="post">
            @csrf
            @foreach($settings as $setting)
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.help.edit') }}" class="btn btn-primary">Редактировать</a>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" class="form-control" id="title"
                                   value="{{ $setting->title }}" required disabled>
                        </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="excerpt">Краткое описание</label>
                                    <textarea rows="3" style="width: 100%" id="excerpt" disabled>{{ $setting->excerpt }}</textarea>
                                </div>
                            </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">Текст</label>
                                        <textarea rows="5" style="width: 100%" id="content" disabled>{{ $setting->content }}</textarea>
                                    </div>
                                </div>
                        </div>
                    </div>
            @endforeach

            <div class="card-footer">
                <a href="{{ route('admin.help.edit') }}" class="btn btn-primary">Редактировать</a>
            </div>
        </form>
    </div>
@endsection

