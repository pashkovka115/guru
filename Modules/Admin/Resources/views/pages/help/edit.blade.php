@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <form role="form" action="{{ route('admin.help.update') }}" method="post">
            @csrf
            @foreach($settings as $setting)
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" class="form-control" id="title" name="title_{{ $setting->id }}"
                                   value="{{ $setting->title }}" required>
                        </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="excerpt">Краткое описание</label>
                                    <textarea rows="3" style="width: 100%" id="excerpt"
                                              name="excerpt_{{ $setting->id }}">{{ $setting->excerpt }}</textarea>
                                </div>
                            </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">Текст</label>
                                        <textarea rows="5" style="width: 100%" id="content"
                                                  name="content_{{ $setting->id }}">{{ $setting->content }}</textarea>
                                    </div>
                                </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </div>
            @endforeach
        </form>

        @if($settings->count() < 1)
{{--     TODO: можно реализовать добавление полей        --}}
        <form action="{{ route('admin.help.add_field') }}" method="post">
            @csrf
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Выберите тип поля</label>
                                <select name="post_type" class="form-control">
                                    <option value="help">Помощь и поддержка</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Добавить поле</button>
                </div>
            </div>
        </form>
        @endif
    </div>
@endsection
@section('scripts')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('content', {
            filebrowserImageBrowseUrl: '/file-manager/ckeditor',
            height: 300
        });
    </script>
@endsection
