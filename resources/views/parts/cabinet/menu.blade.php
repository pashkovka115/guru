<div class="personal_nav">
    {{ request()->is('admin/tour') ? ' active' : null }}
    <ul class="personal_nav__menu">
        <li>
            <a href="{{ route('site.cabinet.user.index') }}"{!! request()->is('cabinet/user') ? '  class="active"' : null  !!}>Личные данные</a>
        </li>
        @if(auth()->user()->profile->auth ?? false)
{{--            <li><a href="{{ route('site.cabinet.message.index') }}"{!! Route::currentRouteName() == 'site.cabinet.message.index' ? '  class="active"' : null  !!}>Сообщения</a></li>--}}
            <li>
                <a href="{{ route('site.cabinet.tour.index') }}"{!! request()->is('cabinet/tour') ? '  class="active"' : null  !!}>Мероприятия</a>
            </li>
            <li>
                <a href="{{ route('site.cabinet.leaders.index') }}"{!! request()->is('cabinet/leaders') ? '  class="active"' : null  !!}>Авторы</a>
            </li>
        @endif
        @if((auth()->user()->profile->auth ?? false) or (auth()->user()->profile->type_user ?? false) == 'leader')
            <li><a href="{{ route('site.cabinet.review.index') }}"{!! Route::currentRouteName() == 'site.cabinet.review.index' ? '  class="active"' : null  !!}>Отзывы</a></li>
        @endif
        <li><a href="{{ route('site.cabinet.purchases.index') }}"{!! Route::currentRouteName() == 'site.cabinet.purchases.index' ? '  class="active"' : null  !!}>Покупки</a></li>
        <li>
            <a href="{{ route('site.cabinet.user.edit', ['user' => auth()->id()]) }}"{!! Route::currentRouteName() == 'site.cabinet.user.edit' ? '  class="active"' : null  !!}>Редактировать данные</a>
        </li>
    </ul>
</div>

