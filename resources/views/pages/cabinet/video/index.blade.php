@extends('layouts.app')

@section('styles')
    @include('pages.cabinet.styles')
@endsection

@section('scripts')
    @include('pages.cabinet.scripts')
@endsection

@section('content')
    <div class="block_create">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('parts.cabinet.menu')
                    <div class="information-create">
                        <div class="information-create-block">
                            <h1 class="create-title">Видео</h1>
                            <a href="" target="_blank" class="btn-views">Посмотреть</a>
                        </div>
                        <div class="block-panel">
                            <div class="block-selection" style="width: 100%">
                                <div class="block-panel-sub">
                                    <?php
                                    $videos = json_decode($video_courses) ?? [];
                                    ?>
                                    @foreach($videos as $video)
                                        <div class="block-variants">
                                            <form class="form_edit" action="" method="post" style="width: 100%">
                                                @csrf
                                                <input type="hidden" name="old_link" value="{{ $video }}">
                                                <input class="video-url" type="text" name="video_url" value="{{ $video }}" placeholder="Ссылка на видео">
                                                <input type="submit" name="update_url"
                                                       value="Обновить"
                                                       data-action="{{ route('site.cabinet.video.update', ['video' => auth()->id()]) }}"
                                                       data-method="PUT"
                                                       style="width: 150px"
                                                >

                                                <input type="submit" name="delete_url"
                                                       value="Удалить"
                                                       data-action="{{ route('site.cabinet.video.destroy', ['video' => auth()->id()]) }}"
                                                        data-method="DELETE"
                                                       style="width: 150px"
                                                >
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="panel-create">
                            <form id="add_url" action="{{ route('site.cabinet.video.store') }}" autocomplete="off" method="post">
                                @csrf
                                <div class="block-panel">
                                    <div class="block-selection">
                                        <div class="block-panel-sub">
                                            <p class="create-text-min">Добавляйте свои видео-курсы вставля ссылки видео из youtube. Нажимайте кнопку добавить видео, чтобы появилось поля для вставки ссылки.</p>
                                            <button class="btn-add-video" type="button">Добавить видео</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-publication">
                                    <button form="add_url" type="submit" class="btn-public">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.body.onload = function () {
            $('.btn-add-video').click(function() {
                $(this).before(`<div class="block-variants"><input class="video-url" type="text" name="video_url[]" value="" placeholder="Ссылка на видео"></div>`);
            });

            $('form.form_edit').on('click', 'input[type="submit"]', function (e) {
                e.preventDefault();
                $this = $(this)
                var action_url = $this.data('action');
                var action_method = $this.data('method');
                var $form = $this.parent('form');

                $form.attr('action', action_url);
                $this.before('<input type="hidden" name="_method" value="' + action_method + '">');
                $form.submit();
            });
        };
    </script>
@endsection
