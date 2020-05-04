@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <form role="form" action="{{ route('admin.about.update') }}" method="post">
            @csrf
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
                                                   name="title_{{ $tit->id }}"
                                                   value="{{ $tit->title }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                        <a  href="{{ route('admin.about.destroy', ['id' => $tit->id]) }}" class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
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
                        <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
                        @foreach($contents as $content)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="form-group">
                                            <label for="content">Статья о нас</label>
                                            <textarea rows="7" id="content_{{ $content->id }}" style="width: 100%"
                                                      name="content_{{ $content->id }}">{{ $content->content }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <a  href="{{ route('admin.about.destroy', ['id' => $content->id]) }}" class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
                                                <i class="fas fa-trash"></i>Удалить
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script> CKEDITOR.replace('content_{{ $content->id }}', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'}); </script>
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
                                                   name="title_{{ $person->id }}" value="{{ $person->title }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="content">Должность</label>
                                            <input type="text" class="form-control" id="title"
                                                   name="excerpt_{{ $person->id }}" value="{{ $person->excerpt }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="content">О себе</label>
                                            <textarea rows="3" id="content" style="width: 100%"
                                                      name="content_{{ $person->id }}">{{ $person->content }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">
                                            <label for="image_label_{{ $loop->index }}">Фото</label>
                                            <div class="input-group">
                                                <input type="text" id="image_label_{{ $loop->index }}"
                                                       class="form-control" name="img_{{ $person->id }}"
                                                       aria-label="Image" aria-describedby="button-image"
                                                       value="{{ $person->img }}">
                                                <div class="input-group-append">
                                                    <a  href="#" class="btn btn-outline-secondary" type="a"
                                                            id="button-image_{{ $loop->index }}">Выбрать
                                                    </a>
                                                </div>
                                            </div>
                                            <img src="{{ $person->img }}" alt="">
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                document.getElementById('button-image_{{ $loop->index }}').addEventListener('click', (event) => {
                                                    event.preventDefault();
                                                    inputId = "image_label_{{ $loop->index }}"
                                                    window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                                                });
                                            });
                                        </script>

                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <a href="{{ route('admin.about.destroy', ['id' => $person->id]) }}" class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
                                                <i class="fas fa-trash"></i>Удалить
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <script>
                            let inputId = '';
                            function fmSetLink($url) {
                                document.getElementById(inputId).value = $url;
                            }
                        </script>
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
                                                   name="title_{{ $prog->id }}" value="{{ $prog->title }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="content">Описание</label>
                                            <textarea rows="3" id="content" style="width: 100%"
                                                      name="excerpt_{{ $prog->id }}">{{ $prog->excerpt }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <a  href="{{ route('admin.about.destroy', ['id' => $prog->id]) }}" class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
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
            @endif
            <div class="card-footer">
                <button class="btn btn-primary">Сохранить</button>
            </div>
        </form>

        <form action="{{ route('admin.about.add_field') }}" method="post">
            @csrf
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Выберите тип поля</label>
                                <select name="post_type" class="form-control">
                                    <option value="title">Заголовок страницы</option>
                                    <option value="content">Произвольный контент</option>
                                    <option value="people">Наша команда</option>
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

