@extends('admin::layouts.master')

{{--@section('navbar')
    @include('admin::parts.navbar_tour', ['id' => $tour->id])
@endsection--}}

@section('content')
    <form role="form" action="{{ route('admin.tour.general.update', ['general' => $tour->id]) }}" method="post">
        @csrf
        @method('PUT')
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
                                           name="active"{{$checked}}>
                                </dd>
                                <dt class="col-sm-4">Одобрен администратором</dt>
                                <dd class="col-sm-8">
                                    @php
                                        if ($tour->good){
                                            $checked = ' checked';
                                        }else{$checked = '';}
                                    @endphp
                                    <input class="form-check-input" type="checkbox" id="good"
                                           name="good"{{$checked}}>
                                </dd>

                                <dt class="col-sm-4">Удалить это мероприятие</dt>
                                <dd class="col-sm-8">
                                    <input class="form-check-input" type="checkbox" name="delete_event" id="delete_event">
                                </dd>

                            </dl>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" onclick="return delete_item()">Применить</button>
                </div>
            </div>


    </form>
@endsection
@section('scripts')
    <script>
        function delete_item() {
            if ($('#delete_event').is(':checked')){
                return confirm('Удалить это мероприятие?');
            }
        }
    </script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('description', {
            filebrowserImageBrowseUrl: '/file-manager/ckeditor',
            height: 300
        });
    </script>
@endsection
