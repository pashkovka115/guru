@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('admin.home.edit') }}" class="btn btn-primary">Редактировать</a>
            </div>
        </div>
        <form role="form">
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
                                                   value="{{ $content->title }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Описание</label>
                                            <textarea rows="3" style="width: 100%" disabled>{{ $content->excerpt }}</textarea>
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
                                                   value="{{ $progress->title }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Описание</label>
                                            <textarea rows="3" style="width: 100%" disabled>{{ $progress->excerpt }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <i class="fas fa-trash"></i>Удалить
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
                <a href="{{ route('admin.home.edit') }}" class="btn btn-primary">Редактировать</a>
            </div>
        </form>
    </div>
@endsection

