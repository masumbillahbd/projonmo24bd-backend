<?php $settings = \App\Models\Setting::find(1); ?>
<style>
    .login__desktop {
        text-align: center;
        display: block;
        background: #673AB7;
        border-radius: 36px;
        width: 100%;
        height: 41px;
        padding: 6px;
        margin-top: 5px;
        color: #fff !important;
        font-size: 19px;
        font-family: sans-serif !important;
    }

    .chat__icon {
        position: fixed;
        width: 150px;
        bottom: 30px;
        left: 30px;
    }

    .chat__icon img {
        /*position: absolute;*/
        /*bottom: 25px;*/
        /*left: 25px;*/
        height: 75px;
    }

    .chat__icon p {
        line-height: 1;
        padding: 4px 0 1px;
        margin-bottom: 0 !important;
        color: #000;
    }

    .middle__block4 .caption {
        height: 82px;
        overflow: hidden;
    }

    @media (max-width: 981px) {
        .chat__icon {
            position: fixed;
            width: 67px;
            bottom: 0px;
            left: 0px;
            height: 57px;
        }

        .chat__icon img {
            height: 40px;
            position: relative;
            left: 4px;
            top: -3px;
        }

        .chat__icon p {
            font-size: .6rem;
            background: #fff;
            line-height: 1;
            padding: 4px 0 1px;
            margin-bottom: 0 !important;
            width: 51px;
        }

        .btn__chat {
            font-size: 1rem !important;
            background: #0e8c3c;
            font-weight: 300 !important;
            color: var(--bs-white) !important;
            padding: 1px 7px 0 !important;
            border-radius: 2px;
        }

        .sidebar .fb__page {
            margin-top: 20px;
        }

        .follow__btn__mbl i {
            font-size: 25px;
            padding: 8px 2px;
            color: #fff;
        }
    }
</style>

<div class="top__ads d-none">

</div>

<!-- ======= Top Bar ======= -->
<section id="topbar" class="align-items-center d-flex">
    <div class="container d-flex justify-content-center justify-content-md-between d-none" style="position: relative;">
        <div class="contact-info ps-3">
            <i class="bi bi-envelope d-flex align-items-center d-none"><a
                    href="mailto:{{ $settings->site_email }}">{{ $settings->site_email }}</a></i>
            <span
                class="d-flex align-items-center date__time">{{ todays_eng_date() }} <br> {{ todays_ban_date() }}</span>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <a href="{{ $settings->facebook }}" class="facebook social__icon" target="_blank"
               style="background: #226ed3;"><i
                    class="bx bxl-facebook"></i></a>
            <a href="{{ $settings->twitter }}" class="twitter social__icon" target="_blank" style="background: #1d9bf0"><i
                    class="bx bxl-twitter"></i></a>
            <a href="{{ $settings->youtube }}" class="youtube social__icon" target="_blank" style="background: #ff0000"><i
                    class="bi bi-youtube"></i></a>
            <a href="#" class="instagram social__icon" target="_blank" style="background: #c038be"><i
                    class="bx bxl-instagram"></i></a>
            <a href="#" class="linkedin social__icon d-none" style="background: #0077b5; padding: 0;"><i
                    class="bx bxl-linkedin social__icon" target="_blank"></i></a>
            <a href="/video-gallery/gallery/video" class="btn__video d-none">ভিডিও</a>

        </div>
        <div class="social-links d-flex d-md-none d-lg-none align-items-center justify-content-between">
            <a href="{{ $settings->facebook }}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="{{ $settings->youtube }}" class="youtube"><i class="bi bi-youtube"></i></a>
            <a href="{{ $settings->twitter }}" class="twitter" target="_blank"><i class="bi bi-twitter"></i></a>
        </div>
    </div>
</section>
{{--<div class="header__ads__top d-none d-md-block d-lg-block py-3">--}}
<div class="header__ads__top d-none">
    <div class="container">
        <div class="matter__banner">
            <?php $ad = ad_by_position(3); ?>
            @if(!empty($ad))
                @if(!empty($ad->url))
                    <a href="{{$ad->url}}" target="_blank">
                        <img src="{{ asset('ads/'.$ad->photo)}}"/>
                    </a>
                @else
                    <img src="{{ asset('ads/'.$ad->photo)}}"/>
                @endif
            @endif
            <?php unset($ad) ?>
        </div>
    </div>
</div>
<!-- ======= Header ======= -->
<header id="header" class="header">
    <?php  $breakingnews = App\Models\Breakingnews::orderBy('id', 'desc')->get(); ?>
    @if($breakingnews->isNotEmpty())
        <div class="container">
            <div class="breaking__news pt-0 position-relative">
                <div class="scroll__news d-flex">
                    <div class="title">
                        // BREAKING NEWS //
                    </div>
                    <marquee scrollamount="6" scrolldelay="5" direction="left" onmouseover="this.stop()"
                             onmouseout="this.start()">
                        <ul class="list-inline">
                            @foreach($breakingnews as $post)
                                <li class="">
                                    <a style="color:var(--bs-black);"
                                       href="{{$post->news_link}}">{{ $post->news_text }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </marquee>
                </div>
            </div>
        </div>
    @endif

    <div class="breaking__news d-none">
        <style>
            /*.news__ticker .heading span {*/
            /*    position: relative;*/
            /*    top: -9px;*/
            /*    left: 7px;*/
            /*}*/
        </style>
        <?php $ticket = App\Models\Breakingnews::orderBy('id', 'desc')->get(); ?>
        @if(!empty(count($ticket)))
            <div class="news__ticker">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2 col-lg-2 col-4 col-sm-4">
                            {{--                            <div class="heading"><i class="bi bi-quote"></i><span>ব্রেকিং:</span></div>--}}
                            <div class="heading"><span>ব্রেকিং:</span></div>
                        </div>
                        <div class="col-md-5 col-lg-5 col-8 col-sm-8">
                            <div class="d-flex  justify-content-between align-items-center breaking-content">
                                <marquee class="news-scroll" behavior="scroll" direction="left"
                                         onmouseover="this.stop();"
                                         onmouseout="this.start();">
                                    <ul>
                                        <li class="item">
                                            @foreach($ticket as $post)
                                                <a style="color: #fff"
                                                   href="{{$post->news_link}}">{!! $post->news_text !!}</a>
                                            @endforeach
                                        </li>
                                    </ul>
                                </marquee>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{--    <div class="container d-flex align-items-center justify-content-between">--}}
    <div class="site__top d-lg-block d-md-block d-sm-flex col-flex align-items-center justify-content-between">
        <div class="container top__container">
            <div class="row d-flex align-items-center">
                <div class="col-md-3">
                    <div class="contact-info ps-3 d-none d-md-flex">
                        @if($settings->desktop_menu_bar == 1)
                            <span class="menu__btn py-0 me-3" id="desktop-menu-open"><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-align-right" width="38" height="38"
                                    viewBox="0 0 24 24" stroke-width="1" stroke="#000000" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M4 6l16 0"/>
  <path d="M10 12l10 0"/>
  <path d="M6 18l14 0"/>
