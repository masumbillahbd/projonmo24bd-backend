<!doctype html>
<html lang="bn">
<!--<![endif]-->

<head>
    @php
        $settings = \App\Models\Setting::find('1');
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @yield('meta_info')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="ALL"/>
    <meta name="robots" content="index, follow"/>
    <meta name="googlebot" content="index, follow"/>
    <meta property="og:site_name" content="{{ $settings->site }}"/>
    <meta property="fb:app_id" content="{{ $settings->fb_app_id }}"/>
    <meta property="fb:pages" content=""/>
    <link rel="apple-touch-icon" href="{{ url($settings->favicon) }}">
    <link rel="shortcut icon" href="{{ url($settings->favicon) }}">
    <link href="{{ asset('/site_con/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/site_con/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/site_con/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/site_con/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    {{--    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100..900&display=swap"
          rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('/site_con/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/site_con/assets/css/site.css') }}" rel="stylesheet">
    <link rel="alternate" hreflang="en-US" href="{{ $settings->site_url }}"/>
    <script type='text/javascript'
            src='https://platform-api.sharethis.com/js/sharethis.js#property=68679171a7b03900199a1365&product=sop'
            async='async'></script>

    @yield('extra_css')

    <style>
        .whatsapp__url {
            position: fixed;
            bottom: 42px;
            background: #0dc143;
            left: 52px;
            border-radius: 8px;
            padding: 2px 15px;
            box-shadow: 3px 3px 1px #2b9d2a;
        }

        .whatsapp__url a {
            color: #fff;
            font-size: 23px;
        }

        .gslide-media {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 990px;
        }

        .desc-bottom .gslide-image img, .desc-top .gslide-image img {
            width: 100%;
        }

        @media (max-width: 991px) {
            .whatsapp__url {
                position: fixed;
                bottom: 7px;
                background: transparent;
                left: 6px;
                border-radius: 8px;
                padding: 4px 4px;
                box-shadow: none;
                z-index: 99;
            }

            .whatsapp__url svg {
                stroke: #0dc143;
                height: 50px !important;
            }

            .tawk-mobile {
                display: none;
            }

            .gslide-media {
                width: 90%;
            }
        }
    </style>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H1ECFP9GQJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-H1ECFP9GQJ');
    </script>
</head>
<body>
<div>
    @include('_front.parts.header')
    @yield('main_content')
    @include('_front.parts.footer')
</div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
{{--<script src="{{ asset('/site_con/assets/vendor/purecounter/purecounter.js') }}"></script>--}}
<script src="{{ asset('/site_con/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/site_con/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('/site_con/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('/site_con/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{ asset('/site_con/assets/vendor/php-email-form/validate.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="{{ asset('/site_con/assets/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@yield('extra_js')
<script src="{{ asset('/assets/js/front.js') }}"></script>
<script defer src="https://static.addtoany.com/menu/page.js"></script>

</body>
</html>


