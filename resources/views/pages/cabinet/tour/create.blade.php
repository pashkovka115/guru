@extends('layouts.app')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
        <div class="block_create">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="information-create">
                            <h1 class="create-title">Создать мероприятие</h1>
                            <div class="panel-create">
                                <form enctype="multipart/form-data" action="{{ route('site.cabinet.tour.store') }}" autocomplete="off" method="post">
                                    @csrf
                                    <div class="block-panel">
                                        <label for="name" class="create-subtitle">Название мероприятия*</label>
                                        <input id="name" type="text" name="title" value="{{ old('title') }}" required placeholder="Введите название вашего мероприятия">
                                    </div>
                                    <div class="block-panel">
                                        <label for="autor" class="create-subtitle">Ведущий:</label>
                                        <select class="chosen-select" id="autor" name="leader_ids[]" multiple="multiple">
                                            @foreach($organizator->leaders as $leader)
                                            <option value="{{ $leader->id }}">{{ $leader->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="block-panel">
                                        <label for="organization" class="create-subtitle">Организатор:</label>
                                        <input id="organization" value="{{ auth()->user()->name }}" disabled>
                                    </div>
                                    <div class="block-panel">
{{--                                        <label class="create-subtitle">Дата и цена:</label>--}}
                                        <div class="block-selection">
                                            {{--  TODO: этот блок переизбыточен, зачем он?   --}}
                                            {{--<div class="block-panel-sub">
                                                <p class="create-subtitle">Бронирование мероприятия:</p>
                                                <p class="create-checkbox">
                                                    <input checked name="date_type" type="radio" value="Определенная дата начала и окончания">Определенная дата начала и окончания
                                                </p>
                                                <p class="create-checkbox">
                                                    <input name="date_type" type="radio" value="Опция для онлайн-курсов">Опция для онлайн-курсов (нету даты начала и окончания)
                                                </p>
                                            </div>--}}
                                            <div class="block-panel-sub date-start-end">
                                                <p class="create-subtitle">Когда начинается и заканчивается ваше мероприятие?</p>
                                                <div class="create-date">
                                                    <div><p>Дата начала</p><input id="date-start" type="date" name="date_start" value="{{ old('date_start') }}"></div>
                                                    <div><p>Дата окончания</p><input id="date-end" type="date" name="date_end" value="{{ old('date_end') }}"></div>
                                                </div>
                                            </div>
                                            <div class="block-panel-sub">
                                                <p class="create-subtitle">Установить цену*</p>
                                                {{--  TODO: этот блок переизбыточен, зачем он?   --}}
                                                {{--<div class="create-price">
                                                    <p>Выбор цены:</p>
                                                    <select name="price" id="price">
                                                        <option value="Фиксированная цена">Фиксированная цена</option>
                                                        <option value="Бесплатно">Бесплатно</option>
                                                    </select>
                                                </div>--}}
                                                <div class="create-price specify-price">
{{--    TODO: необходимо в интерфейсе форматировать цену т.к. в базе цена хранится в копейках    --}}
                                                    <p>Укажите цену:</p>
                                                    <input id="price-base" type="text" name="price_base" value="{{ old('price_base') }}" required>
                                                    <span>RUB</span>
                                                </div>
                                            </div>
                                            <div class="block-panel-sub">
                                                <p class="create-subtitle">Вариативность цены:</p>
                                                <p class="create-text-min">Укажите цены для данного мероприятия в зависимости от колличества участников. При добавлении фотографии, оно также отрабразиться в общем списке фото.</p>
                                                <div class="block-variants">
                                                    <div class="choose-file">
                                                        <div class="upload-demo">
                                                            <div class="upload-demo-wrap"><img class="img-fluid portimg" src="{{ asset('assets/site/images/wide.jpg') }}"></div>
                                                        </div>
{{--    TODO: эта панель должна появляться только при клике по "добавить вариант", иначе её не должно быть в форме      --}}
                                                        <span class="btn_upload">
													        	<input type="file" name="photo_variant[]" class="inputfile photo-variant">
													        	Загрузить фото
													      	</span>
                                                    </div>
                                                    <div class="block-variant-date">
                                                        <p>Дата начала</p>
                                                        <input class="text-variant" type="text" name="date_start_variant[]" value="">
                                                    </div>
                                                    <div class="block-variant-date">
                                                        <p>Дата окончания</p>
                                                        <input class="text-variant" type="text" name="date_end_variant[]" value="">
                                                    </div>
                                                    <div class="block-variant-desk">
                                                        <p>Краткое описание (проживание, питание и т.д.)</p>
                                                        <input class="text-variant" type="text" name="text_variant[]" value="">
                                                    </div>
                                                    <div class="block-variant-price">
                                                        <p>Цена (RUB)</p>
                                                        <input class="price-variant" type="text" name="price_variant[]" value="">
                                                    </div>
                                                    <div class="block-variant-amount">
                                                        <p>Кол. человек</p>
                                                        <select name="amount_variant[]" class="amount-variant">
                                                            <option value="1 человек">1 человек</option>
                                                            <option value="2 человека">2 человек</option>
                                                            <option value="3 человека">3 человека</option>
                                                            <option value="4 человека">4 человека</option>
                                                            <option value="5 человек">5 человек</option>
                                                        </select>
                                                    </div>
                                                    <div class="delete"><i class="fa fa-times" aria-hidden="true"></i></div>
                                                </div>
                                                <button class="click_to_add_block" type="button">Добавить вариант</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="photogallery" class="create-subtitle">Фотогалерея:</label>
                                        <div class="block-panel-sub">
												<span class="btn_upload">
										        	<input id="photogallery" type="file" name="photogallery[]" multiple class="photogallery" >
										        	Загрузить фото
										      	</span>
                                            <div class="photogallery-container"></div>
                                            <p>Объявления имеющее как минимум 5 высококачественных фотографии получают больший интересно со стороны клиентов, чем те, у которых нету фото. Максимальное колличество фото не более 20. <span>Изображнея не пройдут процесс проверки, если они включают в себя: текст, водяные знаки, коллажи, фильтры или размытости.</span></p>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="adress" class="create-subtitle">Месторасположение мероприятия:</label>
                                        <input id="address" type="text" name="address" value="{{ old('address') }}">
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
                                        <label for="adress-desk" class="create-subtitle">Подробнее о месторасположении:</label>
                                        <div class="block-panel-sub">
                                            <p>Опишите в форме ниже подробную информацию о месторасположении(как добраться, где будет мероприятии точно и т.д.)</p>
                                            <textarea placeholder="Подробнее о локации проведения" id="adress-desk" name="adress_desk">{{ old('adress_desk') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="video-url" class="create-subtitle">Видео YouTube:</label>
                                        <input id="video-url" type="text" name="video_url" value="{{ old('video_url') }}">
                                    </div>
                                    <div class="block-panel">
                                        <label for="tags" class="create-subtitle">Теги темы(максимум 5):</label>
                                        <select class="chosen-select" id="tags" name="tags[]" multiple="multiple">
                                            @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="block-panel">
                                        <label for="text-desk" class="create-subtitle">Информация о мероприятии:</label>
                                        <textarea placeholder="Введите краткое описание вашего мероприятия" id="text-desk" name="info_excerpt">{{ old('info_excerpt') }}</textarea>
                                    </div>
                                    <div class="block-panel">
                                        <label for="text-inform-event" class="create-subtitle">Подробнее о мероприятии:</label>
                                        <textarea placeholder="Перечислите подробную информацию, о вашем мероприятии:" id="text-inform-event" name="info_description">{{ old('info_description') }}</textarea>
                                    </div>
                                    <div class="block-panel">
                                        <label for="group-event" class="create-subtitle">Размер группы:</label>
                                        <div class="block-panel-sub">
                                            <p>Выберите максимальный размер группы</p>
                                            <select name="count_person" id="group-event">
                                                <option value="1 человек">1 человек</option>
                                                <option value="2 человека">2 человек</option>
                                                <option value="3 человека">3 человека</option>
                                                <option value="4 человека">4 человека</option>
                                                <option value="5 человек">5 человек</option>
                                                <option value="от 5 до 10  человек">от 5 до 10</option>
                                                <option value="от 10 до 20  человек">от 10 до 20</option>
                                                <option value="от 20 до 50  человек">от 20 до 50</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="timetable-event" class="create-subtitle">Расписание мероприятия:</label>
                                        <div class="block-panel-sub">
                                            <p>Опишите в форме ниже, детальное расписание мероприятия по дням. Оно не должно быть 100% точным. Дайте участникам понять, что будет происходить каждый день и как все организовано.</p>
                                            <textarea placeholder="Опишите, что участникам стоит ожидать в течении дня" id="timetable-event" name="timetable">{{old('timetable')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="included-event" class="create-subtitle">Что включено в мероприятие:</label>
                                        <div class="block-panel-sub">
                                            <p>Перечислите все, что включено в ваше мероприятие. Это может включать питание, количество ночей проживания, конкретные мероприятия и стоимость авиабилетов.</p>
                                            <textarea placeholder="Опишите, что включено" id="included-event" name="included">{{ old('included') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="no-included-event" class="create-subtitle">Что не включено в мероприятие:</label>
                                        <div class="block-panel-sub">
                                            <p>Перечислите все, что не включено, например, дополнительные мероприятия и авиабилеты.</p>
                                            <textarea placeholder="Опишите, что не включено" id="no-included-event" name="no_included">{{ old('no_included') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="security-event" class="create-subtitle">Безопастность:</label>
                                        <div class="block-panel-sub">
                                            <p>Напишите информацию напротив пункта, если ничего не указывать, данное поле не будет выводиться.</p>
                                            <div class="block-security-event">
                                                <label class="first-aid">
                                                    <span>Первая помощь:</span>
                                                    <input type="text" name="first_aid" value="{{ old('first_aid') }}" placeholder="Подробная информация">
                                                </label>
                                                <label class="drinking-water">
                                                    <span>Питьевая вода:</span>
                                                    <input type="text" name="drinking_water" value="{{ old('drinking_water') }}" placeholder="Подробная информация">
                                                </label>
                                                <label class="communication">
                                                    <span>Wi-Fi / Интернет / Телефон:</span>
                                                    <input type="text" name="communication" value="{{ old('communication') }}" placeholder="Подробная информация">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="accommodation-event" class="create-subtitle">Проживание и удобства:</label>
                                        <div class="block-panel-sub">
                                            <p>Добавьте 1-2 фотографии, опишите подробнее о проживании. Выберите варианты удоств, которые будуте доступны в вашем мероприятии.</p>
                                            <span class="btn_upload">
										        	<input id="accommodation-photo" type="file" name="accommodation_photo[]" multiple="">
										        	Загрузить фото
										      	</span>
                                            <div class="accommodation-container"></div>
                                            <textarea placeholder="Подробное описание" id="accommodation-event" name="accommodation_description"></textarea>
                                            <div class="comfort-event">
                                                <p class="create-subtitle">Выберите, какие удобства доступны:</p>
                                                <label for="conditioner">
                                                    <input type="checkbox" id="conditioner" name="conditioner" value="Кондиционер">
                                                    <span>Кондиционер</span>
                                                </label>
                                                <label for="wifi">
                                                    <input type="checkbox" id="wifi" name="wifi" value="Беплатный Wifi">
                                                    <span>Беплатный Wifi</span>
                                                </label>
                                                <label for="pool">
                                                    <input type="checkbox" id="pool" name="pool" value="Бассейн">
                                                    <span>Бассейн</span>
                                                </label>
                                                <label for="towel">
                                                    <input type="checkbox" id="towel" name="towel" value="Полотенца">
                                                    <span>Полотенца</span>
                                                </label>
                                                <label for="kitchen">
                                                    <input type="checkbox" id="kitchen" name="kitchen" value="Кухня">
                                                    <span>Кухня</span>
                                                </label>
                                                <label for="coffee-tea">
                                                    <input type="checkbox" id="coffee-tea" name="coffee_tea" value="Кофе / Чай">
                                                    <span>Кофе / Чай</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="accommodation-event-variants" class="create-subtitle">Варианты размещения:</label>
                                        <div class="block-panel-sub">
                                            <p>Укажите подходящии варианты</p>
                                            <div class="block-security-event">
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="private_room" value="Отдельный номер">
                                                    <span>Отдельный номер</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="dormitory_room" value="Общий номер">
                                                    <span>Общий номер</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="separate_house" value="Отдельный домик">
                                                    <span>Отдельный домик</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="accommodation-event-variants" class="create-subtitle">Трансфер:</label>
                                        <div class="block-panel-sub">
                                            <p>Укажите подходящии варианты трасфера</p>
                                            <div class="block-security-event">
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="transfer_free" value="Встреча в аэропорту и траснфер (бесплатно)">
                                                    <span>Встреча в аэропорту и траснфер (бесплатно)</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="transfer_fee" value="Встреча в аэропорту и траснфер (за доп.плату)">
                                                    <span>Встреча в аэропорту и траснфер (за доп.плату)</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="not_transfer" value="Добираетесь сами">
                                                    <span>Добираетесь сами</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="meals-event" class="create-subtitle">Питание:</label>
                                        <div class="block-panel-sub">
                                            <p>Добавьте 1-2 фотографии, опишите подробнее о питании. Выберите варианты питания, которые будуте доступны в вашем мероприятии.</p>
                                            <span class="btn_upload">
										        	<input id="meals-photo" type="file" name="gallery_meals[]" multiple="">
										        	Загрузить фото
										      	</span>
                                            <div class="meals-container"></div>
                                            <textarea placeholder="Подробное описание" id="meals-event" name="meals_desc">{{ old('meals_desc') }}</textarea>
                                            <div class="comfort-event">
                                                <p class="create-subtitle">Выберите, варианты меню:</p>
                                                <label for="vegan">
                                                    <input type="checkbox" id="vegan" name="vegan" value="Веган">
                                                    <span>Веган</span>
                                                </label>
                                                <label for="vegetarianism">
                                                    <input type="checkbox" id="vegetarianism" name="vegetarianism" value="Вегетарианство">
                                                    <span>Вегетарианство</span>
                                                </label>
                                                <label for="fish">
                                                    <input type="checkbox" id="fish" name="fish" value="Рыба">
                                                    <span>Рыба</span>
                                                </label>
                                                <label for="ayurveda">
                                                    <input type="checkbox" id="ayurveda" name="ayurveda" value="Аюрведа">
                                                    <span>Аюрведа</span>
                                                </label>
                                                <label for="meat">
                                                    <input type="checkbox" id="meat" name="meat" value="Мясо">
                                                    <span>Мясо</span>
                                                </label>
                                                <label for="organic">
                                                    <input type="checkbox" id="organic" name="organic" value="Органическая">
                                                    <span>Органическая</span>
                                                </label>
                                                <label for="gluten-free">
                                                    <input type="checkbox" id="gluten-free" name="gluten_free" value="Без глютена">
                                                    <span>Без глютена</span>
                                                </label>
                                                <label for="milk-free">
                                                    <input type="checkbox" id="milk-free" name="milk_free" value="Без молока">
                                                    <span>Без молока</span>
                                                </label>
                                                <label for="nuts-free">
                                                    <input type="checkbox" id="nuts-free" name="nuts_free" value="Без орехов">
                                                    <span>Без орехов</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="meals-event-variants" class="create-subtitle">Варианты питания:</label>
                                        <div class="block-panel-sub">
                                            <p>Выбрать подходящий вариант</p>
                                            <select name="count_meals" id="meals-event-variants">
                                                <option disabled="Выбрать вариант" selected>Выбрать вариант</option>
                                                <option value="3 раза в день">3 раза в день</option>
                                                <option value="2 раза в день">2 раза в день</option>
                                                <option value="1 раз в день">1 раз в день</option>
                                                <option value="Без питания">Без питания</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="category-event-variants" class="create-subtitle">Выбрать категорию мероприятия:</label>
                                        <div class="block-panel-sub">
                                            <p>Выбрать подходящий вариант</p>
                                            <select name="category_tour_id" id="category-event-variants">
                                                <option disabled="Выбрать вариант" selected>Выбрать категорию</option>
                                                @foreach($tour_categpries as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="block-publication">
                                        <button type="submit" class="btn-public">Опубликовать</button>
{{--                                        <a class="no-btn-public" href="javascript:window.history.back();" title="Отмена">Отмена</a>--}}
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
{{--    <script src="{{asset('assets/site/js/readmore.min.js')}}"></script>--}}
{{--    <script src="{{asset('assets/site/js/owl.carousel.min.js')}}"></script>--}}
<script>
    $(function() {
        // Multiple images preview in browser
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
    let $block = $('.block-variants').clone();

    $('.click_to_add_block').click(function() {
        $(this).before($block.clone());
    });

    $(document).on('click', '.delete', function() {
        $(this).parent().remove();
    });
</script>
<script>
    $(document).ready(function() {
        $('#price').change(function() {
            if($(this).val() === "Бесплатно")
            {
                $(".specify-price").css("display", "none");
            }
            else
            {
                $(".specify-price").css("display", "flex");
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('[name=date_type]').change(function() {
            if($(this).val() === "Опция для онлайн-курсов")
            {
                $(".date-start-end").css("display", "none");
            }
            else
            {
                $(".date-start-end").css("display", "block");
            }
        });
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
    function readURL() {
        let $input = $(this);
        let $newinput =  $(this).parent().parent().parent().find('.portimg');
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                reset($newinput.next('.delbtn'), true);
                $newinput.attr('src', e.target.result).show();
                $newinput.after('<span class="delbtn removebtn"><i class="fa fa-times" aria-hidden="true"></i></span>');
            }
            reader.readAsDataURL(this.files[0]);
        }
    }
    $(document).on("change", ".photo-variant", readURL);
    $(document).on('click', '.choose-file .delbtn', function (e) {
        reset($(this));
    });

    function reset(elm, prserveFileName) {
        if (elm && elm.length > 0) {
            let $input = elm;
            $input.prev('.portimg').attr('src', '').hide();
            if (!prserveFileName) {
                $('input.photo-variant').val("");
            }
            elm.remove();
        }
    }
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
                        $(".removebtn").click(function(){
                            $(this).parent(".photogallery-demo").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
            });
            $("#accommodation-photo").on("change", function(e) {
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
                            "</span>").insertAfter(".accommodation-container");
                        $(".removebtn").click(function(){
                            $(this).parent(".photogallery-demo").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
            });
            $("#meals-photo").on("change", function(e) {
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
                            "</span>").insertAfter(".meals-container");
                        $(".removebtn").click(function(){
                            $(this).parent(".photogallery-demo").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Ваш браузер устарел и не поддерживает загрузку!")
        }
    });
</script>
{{--<script>
    $('.login-list').click( function(){
        $('.login-sub').toggle();
    });
    $(document).on('click', function(e) {
        if (!$(e.target).closest(".login-list").length) {
            $('.login-sub').hide();
        }
        e.stopPropagation();
    });
</script>--}}
@endsection
