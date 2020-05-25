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
                        <h1 class="create-title">Создать автора (преподавателя)</h1>
                        <div class="panel-create">
                            <form enctype="multipart/form-data" action="{{ route('site.cabinet.leaders.store') }}" method="post">
                                @csrf
                                <div class="block-panel">
                                    <label for="name" class="create-subtitle">Имя и фамилия автора (преподавателя):</label>
                                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                                </div>
                                <div class="block-panel">
                                    <label for="email" class="create-subtitle">Email:</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="block-panel">
                                    <label for="avatar" class="create-subtitle">Аватар:</label>
                                    <div class="block-avatar">
                                        <div class="choose-file">
                                            <div class="upload-demo">
                                                <div class="upload-demo-wrap"><img class="img-fluid portimg" src="{{ asset('assets/site/images/no-avatar.jpg') }}"></div>
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
                                        <textarea id="name-desk" name="description"></textarea>
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
                                        <!-- Пример как будет выглядеть в редактировании -->
                                        {{--<span class="photogallery-demo"><img class="photogallery-elem" src="https://www.tvr.by/upload/iblock/42d/42d1898756e574fcaf9b7519c354ce9c.jpg" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                        <span class="photogallery-demo"><img class="photogallery-elem" src="https://cdn24.img.ria.ru/images/151546/28/1515462835_0:0:1036:587_600x0_80_0_0_a75f922e8b052d966122e1c9dc40feb4.jpg" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                        <span class="photogallery-demo"><img class="photogallery-elem" src="https://avatars.mds.yandex.net/get-vh/1528766/17938558859946010694-8Om2usjIWnMGFo-u6w3VfA-1551431625/936x524" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                        --}}
                                        <p>Добавьте фото автора (преподавателя), а также фото, которые посчитаете интересными для профиля</p>
                                    </div>
                                </div>
                                <div class="block-panel">
                                    <label for="adress" class="create-subtitle">Месторасположение автора (преподавателя):</label>
                                    <input id="address" type="text" name="address">
                                    <input id="street" type="hidden"name="street">
                                    <input id="house" type="hidden" name="house">
                                    <input id="region" type="hidden"name="region">
                                    <input id="city" type="hidden" name="city">
                                    <input id="country" type="hidden" name="country">
                                    <input id="latitude" type="hidden" name="latitude">
                                    <input id="longitude" type="hidden" name="longitude">
                                    <div id="map"></div>
                                </div>
                                <div class="block-panel">
                                    <label for="organization" class="create-subtitle">Организация автора (преподавателя):</label>
                                    <input id="organization" name="organization" value="{{ auth()->user()->name }}" disabled>
                                </div>
                                <div class="block-panel">
                                    <label for="video-url" class="create-subtitle">Видео YouTube:</label>
                                    <input id="video-url" type="text" name="url" value="{{ old('url') }}">
                                </div>

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
