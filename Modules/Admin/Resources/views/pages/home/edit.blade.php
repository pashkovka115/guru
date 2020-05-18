@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <form role="form" action="{{ route('admin.home.update') }}" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5>Заголовок в шапке</h5>
                        </div>
                        @foreach($titles as $tit)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="form-group">
                                            <label for="title">Заголовок</label>
                                            <input type="text" class="form-control" id="title"
                                                   name="title_{{ $tit->id }}" value="{{ $tit->title }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <a  href="{{ route('admin.home.destroy', ['id' => $tit->id]) }}" class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
                                                <i class="fas fa-trash"></i>Удалить
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5>Наша идея</h5>
                        </div>
                        @foreach($contents as $content)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="form-group">
                                            <label for="title">Заголовок</label>
                                            <input type="text" class="form-control" id="title"
                                                   name="title_{{ $content->id }}" value="{{ $content->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Описание</label>
                                            <textarea rows="3" name="excerpt_{{ $content->id }}" style="width: 100%">{{ $content->excerpt }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <a  href="{{ route('admin.home.destroy', ['id' => $content->id]) }}" class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
                                                <i class="fas fa-trash"></i>Удалить
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5>Наши преимущества</h5>
                        </div>
                        @foreach($progresies as $progress)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="form-group">
                                            <label for="title">Заголовок</label>
                                            <input type="text" class="form-control" id="title"
                                                   name="title_{{ $progress->id }}" value="{{ $progress->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Описание</label>
                                            <textarea rows="3" name="excerpt_{{ $progress->id }}" style="width: 100%">{{ $progress->excerpt }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <a  href="{{ route('admin.home.destroy', ['id' => $progress->id]) }}" class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
                                                <i class="fas fa-trash"></i>Удалить
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary">Сохранить</button>
            </div>
        </form>

        <form action="{{ route('admin.home.add_field') }}" method="post">
            @csrf
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Выберите тип поля</label>
                                <select name="post_type" class="form-control">
{{--                                    <option value="title">Заголовок страницы</option>--}}
                                    <option value="content">Наша идея</option>
{{--                                    <option value="people">Наша команда</option>--}}
                                    <option value="progress">Наши преимущества</option>
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
    </div>
@endsection

