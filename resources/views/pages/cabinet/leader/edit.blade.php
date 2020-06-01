@extends('layouts.app')

@section('styles')
    @include('pages.cabinet.styles')
@endsection

@section('scripts')
    @include('pages.cabinet.scripts')
    <script>
        $('.removebtn').on('click', function(){
            var $this  = $(this);
            var fieldName = $this.data('gallery');
            var fieldSrc = $this.data('src');

            $.ajax({
                type: "POST",
                url: "{{ route('site.ajax.gallery.author.remove') }}",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'field-name': fieldName,
                    'field-src': fieldSrc
                },
                success: function(msg){
                    // console.log(msg)
                    //$this.parent(".photogallery-demo").remove();
                },
                error: function (msg, textStatus) {
                    console.log('Неудача. ' + textStatus);
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="block_create">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('parts.cabinet.menu')
                    <div class="information-create">
                        <div class="personal_events">
                            <h1 class="create-title">Редактировать автора (преподавателя)</h1>
                            <a href="{{ route('site.author.show', ['id' => $user->id]) }}" target="_blank" class="btn-views">Посмотреть</a>
                        </div>
                        <div class="panel-create">
                            <form enctype="multipart/form-data" action="{{ route('site.cabinet.leaders.update', ['leader' => $user->id]) }}" autocomplete="off" method="post">
                                @csrf
                                @method('PUT')
                                <div class="block-panel">
                                    <label for="name" class="create-subtitle">Имя и фамилия автора (преподавателя):</label>
                                    <input id="name" type="text" name="name" value="{{ $user->name }}" required>
                                </div>
                                <div class="block-panel">
                                    <label for="email" class="create-subtitle">Email:</label>
                                    <input id="email" type="email" name="email" value="{{ $user->email }}" disabled>
                                </div>
                                @if($user->profile)
                                <div class="block-panel">
                                    <label for="avatar" class="create-subtitle">Аватар:</label>
                                    <div class="block-avatar">
                                        <div class="choose-file">
                                            <div class="upload-demo">
                                                <?php
                                                if ($user->profile->avatar){
                                                    $src = json_decode($user->profile->avatar)[0] ?: '';
                                                }else{
                                                    $src = asset('assets/site/images/no-avatar.jpg');
                                                }
                                                ?>
                                                <div class="upload-demo-wrap"><img class="img-fluid portimg" src="{{ $src }}"></div>
                                            </div>
                                            <span class="btn_upload">
                                                <input type="file" name="avatar" class="inputfile photo-variant">
                                                Загрузить фото
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-panel">
                                    <label for="name-desk" class="create-subtitle">Информация об авторе (преподавателе):</label>
                                    <div class="block-panel-sub">
                                        <p>Опишите в форме ниже подробную информацию об авторе (преподавателе)</p>
                                        <textarea id="name-desk" name="description">{{ $user->profile->description ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="block-panel">
                                    <label for="photogallery" class="create-subtitle">Фотогалерея:</label>
                                    <div class="block-panel-sub">
												<span class="btn_upload">
										        	<input id="photogallery" type="file" name="gallery[]" multiple class="photogallery" >
										        	Загрузить фото
										      	</span>
                                        <div class="photogallery-container"></div>
                                        <?php
                                        $gallery = json_decode($user->profile->gallery) ?? [];
                                        ?>
                                        @foreach($gallery as $src)
                                            <span class="photogallery-demo">
                                                <img class="photogallery-elem" src="{{ $src }}" title="undefined">
                                                <span class="removebtn" data-gallery="gallery_{{ $user->profile->id }}" data-src="{{ $src }}"><i class="fa fa-times" aria-hidden="true"></i></span>
                                            </span>
                                        @endforeach
                                        <p>Добавьте фото автора (преподавателя), а также фото, которые посчитаете интересными для профиля</p>
                                    </div>
                                </div>
                                <div class="block-panel">
                                    <label for="adress" class="create-subtitle">Месторасположение автора (преподавателя):</label>
                                    <input id="address" type="text" name="address" value="{{ $user->profile->address }}">
                                    <input id="street" type="hidden" name="street">
                                    <input id="house" type="hidden" name="house">
                                    <input id="region" type="hidden" name="region">
                                    <input id="city" type="hidden" name="city">
                                    <input id="country" type="hidden" name="country">
                                    <input id="latitude" type="hidden" name="latitude">
                                    <input id="longitude" type="hidden" name="longitude">
                                    <div id="map"></div>
                                </div>
                                <div class="block-panel">
                                    <label for="video-url" class="create-subtitle">Видео YouTube:</label>
                                    <input id="video-url" type="text" name="url" value="{{ $user->profile->url ?? '' }}">
                                </div>
                            @endif

                                <div class="block-publication">
                                    <button type="submit" class="btn-public">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts_footer')

@endsection
