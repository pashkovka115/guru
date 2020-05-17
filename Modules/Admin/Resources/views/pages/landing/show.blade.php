@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form">
                        <div class="card-footer">
                            <a href="{{ route('admin.landing.edit') }}" class="btn btn-primary">Редактировать</a>
                        </div>
                        @if($headers)
                            <div class="card-header" style="background-color: #00b3ff">
                                <h3 class="card-title">Шапка</h3>
                            </div>
                            @foreach($headers as $header)
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label>Заголовок</label>
                                                <input type="text" class="form-control"
                                                       value="{{ $header->title }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Текст кнопки</label>
                                                <input type="text" class="form-control"
                                                       value="{{ $header->button_text }}" disabled>
                                            </div>
                                        </div>
                                        @if($headers->count() > 0)
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label>Сортировка</label>
                                                <select class="form-control"  disabled>
                                                    @for($i = 0; $i < $headers->count(); $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <i class="fas fa-trash"></i>Удалить
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Текст в шапке</label>
                                        <textarea class="form-control"
                                                  rows="3" disabled>{{ $header->excerpt }}</textarea>
                                    </div>
                                </div>
                                <hr style="border: solid 1px black">
                            @endforeach
                        @endif

                        @if($posts)
                            <div class="card-header" style="background-color: #00b3ff">
                                <h3 class="card-title">Записи</h3>
                            </div>
                        @foreach($posts as $post)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label>Заголовок</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $post->title }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="image_label_{{ $loop->index }}">Фото</label>
                                            <img src="{{ $post->img }}" alt="" style="max-height: 100px">
                                        </div>
                                    </div>
                                    @if($posts->count() > 1)
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label>Сортировка</label>
                                                <select class="form-control" disabled>
                                                    @for($i = 0; $i < $posts->count(); $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <i class="fas fa-trash"></i>Удалить
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Текст</label>
                                    <textarea class="form-control"
                                              rows="3" disabled>{{ $post->content }}</textarea>
                                </div>
                            </div>
                            <hr style="border: solid 1px black">
                        @endforeach

                        @endif

                        @if($decoratives)
                            <div class="card-header" style="background-color: #00b3ff">
                                <h3 class="card-title">Декоративный блок</h3>
                            </div>
                        @foreach($decoratives as $decorative)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label>Заголовок</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $decorative->title }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <i class="fas fa-trash"></i>Удалить
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Текст</label>
                                    <textarea class="form-control"
                                              rows="3" disabled>{{ $decorative->excerpt }}</textarea>
                                </div>
                            </div>
                                <hr style="border: solid 1px black">
                        @endforeach
                        @endif

                        @if($progresies)
                            <div class="card-header" style="background-color: #00b3ff"><h3 class="card-title">
                                    Отличия</h3></div>
                        @foreach($progresies as $progress)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label>Заголовок</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $progress->title }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <i class="fas fa-trash"></i>Удалить
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Текст</label>
                                    <textarea class="form-control"
                                              rows="3" disabled>{{ $progress->excerpt }}</textarea>
                                </div>
                            </div>
                            @endforeach
                        @endif


                        @if($contents)
                            <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

                            <div class="card-header" style="background-color: #00b3ff"><h3 class="card-title">
                                    Произвольный текст</h3></div>
                        @foreach($contents as $content)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label>Заголовок</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $content->title }}" disabled>
                                        </div>
                                    </div>

                                    @if($contents->count() > 0)
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label>Сортировка</label>
                                                <select class="form-control" disabled>
                                                    @for($i = 0; $i < $contents->count(); $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <i class="fas fa-trash"></i>Удалить
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Текст</label>
                                    <textarea class="form-control"
                                              rows="3" disabled>{{ $content->content }}</textarea>
                                </div>
                            </div>
                        @endforeach
                        @endif
                        <div class="card-footer">
                            <a href="{{ route('admin.landing.edit') }}" class="btn btn-primary">Редактировать</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
