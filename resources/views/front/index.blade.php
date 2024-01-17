@extends('front.layouts.layout_main')
@section('meta-title', 'Bricks.ru - все для печейи каминов. Пченой кирпич, смеси, чугунное печное литьё - Магазин, продажа в Москве')
@section('meta-description', 'Товары для строиетльства печей и каминов, Магазин - продажа со склада: Пеной кирпич, смеси, чугунные плиты, печные дверцы, решётки и колосники, Печной Центр в Москве')
@section('meta-keywords', 'meta-keywords', 'мнтаж, строительство, кирпич, смеси, печи, камины, дымоходы, банные, бани, чугунные, дровяные, литье, для печей, купить, цена')
<!-- <h1 class="visually-hidden">Пченой Центр в Грибках 5 км. от МКАД - в Москве</h1> -->
@section('content')
    @if($sliders)
        </div>
        <div class="container-fluid slider_box">
            <div class="container">
                <div class="slider swiper" id="slider">
                    <div class="slider_wrapper swiper-wrapper">
                        @foreach($sliders as $sliderItem)
                            <div class="slider_item swiper-slide">
                                <div class="slider_info">
                                    <h3 class="slider_title" data-swiper-parallax-opacity="0"  data-swiper-parallax-duration="1000">
                                        @if($sliderItem->url)
                                            <a href="{{$sliderItem->url}}" class="slider_link">{{$sliderItem->name}}</a>
                                        @else
                                            <span class="slider_link">{{$sliderItem->name}}</span>
                                        @endif
                                    </h3>
                                    <div class="slider_text" data-swiper-parallax-opacity="0" data-swiper-parallax-duration="1000">
                                       {!! $sliderItem->text !!}
                                    </div>
                                    @if($sliderItem->url)
                                        <a href="{{$sliderItem->url}}" class="slider_btn" data-swiper-parallax-opacity="0" data-swiper-parallax-duration="1000">Узнать подробнее</a>
                                    @endif
                                </div>
                                <div class="slider_img_wrap" data-swiper-parallax-opacity="0" data-swiper-parallax-scale="0.95" data-swiper-parallax-duration="1000">
                                    <img src="{{Storage::url($sliderItem->img) }}" alt="{{$sliderItem->name}}" class="slider_img">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    @endif

    <!--   МЕСТО ДЛЯ КАТЕГОРИЙ -->

    @if($masters)
        <div class="container">
            <section class="artisan">
                <h2 class="artisan_h2">Наши печники</h2>
                <div class="swiper" id="artisan">
                    <ul class="artisan_list swiper-wrapper">
                       @foreach($masters as $master)
                            <li class="artisan_item swiper-slide">
                                <a href="{{route('master.item', $master->url)}}" class="artisan_img_link  shine" style="background-image: url({{$master->getFirstMediaUrl('small-photo')}})"></a>
                                <h3 class="artisan_title">
                                    <a href="{{route('master.item', $master->url)}}" class="artisan_title_link">{{$master->name}}</a></h3>
                                <p class="artisan_location">@if($master->location) {{$master->location}} @else {{''}}@endif</p>
                                @if($master->member)<p class="artisan_info">Печник, участник НП РСПК</p> @endif
                            </li>
                       @endforeach
                    </ul>
                    <div class="artisan-button-prev"><span class="icon-chevron-left"></span></div>
                    <div class="artisan-button-next"><span class="icon-chevron-right"></span></div>
                </div>
            </section>
        </div>
    @endif







@endsection
@section('scripts')
    <script>
        window.onload = function () {
            const swiper = new Swiper('#slider', {
                speed: 1000,
                loop: true,
                parallax: true,
                effect: "fade",
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });

            const artisan = new Swiper('#artisan', {
                speed: 400,
                loop: true,
                navigation: {
                    nextEl: '.artisan-button-prev',
                    prevEl: '.artisan-button-next',
                },
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 0
                    },
                    576: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    // when window width is >= 480px
                    920: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    // when window width is >= 640px
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 30
                    }
                }
            });

            const brands = new Swiper('#brands', {
                speed: 400,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 0
                    },
                    576: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 20
                    },
                    992: {
                        slidesPerView: 5,
                        spaceBetween: 20
                    },
                    1200: {
                        slidesPerView: 7,
                        spaceBetween: 15
                    }
                }
            });
        };
    </script>
@endsection