</svg></span>@endif
                        <span class="d-flex align-items-center date__time">{{todays_eng_date()}} <br> {{todays_ban_date()}}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center">
                        <a href="/" class="logo"><img src="/{{ $settings-> logo }}"
                                                      alt="{{ $settings->site }}"></a>
                        <a href="/" class="logo_w"><img src="/{{ $settings-> logo }}"
                                                        alt="{{ $settings->site }}"
                                                        class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-md-3 d-none d-md-block">
                    <div class="social-links my-4 float-end position-relative" style="float: right">
                        {{--                        <a href="{{ $settings->facebook }}" class="facebook social__icon" target="_blank"--}}
                        {{--                           style="background: #226ed3;"><i--}}
                        {{--                                    class="bx bxl-facebook"></i></a>--}}
                        {{--                        <a href="{{ $settings->twitter }}" class="twitter social__icon" target="_blank"--}}
                        {{--                           style="background: #1d9bf0"><i--}}
                        {{--                                    class="bx bxl-twitter"></i></a>--}}
                        {{--                        <a href="{{ $settings->youtube }}" class="youtube social__icon" target="_blank"--}}
                        {{--                           style="background: #ff0000"><i--}}
                        {{--                                    class="bi bi-youtube"></i></a>--}}
                        {{--                        <a href="#" class="instagram social__icon" target="_blank" style="background: #c038be"><i--}}
                        {{--                                    class="bx bxl-instagram"></i></a>--}}
                        {{--                        <a href="#" class="linkedin social__icon d-none" style="background: #0077b5; padding: 0;"><i--}}
                        {{--                                    class="bx bxl-linkedin social__icon" target="_blank"></i></a>--}}
                        {{--                        <a href="/video-gallery/gallery/video" class="btn__video d-none">ভিডিও</a>--}}

                        <div class="search-bar" id="mainSrcBox" style="display: inline-block;">
                            <form method="get" action="{{ route('search') }}">
                                <input type="text" class="search-input" required="" name="x"
                                       placeholder="অনুসন্ধান...">
                                <button class="searchIcon" id="searchIcon" type="submit" name="button"><i
                                        class="bi bi-search"></i>
                                </button>
                                <button class="searchCloseBtn d-none" id="searchCloseBtn" type="button" name="button"><i
                                        class="bi bi-x" aria-hidden="true"></i></button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="bodyblur"></div>
        <center class="site__menu">

            <div class="container">
                <nav id="navbar" class="navbar">
                    <ul class="url__li">
                        <a href="/" class="logo d-none"><img src="/{{ $settings-> logo }}"
                                                      alt="{{ $settings->site }}"></a>
                        <li class="mbl__menu__option d-block d-md-none d-lg-none my-5 px-3"
                            style="border-bottom: 1px solid transparent;">
                            <div class="search-bar" id="mainSrcBox">
                                <form method="get" action="{{ route('search') }}">
                                    <input type="text" class="search-input" required="" name="x"
                                           placeholder="অনুসন্ধান...">
                                    <button class="searchIcon" id="searchIcon" type="submit" name="button"><i
                                            class="bi bi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                        @foreach(\App\Models\Menu::orderBy('position', 'asc')->get() as $key=> $menu)
                            <li class="{{ $menu->subMenu->count() > 0 ? 'dropdown ' : '' }} {{ $key == 0 ? 'active' :'' }}">
                                <a href="{{ $menu->url_path }}" @if($menu->subMenu->count() > 0) class="dropdown-toggle"
                                   data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false" @endif>
                                    {!! $menu->url_text !!}
                                    {!! $menu->subMenu->count() > 0 ? '<span class="caret"></span>' : '' !!}
                                </a>
                                @if($menu->subMenu->count() > 0)
                                    <ul class="dropdown-menu">
                                        @foreach(\App\Models\SubMenu::where('menu_id',$menu->id)->orderby('position','asc')->get() as $submenu)
                                            <li><a href="{{ $submenu->url_path }}">{{ $submenu->url_text }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        <?php $livestream = livestream();?>
                        @if($livestream->status == 1)
                            <li class="live__btn"><a class="text-danger" href="{{route('livestream.show')}}">Live</a>
                            </li>
                        @endif
                    </ul>
                    <a href="{{ route('video.gallery') }}" class="video__mbl d-block d-md-none d-lg-none mx-2">
                        ভিডিও
                    </a>
                    <a id="mobilemenuopen" class="d-none d-md-none d-lg-none"><i class="bi bi-search"></i>
                    </a>
                    <div class="mobilemenu  d-md-none d-lg-none" id="mobilemenu" style="display: none;">
                        <form method="get" action="{{ route('search') }}">
                            <input type="text" class="search-input" required="" name="x"
                                   placeholder="কি খুঁজতে চান?">
                            <button class="searchIcon" id="searchIcon" type="submit" name="button"><i
                                    class="fa fa-search"></i>
                            </button>
                            <button class="mobilemenuclose" id="mobilemenuclose" type="button" name="button"><i
                                    class="fa fa-times" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>

                <!--desktop-menu open-->
                <nav class="desktop-menu" id="desktop-menu">
                    <div id="desktop-menu-close">
                        <i class="bi bi-x"></i>
                    </div>
                    <ul class="main-menu">
                        @foreach(\App\Models\Menu::orderBy('position', 'asc')->get() as $key=> $menu)
                            <li class="menu-item"><a
                                    href="{{$menu->url_path}}">{{$menu->url_text}}</a> @if($menu->subMenu->count() > 0)
                                    <i class="bi bi-chevron-down MDDMOI icon"></i> @endif
                                @if($menu->subMenu->count() > 0)
                                    <ul class="sub-menu MDDM">
                                        @foreach(\App\Models\SubMenu::where('menu_id',$menu->id)->orderby('position','asc')->get() as $submenu)
                                            <li class="sub-item"><a
                                                    href="{{$submenu->url_path}}">{{$submenu->url_text}}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <!--desktop-menu end-->
            </div>

        </center>
    </div>

    <div id="search" class="d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('search') }}" class="form-group" role="search" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="x" placeholder="কি খুঁজতে চান?">
                            <span class="input-group-btn">
                                <button class="btn btn-search" type="submit"><i class="fa fa-search"
                                                                                aria-hidden="true"></i></button>
                            </span>
                            <div class="input-group-btn search-panel">
                                <button type="button" class="btn btn-close search_close"><i class="fa fa-times"
                                                                                            aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="nav__scrollbar__mbl d-none">
    <a href="{{ route('Archive') }}">সর্বশেষ</a>
    <?php $menus = menu_query(8, 1); ?>
    @foreach($menus as $menu)
        <a href="{{ $menu->url_path }}">{{ $menu->url_text}}</a>
    @endforeach
    <?php unset($menus); ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var nav = document.getElementById("desktop-menu");
    var open = document.getElementById("desktop-menu-open")
    var close = document.getElementById("desktop-menu-close")
    var bodyblur = document.getElementById("bodyblur")
    open.addEventListener("click", function () {
        nav.style.left = "0px";
        bodyblur.style.display = "block";
        // openNav.style.display = "none";
    })
    close.addEventListener("click", function () {
        nav.style.left = "-290px";
        bodyblur.style.display = "none";
        // openNav.style.display = "block";
    })
    $('.MDDMOI').click(function () {
        $(this).next().toggle();
        console.log($(this).attr('class'))
        if ($(this).attr('class') == 'bi bi-chevron-down MDDMOI icon') {
            $(this).removeClass('bi bi-chevron-down MDDMOI icon');
            $(this).addClass('bi bi-chevron-up MDDMOI icon');
        } else if ($(this).attr('class') == 'bi bi-chevron-up MDDMOI icon') {
            $(this).removeClass('bi bi-chevron-up MDDMOI icon');
            $(this).addClass('bi bi-chevron-down MDDMOI icon');
        }
        if ($('.MDDM:visible').length > 1) { // reset all if there is more than one opened
            $('.MDDM:visible').hide(); // hide all
            $(this).next().show(); // now show only the list you want
        }
    })

    $(document).mouseup(function (e) {
        let desktopMenu = $("#desktop-menu");
        let bodyblur = $("#bodyblur");
        if (!desktopMenu.is(e.target) && desktopMenu.has(e.target).length === 0) {
            desktopMenu.css("left", "-290px");
            bodyblur.hide();
        }
    });

</script>
