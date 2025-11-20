@extends('layouts.frontend')

@section('meta_info')
@php $settings = setting(); @endphp
    <title>@if(!empty($query)){{$query}}@endif | {{ $settings->site_title }}</title>
    <meta name="title" content="{{ $settings->site_title }}"/>
    <meta name="keywords" content="{{ $settings->meta_keywords }}"/>
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta name="classification" content="Magazine, Newspaper, Artical"/>
    <meta property="og:title" content="{{ $settings->meta_title }}"/>
    <meta property="og:description" content="{{ $settings->meta_description }}">
    <meta property="og:image" content="{{ url($settings->meta_image) }}"/>
    <meta property="og:url" content="{{ $settings->site_url }}"/>
    <meta property="og:site_name" content="{{ $settings->site }}">
    <meta name="twitter:url" content="{{ $settings->site_url }}"/>
    <meta name="twitter:title" content="{{ $settings->site_title }}"/>
    <meta name="twitter:description" content="{{ $settings->meta_description }}"/>
    <meta name="twitter:image" content="{{ url($settings->meta_image) }}"/>
    <meta name="twitter:creator" content="">
@endsection

<style>
    .search__page .btn.btn-search {
        background: var(--bs-blue);
        padding: 7px 15px 5px;
        height: 40px;
        color: var(--bs-white);
    }

    .search__page .well h4 {
        position: relative;
        top: 6px;
        color: var(--bs-blue);
    }

    .search__page .list-group-item {
        position: relative;
        display: block;
        padding: 0.5rem 0;
        color: #212529;
        text-decoration: none;
        background-color: #fff;
        border: none;
        border-bottom: 1px solid #ccc;
    }

    @media (min-width: 982px) {
        .search__page .search__left {
            padding-right: 20px;
            border-right: 1px solid #ccc;
        }
    }
</style>


@section('extra_css')

@endsection

@section('main_content')
    <div class="ads__section single_page py-3">
        <div class="container">
            <div class="matter__banner d-none d-md-block d-lg-block text-center">
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

            <div class="matter__square d-block d-md-none d-lg-none text-center">
                <?php $ad = ad_by_position(2); ?>
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

    <section class="search__page">
        <div class="container">
            <div class="row">
                <div class="col-md-8 search__left">
                    <div class="well well-sm text-left position-relative mb-4">
                        <h3>বিষয়: "{{ $query }}"</h3>
                    </div>
                    <form action="{{ route('search') }}" class="form-group" role="search" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="x" placeholder="খুঁজুন...">
                            <span class="input-group-btn">
                                <button class="btn btn-search" type="submit"><i class="bi bi-search"
                                                                                aria-hidden="true"></i></button>
                            </span>
                            <!--<div class="input-group-btn search-panel">
                                <button type="button" class="btn btn-close search_close"><i class="fa fa-times" aria-hidden="true"></i></i></button>
                            </div>-->
                        </div>
                    </form>

                    <div class="search__items py-5">
                        @if($posts)
                            @foreach($posts as $post)
                                <div class="news__item my-3 pb-3 border__btm">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="media">
                                                    <img
                                                        src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                        data-src="{{ !empty($post->featured_mini) ? $post->featured_mini : $post->featured_image }}"
                                                        alt="{{ strip_tags($post->headline) }}"
                                                        class="lazy media-object">
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="media-body">
                                                    <h4 class="text-600">{{ strip_tags($post->headline) }}</h4>
                                                    <i class="bi bi-clock"></i> {{ bangla_published_time($post->created_at) }}
                                                </div>
                                                <p class="caption mb-2">
                                                    {{ strip_tags( Str::limit($post->post_content, 150)) }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <nav class="text-left">
                                {!! $posts->links() !!}
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="matter__square ads_6 ads__mbl mb-3" align="center">
                        <?php $ad = ad_by_position(4); ?>
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
                    <div class="matter__square ads_6 ads__mbl mb-3" align="center">
                        <?php $ad = ad_by_position(5); ?>
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
                    <div class="well well-sm text-left position-relative mb-4">
                        <h3>আর্কাইভ</h3>
                    </div>
                    <div class="form-inline mb-3">
                        <div class="form-group">
                            <form action="{{ route('Archive') }}" method="get">
                                <input class="form-control" id="textDate" name="postByDate"
                                       @if(!empty($date))value="{{$date}}" @endif placeholder="yyyy-mm-dd" required
                                       type="date">
                                <button type="submit" class="btn btn-success mt-3 text-center d-block m-auto">দেখুন
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('extra_js')
    <script src="{{asset('assets/vendors/bootstrap-datepicker-1.6.1/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
    @include('_front.lazy_load')
@endsection

