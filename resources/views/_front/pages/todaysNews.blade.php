@extends('layouts.frontend')
@section('meta_info')
@php $settings = setting(); @endphp
    <title>Todays News | {{ $settings->site_title }}</title>
    <meta name="title" content="Todays News | {{ $settings->site_title }}"/>
    <meta name="keywords" content="{{ $settings->meta_keywords }}"/>
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta name="classification" content="Magazine, Newspaper, Artical"/>
    <meta property="og:title" content="Todays News | {{ $settings->meta_title }}"/>
    <meta property="og:description" content="{{ $settings->meta_description }}">
    <meta property="og:image" content="{{ url($settings->meta_image) }}"/>
    <meta property="og:url" content="{{ $settings->site_url }}"/>
    <meta property="og:site_name" content="{{ $settings->site }}">
    <meta name="twitter:url" content="{{ $settings->site_url }}"/>
    <meta name="twitter:title" content="Todays News | {{ $settings->site_title }}"/>
    <meta name="twitter:description" content="{{ $settings->meta_description }}"/>
    <meta name="twitter:image" content="{{ url($settings->meta_image) }}"/>
    <meta name="twitter:creator" content="">
@endsection
@section('extra_css')
    <link rel="stylesheet"
          href="{{asset('assets/vendors/bootstrap-datepicker-1.6.1/css/bootstrap-datepicker.min.css')}}">
    <style>
        .callout-card {
            margin-bottom: 20px;
        }
        .all__news__page .heading h1 {
            color: #f00000;
            font-weight: 600;
            margin-bottom: 0;
            line-height: 1;
        }

        @media (max-width: 991px) {
        .callout-card img{
            height: 100px;
            object-fit: cover;
        }
        }
    </style>
@endsection

@section('main_content')
    <section class="container all__news__page">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8">
                <div class="heading py-2 mt-3">
                    <h1 class="mb-0">আজকের খবর</h1>
                </div>
                <hr>
                @php $posts = todays_news(); @endphp
                @if(!empty($posts))
                    @foreach($posts as $post)
                        <div class="callout-card pb-2 mb-4 border__btm">
                            <div class="row">
                                <div class="col-md-8 col-8 col-sm-8">
                                    <div class="media-body">
                                        <div class="float-left d-block mb-2"
                                             style="font-size: 20px;font-weight: 500;">
                                            <i class="bi bi-clock"
                                               style="font-size: 17px;position: relative;top: -2px;"></i> 
                                               {{engMonth_to_banMonth_replace(ampa_replace(e_to_b_replace(($post->created_at->format('h:i A')))))}}
                                        </div>
                                        <ul class="list-inline ">
                                            <li><h4 class="media-heading"><a
                                                            href="{{ news_url($post->id) }}"><strong>{{ $post->headline }}</strong></a>
                                                </h4></li>
                                            <li class="clearfix"></li>
                                        </ul>
                                        <p class="d-none d-md-block d-lg-block">{{ Str::limit($post->excerpt, 110) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4 col-sm-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <img class="media-object img-fluid mt-5"
                                             src="{{$post->featured_image}}" alt="{{ $post->headline }}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </section>
@include('_front.lazy_load')   
@endsection