@extends('front.layouts.layout')
@section('meta-title', $master->getMetaTitle)
@section('meta-description', $master->getMetaDescription)
@section('meta-keywords', $master->getMetaKeywords)
@section('h1', $master->getMetaH1)
@section('breadcrumbs')
    {{ Breadcrumbs::render('master.detail', $master) }}
@endsection
@section('content')
    <div class="master_group @if($master->childrenMasters->isNotEmpty()) many @endif">
        <div class="master_wrap">
            <div class="master_img_block">
                <a href="{{$master->getFirstMediaUrl('photo')}}" class="master_img_link" data-fancybox="gallery">
                    <img src="{{$master->getFirstMediaUrl('photo')}}" class="master_img" alt="{{$master->getMetaH1}}">
                </a>
            </div>
            <div class="master_info_wrap">
                <h3 class="master_title">{{$master->getMetaH1}}</h3>
                @if($master->phone)<a href="{{'tel:+'.preg_replace('/[^0-9.]+/', '',$master->phone)}}" class="master_phone">тeл.: {{ $master->phone }}</a>@endif
                @if($master->email)<a href="{{'mailto:'.$master->email}}" class="master_mail">{{$master->email}}</a>@endif
                @if($master->member)<p class="master_member">Участник НП РСПК</p>@endif
                @if($master->phone && $master->whatsapp)
                    <a href="{{'https://wa.me/'.preg_replace('/[^0-9.]+/', '',$master->phone)}}" class="master_btm whatsapp"><svg class="icon"><use xlink:href="#whatsapp"></use></svg>Написать в Whatsapp</a>
                @endif
                @if($master->brief)
                    <div class="master_info">{!! $master->brief !!}</div>
                @endif
            </div>
        </div>
        @if($master->childrenMasters)
            @foreach($master->childrenMasters as $partner)
                <div class="master_wrap">
                    <div class="master_img_block">
                        <a href="{{$partner->getFirstMediaUrl('photo')}}" class="master_img_link" data-fancybox="gallery">
                            <img src="{{$partner->getFirstMediaUrl('photo')}}" class="master_img" alt="{{$partner->getMetaH1}}">
                        </a>
                    </div>
                    <div class="master_info_wrap">
                        <h3 class="master_title">{{$partner->getMetaH1}}</h3>
                        @if($partner->phone)<a href="{{'tel:+'.preg_replace('/[^0-9.]+/', '', $partner->phone)}}" class="master_phone">тeл.: {{ $partner->phone }}</a>@endif
                        @if($partner->email)<a href="{{'mailto:'.$partner->email}}" class="master_mail">{{$partner->email}}</a>@endif
                        @if($partner->member)<p class="master_member">Участник НП РСПК</p>@endif
                        @if($partner->phone && $partner->whatsapp)
                            <a href="{{'https://wa.me/'.preg_replace('/[^0-9.]+/', '', $partner->phone)}}" class="master_btm whatsapp"><svg class="icon"><use xlink:href="#whatsapp"></use></svg>Написать в Whatsapp</a>
                        @endif
                        @if($partner->brief)
                            <div class="master_info">{!! $partner->brief !!}</div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    @if($master->participant)
        <div class="master_membership">
            <h3 class="master_membership_h3">{{$master->participant}}</h3>
            @if($master->document)
                <a href="{{Storage::url($master->document)}}" class="master_membership_btn" data-fancybox="mamber">Смотреть</a>
            @endif
        </div>
    @endif

    @if($diplomas)
        <section class="master_images_section">
            <h3 class="master_images_title">Дипломы и сертификаты</h3>
            <div class="master_images_list">
                @foreach($diplomas as $diploma)
                    <div class="master_image_block">
                        <a href="{{$diploma}}" class="master_image_link" data-fancybox="gallery">
                            <img src="{{$diploma}}" alt="Сертификат, диплом печника" class="master_image">
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if($examples)
        <section class="master_images_section">
            <h3 class="master_images_title">Галерея выполненных работ</h3>
            <div class="master_images_list">
                @foreach($examples as $example)
                    <div class="master_image_block">
                        <a href="{{$example}}" class="master_image_link" data-fancybox="gallery">
                            <img src="{{$example}}" alt="Пример работы печника" class="master_image">
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection

