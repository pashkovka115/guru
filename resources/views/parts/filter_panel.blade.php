<div class="search-filter-panel">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter-category">
                    <li>
                        <span class="category-result">Выбрать категорию</span>
                        <div class="subcategory">
                            <div class="category_filter_block">
                                <div class="category_group_filter">
                                    @foreach($all_categories as $category)
                                    <label>
                                        <input type="checkbox" name="cat1" value="{{ $category->id }}">
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
                                        <input type="checkbox" name="cat1" value="{{ $country->country }}">
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
                    </li>
                    <li>
                        <span class="range-result">Продолжительность</span>
{{--     Здесь отсылай на сервер количество дней которое выберет пользователь                   --}}
                        <div class="subcategory">
                            <div class="filter_range">
                                <div class="range-result">Продолжительность</div>
                                <div class="range-line"></div>
                            </div>
                            <div class="category_button_filter">
                                <button type="submit">Применить</button>
                            </div>
                        </div>
                    </li>
                    <li>
                         {{ $min_price }} - {{ $max_price }}
                        <span class="range-price-result">Цена</span>
                        <div class="subcategory">
                            <div class="filter_range">
                                <div class="range-price-result">Цена</div>
                                <div class="range-price"></div>
                            </div>
                            <div class="category_button_filter">
                                <button type="submit">Применить</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
