<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>@yield('meta-title', 'Bricks.ru - все для печейи каминов. Пченой кирпич, смеси, чугунное печное литьё - Магазин, продажа в Москве')</title>
    <meta name="description" content="@yield('meta-description', 'Товары для строиетльства печей и каминов, Магазин - продажа со склада: Пеной кирпич, смеси, чугунные плиты, печные дверцы, решётки и колосники, Печной Центр в Москве')">
    <meta name="keywords" content="@yield('meta-keywords', 'мнтаж, строительство, кирпич, смеси, печи, камины, дымоходы, банные, бани, чугунные, дровяные, литье, для печей, купить, цена')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="css/app.min.css">
</head>

<body>
<div class="container-fluid top">
    <div class="container">
        <apan class="top_wrapper">

            <nav class="top_container">
                <button	 class="top_nav_btn closed" id="topNmvBtn"></button>
                <ul class="top_nav">
                    <li class="top_nav_ltem"><a href="/" class="top_nav_link">О компании</a></li>
                    <li class="top_nav_ltem"><a href="#" class="top_nav_link">Монтаж</a></li>
                    <li class="top_nav_ltem"><a href="#" class="top_nav_link">Наши работы</a></li>
                    <li class="top_nav_ltem"><a href="#" class="top_nav_link">Доставка</a></li>
                    <li class="top_nav_ltem"><a href="#" class="top_nav_link">Доставка</a></li>
                    <li class="top_nav_ltem"><a href="#" class="top_nav_link">Акции</a></li>
                </ul>
            </nav>
            <span class="top_address">г. Москва, МКАД, 38-й километр, 4Бс1</apan>
    </div>
</div>
</div>
<div class="container head">
    <div class="logo_wrap">
        <a href="/" class="logo_link">
            <img src="/images/src/logo_100.png" alt="logo" class="logo_img">
            <div class="logo_text">
                <span class="logo_text_top">Кирпичи.рф</span><span class="logo_text_bottom">Все для печей</span>
            </div>
        </a>
    </div>
    <div class="head_info_wrap">
        <div class="head_info_phone"><a href="tel:+79168818399" class="head_info_phone_link">8 (916) 881-83-99</a></div>
        <div class="head_info_time">Пн-Вс: 09:00 - 19:00</div>
    </div>
    <div class="head_tach_wrap">
        <a href="#" class="head_tach_link"><span class="head_tach_txt">Заказать звонок</span></a>
    </div>
    <div class="head_serch_wrap" id="searchForm">
        <form action="#" class="head_serch_form">
            <input id="title-search-input" type="text" name="q" value="" autocomplete="off" class="head_serch_input">
            <button type="submit" name="s" class="head_serch_btn"><span class="icon-magnifying-glass"></span></button>
        </form>
        <span class="head_serch_closed_btn" id="searchBtnClosed"><span class="icon-xmark"></span></span>
    </div>
    <div class="head_person_wrap">
        <span class="head_mob_btn"><span class="icon-phone"></span></span>
        <span class="head_mob_btn" id="searchBtn"><span class="icon-magnifying-glass"></span></span>
        <a href="#" class="head_person_link __auth">
            <div class="head_person_icon">
                <span class="icon-user"></span>
            </div>
            <div class="head_person_name">Вход</div>
        </a>
        <a href="/cart.html" class="head_cart_link __full">
            <div class="head_cart_icon">
                <div class="head_cart_qty">0</div>
                <span class="icon-cart"></span>
            </div>
            <div class="head_cart_name">Оформить</div>
        </a>
    </div>
</div>
