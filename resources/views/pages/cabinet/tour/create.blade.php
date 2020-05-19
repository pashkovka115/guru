@extends('layouts.app')

@section('styles')
    @include('pages.cabinet.styles')
@endsection

@section('scripts')
    @include('pages.cabinet.scripts')
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
            <input class="price-variant" type="text" name="price_variant[]" value="" required>
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
        <div class="delete" data-id="0"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
    `);
        });

        $(document).on('click', '.delete', function(e) {
            // e.stopPropagation();
            // console.log(e.target.parentElement)
            $.ajax({
                type: "GET",
                url: "{{ url('delete-variant-tour') }}/" + e.target.parentElement.dataset.id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    //'id': e.target.parentElement.dataset.id
                },
                success: function(msg){
                    console.log(msg, 'удаление ' + e.target.parentElement.dataset.id);
                    $(e.target).parent().parent().remove();
                    // $(this).parent().remove();
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
                            <h1 class="create-title">Новое мероприятие</h1>
                            <div class="panel-create">
                                <form enctype="multipart/form-data" action="{{ route('site.cabinet.tour.store') }}" autocomplete="off" method="post">
                                    @csrf
                                    <div class="block-panel">
                                        <label for="name" class="create-subtitle">Название мероприятия:</label>
                                        <input id="name" type="text" name="title" value="{{ old('title') }}" required placeholder="Введите название вашего мероприятия">
                                    </div>
                                    <div class="block-panel">
                                        <label for="category-event-variants" class="create-subtitle">Выбрать категорию мероприятия:</label>
                                        <div class="block-panel-sub">
                                            <p>Выбрать подходящий вариант</p>
                                            <select name="category_tour_id" id="category-event-variants">
                                                @foreach($tour_categpries as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                        <div class="block-selection">

                                            <div class="block-panel-sub">
                                                <p class="create-subtitle">Вариативность:</p>
                                                <p class="create-text-min">Укажите цену, даты, краткое описание для данного мероприятия в зависимости от колличества участников. При добавлении фотографии, оно также отрабразиться в общем списке фото.</p>

                                                <button class="click_to_add_block" type="button">Добавить вариант</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="photogallery" class="create-subtitle">Фотогалерея:</label>
                                        <div class="block-panel-sub">
                                                <span class="btn_upload">
                                                    <input id="photogallery" type="file" name="photogallery[]" multiple class="photogallery">
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
                                        @php
                                        //dd($tour->tags)
                                        @endphp
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
                                                <option value="{{ $pers }}">{{ $pers }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="block-panel">
                                        <label for="timetable-event" class="create-subtitle">Расписание мероприятия:</label>
                                        <div class="block-panel-sub">
                                            <p>Опишите в форме ниже, детальное расписание мероприятия по дням. Оно не должно быть 100% точным. Дайте участникам понять, что будет происходить каждый день и как все организовано.</p>
                                            <textarea placeholder="Опишите, что участникам стоит ожидать в течении дня" id="timetable-event" name="timetable">{{ old('timetable') }}</textarea>
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
                                                    <input type="checkbox" id="conditioner" name="conditioner" value="Кондиционер" @if(old('conditioner')) checked @endif>
                                                    <span>Кондиционер</span>
                                                </label>
                                                <label for="wifi">
                                                    <input type="checkbox" id="wifi" name="wifi" value="Беплатный Wifi" @if(old('wifi')) checked @endif>
                                                    <span>Беплатный Wifi</span>
                                                </label>
                                                <label for="pool">
                                                    <input type="checkbox" id="pool" name="pool" value="Бассейн" @if(old('pool')) checked @endif>
                                                    <span>Бассейн</span>
                                                </label>
                                                <label for="towel">
                                                    <input type="checkbox" id="towel" name="towel" value="Полотенца" @if(old('towel')) checked @endif>
                                                    <span>Полотенца</span>
                                                </label>
                                                <label for="kitchen">
                                                    <input type="checkbox" id="kitchen" name="kitchen" value="Кухня" @if(old('kitchen')) checked @endif>
                                                    <span>Кухня</span>
                                                </label>
                                                <label for="coffee-tea">
                                                    <input type="checkbox" id="coffee-tea" name="coffee_tea" value="Кофе / Чай" @if(old('coffee_tea')) checked @endif>
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
                                                    <input type="checkbox" name="private_room" value="Отдельный номер" @if(old('private_room')) checked @endif>
                                                    <span>Отдельный номер</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="dormitory_room" value="Общий номер" @if(old('dormitory_room')) checked @endif>
                                                    <span>Общий номер</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="separate_house" value="Отдельный домик" @if(old('separate_house')) checked @endif>
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
                                                    <input type="checkbox" name="transfer_free" value="Встреча в аэропорту и траснфер (бесплатно)" @if(old('transfer_free')) checked @endif>
                                                    <span>Встреча в аэропорту и траснфер (бесплатно)</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="transfer_fee" value="Встреча в аэропорту и траснфер (за доп.плату)" @if(old('transfer_fee')) checked @endif>
                                                    <span>Встреча в аэропорту и траснфер (за доп.плату)</span>
                                                </label>
                                                <label class="accommodation-event-variants">
                                                    <input type="checkbox" name="not_transfer" value="Добираетесь сами" @if(old('not_transfer')) checked @endif>
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
                                                    <input type="checkbox" id="vegan" name="vegan" value="Веган" @if(old('vegan')) checked @endif>
                                                    <span>Веган</span>
                                                </label>
                                                <label for="vegetarianism">
                                                    <input type="checkbox" id="vegetarianism" name="vegetarianism" value="Вегетарианство" @if(old('vegetarianism')) checked @endif>
                                                    <span>Вегетарианство</span>
                                                </label>
                                                <label for="fish">
                                                    <input type="checkbox" id="fish" name="fish" value="Рыба" @if(old('fish')) checked @endif>
                                                    <span>Рыба</span>
                                                </label>
                                                <label for="ayurveda">
                                                    <input type="checkbox" id="ayurveda" name="ayurveda" value="Аюрведа" @if(old('ayurveda')) checked @endif>
                                                    <span>Аюрведа</span>
                                                </label>
                                                <label for="meat">
                                                    <input type="checkbox" id="meat" name="meat" value="Мясо" @if(old('meat')) checked @endif>
                                                    <span>Мясо</span>
                                                </label>
                                                <label for="organic">
                                                    <input type="checkbox" id="organic" name="organic" value="Органическая" @if(old('organic')) checked @endif>
                                                    <span>Органическая</span>
                                                </label>
                                                <label for="gluten-free">
                                                    <input type="checkbox" id="gluten-free" name="gluten_free" value="Без глютена" @if(old('gluten_free')) checked @endif>
                                                    <span>Без глютена</span>
                                                </label>
                                                <label for="milk-free">
                                                    <input type="checkbox" id="milk-free" name="milk_free" value="Без молока" @if(old('milk_free')) checked @endif>
                                                    <span>Без молока</span>
                                                </label>
                                                <label for="nuts-free">
                                                    <input type="checkbox" id="nuts-free" name="nuts_free" value="Без орехов" @if(old('nuts_free')) checked @endif>
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
                                                <option value="{{ $meat }}">{{ $meat }}</option>
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

