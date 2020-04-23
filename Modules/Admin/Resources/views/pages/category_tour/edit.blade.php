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
                                <label for="img">Текущее изображение</label>
                                <img id="img" src="{{ $category->img }}" alt="" style="max-height: 200px; width: auto;">
                            </div>

                            <div class="form-group">
                                <label for="image_label">Выбор изображения</label>
                                <div class="input-group">
                                    <input type="text" id="image_label" class="form-control" name="img"
                                           aria-label="Image" aria-describedby="button-image">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-image">Выбрать</button>
                                    </div>
                                </div>
                            </div>
                            @verbatim
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {

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
