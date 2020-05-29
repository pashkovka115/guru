<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <p class="title-footer">Навигация:</p>
                <ul class="footer_menu">
                    <li><a href="/">Главная</a></li>
                    <li><a href="{{ route('site.journal.blog.index') }}">Журнал</a></li>
                    <li><a href="{{ route('site.about') }}">О нас</a></li>
                    @foreach($pages_menu as $item)
                    <li><a href="{{ route('site.pages.official.show', ['page' => $item->slug]) }}">{{ $item->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <p class="title-footer">Популярные мероприятия:</p>
                <ul class="footer_menu">
                    @foreach($popular_tour as $tour)
                    <li><a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}">{{ $tour->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <p class="title-footer">Популярные Страны:</p>
                <ul class="footer_menu">
                    <?php $pop_cou = []; ?>
                    @foreach($popular_country as $tour)
                            <?php if(!in_array($tour->country, $pop_cou)): ?>
                        <li>
                            <a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}">{{ $tour->country }}</a>
                        </li>
                        <?php $pop_cou[] = $tour->country; endif; ?>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-6">
                <div class="row">
                    <div class="col-lg-12 col-md-4 col-sm-12 menu_dop">
                        <p class="title-footer">Для организаторов:</p>
                        <ul class="footer_menu">
                            <li><a href="{{ route('site.landing') }}">Добавить объявление (бесплатно)</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-12 col-md-4 col-sm-12 menu_dop">
                        <p class="title-footer">Присоединяйтесь к нам в соц.сетях:</p>
                        <ul class="social">
                            @foreach(get_settings('url') as $network)
                            <li><a href="{{ $network->url }}" title="{{ $network->url }}"><img src="{{ $network->icon }}" alt="" class="img-fluid"></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-12 col-md-4 col-sm-12 menu_dop">
                        <p class="title-footer">Контакты:</p>
                        <ul>
                            <li><a href="{{ route('site.help.show') }}" class="help_link">Помощь и поддержка</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="copyright">© <?= date('Y') ?> Новый сайт</div>
            </div>
        </div>
    </div>
</footer>
</div>
@yield('popap_form')
<div class="mobile_menu_container">
    <div class="mobile_menu_content">
        <ul>
            <li class="mobile_menu_title"><span class="mobile_menu_close"></span></li>
            <li><a class="parent" href="/">Главная</a></li>
            <li><a class="parent" href="{{ route('site.catalog.category.list') }}">Каталог мероприятий</a></li>
            <li><a class="parent" href="{{ route('site.about') }}">О нас</a></li>
            <hr>
            <li><a class="parent" href="{{ route('site.cabinet.tour.create') }}">Добавить мероприятие</a></li>
            <li><a class="parent" href="{{ route('register') }}">Регистрация</a></li>
            @guest
            <li><a class="parent" href="{{ route('login') }}">Войти</a></li>
            <!-- Если вход выполнен в личный кабинет убираем Регистрацию и Войти и на их место -->
            @else
            <li><a class="parent" href="{{ route('site.cabinet.user.index') }}">Личный кабинет</a></li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form2').submit();"> Выйти
                </a>
                <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endguest
            <hr>
        </ul>
    </div>
</div>
<div class="mobile_menu_overlay"></div>
@section('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    (function () {
        var func = EventTarget.prototype.addEventListener;

        EventTarget.prototype.addEventListener = function (type, fn, capture) {
            this.func = func;
            capture = capture || {};
            capture.passive = false;
            this.func(type, fn, capture);
        };
    }());
    /*jQuery.event.special.touchstart = {
        setup: function( _, ns, handle ){
            if ( ns.includes("noPreventDefault") ) {
                this.addEventListener("touchstart", handle, { passive: false });
            } else {
                this.addEventListener("touchstart", handle, { passive: true });
            }
        }
    };*/
</script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="{{asset('assets/site/js/readmore.min.js')}}"></script>
<script src="{{asset('assets/site/js/owl.carousel.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="{{asset('assets/site/js/main.js')}}"></script>
@yield('scripts_footer')
@show
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
</body>
</html>
