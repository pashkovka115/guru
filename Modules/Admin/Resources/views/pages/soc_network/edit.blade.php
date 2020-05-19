@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form role="form" action="{{ route('admin.settings.soc_network.update', ['soc_network' => $setting->id]) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example">Ссылка</label>
                                            <input type="text" class="form-control" id="example" name="url" value="{{ $setting->url }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ $setting->icon }}" alt="">
                                    </div>
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="image_label">Иконка</label>
                                                <div class="input-group">
                                                    <input type="text" id="image_label"
                                                           class="form-control" name="icon"
                                                           aria-label="Image" aria-describedby="button-image"
                                                           value="{{ $setting->icon }}">
                                                    <div class="input-group-append">
                                                        <a  href="#" class="btn btn-outline-secondary" type="a"
                                                            id="button-image">Выбрать
                                                        </a>
                                                    </div>
                                                </div>
                                                <img src="" alt="">
                                            </div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function () {
                                                    document.getElementById('button-image').addEventListener('click', (event) => {
                                                        event.preventDefault();
                                                        inputId = "image_label"
                                                        window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                                <script>
                                    let inputId = '';
                                    function fmSetLink($url) {
                                        document.getElementById(inputId).value = $url;
                                    }
                                </script>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection

