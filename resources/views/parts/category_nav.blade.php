<div class="cat_nav">
    <ul class="cat_nav__menu">
        <li><a href="{{ route('site.catalog.category.list') }}"{!! Route::currentRouteName() == 'site.catalog.category.list' ? '  class="active"' : null  !!}>Мероприятия (777)</a></li>
        <li><a href="{{ route('site.author.list') }}"{!! Route::currentRouteName() == 'site.author.list' ? '  class="active"' : null  !!}>Учителя и Авторы (888)</a></li>
        <li><a href="#">Организации (999)</a></li>
    </ul>
    <div class="sort">
        <span>Сортировать по:</span>
        <select id="sortby">
            <option value="popular">Популярности</option>
            <option value="date-start">Дате начала</option>
            <option value="price-low">Цена(по возрастанию)</option>
            <option value="price-high">Цена(по убыванию)</option>
        </select>
    </div>
</div>
