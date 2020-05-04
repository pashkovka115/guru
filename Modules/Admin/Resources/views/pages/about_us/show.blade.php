@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <form role="form">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        @foreach($titles as $tit)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="form-group">
                                            <label for="title">Заголовок страницы</label>
                                            <input type="text" class="form-control" id="title"
                                                   value="{{ $tit->title }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <i class="fas fa-trash"></i>Удалить
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
                        @foreach($contents as $content)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="form-group">
                                            <label for="content">Статья о нас</label>
                                            <textarea rows="7" id="content_{{ $content->id }}" style="width: 100%"
                                                      disabled>{{ $content->content }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                                <i class="fas fa-trash"></i>Удалить
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if($team->count() > 0)
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5>Наша команда</h5>
                        </div>
                        @foreach($team as $person)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="content">Имя</label>
                                            <input type="text" class="form-control" id="title"
                                                   value="{{ $person->title }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="content">Должность</label>
                                            <input type="text" class="form-control" id="title"
                                                   value="{{ $person->excerpt }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="content">О себе</label>
                                            <textarea rows="3" id="content" style="width: 100%"
                                                      disabled>{{ $person->content }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">
                                            <label>Фото</label>
                                            <img src="{{ $person->img }}" alt="">
                                        </div>

                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                                <i class="fas fa-trash"></i>Удалить
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @endif
            @if($progress->count() > 0)
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5>Наши преимущества</h5>
                        </div>
                        @foreach($progress as $prog)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="content">Заголовок</label>
                                            <input type="text" class="form-control" id="title"
                                                   value="{{ $prog->title }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="content">Описание</label>
                                            <textarea rows="3" id="content" style="width: 100%"
                                                      disabled>{{ $prog->excerpt }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                                <i class="fas fa-trash"></i>Удалить
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            <div class="card-footer">
                <a href="{{ route('admin.about.edit') }}" class="btn btn-primary">Редактировать</a>
            </div>
        </form>
    </div>
@endsection

