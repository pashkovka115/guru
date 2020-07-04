<div class="cat_nav">
    <ul class="cat_nav__menu">
        <li>
            <a href="{{ route('site.catalog.category.list') }}"{!! Route::currentRouteName() == 'site.catalog.category.list' ? '  class="active"' : null  !!}>
                Мероприятия @if(Route::currentRouteName() != 'site.catalog.search') ({{ $cnt_tours }}) @endif
            </a>
        </li>
        <li>
            <a href="{{ route('site.author.list') }}"{!! Route::currentRouteName() == 'site.author.list' ? '  class="active"' : null  !!}>
                Учителя и Авторы @if(Route::currentRouteName() != 'site.catalog.search') ({{ $cnt_leaders }}) @endif
            </a>
        </li>
        <li>
            <a href="{{ route('site.organizer.list') }}"{!! Route::currentRouteName() == 'site.organizer.list' ? '  class="active"' : null  !!}>
                Организации @if(Route::currentRouteName() != 'site.catalog.search') ({{ $cnt_organizers }}) @endif
            </a>
        </li>
    </ul>
    @if(Route::currentRouteName() == 'site.catalog.category.list' or Route::currentRouteName() == 'site.catalog.category.name')
    <div class="sort">
        <span>Сортировать по:</span>
        <select id="sortby">
            <option value="popular">Популярности</option>
            <option value="date-start">Дате начала</option>
            <option value="price-low">Цена(по возрастанию)</option>
            <option value="price-high">Цена(по убыванию)</option>
        </select>
    </div>
        @endif
</div>
