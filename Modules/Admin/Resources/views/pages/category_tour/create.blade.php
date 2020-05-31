@extends('admin::layouts.master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.category_tour.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Категория</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="image_label">Изображение</label>
                                <div class="input-group">
                                    <input type="text" id="image_label" class="form-control" name="img"
                                           aria-label="Image" aria-describedby="button-image">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
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
