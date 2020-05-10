<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <p class="title-footer">Навигация:</p>
                <ul class="footer_menu">
                    <li><a href="/">Главная</a></li>
                    <li><a href="{{ route('site.journal.blog.index') }}">Журнал</a></li>
                    @foreach($pages_menu as $item)
                    <li><a href="{{ route('site.pages.official.show', ['page' => $item->id]) }}">{{ $item->title }}</a></li>
                    @endforeach
                    <li><a href="{{ route('site.about') }}">О нас</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <p class="title-footer">Популярные мероприятия:</p>
                <ul class="footer_menu">
                    @foreach($popular_tour as $tour)
                    <li><a href="{{ route('site.catalog.tour.show', ['tour' => $tour->id]) }}">{{ $tour->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <p class="title-footer">Популярные Стран:</p>
                <ul class="footer_menu">
                    @foreach($popular_country as $tour)
                        <li>
                            <a href="{{ route('site.catalog.tour.show', ['tour' => $tour->id]) }}">{{ $tour->country }}</a>
                        </li>
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
                            <li><a href="#" title="facebook"></a></li>
                            <li><a href="#" title="vk"></a></li>
                            <li><a href="#" title="instagram"></a></li>
                            <li><a href="#"	title="telegram"></a></li>
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
            <li><a class="parent" href="/">Каталог мероприятий</a></li>
            <li><a class="parent" href="/">О нас</a></li>
            <hr>
            <li><a class="parent" href="{{ route('site.cabinet.tour.create') }}">Добавить мероприятие</a></li>
            <li><a class="parent" href="{{ route('register') }}">Регистрация</a></li>
            <li><a class="parent" href="{{ route('login') }}">Войти</a></li>
            <hr>
        </ul>
    </div>
</div>
<div class="mobile_menu_overlay"></div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="{{asset('assets/site/js/readmore.min.js')}}"></script>
<script src="{{asset('assets/site/js/owl.carousel.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script src="{{asset('assets/site/js/main.js')}}"></script>
@yield('scripts_footer')

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
