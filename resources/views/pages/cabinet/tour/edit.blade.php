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
                            <h1 class="create-title">Редактировать мероприятие</h1>
                            <div class="panel-create">
                                <form enctype="multipart/form-data" action="{{ route('site.cabinet.tour.store') }}" autocomplete="off" method="post">
                                    @csrf
                                    <div class="block-panel">
                                        <label for="name" class="create-subtitle">Название мероприятия:</label>
                                        <input id="name" type="text" name="title" value="{{ $tour->title }}" required placeholder="Введите название вашего мероприятия">
                                    </div>
                                    <div class="block-panel">
                                        @php
                                            $tour_leaders = $tour->leaders;
                                        @endphp
                                        <label for="autor" class="create-subtitle">Ведущий:</label>
                                        <select class="chosen-select" id="autor" name="leader_ids[]" multiple="multiple">
                                            @foreach($organizator->leaders as $leader)
                                                @php
                                                foreach($tour_leaders as $t_lead){
                                                    if ($leader->id == $t_lead->id){
                                                        $selected = ' selected';
                                                        break;
                                                    }else{
                                                        $selected = '';
                                                    }
                                                }
                                                if (!isset($selected)) $selected = '';
                                                @endphp
                                            <option value="{{ $leader->id }}"{{ $selected }}>{{ $leader->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="block-panel">
                                        <label for="organization" class="create-subtitle">Организатор:</label>
                                        <input id="organization" value="{{ auth()->user()->name }}" disabled>
                                    </div>
                                    <div class="block-panel">
                                        <div class="block-selection">

                                            <div class="block-panel-sub">
                                                <p class="create-subtitle">Вариативность:</p>
                                                <p class="create-text-min">Укажите цену, даты, краткое описание для данного мероприятия в зависимости от колличества участников. При добавлении фотографии, оно также отрабразиться в общем списке фото.</p>

                                                @foreach($tour->variants as $variant)
                                                <div class="block-variants">
                                                    <div class="choose-file">
                                                        <div class="upload-demo">
                                                            <div class="upload-demo-wrap"><img class="img-fluid portimg" src="{{ $variant->photo_variant }}"></div>
                                                        </div>

                                                        <span class="btn_upload">
                                                                <input type="file" name="saved_photo_variant[]" class="inputfile photo-variant" value="{{ $variant->photo_variant }}">
                                                                Загрузить фото
                                                            </span>
                                                    </div>
                                                    <div class="block-variant-date">
                                                        <p>Дата начала</p>
                                                        <input class="text-variant" type="date" name="saved_date_start_variant[]" value="{{ explode(' ', $variant->date_start_variant)[0] }}">
                                                    </div>
                                                    <div class="block-variant-date">
                                                        <p>Дата окончания</p>
                                                        <input class="text-variant" type="date" name="saved_date_end_variant[]" value="{{ explode(' ', $variant->date_end_variant)[0] }}">
                                                    </div>
                                                    <div class="block-variant-desk">
                                                        <p>Краткое описание (проживание, питание и т.д.)</p>
                                                        <input class="text-variant" type="text" name="saved_text_variant[]" value="{{ $variant->text_variant }}">
                                                    </div>
                                                    <div class="block-variant-price">
                                                        <p>Цена (RUB)</p>
                                                        <input class="price-variant" type="text" name="saved_price_variant[]" value="{{ $variant->price_variant }}">
                                                    </div>
                                                    <div class="block-variant-amount">
                                                        <p>Кол. человек</p>
                                                        @php
                                                        $people = [
                                                            "1 человек",
                                                            "2 человека",
                                                            "3 человека",
                                                            "4 человека",
                                                            "5 человек",
                                                        ];

                                                        @endphp
                                                        <select name="saved_amount_variant[]" class="amount-variant">
                                                            <option>Не выбрано</option>
                                                            @foreach($people as $cnt)
                                                                @php
                                                                if ($cnt == $variant->amount_variant){
                                                                   $selected = ' selected';
                                                                }else{ $selected = ''; }
                                                                @endphp
                                                            <option value="{{ $cnt }}"{{ $selected }}>{{ $cnt }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="delete"><i class="fa fa-times" aria-hidden="true"></i></div>
                                                </div>
                                                @endforeach
                                                <button class="click_to_add_block" type="button">Добавить вариант</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="photogallery" class="create-subtitle">Фотогалерея:</label>
                                        <div class="block-panel-sub">
                                            @php
                                                foreach (json_decode($tour->gallery) as $src){
                                                 //   echo "<img src='$src'>";
                                                    echo "<img src='' alt='заглушка изображения'>";
                                                }
                                            @endphp
                                                <span class="btn_upload">
                                                    <input id="photogallery" type="file" name="photogallery[]" multiple class="photogallery">
                                                    Загрузить фото
                                                </span>
                                            <div class="photogallery-container"></div>
                                            <span class="photogallery-demo"><img class="photogallery-elem" src="https://www.tvr.by/upload/iblock/42d/42d1898756e574fcaf9b7519c354ce9c.jpg" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                            <span class="photogallery-demo"><img class="photogallery-elem" src="https://cdn24.img.ria.ru/images/151546/28/1515462835_0:0:1036:587_600x0_80_0_0_a75f922e8b052d966122e1c9dc40feb4.jpg" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                            <span class="photogallery-demo"><img class="photogallery-elem" src="https://avatars.mds.yandex.net/get-vh/1528766/17938558859946010694-8Om2usjIWnMGFo-u6w3VfA-1551431625/936x524" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                            <p>Объявления имеющее как минимум 5 высококачественных фотографии получают больший интересно со стороны клиентов, чем те, у которых нету фото. Максимальное колличество фото не более 20. <span>Изображнея не пройдут процесс проверки, если они включают в себя: текст, водяные знаки, коллажи, фильтры или размытости.</span></p>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="adress" class="create-subtitle">Месторасположение мероприятия:</label>
                                        <input id="address" type="text" name="address" value="{{ $tour->address }}">
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
                                            <textarea placeholder="Подробнее о локации проведения" id="adress-desk" name="adress_desk">{{ $tour->adress_desk }}</textarea>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="video-url" class="create-subtitle">Видео YouTube:</label>
                                        <input id="video-url" type="text" name="video_url" value="{{ $tour->video_url }}">
                                    </div>
                                    <div class="block-panel">
                                        <label for="tags" class="create-subtitle">Теги темы(максимум 5):</label>
                                        @php
                                        //dd($tour->tags)
                                        @endphp
                                        <select class="chosen-select" id="tags" name="tags[]" multiple="multiple">
                                            @foreach($tags as $tag)
                                                @php
                                                    foreach ($tour->tags as $t_tag){
                                                        if ($t_tag->id == $tag->id){
                                                            $selected = ' selected';
                                                            break;
                                                        }else { $selected = ''; }
                                                    }
                                                @endphp
                                            <option value="{{ $tag->id }}"{{ $selected }}>{{ $tag->tag }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="block-panel">
                                        <label for="text-desk" class="create-subtitle">Информация о мероприятии:</label>
                                        <textarea placeholder="Введите краткое описание вашего мероприятия" id="text-desk" name="info_excerpt">{{ $tour->info_excerpt }}</textarea>
                                    </div>
                                    <div class="block-panel">
                                        <label for="text-inform-event" class="create-subtitle">Подробнее о мероприятии:</label>
                                        <textarea placeholder="Перечислите подробную информацию, о вашем мероприятии:" id="text-inform-event" name="info_description">{{ $tour->info_description }}</textarea>
                                    </div>
                                    <div class="block-panel">
                                        <label for="group-event" class="create-subtitle">Размер группы:</label>
                                        <div class="block-panel-sub">
                                            @php
                                            $peop = [
                                                "1 человек",
                                                "2 человека",
                                                "3 человека",
                                                "4 человека",
                                                "5 человек",
                                                "от 5 до 10  человек",
                                                "от 10 до 20  человек",
                                                "от 20 до 50  человек",
                                            ];
                                            @endphp
                                            <p>Выберите максимальный размер группы</p>
                                            <select name="count_person" id="group-event">
                                                @foreach($peop as $pers)
                                                    @php
                                                    if ($pers == $tour->count_person){
                                                        $selected = ' selected';
                                                    }else{ $selected = ''; }
                                                    @endphp
                                                <option value="{{ $pers }}"{{ $selected }}>{{ $pers }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="timetable-event" class="create-subtitle">Расписание мероприятия:</label>
                                        <div class="block-panel-sub">
                                            <p>Опишите в форме ниже, детальное расписание мероприятия по дням. Оно не должно быть 100% точным. Дайте участникам понять, что будет происходить каждый день и как все организовано.</p>
                                            <textarea placeholder="Опишите, что участникам стоит ожидать в течении дня" id="timetable-event" name="timetable">{{ $tour->timetable }}</textarea>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="included-event" class="create-subtitle">Что включено в мероприятие:</label>
                                        <div class="block-panel-sub">
                                            <p>Перечислите все, что включено в ваше мероприятие. Это может включать питание, количество ночей проживания, конкретные мероприятия и стоимость авиабилетов.</p>
                                            <textarea placeholder="Опишите, что включено" id="included-event" name="included">{{ $tour->included }}</textarea>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="no-included-event" class="create-subtitle">Что не включено в мероприятие:</label>
                                        <div class="block-panel-sub">
                                            <p>Перечислите все, что не включено, например, дополнительные мероприятия и авиабилеты.</p>
                                            <textarea placeholder="Опишите, что не включено" id="no-included-event" name="no_included">{{ $tour->no_included }}</textarea>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="security-event" class="create-subtitle">Безопастность:</label>
                                        <div class="block-panel-sub">
                                            <p>Напишите информацию напротив пункта, если ничего не указывать, данное поле не будет выводиться.</p>
                                            <div class="block-security-event">
                                                <label class="first-aid">
                                                    <span>Первая помощь:</span>
                                                    <input type="text" name="first_aid" value="{{ $tour->first_aid }}" placeholder="Подробная информация">
                                                </label>
                                                <label class="drinking-water">
                                                    <span>Питьевая вода:</span>
                                                    <input type="text" name="drinking_water" value="{{ $tour->drinking_water }}" placeholder="Подробная информация">
                                                </label>
                                                <label class="communication">
                                                    <span>Wi-Fi / Интернет / Телефон:</span>
                                                    <input type="text" name="communication" value="{{ $tour->communication }}" placeholder="Подробная информация">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="accommodation-event" class="create-subtitle">Проживание и удобства:</label>
                                        <div class="block-panel-sub">
                                            <p>Добавьте 1-2 фотографии, опишите подробнее о проживании. Выберите варианты удоств, которые будуте доступны в вашем мероприятии.</p>
                                            @php
                                            $acc_photo = json_decode($tour->accommodation_photo);
                                            foreach ($acc_photo as $item) {
                                                echo " <img src='' alt='$item'> ";
                                            }
                                            @endphp
                                            <span class="btn_upload">
                                                    <input id="accommodation-photo" type="file" name="accommodation_photo[]" multiple="">
                                                    Загрузить фото
                                                </span>
                                            <div class="accommodation-container"></div>
                                            <span class="photogallery-demo"><img class="photogallery-elem" src="https://www.tvr.by/upload/iblock/42d/42d1898756e574fcaf9b7519c354ce9c.jpg" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                            <span class="photogallery-demo"><img class="photogallery-elem" src="https://cdn24.img.ria.ru/images/151546/28/1515462835_0:0:1036:587_600x0_80_0_0_a75f922e8b052d966122e1c9dc40feb4.jpg" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                            <textarea placeholder="Подробное описание" id="accommodation-event" name="accommodation_description"></textarea>
                                            <div class="comfort-event">
                                                <p class="create-subtitle">Выберите, какие удобства доступны:</p>
                                                <label for="conditioner">
                                                    <input type="checkbox" id="conditioner" name="conditioner" value="Кондиционер" @if($tour->conditioner) checked @endif>
                                                    <span>Кондиционер</span>
                                                </label>
                                                <label for="wifi">
                                                    <input type="checkbox" id="wifi" name="wifi" value="Беплатный Wifi" @if($tour->wifi) checked @endif>
                                                    <span>Беплатный Wifi</span>
                                                </label>
                                                <label for="pool">
                                                    <input type="checkbox" id="pool" name="pool" value="Бассейн" @if($tour->pool) checked @endif>
                                                    <span>Бассейн</span>
                                                </label>
                                                <label for="towel">
                                                    <input type="checkbox" id="towel" name="towel" value="Полотенца" @if($tour->towel) checked @endif>
                                                    <span>Полотенца</span>
                                                </label>
                                                <label for="kitchen">
                                                    <input type="checkbox" id="kitchen" name="kitchen" value="Кухня" @if($tour->kitchen) checked @endif>
                                                    <span>Кухня</span>
                                                </label>
                                                <label for="coffee-tea">
                                                    <input type="checkbox" id="coffee-tea" name="coffee_tea" value="Кофе / Чай" @if($tour->coffee_tea) checked @endif>
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
                                                    <input type="checkbox" name="private_room" value="Отдельный номер" @if($tour->private_room) checked @endif>
                                                    <span>Отдельный номер</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="dormitory_room" value="Общий номер" @if($tour->dormitory_room) checked @endif>
                                                    <span>Общий номер</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="separate_house" value="Отдельный домик" @if($tour->separate_house) checked @endif>
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
                                                    <input type="checkbox" name="transfer_free" value="Встреча в аэропорту и траснфер (бесплатно)" @if($tour->transfer_free) checked @endif>
                                                    <span>Встреча в аэропорту и траснфер (бесплатно)</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="transfer_fee" value="Встреча в аэропорту и траснфер (за доп.плату)" @if($tour->transfer_fee) checked @endif>
                                                    <span>Встреча в аэропорту и траснфер (за доп.плату)</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="not_transfer" value="Добираетесь сами" @if($tour->not_transfer) checked @endif>
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
                                            <span class="photogallery-demo"><img class="photogallery-elem" src="https://www.tvr.by/upload/iblock/42d/42d1898756e574fcaf9b7519c354ce9c.jpg" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                            <span class="photogallery-demo"><img class="photogallery-elem" src="https://cdn24.img.ria.ru/images/151546/28/1515462835_0:0:1036:587_600x0_80_0_0_a75f922e8b052d966122e1c9dc40feb4.jpg" title="undefined"><span class="removebtn"><i class="fa fa-times" aria-hidden="true"></i></span></span>
                                            <textarea placeholder="Подробное описание" id="meals-event" name="meals_desc">{{ old('meals_desc') }}</textarea>
                                            <div class="comfort-event">
                                                <p class="create-subtitle">Выберите, варианты меню:</p>
                                                <label for="vegan">
                                                    <input type="checkbox" id="vegan" name="vegan" value="Веган" @if($tour->vegan) checked @endif>
                                                    <span>Веган</span>
                                                </label>
                                                <label for="vegetarianism">
                                                    <input type="checkbox" id="vegetarianism" name="vegetarianism" value="Вегетарианство" @if($tour->vegetarianism) checked @endif>
                                                    <span>Вегетарианство</span>
                                                </label>
                                                <label for="fish">
                                                    <input type="checkbox" id="fish" name="fish" value="Рыба" @if($tour->fish) checked @endif>
                                                    <span>Рыба</span>
                                                </label>
                                                <label for="ayurveda">
                                                    <input type="checkbox" id="ayurveda" name="ayurveda" value="Аюрведа" @if($tour->ayurveda) checked @endif>
                                                    <span>Аюрведа</span>
                                                </label>
                                                <label for="meat">
                                                    <input type="checkbox" id="meat" name="meat" value="Мясо" @if($tour->meat) checked @endif>
                                                    <span>Мясо</span>
                                                </label>
                                                <label for="organic">
                                                    <input type="checkbox" id="organic" name="organic" value="Органическая" @if($tour->organic) checked @endif>
                                                    <span>Органическая</span>
                                                </label>
                                                <label for="gluten-free">
                                                    <input type="checkbox" id="gluten-free" name="gluten_free" value="Без глютена" @if($tour->gluten_free) checked @endif>
                                                    <span>Без глютена</span>
                                                </label>
                                                <label for="milk-free">
                                                    <input type="checkbox" id="milk-free" name="milk_free" value="Без молока" @if($tour->milk_free) checked @endif>
                                                    <span>Без молока</span>
                                                </label>
                                                <label for="nuts-free">
                                                    <input type="checkbox" id="nuts-free" name="nuts_free" value="Без орехов" @if($tour->nuts_free) checked @endif>
                                                    <span>Без орехов</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="meals-event-variants" class="create-subtitle">Варианты питания:</label>
                                        <div class="block-panel-sub">
                                            <p>Выбрать подходящий вариант</p>
                                            @php
                                            $meats = [
                                                "3 раза в день",
                                                "2 раза в день",
                                                "1 раз в день",
                                                "Без питания",
                                            ];
                                            @endphp
                                            <select name="count_meals" id="meals-event-variants">
                                                @foreach($meats as $meat)
                                                    @php
                                                    if ($meat == $tour->count_meals){
                                                        $selected = ' selected';
                                                    }else{ $selected = ''; }
                                                    @endphp
                                                <option value="{{ $meat }}"{{ $selected }}>{{ $meat }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="category-event-variants" class="create-subtitle">Выбрать категорию мероприятия:</label>
                                        <div class="block-panel-sub">
                                            <p>Выбрать подходящий вариант</p>
                                            <select name="category_tour_id" id="category-event-variants">
                                                @foreach($tour_categpries as $category)
                                                    @php
                                                    if ($tour->category_tour_id == $category->id){
                                                        $selected = ' selected';
                                                    }else{ $selected = ''; }
                                                    @endphp
                                                <option value="{{ $category->id }}"{{ $selected }}>{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="block-publication">
                                        <button type="submit" class="btn-public">Опубликовать</button>
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
$('.click_to_add_block').click(function() {
      $(this).before(`
        <div class="block-variants">
            <div class="choose-file">
                <div class="upload-demo">
                    <div class="upload-demo-wrap"><img class="img-fluid portimg" src="{{ asset('assets/site/images/wide.jpg') }}"></div>
                </div>
                <span class="btn_upload">
                        <input type="file" name="photo_variant[]" class="inputfile photo-variant">
                        Загрузить фото
                    </span>
            </div>
            <div class="block-variant-date">
                <p>Дата начала</p>
                <input class="text-variant" type="date" name="date_start_variant[]" value="">
            </div>
            <div class="block-variant-date">
                <p>Дата окончания</p>
                <input class="text-variant" type="date" name="date_end_variant[]" value="">
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
        `);
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
<script>
    $(".removebtn").click(function(){
        $(this).parent(".photogallery-demo").remove();
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
