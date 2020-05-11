<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? config('app.name', config('app.name_default')) }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <link rel="canonical" href="">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/site/images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/site/images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/site/images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/site/images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/site/images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/site/images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/site/images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/site/images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/site/images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/site/images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/site/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/site/images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/site/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/site/images/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/site/images/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">--}}
    <link rel="stylesheet" href="{{asset('assets/site/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap&subset=cyrillic">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @yield('styles')
    <link rel="stylesheet" href="{{asset('assets/site/css/style.css')}}">
</head>
<body>
<div class="wrapper">
    <header class="header_menu">
        <div class="container">
            <div class="row header">
                <a class="logo" href="{{ url('/') }}">
                    <img src="{{asset('assets/site/images/logo-test.svg')}}" alt="" class="img-fluid">
                    <span>{{ config('app.name', 'gurufor.com') }}</span>
                </a>
                <div class="form_search_new">
                    <form action="{{ route('site.catalog.search') }}" method="post">
                        @csrf
                        <input name="q" placeholder="Введите запрос..." type="search">
                        <button type="submit"><img src="{{asset('assets/site/images/icon_search.png')}}" alt="" class="img-fluid"></button>
                    </form>
                </div>
                <div class="nav">
                    <ul>
                        <li>
                            <a href="#">Популярное</a>
                            <div class="megamenu">
                                <ul class="menu__sub">
                                    <li class="menu__sub_title">
                                        <span>Страны</span>
                                    </li>
                                    @foreach($popular_country as $tour)
                                    <li>
                                        <a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}">{{ $tour->country }}</a>
                                    </li>
                                    @endforeach

                                </ul>
                                <ul class="menu__sub">
                                    <li class="menu__sub_title">
                                        <span>Категории</span>
                                    </li>
                                    @foreach($popular_cats as $cat)
                                    <li>
                                        <a href="{{ route('site.catalog.category.name', ['id' => $cat->id]) }}">{{ $cat->title }}</a>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </li>
                        <li><a href="{{ route('site.landing') }}">Добавить объявление</a></li>
                        @guest
                        <li>
                            <a href="{{ route('login') }}">Вход</a>
                            <span class="separator">/</span>
                            <a href="{{ route('register') }}">Регистрация</a>
                        </li>
                        @else
                            <li class="login-list">
                                <span class="login-link">И</span>
                                <ul class="login-sub">
                                    <li>
                                        <a href="{{ route('site.cabinet.user.index')}}">Личный кабинет</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Выйти
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
                <div class="mobile_menu"></div>
            </div>
        </div>
    </header>
