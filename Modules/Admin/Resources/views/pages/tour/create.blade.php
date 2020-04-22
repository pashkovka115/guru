@extends('admin::layouts.master')

@section('content')
    <form role="form" action="{{ route('admin.tour.store') }}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Категория</label>
                                <select class="form-control" name="category">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Заголовок браузера (title)</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="h1">Наименование тура (h1)</label>
                                <input type="text" class="form-control" id="h1" name="h1" value="{{ old('h1') }}"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="ceremony">
                                    <img alt="experiences" src="{{asset('assets/admin/icons/event-highlights-icon-01.svg')}}">
                                    Церемонии
                                </label>
                                <input type="text" class="form-control" id="ceremony" name="ceremony"
                                       value="{{ old('ceremony') }}">
                            </div>
                            <div class="form-group">
                                <label for="transfer">
                                    <img alt="transport" src="{{asset('assets/admin/icons/event-highlights-icon-02.svg')}}">
                                    Трансфер
                                </label>
                                <input type="text" class="form-control" id="transfer" name="transfer"
                                       value="{{ old('transfer') }}">
                            </div>
                            <div class="form-group">
                                <label for="number_of_people">
                                    <img alt="people" src="{{asset('assets/admin/icons/event-highlights-icon-03.svg')}}">
                                    Группа людей
                                </label>
                                <input type="text" class="form-control" id="number_of_people" name="number_of_people"
                                       value="{{ old('number_of_people') }}">
                            </div>
                            <div class="form-group">
                                <label for="nutrition">
                                    <img alt="people" src="{{asset('assets/admin/icons/event-highlights-icon-04.svg')}}">
                                    Питание
                                </label>
                                <input type="text" class="form-control" id="nutrition" name="nutrition"
                                       value="{{ old('nutrition') }}">
                            </div>
                            <div class="form-group">
                                <label for="hostel">
                                    <img alt="people" src="{{asset('assets/admin/icons/event-highlights-icon-05.svg')}}">
                                    Проживание
                                </label>
                                <input type="text" class="form-control" id="hostel" name="hostel"
                                       value="{{ old('hostel') }}">
                            </div>
                            <div class="form-group">
                                <label for="some_text">Произвольный текст событий</label>
                                <textarea rows="3" class="form-control" id="some_text"
                                          name="some_text">{{old('some_text')}}</textarea>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-body">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="active"
                                                   name="active" checked>
                                            <label for="active" class="form-check-label">Опубликовано</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="good"
                                                   name="good" checked>
                                            <label for="good" class="form-check-label">Одобрен администратором</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date_start">Дата начала</label>
                                <input type="text" class="form-control" id="date_start" name="date_start"
                                       value="{{ old('date_start') }}" placeholder="дд.мм.гггг">
                            </div>

                            <div class="form-group">
                                <label for="date_end">Дата окончания</label>
                                <input type="text" class="form-control" id="date_end" name="date_end"
                                       value="{{ old('date_end') }}" placeholder="дд.мм.гггг">
                            </div>

                            <div class="form-group">
                                <label for="price">Цена</label>
                                <input type="price" class="form-control" id="price" name="price"
                                       value="{{ old('price') }}">
                            </div>
                            <div class="form-group">
                                <label for="excerpt">Краткое описание</label>
                                <textarea rows="3" class="form-control" id="excerpt"
                                          name="excerpt">{{ old('excerpt') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image_label">Выбрать изображение</label>
                                <div class="input-group">
                                    <input type="text" id="image_label" class="form-control" name="img"
                                           aria-label="Image" aria-describedby="button-image" value="{{ old('img') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-image">
                                            Выбрать
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @verbatim
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        document.getElementById('button-image').addEventListener('click', (event) => {
                                            event.preventDefault();
                                            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                                        });
                                    });

                                    // set file link
                                    function fmSetLink($url) {
                                        document.getElementById('image_label').value = $url;
                                    }
                                </script>
                            @endverbatim
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="description">Полное описание</label>
                                <textarea id="description" name="description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('description', {
            filebrowserImageBrowseUrl: '/file-manager/ckeditor',
            height: 300
        });
    </script>
@endsection