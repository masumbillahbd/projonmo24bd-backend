@extends('layouts.frontend')
@php
    $settings = \App\Models\Setting::find('1');
@endphp
@section('meta_info')
    <title>{{ $video->title }}</title>
    <meta name="og:title" content="{{ $video->title }}">
    <meta name="og:description" content="{{ $video->title }}">
    <meta name="og:type" content="article">
    <meta name="og:image" content="{{ $video->thumbnail }}">
    <meta property="og:url" content="{{ video_url($video->uniqid) }}"/>
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:width" content="640"/>
    <meta property="og:image:height" content="360"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ video_url($video->uniqid) }}">
    <meta name="twitter:title" content="{{ $video->title }}">
    <meta name="twitter:description" content="{{ video_url($video->uniqid) }}">
    <meta name="twitter:image" content="{{ $video->thumbnail }}">
    <meta property="ia:markup_url" content="{{ video_url($video->uniqid) }}"/>
    <meta property="ia:markup_url_dev" content="{{ video_url($video->uniqid) }}"/>
    <meta property="ia:rules_url" content="{{ video_url($video->uniqid) }}"/>
    <meta property="ia:rules_url_dev" content="{{ video_url($video->uniqid) }}"/>
    <meta itemscope itemtype="{{ video_url($video->uniqid) }}"/>
    <link rel="canonical" href="{{ video_url($video->uniqid) }}">
    <link rel="amphtml" href="{{ video_url($video->uniqid) }}">
@endsection
@section('main_content')
    <section class="single__video__page">
        <div class="single_page ads ads__top__banner mb-4">
            <div class="container">
                <div class="ads__1 text-center py-3 d-block d-md-none d-lg-none">
                    <img src="/photos/5/6547b0fffa0de62158dcd7001a31330e.gif">
                </div>
                <div class="ads__1 py-3 d-none d-md-block d-lg-block text-center">
                    <img src="/ads/1677944913.gif" class="ads__file">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="vdopgsingle mt-3">
                        @if($video)
                            <div class="panel-body">
                                {!! embed_video($video) !!}
                            </div>
                            <hr>
                            <span class="info__txt">এখন চলছে</span>
                            <div class="vedio__title mb-3"><h2>{{ $video->title }}</h2></div>
                            <p>প্রকাশিত: {{ bangla_published_time($video->created_at) }}</p>
                        @endif
                    </div>
                    <div class="share-btn w-100 pt-4 my-5 d-flex">
                        <div><span class="shr__txt">শেয়ার করুন</span></div>
                        <div class="sharethis-inline-share-buttons" style="width: 90%; float:  left"></div>
                    </div>
                    <div class="comment">
                        <p class="mb-0 ps-2"><b>মন্তব্য করুন:</b></p>
                        <div class="cmnt__bar"></div>
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous"
                                src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v8.0&appId=348966578805818&autoLogAppEvents=1"></script>
                        <div class="fb-comments" data-href="{{ url()->current() }}"
                             data-numposts="10"
                             data-width=""></div>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="block__ads sqr text-center ads__mbl mb-3">
                                <div class="title">
                                    <span>বিজ্ঞাপন</span>
                                </div>
                                <div class="matter__square">
                                    <?php $ad = ad_by_position(14); ?>
                                    @if(!empty($ad))
                                        @if(!empty($ad->url))
                                            <a href="{{$ad->url}}" target="_blank">
                                                <img src="{{ asset('ads/'.$ad->photo)}}" class="mb-0 img-fluid"/>
                                            </a>
                                        @else
                                            <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                        @endif
                                    @endif
                                    <?php unset($ad) ?>
                                </div>
                            </div>
                    <div class="follow__btn d-flex  d-sm-none d-md-none d-lg-none text-center my-4" style="float: none">
                        <span>আমাদের ফলো করুন - </span>
                        <a href="{{ $settings->facebook }}" class="facebook" target="_blank"
                           style="background: #226ed3;"><i
                                    class="bx bxl-facebook"></i></a>
                        <a href="{{ $settings->twitter }}" class="twitter" target="_blank"
                           style="background: #1d9bf0"><i
                                    class="bx bxl-twitter"></i></a>
                        <a href="{{ $settings->youtube }}" class="youtube" target="_blank"
                           style="background: #ff0000"><i
                                    class="bx bxl-youtube"></i></a>
                        <a href="#" class="instagram social__icon" target="_blank" style="background: #c038be"><i
                                    class="bx bxl-instagram"></i></a>
                        <a href="#" class="linkedin social__icon d-none" style="background: #0077b5; padding: 0;"><i
                                    class="bx bxl-linkedin social__icon" target="_blank"></i></a>
                    </div>

                    <div class="more__video mt-৪">
                        <div class="heading mb-3">
                            <h4 class="mb-0">আরও দেখুন</h4>
                            <span class="video__bar"></span>
                        </div>
                        <?php $videos = video_query(12, 0, 'desc') ?>
                        @if($videos)
                                <div class="panel panel-info">
                                    @foreach($videos as $video)
                                            <div class="thumbnail mb-3">
                                                <a href="{{ video_url($video->uniqid) }}">
                                                    <div class="caption py-0" style="width: 65%; float: left;">
                                                        <h4>{{ Str::limit($video->title, 50) }}</h4>
                                                    </div>
                                                    <div class="video__img position-relative" style="width: 35%; float: right">
                                                        <i class="bi bi-play-fill position-absolute"></i>
                                                        <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="img-responsive">
                                                    </div>
                                                </a>
                                            </div>
                                    @endforeach
                                </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
