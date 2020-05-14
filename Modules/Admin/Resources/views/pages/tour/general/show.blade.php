@extends('admin::layouts.master')

@section('content')
    <form role="form">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                Информация о мероприятии
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Название</dt>
                                <dd class="col-sm-8">{{ $tour->title }}</dd>

                                <dt class="col-sm-4">Категория</dt>
                                <dd class="col-sm-8">{{ $tour->category->title }}</dd>

                                <dt class="col-sm-4">Организатор</dt>
                                <dd class="col-sm-8"><a target="_blank"
                                                        href="{{ route('site.author.show', ['id'=>$tour->user->id]) }}">{{ $tour->user->name }}</a></dd>

                                <dt class="col-sm-4">Email</dt>
                                <dd class="col-sm-8">{{ $tour->user->email }}</dd>

                                <dt class="col-sm-4">Адрес на сайте</dt>
                                <dd class="col-sm-8">
                                    <a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}" target="_blank">{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}</a>
                                </dd>
                            </dl>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                Действия
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Опубликовано</dt>
                                <dd class="col-sm-8">
                                    @php
                                        if ($tour->active){
                                            $checked = ' checked';
                                        }else{$checked = '';}
                                    @endphp
                                    <input class="form-check-input" type="checkbox" id="active"
                                           name="active"{{$checked}} disabled>
                                </dd>
                                <dt class="col-sm-4">Одобрен администратором</dt>
                                <dd class="col-sm-8">
                                    @php
                                        if ($tour->good){
                                            $checked = ' checked';
                                        }else{$checked = '';}
                                    @endphp
                                    <input class="form-check-input" type="checkbox" id="good"
                                           name="good"{{$checked}} disabled>
                                </dd>

                                <dt class="col-sm-4">Удалить это мероприятие</dt>
                                <dd class="col-sm-8">
                                    <input class="form-check-input" type="checkbox" id="delete_event" disabled>
                                </dd>

                            </dl>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('admin.tour.general.edit', ['general' => $tour->id]) }}" class="btn btn-primary">Редактировать</a>
            </div>
        </div>


    </form>
@endsection

