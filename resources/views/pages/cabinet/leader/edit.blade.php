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
                    <div class="information-create">
                        <h1 class="create-title">Редактировать автора (преподавателя)</h1>
                        <a href="{{ route('site.author.show', ['id' => $user->id]) }}" target="_blank" class="btn-views">Посмотреть</a>
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
										        	<input id="photogallery" type="file" name="photogallery" multiple class="photogallery" >
										        	Загрузить фото
										      	</span>
                                        <div class="photogallery-container"></div>
                                        <!-- Пример как будет выглядеть в редактировании -->
                                        {{--<span class="photogallery-demo"><img class="photogallery-elem" src="https://www.tvr.by/upload/iblock/42d/42d1898756e574fcaf9b7519c354ce9c.jpg" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                        <span class="photogallery-demo"><img class="photogallery-elem" src="https://cdn24.img.ria.ru/images/151546/28/1515462835_0:0:1036:587_600x0_80_0_0_a75f922e8b052d966122e1c9dc40feb4.jpg" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                        <span class="photogallery-demo"><img class="photogallery-elem" src="https://avatars.mds.yandex.net/get-vh/1528766/17938558859946010694-8Om2usjIWnMGFo-u6w3VfA-1551431625/936x524" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>--}}
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
        let autocomplete,  marker, infowindow, map;
        function initMap() {

            /*map = new google.maps.Map(document.getElementById('map'), {
                center: {lat:-33.56, lng:151.21},
                zoom: 13
            });

            infowindow = new google.maps.InfoWindow();
            marker = new google.maps.Marker({
                map:map
            });*/

            let inputs = document.querySelector('#address');
            autocomplete = new google.maps.places.Autocomplete(inputs);

            google.maps.event.addListener(autocomplete,'place_changed',function() {

                /*marker.setVisible(false);
                infowindow.close();*/

                let place = autocomplete.getPlace();
                if(!place.geometry) {
                    alert('Error');
                }
                /*if(place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                }
                else {
                    alert('Error');
                }*/

                /*marker.setIcon({
                    url:place.icon,
                    scaledSize: new google.maps.Size(35,35)
                });

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);*/

                let address = '';
                if(place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                //infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                //infowindow.open(map, marker);

                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value= place.geometry.location.lng();

                let city = '';
                let street = '';
                let house = '';
                let region = '';
                let country = '';

                let tmp = '';
                place.address_components.forEach(function(item) {
                    tmp = item.long_name;
                    if(item.types) {
                        item.types.forEach(function(t) {

                            switch(t) {
                                case 'street_number':
                                    house = tmp;
                                    break;
                                case 'route' :
                                    street = tmp;
                                    break;
                                case 'administrative_area_level_1' :
                                case 'administrative_area_level_2' :
                                    region = tmp;
                                    break;
                                case 'country' :
                                    country = tmp;
                                    break;
                                case 'postal_town' :
                                case 'locality' :
                                    city = tmp;
                                    break;
                            }

                        });
                    }
                });
                document.getElementById('city').value = city;
                document.getElementById('street').value = street;
                document.getElementById('house').value = house;
                document.getElementById('region').value = region;
                document.getElementById('country').value = country;
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrIHJDN5FNpn8bC3CfiIzDR8uA-0tOD4Y&libraries=places&callback=initMap"></script>
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
            // $(this).parent(".photogallery-demo").remove();

            // if (e.target.parentElement.previousElementSibling.src && ! e.target.parentElement.previousElementSibling.src.startsWith('data:')) {
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
                        // $(this).parent(".photogallery-demo").remove();
                    },
                    error: function (msg, textStatus) {
                        //console.log('Неудача. ' + textStatus);
                    }
                });
            /*}else{
                $(this).parent(".photogallery-demo").remove();
            }*/

        });
    </script>

    <script>
        $('.login-list').click( function(){
            $('.login-sub').toggle();
        });
        $(document).on('click', function(e) {
            if (!$(e.target).closest(".login-list").length) {
                $('.login-sub').hide();
            }
            e.stopPropagation();
        });
    </script>
@endsection
