@extends('layouts.frontend')

@section('meta_info')
@php $settings = setting(); @endphp
    <title>@if(!empty($sub_category->name)){{$sub_category->name}}@endif | {{ $settings->site_title }}</title>
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
@endsection

@php $url = URL::current(); $urls = explode('/', $url); $lasturl = end($urls);    @endphp

@section('extra_css')
    <style>
        .sub__cat .sub span:last-child::after {
            display: none;
        }

        .sub__cat .sub span:after {
            background-color: var(--bs-blue);
            margin: 0 11px;
        }
    </style>

@endsection

@section('main_content')
    <section class="section_page sub__cat">
        <div class="container-bg">
            <div class="container">
                <div class="row hidden">
                    <div class="col-md-12">
                        <div class="section_heading sub__cat__page d-flex pt-3 pb-4">
                            <a href="{{ sub_category_url($sub_category->slug) }}">{{ $sub_category->name }}</a>
                        </div>
                        <div class="sub pb-4">
                            <?php $sub_categories = $category->SubCategory->all();  ?>
                            @foreach($sub_categories as $sub_cat)
                                @if($sub_cat->slug == $lasturl)
                                    <span style="color:red;">{{ $sub_cat->name }}</span>
                                @else
                                    <span>
                                    <a class="activesubcat"
                                       href="{{ route('sub_cat.post', ['cat' => $category->slug, 'sub_cat' => $sub_cat->slug]) }}">{{ $sub_cat->name }}</a></span>
                                @endif
                            @endforeach
                            <?php unset($sub_categories, $category); ?>
                        </div>
                    </div>
                </div>
                <div class="cat__pg__top__1">
                    <div class="row">
                        <div class="border__right col-md-6">
                            <?php $post = posts_by_sub_category($sub_category->id, 1);  ?>
                            @if(!empty($post))
                                <div class="link-hover-homepage">
                                    <a href="{{ news_url($post->id ?? 0) }}">
                                        <img src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                data-src="{{ $post->featured_image }}"

                                                class="img-responsive lazy"
                                                alt="{{ $post->headline }}">
                                        <h4 class="pt-2 text-600">{!! $post->headline !!}</h4>
                                    </a>
                                    <p class="pt-2 excerpt">{{ Str::limit($post->excerpt, 90) }}</p>
                                    <time class="px-1"><?php $ago_time = bn_ago_time($post->created_at); $create_time = e_to_b_replace($ago_time);?> {{ $create_time }}</time>
                                </div>
                            @else
                                <p class="text-center">দু:খিত! কোন সংবাদ পাওয়া যায় নি...</p>
                            @endif
                            <?php unset($post); ?>
                        </div>
                        <div class="col-md-3">
                            <div class="sidebar">
                                <div class="content__col">
                                    <?php $posts = posts_by_sub_category($sub_category->id, 2, 1); ?>
                                    @if($posts)
                                        @foreach($posts as $post)
                                            <div class="border__btm">
                                                <div class="link-hover-homepage">
                                                    <a href="{{ news_url($post->id) }}"><img
                                                                src="{{ $post->featured_image }}"
                                                                class="img-responsive" alt="{{ $post->headline }}">
                                                        <h4 class="pt-2 text-600">{!! $post->headline !!}</h4>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <?php unset($posts); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="ads ads_6 ads__mbl mb-3" align="center">
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
                            <div class="ads ads_6 ads__mbl mb-3" align="center">
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
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-9">
                        <div class="cat-block-2">
                            <?php $posts = posts_by_sub_category($sub_category->id, 2, 3); ?>
                            @if($posts)
                                <div class="row">
                                    @foreach($posts as $post)
                                        <div class="col-md-4 col-xs-6">
                                            <div class="lead_8_content1">
                                                <div class="thumbnail">
                                                    <div class="link-hover-homepage">
                                                        <a href="{{ news_url($post->id) }}">
                                                            <img src="{{ $post->featured_image }}"
                                                                 class="img-responsive" alt="{{ $post->headline }}">
                                                        </a>
                                                        <div class="body__content__child">
                                                            <a href="{{ news_url($post->id) }}">
                                                                <h5 class="pt-3 px-2">{{ Str::limit($post->headline, 75) }}</h5>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <?php unset($posts); ?>
                        </div>
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('_front.lazy_load')
@endsection
