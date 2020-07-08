<div class="search-filter-panel">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form>
                    <ul class="filter-category">
                        <li>
                            <span class="category-result">Выбрать категорию</span>
                            <div class="subcategory">
                                <div class="category_filter_block">
                                    <div class="category_group_filter">
                                        @foreach($all_categories as $category)
                                        <label>
                                            <input type="checkbox" name="category" value="{{ $category->id }}">
                                            <span>{{ $category->title }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="category_button_filter">
                                    <button type="submit">Применить</button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="place-result">Выбрать место</span>
                            <div class="subcategory">
                                <div class="category_filter_block">
                                    <div class="category_group_filter">
                                        @foreach($countries as $country)
                                        <label>
                                            <input type="checkbox" name="country" value="{{ $country->country }}">
                                            <span>{{ $country->country }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="category_button_filter">
                                    <button type="submit">Применить</button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span id="demo" style="display: block;">Выбрать даты</span>
                            <input type="hidden" name="date-picker" class="date-picker" value=""/>  
                        </li>
                        <li>
                            <span class="range-result">Продолжительность</span>
    {{--     Здесь отсылай на сервер количество дней которое выберет пользователь                   --}}
                            <div class="subcategory">
                                <div class="filter_range">
                                    <div class="range-result">Продолжительность</div>
                                    <input type="hidden" name="range-day-min" class="range-day-min"/>
                                    <input type="hidden" name="range-day-max" class="range-day-max"/>
                                    <div class="range-line"></div>
                                </div>
                                <div class="category_button_filter">
                                    <button type="submit">Применить</button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="range-price-result">Цена</span>
                            <div class="subcategory">
                                <div class="filter_range">
                                    <div class="range-price-result">Цена</div>
                                    <input type="hidden" name="range-price-min" class="range-price-min"/>
                                    <input type="hidden" name="range-price-max" class="range-price-max"/>
                                    <div class="range-price"></div>
                                </div>
                                <div class="category_button_filter">
                                    <button type="submit">Применить</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>
