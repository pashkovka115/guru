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
                        </div>
                        <div class="block-panel">
                            <div class="block-selection">
                                <div class="block-panel-sub">
                                    <?php
                                    $videos = (object)json_decode($video_courses) ?? [];
                                    ?>
                                    @foreach($videos as $video)
                                        <div class="block-variants">
                                            <form class="form_edit" action="{{ route('site.cabinet.video.destroy', ['video' => auth()->id()]) }}" method="post">
                                                @method('DELETE')
                                                @csrf
{{--                                                <input type="hidden" name="old_link" value="{{ $video }}">--}}
                                                <input class="video-url" type="text" name="video_url" value="{{ $video->url }}" placeholder="Ссылка на видео">
                                                <input class="video-title" type="text" name="video_title" value="{{ $video->title ?? '' }}" placeholder="Заголовок видео">
                                                <input type="submit" class="form_edit__btn-delete" value="Удалить">
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
                $(this).before(`<div class="block-videos"><input class="video-url" type="text" name="video_url[]" value="" placeholder="Ссылка на видео"><input class="video-title" type="text" name="video_title[]" value="" placeholder="Заголовок видео"></div>`);
            });
        };
    </script>
@endsection
