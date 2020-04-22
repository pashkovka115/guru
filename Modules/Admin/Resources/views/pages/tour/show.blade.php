@extends('admin::layouts.master')

@section('content')
    <form role="form">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Категория</label>
                                @foreach($tour->categories as $category)
                                    <h5><span class="badge badge-secondary">{{$category->title}}</span></h5>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label for="title">Заголовок браузера (title)</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ $tour->title }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="h1">Наименование тура (h1)</label>
                                <input type="text" class="form-control" id="h1" name="h1" value="{{ $tour->h1 }}"
                                       disabled>
                            </div>

                            <div class="form-group">
                                <label for="ceremony">
                                    <img alt="experiences"
                                         src="{{asset('assets/admin/icons/event-highlights-icon-01.svg')}}">
                                    Церемонии
                                </label>
                                <input type="text" class="form-control" id="ceremony" name="ceremony"
                                       value="{{ $tour->ceremony }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="transfer">
                                    <img alt="transport"
                                         src="{{asset('assets/admin/icons/event-highlights-icon-02.svg')}}">
                                    Трансфер
                                </label>
                                <input type="text" class="form-control" id="transfer" name="transfer"
                                       value="{{ $tour->transfer }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="number_of_people">
                                    <img alt="people"
                                         src="{{asset('assets/admin/icons/event-highlights-icon-03.svg')}}">
                                    Группа людей
                                </label>
                                <input type="text" class="form-control" id="number_of_people" name="number_of_people"
                                       value="{{ $tour->number_of_people }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nutrition">
                                    <img alt="people"
                                         src="{{asset('assets/admin/icons/event-highlights-icon-04.svg')}}">
                                    Питание
                                </label>
                                <input type="text" class="form-control" id="nutrition" name="nutrition"
                                       value="{{ $tour->nutrition }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="hostel">
                                    <img alt="people"
                                         src="{{asset('assets/admin/icons/event-highlights-icon-05.svg')}}">
                                    Проживание
                                </label>
                                <input type="text" class="form-control" id="hostel" name="hostel"
                                       value="{{ $tour->hostel }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="some_text">Произвольный текст событий</label>
                                <textarea rows="3" class="form-control" id="some_text"
                                          name="some_text" disabled>{{$tour->some_text}}</textarea>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{route('admin.tour.edit', ['tour'=>$tour->id])}}" class="btn btn-primary">Редактировать</a>
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
                                            @php
                                                if ($tour->active){
                                                    $checked = ' checked';
                                                }else{$checked = '';}
                                            @endphp
                                            <input class="form-check-input" type="checkbox" id="active"
                                                   name="active" {{$checked}} disabled>
                                            <label for="active" class="form-check-label">Опубликовано</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            @php
                                                if ($tour->good){
                                                    $checked = ' checked';
                                                }else{$checked = '';}
                                            @endphp
                                            <input class="form-check-input" type="checkbox" id="good"
                                                   name="good" {{$checked}} disabled>
                                            <label for="good" class="form-check-label">Одобрен администратором</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date_start">Дата начала</label>
                                <input type="text" class="form-control" id="date_start" name="date_start"
                                       value="{{ \Carbon\Carbon::parse($tour->date_start)->format('d.m.Y') }}"
                                       placeholder="дд.мм.гггг" disabled>
                            </div>

                            <div class="form-group">
                                <label for="date_end">Дата окончания</label>
                                <input type="text" class="form-control" id="date_end" name="date_end"
                                       value="{{ \Carbon\Carbon::parse($tour->date_end)->format('d.m.Y') }}"
                                       placeholder="дд.мм.гггг" disabled>
                            </div>

                            <div class="form-group">
                                <label for="price">Цена</label>
                                <input type="price" class="form-control" id="price" name="price"
                                       value="{{ $tour->price }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="excerpt">Краткое описание</label>
                                <textarea rows="3" class="form-control" id="excerpt"
                                          name="excerpt" disabled>{{$tour->excerpt}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image_label">Текущее изображение</label>
                                <div class="input-group">
                                    <img src="{{ $tour->img }}" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="description">Полное описание</label>
                        <textarea rows="5" style="width: 100%" id="description" name="description"
                                  disabled>{{$tour->description}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

