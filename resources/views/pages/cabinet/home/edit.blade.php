@extends('layouts.app')

@section('styles')
@include('pages.cabinet.styles')
@endsection

@section('scripts')
@include('pages.cabinet.scripts')
<script>
    $(function() {
        var imagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img class="img-fluid">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
    });
</script>
<script>
    $(".chosen-select").select2({
        tags: true
    });
</script>
<script>
    $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            $("#photogallery").on("change", function(e) {
                let files = e.target.files,
                    filesLength = files.length;
                for (let i = 0; i < filesLength; i++) {
                    let f = files[i]
                    let fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        let file = e.target;
                        $("<span class=\"photogallery-demo\">" +
                            "<img class=\"photogallery-elem\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                            "<span class=\"removebtn\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span>" +
                            "</span>").insertAfter(".photogallery-container");
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Ваш браузер устарел и не поддерживает загрузку!")
        }
    });
</script>
<script>
    $(".removebtn").click(function(e) {
        $.ajax({
            type: "POST",
            url: "{{ url('delete-img-gallery-author') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'url': e.target.parentElement.previousElementSibling.src,
                'id': {{ $user->id }}
            },
            success: function (msg) {
                $(e.target.parentElement.parentElement).remove();
                //console.log(e.target);
            },
            error: function (msg, textStatus) {
                //console.log('Неудача. ' + textStatus);
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
                        <div class="information-create-block">
                            <h1 class="create-title">Мои данные</h1>
                            @if((auth()->user()->profile->auth ?? false))
                            <a href="{{ route('site.author.show', ['id' => $user->id]) }}" target="_blank" class="btn-views">Посмотреть</a>
                            @endif
                        </div>
                        <div class="panel-create">
                            <form enctype="multipart/form-data" action="{{ route('site.cabinet.user.update', ['user' => auth()->id()]) }}" autocomplete="off" method="post">
                                @csrf
                                @method('PUT')
                                <div class="block-panel">
                                    <label for="name" class="create-subtitle">Имя и фамилия:</label>
                                    <input id="name" type="text" name="name" value="{{ $user->name }}" required>
                                    <p style="padding: 10px">{{ $user->email }}</p>
                                </div>
                                @if($user->profile)
                                    <div class="block-panel">
                                        <label for="avatar" class="create-subtitle">Аватар:</label>
                                        <div class="block-avatar">
                                            <div class="choose-file">
                                                <div class="upload-demo">
                                                    <div class="upload-demo-wrap">
                                                        @if($user->profile->avatar)
                                                            <img class="img-fluid portimg" src="{{ json_decode($user->profile->avatar)[0] ?? '' }}" alt="аватар">
                                                        @else
                                                            <img class="img-fluid portimg" src="{{ asset('assets/site/images/no-avatar.jpg') }}">
                                                        @endif
                                                    </div>
                                                </div>
                                                <span class="btn_upload">
                                                <input type="file" name="avatar" class="inputfile photo-variant">
                                                Загрузить фото
                                            </span>
                                            </div>
                                        </div>
                                    </div>


                                <div class="block-panel">
                                    <label for="name-excerpt" class="create-subtitle">Информация об авторе (преподавателе):</label>
                                    <div class="block-panel-sub">
                                        <p>Опишите в форме ниже краткую информацию об авторе. Может использоваться в лентах.</p>
                                        <textarea id="name-excerpt" name="excerpt">{{ $user->profile->excerpt ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="block-panel">
                                    <label for="name-desk" class="create-subtitle">Информация об авторе (преподавателе):</label>
                                    <div class="block-panel-sub">
                                        <p>Опишите в форме ниже подробную информацию об авторе (преподавателе). Используется на странице автора.</p>
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
                                                <span  data-gallery="gallery_{{ $user->profile->id }}" data-src="{{ $src }}" class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                        @endforeach
                                        <p><span>Добавьте фото автора (преподавателя), а также фото, которые посчитаете интересными для профиля</span></p>
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
                                @else
                                    <p>Чтобы получить возможность создания своих мероприятий, нажмите кнопку ниже для создания профиля.</p>
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
