@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.category_tour.update', ['category_tour'=>$category->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Категория</label>
                                <input type="text" class="form-control" id="name" name="title"
                                       value="{{ $category->title }}" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="img">Текущее изображение</label>
                                        <img id="img" src="{{ $category->img }}" alt="" style="max-height: 200px; width: auto;">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="icon">Текущая иконка</label>
                                        <img id="icon" src="{{ $category->icon }}" alt="" style="max-height: 200px; width: auto;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image_label">Выбор изображения</label>
                                <div class="input-group">
                                    <input type="text" id="image_label" class="form-control" name="img" value="{{ $category->img }}"
                                           aria-label="Image" aria-describedby="button-image">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-image">Выбрать</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon_label">Выбор иконки</label>
                                <div class="input-group">
                                    <input type="text" id="icon_label" class="form-control" name="icon" value="{{ $category->icon }}"
                                           aria-label="Image" aria-describedby="icon-image">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="icon-image">Выбрать</button>
                                    </div>
                                </div>
                            </div>
                            @verbatim
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        document.getElementById('button-image').addEventListener('click', (event) => {
                                            event.preventDefault();
                                            inputId = 'image_label'
                                            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                                        });
                                    });

                                    document.addEventListener("DOMContentLoaded", function() {
                                        document.getElementById('icon-image').addEventListener('click', (event) => {
                                            event.preventDefault();
                                            inputId = 'icon_label'
                                            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                                        });
                                    });

                                    let inputId = '';
                                    function fmSetLink($url) {
                                        document.getElementById(inputId).value = $url;
                                    }
                                </script>
                            @endverbatim

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{--    <link rel="stylesheet" href="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.css')}}">--}}
{{--<script src="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>--}}
{{--    <script>$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })</script>--}}
@endsection
