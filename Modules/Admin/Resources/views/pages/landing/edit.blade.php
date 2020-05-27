@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.landing.update', ['landing' => 0]) }}" method="post">
                        @csrf
                        @if($headers)
                            <div class="card-header" style="background-color: #00b3ff">
                                <h3 class="card-title">Шапка</h3>
                            </div>
                            @foreach($headers as $header)
                                <div class="card-body" style='background-image: url("{{ $header->img }}")'>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label>Заголовок</label>
                                                <input type="text" class="form-control" name="title_{{ $header->id }}"
                                                       value="{{ $header->title }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Текст кнопки</label>
                                                <input type="text" class="form-control"
                                                       name="button-text_{{ $header->id }}"
                                                       value="{{ $header->button_text }}">
                                            </div>
                                        </div>
                                        @if($headers->count() > 1)
                                            <div class="col-sm-1">
                                                <div class="form-group">
                                                    <label>Сортировка</label>
                                                    <select class="form-control" name="sort_{{ $header->id }}">
                                                        @for($i = 0; $i < $headers->count(); $i++)
                                                            <?php if ($header->sort == $i) $selected = ' selected'; else $selected = ''; ?>
                                                            <option value="{{ $i }}"{{ $selected }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <a href="{{ route('admin.landing.destroy', ['id' => $header->id]) }}"
                                                   class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
                                                    <i class="fas fa-trash"></i>Удалить
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="form-group">
                                                <label for="image_label_{{ $loop->index }}">Фоновое изображение</label>
                                                <div class="input-group">
                                                    <input type="text" id="header_image_label_{{ $loop->index }}"
                                                           class="form-control" name="img_{{ $header->id }}"
                                                           aria-label="Image" aria-describedby="button-image"
                                                           value="{{ $header->img }}">
                                                    <div class="input-group-append">
                                                        <a href="#" class="btn btn-outline-secondary" type="a"
                                                           id="header_button-image_{{ $loop->index }}">Выбрать
                                                        </a>
                                                    </div>
                                                </div>
                                                <img src="{{ $header->img }}" alt="" style="max-height: 100px">
                                            </div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function () {
                                                    document.getElementById('header_button-image_{{ $loop->index }}').addEventListener('click', (event) => {
                                                        event.preventDefault();
                                                        inputId = "header_image_label_{{ $loop->index }}"
                                                        window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                                                    });
                                                });
                                            </script>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Текст в шапке</label>
                                        <textarea name="excerpt_{{ $header->id }}" class="form-control"
                                                  rows="3">{{ $header->excerpt }}</textarea>
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
                                                <input type="text" class="form-control" name="title_{{ $post->id }}"
                                                       value="{{ $post->title }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">

                                            <div class="form-group">
                                                <label for="image_label_{{ $loop->index }}">Фото</label>
                                                <div class="input-group">
                                                    <input type="text" id="image_label_{{ $loop->index }}"
                                                           class="form-control" name="img_{{ $post->id }}"
                                                           aria-label="Image" aria-describedby="button-image"
                                                           value="{{ $post->img }}">
                                                    <div class="input-group-append">
                                                        <a href="#" class="btn btn-outline-secondary" type="a"
                                                           id="button-image_{{ $loop->index }}">Выбрать
                                                        </a>
                                                    </div>
                                                </div>
                                                <img src="{{ $post->img }}" alt="" style="max-height: 100px">
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
                                        @if($posts->count() > 1)
                                            <div class="col-sm-1">
                                                <div class="form-group">
                                                    <label>Сортировка</label>
                                                    <select class="form-control" name="sort_{{ $post->id }}">
                                                        @for($i = 0; $i < $posts->count(); $i++)
                                                            <?php if ($post->sort == $i) $selected = ' selected'; else $selected = ''; ?>
                                                            <option value="{{ $i }}"{{ $selected }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <a href="{{ route('admin.landing.destroy', ['id' => $post->id]) }}"
                                                   class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
                                                    <i class="fas fa-trash"></i>Удалить
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Текст</label>
                                        <textarea name="excerpt_{{ $post->id }}" class="form-control"
                                                  rows="3">{{ $post->excerpt }}</textarea>
                                    </div>
                                </div>
                                <hr style="border: solid 1px black">
                            @endforeach
                            <script>
                                let inputId = '';

                                function fmSetLink($url) {
                                    document.getElementById(inputId).value = $url;
                                }
                            </script>
                        @endif

                        @if($decoratives)
                            <div class="card-header" style="background-color: #00b3ff">
                                <h3 class="card-title">Декоративный блок</h3>
                            </div>
                            @foreach($decoratives as $decorative)
                                <div class="card-body" style='background-image: url("{{ $decorative->img }}")'>

                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="form-group">
                                                <label for="image_label_{{ $loop->index }}">Фоновое изображение</label>
                                                <div class="input-group">
                                                    <input type="text" id="decorative_image_label_{{ $loop->index }}"
                                                           class="form-control" name="img_{{ $decorative->id }}"
                                                           aria-label="Image" aria-describedby="button-image"
                                                           value="{{ $decorative->img }}">
                                                    <div class="input-group-append">
                                                        <a href="#" class="btn btn-outline-secondary" type="a"
                                                           id="decorative_button-image_{{ $loop->index }}">Выбрать
                                                        </a>
                                                    </div>
                                                </div>
                                                <img src="{{ $decorative->img }}" alt="" style="max-height: 100px">
                                            </div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function () {
                                                    document.getElementById('decorative_button-image_{{ $loop->index }}').addEventListener('click', (event) => {
                                                        event.preventDefault();
                                                        inputId = "decorative_image_label_{{ $loop->index }}"
                                                        window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                                                    });
                                                });
                                            </script>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label>Заголовок</label>
                                                <input type="text" class="form-control"
                                                       name="title_{{ $decorative->id }}"
                                                       value="{{ $decorative->title }}">
                                            </div>
                                        </div>

                                        @if($decoratives->count() > 1)
                                            <div class="col-sm-1">
                                                <div class="form-group">
                                                    <label>Сортировка</label>
                                                    <select class="form-control" name="sort_{{ $decorative->id }}">
                                                        @for($i = 0; $i < $decoratives->count(); $i++)
                                                            <?php if ($decorative->sort == $i) $selected = ' selected'; else $selected = ''; ?>
                                                            <option value="{{ $i }}"{{ $selected }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <a href="{{ route('admin.landing.destroy', ['id' => $decorative->id]) }}"
                                                   class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
                                                    <i class="fas fa-trash"></i>Удалить
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Текст</label>
                                        <textarea name="excerpt_{{ $decorative->id }}" class="form-control"
                                                  rows="3">{{ $decorative->excerpt }}</textarea>
                                    </div>
                                </div>
                                <hr style="border: solid 1px black">
                            @endforeach
                        @endif

                        @if($progresies)
                            <div class="card-header" style="background-color: #00b3ff">
                                <h3 class="card-title">Отличия</h3>
                            </div>
                            @foreach($progresies as $progress)
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            @if($loop->index == 0)
                                                <div class="form-group">
                                                    <label>Заголовок блока</label>
                                                    <input type="text" class="form-control"
                                                           name="title_{{ $progress->id }}"
                                                           value="{{ $progress->title }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Текст кнопки</label>
                                                    <input type="text" class="form-control"
                                                           name="button-text_{{ $progress->id }}"
                                                           value="{{ $progress->button_text }}">
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label>Заголовок элемента</label>
                                                    <input type="text" class="form-control"
                                                           name="title_{{ $progress->id }}"
                                                           value="{{ $progress->title }}">
                                                </div>
                                            @endif

                                        </div>

                                        @if($progresies->count() > 1)
                                            <div class="col-sm-1">
                                                <div class="form-group">
                                                    <label>Сортировка</label>
                                                    <select class="form-control" name="sort_{{ $progress->id }}">
                                                        @for($i = 0; $i < $progresies->count(); $i++)
                                                            <?php if ($progress->sort == $i) $selected = ' selected'; else $selected = ''; ?>
                                                            <option value="{{ $i }}"{{ $selected }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <a href="{{ route('admin.landing.destroy', ['id' => $progress->id]) }}"
                                                   class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
                                                    <i class="fas fa-trash"></i>Удалить
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @if($loop->index > 0)
                                        <div class="form-group">
                                            <label>Текст</label>
                                            <textarea name="excerpt_{{ $progress->id }}" class="form-control"
                                                      rows="3">{{ $progress->excerpt }}</textarea>
                                        </div>
                                    @endif
                                </div>
                                <hr style="border: solid 1px black">
                            @endforeach
                        @endif


                        @if($contents)
                            <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

                            <div class="card-header" style="background-color: #00b3ff">
                                <h3 class="card-title">Произвольный текст</h3>
                            </div>
                            @foreach($contents as $content)
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label>Заголовок</label>
                                                <input type="text" class="form-control" name="title_{{ $content->id }}"
                                                       value="{{ $content->title }}">
                                            </div>
                                        </div>

                                        @if($contents->count() > 1)
                                            <div class="col-sm-1">
                                                <div class="form-group">
                                                    <label>Сортировка</label>
                                                    <select class="form-control" name="sort_{{ $content->id }}">
                                                        @for($i = 0; $i < $contents->count(); $i++)
                                                            <?php if ($content->sort == $i) $selected = ' selected'; else $selected = ''; ?>
                                                            <option value="{{ $i }}"{{ $selected }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <a href="{{ route('admin.landing.destroy', ['id' => $content->id]) }}"
                                                   class="btn btn-danger btn-sm" style="margin-top: 2.1rem">
                                                    <i class="fas fa-trash"></i>Удалить
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Текст</label>
                                        <textarea id="editor_{{ $content->id }}" name="content_{{ $content->id }}"
                                                  class="form-control"
                                                  rows="3">{{ $content->content }}</textarea>
                                    </div>
                                    <script> CKEDITOR.replace('editor_{{ $content->id }}', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'}); </script>
                                </div>
                                <hr style="border: solid 1px black">
                            @endforeach
                        @endif


                        <div class="card-footer">
                            <button class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>

                    <form action="{{ route('admin.landing.add_field') }}" method="post">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Выберите тип поля</label>
                                            <select name="post_type" class="form-control">
                                                <option value="header">Шапка</option>
                                                <option value="post">Записи</option>
                                                <option value="decorative">Декоративный блок</option>
                                                <option value="progress">Отличия</option>
                                                <option value="content">Произвольный текст</option>
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
            </div>
        </div>
    </div>


@endsection
