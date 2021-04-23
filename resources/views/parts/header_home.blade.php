<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Gurufor.com</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <link rel="canonical" href="">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
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
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{ asset('assets/site/bootstrap/css/bootstrap.min.css') }}">
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />--}}
    <link rel="stylesheet" href="{{ asset('assets/site/css/jquery.fancybox.min.css') }}" />
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    <link rel="stylesheet" href="{{ asset('assets/site/css/font-awesome.min.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('assets/site/css/jquery.fancybox.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/site/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/owl.theme.default.min.css') }}">
    <?php if (stripos(env('APP_URL'), '.loc') === false): ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap&subset=cyrillic">
    <?php endif; ?>
    <link rel="stylesheet" href="{{ asset('assets/site/css/style.css') }}">
</head>
<body>
<div class="wrapper">
    <header>
        <div class="container">
            <div class="row header">
                <a class="logo" href="/">
                    <img src="{{ asset('assets/site/images/logo-test.svg') }}" alt="" class="img-fluid">
                    <span>{{ env('APP_NAME') }}</span>
                </a>
                <div class="form_search_header">
                    <form action="{{ route('site.catalog.search') }}" method="post" autocomplete="off" class="search-input">
                        @csrf
                        <input name="q" placeholder="Введите запрос..." type="search">
                        <button type="submit">Поиск</button>
                        <div class="search-category">
                            <div class="search-category__events">
                                <a href="{{ route('site.catalog.category.list') }}">
                                    <img src="{{ asset('assets/site/images/all-events.svg') }}" alt="" class="img-fluid">
                                    <span>Все мероприятия</span>
                                </a>
                                @foreach($categories as $category)
                                <a href="{{ route('site.catalog.category.name', ['id' => $category->id]) }}">
                                    <img src="{{ $category->icon }}" alt="" class="img-fluid">
                                    <span>{{ $category->title }}</span>
                                </a>
                                @endforeach

                            </div>
                            <div class="search-category__country">
                                <div class="search-category__title">
                                    Популярные мероприятия
                                </div>
                                @foreach($popular_country as $tour)
                                    <a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}">{{ $tour->country ?? $tour->title ?? '' }}</a>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
                <div class="nav">
                    <ul>
                        <li><a href="{{ route('site.landing') }}">Добавить событие</a></li>
                        @guest
                            <li>
                                <a href="{{ route('login') }}">Вход</a>
                                <span class="separator">/</span>
                                <a href="{{ route('register') }}">Регистрация</a>
                            </li>
                        @else
                            <li class="login-list">
                                <span class="login-link"></span>
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
                <div class="mobile-nav">
                    <div class="mobile_search"><img src="{{ asset('assets/site/images/search-icon.svg') }}" alt="Поиск"></div>
                    <div class="mobile_menu"></div>
                </div>
            </div>
        </div>
    </header>
    <div class="home_block">
        <div class="container">
            <div class="row justify-content-center">
                @if($home_header_titles->count() > 0)
                    @foreach($home_header_titles as $tit_head)
                        <div class="col-md-12">
                            <h1 class="home__title">{{ $tit_head->title }}</h1>
                        </div>
                    @endforeach
                @endif
                <div class="form_search">
                    <form action="{{ route('site.catalog.search') }}" method="post" autocomplete="off" class="search-input">
                        @csrf
                        <input name="q" placeholder="Введите запрос..." type="search">
                        <button type="submit">Поиск</button>
                        <div class="search-category">
                            <div class="search-category__events">
                                <a href="{{ route('site.catalog.category.list') }}">
                                    <img src="{{ asset('assets/site/images/all-events.svg') }}" alt="" class="img-fluid">
                                    <span>Все мероприятия</span>
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('site.catalog.category.name', ['id' => $category->id]) }}">
                                        <img src="{{ $category->icon }}" alt="" class="img-fluid">
                                        <span>{{ $category->title }}</span>
                                    </a>
                                @endforeach

                            </div>
                            <div class="search-category__country">
                                <div class="search-category__title">
                                    Популярные мероприятия
                                </div>
                                @foreach($popular_country as $tour)
                                <a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}">{{ $tour->country ?? $tour->title ?? '' }}</a>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
