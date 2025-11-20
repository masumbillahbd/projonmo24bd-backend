@extends('layouts.frontend')
@php $settings = setting(); @endphp
@section('meta_info')
    <title>{{ $settings->site_title }}</title>
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
@section('extra_css')
    <style>
        /*push-notification open*/
        .pushengage {
            display: none;
            position: fixed;
            z-index: 999999;
            padding-top: 0;
            width: 350px;
            overflow: auto;
            border-radius: 0 0 12px 12px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, .08);
            left: 50%;
            top: 0;
            transform: translate(-50%, 0);
            background: #fefefe;
            padding: 10px;
        }
        .pushengage-content {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            width: 100%;
        }
        .pushengage-content .icon {
            width: 48px;
            height: 48px;
            display: flex;
            flex-shrink: 0;
            margin-right: 13px;
        }
        .pushengage-content .title-message {
            word-wrap: break-word;
            overflow: hidden;
            font-size: 13px;
            font-weight: 500;
            font-style: normal;
            text-align: left;
            display: block;
        }
        .pushengage-content .title-message p {
            line-height: 28px;
            margin: 0;
        }
        .pushengage-opt-container {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: flex-end;
            margin-top: 11px;
        }
        .pushengage-allow-btn {
            background-color: #1890ff;
            color: #fff;
            margin-right: 8px;
            align-items: center;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            padding: 10px 24px;
            font-size: 12px;
            font-weight: 600;
            line-height: 15px;
            text-align: center;
            word-break: break-word;
            font-style: normal;
        }
        .pushengage-close-btn {
            background-color: #ffffff;
            border: 1px solid #d8d8d8;
            color: #677489;
            align-items: center;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            padding: 10px 24px;
            font-size: 12px;
            font-weight: 600;
            line-height: 15px;
            text-align: center;
            word-break: break-word;
            font-style: normal;
        }
        .pushengage-allow-btn p,
        .pushengage-close-btn p {
            font-size: 12px;
            font-weight: 600;
            line-height: 15px;
            text-align: center;
            word-break: break-word;
            font-style: normal;
            margin: 0px;
        }
        /*push-notification end*/

        /*========== Home Post Slider Start =============*/
        .post-slider .next,
        .post-slider .prev {
            font-size: 24px;
            cursor: pointer;
            color: #ffffff;
            border: none;
            font-weight: 300;
            background: #2a2a2adb;
            border-radius: 50%;
            width: 39px;
            height: 39px;
            padding: 5px 8px;
        }

        .post-slider .next {
            position: absolute;
            right: -1%;
            top: 75px;
            z-index: 10;
        }

        .post-slider .prev {
            position: absolute;
            left: -1%;
            top: 75px;
            z-index: 10;
        }

        .post-slider h1 {
            text-align: center;
        }

        .post-slider .sl-wrapper {
            position: relative;
            width: 100%;
        }

        .post-slider .post-wrapper {
            width: 100%;
            margin: 0px auto;
            /* border: 1px dotted red; */
            padding: 10px 0px 10px 0px;
            overflow: hidden;
            background: #fff;
        }

        .post-slider .post-wrapper .post {
            width: 300px;
            display: inline-block;
            background: white;
            color: white;
            margin: 0 7px;
        }

        .post-slider .post-wrapper .post .slider-image {
            width: 100%;
            height: 156px;
            object-fit: cover;
            margin-left: 0 !important;
        }

        .post-slider .post-wrapper .post .post-info h4 {
            display: -webkit-box;
            height: 48px;
            -webkit-box-orient: vertical;
            overflow: hidden;
            -webkit-line-clamp: 3;
            margin: 6px 0;
            padding-left: 3px;
        }

        .post-slider .post-wrapper .post .post-info a {
            font-weight: 600;
            line-height: 25px;
            letter-spacing: .56px;
            text-decoration: none;
        }

        .slick-dots {
            display: none;
        }

        /* //poll */

        .vote__rate .total-vote {
            text-align: center;
            font-size: 18px;
        }

        [data-option="হ্যাঁ"] {
            background: #198754;
            background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-size: 1rem 1rem;
        }

        [data-option="না"] {
            background: #dc3545;
            background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-size: 1rem 1rem;
        }
        @media (max-width: 991px) {
            .full__row__3 img {
                float: unset;
            }

            .post-slider .prev {
                left: 0;
                top: 57px;
            }

            .post-slider .next {
                right: 0;
                top: 57px;
            }

            .post-slider .post-wrapper .post .slider-image {
                height: 121px;
            }

            .post-slider .post-wrapper .post .post-info h4 {
                margin-top: 0;
            }

            .post-slider .post-info {
                box-shadow: 0 2px 4px -1px rgba(0, 0, 0, .2), 0 4px 5px 0 rgba(0, 0, 0, .14), 0 1px 10px 0 rgba(0, 0, 0, .12) !important;
                padding: 5px;
            }
        }

        /*========== Home Post Slider End =============*/
    </style>
@endsection


@section('main_content')

    @if($settings->scroll_bar == 1)
        <div class="newsticker pt-2">
            <div class="container">
                <div class="scroll-news">
                    <marquee scrollamount="6" scrolldelay="5" direction="left" onmouseover="this.stop()"
                             onmouseout="this.start()">
                        <ul class="list-inline m-0">
                            @foreach(post_scroll_query(10,0,'desc') as $post)
                                <li class="">
                                    <a href="{{ news_url($post->id) }}">{{ $post->headline }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </marquee>
                </div>
            </div>
        </div>
    @endif

    @if($settings->popular_tag == 1)
        <div class="popular-topic">
            <div class="container">
                <div class="topic__item d-flex justify-content-center">
                    <div class="heading">
                        ট্রেন্ডিং
                    </div>
                    <div class="body">
                        @php $tags = popular_tags(5); @endphp
                        @foreach($tags as $tag)
                            <a href="{{tag_url(tag_name($tag->id))}}">{{tag_name($tag->id)}} <i
                                        class="bi bi-chevron-right"></i></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <section class="home__top pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="ads__mbl text-center d-block d-md-none d-lg-none mb-3">
                        @php $ad = ad_by_position(2); @endphp
                        @if(!empty($ad))
                            @if(!empty($ad->url))
                                <a href="{{$ad->url}}" target="_blank">
                                    <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                </a>
                            @else
                                <img src="{{ asset('ads/'.$ad->photo)}}"/>
                            @endif
                        @endif
                        @php unset($ad) @endphp
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb__mbl">
                            <div class="lead-single position-relative mb-2">
                                @php $sticky_post = sticky_posts_by_position(1); @endphp
                                @if($sticky_post)
                                    <div class="link-hover-homepage">
                                        <a href="{{ news_url($sticky_post->id) }}">
                                            <div class="thumbnail">
                                                <img src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                     data-src="{{ $sticky_post->featured_image }}"
                                                     alt="{!! $sticky_post->headline !!}" class="img-responsive lazy">
                                            </div>
                                        </a>
                                        <div class="lead__single__content py-3">
                                            <span>{!! $sticky_post->sub_headline !!}</span>
                                            <a href="{{ news_url($sticky_post->id) }}"><h3>
                                                    {!! $sticky_post->headline !!}</h3></a>
                                            <p class="d-block">
                                                {{ Str::limit($sticky_post->excerpt, 400) }}
                                            </p>
                                            <time class="d-none">@php $ago_time = bn_ago_time($sticky_post->created_at); $create_time = e_to_b_replace($ago_time);@endphp {{ $create_time }}</time>
                                        </div>
                                    </div>
                                @endif
                                @php unset($sticky_post); @endphp
                            </div>

                            <div class="lead3 d-none d-md-block d-lg-block">
                                @php $posts = sticky_posts_by_position(3, 1); @endphp
                                @if($posts)
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="col-md-4 col-6 mb__mbl">
                                                <div class="link-hover-homepage mb-3 mb-md-0 mb-lg-0">
                                                    <a href="{{news_url($post->id)}}">
                                                        <div class="thumbnail">
                                                            <img style="width: 100%;"
                                                                 src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                                 data-src="{{ $post->featured_image }}"
                                                                 class="img-responsive lazy"
                                                                 alt="{{ $post->headline }}">
                                                        </div>
                                                        <h4 class="py-2 lead__title">
                                                            @if(!empty($post->sub_headline))
                                                                <span class="sub__heading">{!! $post->sub_headline !!}</span>
                                                                /
                                                            @endif {{ $post->headline }}
                                                        </h4>
                                                    </a>
                                                    <time class="px-1">@php $ago_time = bn_ago_time($post->created_at); $create_time = e_to_b_replace($ago_time);@endphp {{ $create_time }}</time>
                                                    <p class="d-none">
                                                        {{ Str::limit($post->excerpt, 130) }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @php unset($posts, $post); @endphp
                            </div>
                            <div class="lead3 d-block d-md-none d-lg-none">
                                @php $posts = sticky_posts_by_position(6, 1); @endphp
                                @if($posts)
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="col-md-4 col-6 mb__mbl">
                                                <div class="link-hover-homepage">
                                                    <a href="{{news_url($post->id)}}">
                                                        <div class="thumbnail">
                                                            <img style="width: 100%;"
                                                                 src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                                 data-src="{{ $post->featured_image }}"
                                                                 class="img-responsive lazy"
                                                                 alt="{{ $post->headline }}">
                                                        </div>
                                                        <h4 class="py-2 lead__title">
                                                            @if(!empty($post->sub_headline))
                                                                <span class="sub__heading">{!! $post->sub_headline !!}</span>
                                                                /
                                                            @endif {{ $post->headline }}
                                                        </h4>
                                                    </a>
                                                    <time class="px-1">@php $ago_time = bn_ago_time($post->created_at); $create_time = e_to_b_replace($ago_time);@endphp {{ $create_time }}</time>
                                                    <p class="d-none">
                                                        {{ Str::limit($post->excerpt, 130) }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @php unset($posts, $post); @endphp
                            </div>
                        </div>
                        <div class="col-md-4 border__right__top mb__mbl">
                            <div class="lead_5 lead__middle__block mb-3 mb-md-0 mb-lg-0 d-none d-md-block d-lg-block">
                                @php $posts = sticky_posts_by_position(3, 4); @endphp
                                @if($posts)
                                    @foreach($posts as $post)
                                        <div class="link-hover-homepage mb-3">
                                            <div class="media-body">
                                                <a href="{{ news_url($post->id) }}">
                                                    <div class="thumbnail">
                                                        <img style="float:right; margin-top: 0px;"
                                                             class="media-object lazy"
                                                             src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                             data-src="{{ $post->featured_image }}"
                                                             alt="{!! $post->headline !!}">
                                                    </div>
                                                </a>
                                                <a href="{{ news_url($post->id) }}">
                                                    <h4 class="media-heading lead__title">
                                                        @if(!empty($post->sub_headline))
                                                            <span class="sub__heading">{!! $post->sub_headline !!}</span>
                                                            /
                                                        @endif {{ $post->headline }}
                                                    </h4>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @php unset($posts, $post); @endphp
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ads ads_6 ads__mbl mb-3" align="center">
                        @php $ad = ad_by_position(5); @endphp
                        @if(!empty($ad))
                            @if(!empty($ad->url))
                                <a href="{{$ad->url}}" target="_blank">
                                    <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                </a>
                            @else
                                <img src="{{ asset('ads/'.$ad->photo)}}"/>
                            @endif
                        @endif
                        @php unset($ad) @endphp
                    </div>

                    <div class="popular__home mb-3">
                        <div class="popularNews__hm">
                            <div class="heading w-100">
                                <h4 class="mb-0">জনপ্রিয়</h4>
                            </div>
                            <div class="list-content mb-5">
                                <div class=" me-2">
                                    @include('_front._render.popularNews')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <hr style="margin-top: 0px;">
        </div>
    </section>
    <div class="ads__section py-3">
        <div class="container">
            <div class="matter__banner">
                @php $ad = ad_by_position(3); @endphp
                @if(!empty($ad))
                    @if(!empty($ad->url))
                        <a href="{{$ad->url}}" target="_blank">
                            <img src="{{ asset('ads/'.$ad->photo)}}"/>
                        </a>
                    @else
                        <img src="{{ asset('ads/'.$ad->photo)}}"/>
                    @endif
                @endif
                @php unset($ad) @endphp
            </div>
        </div>
    </div>
    <section class="full__row__3" style="background-color: #efefef !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-small-block-2">
                        <!-- Default panel contents -->
                        <div class="category-heading position-relative">
                            <a href="{{ category_url(4) }}">{{ category_name(4) }}</a>
                        </div>
                        <div class="css_bar"></div>
                        <div class="cat-lead-single block-top-2">
                            <div class="row">
                                <div class="col-md-6 mb__mbl">
                                    @php $post = posts_by_category(4, 1); @endphp
                                    @if($post)
                                        <div class="link-hover-homepage cat__lead">
                                            <a href="{{ news_url($post->id) }}">
                                                <div class="thumbnail">
                                                    <img src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                         data-src="{{ $post->featured_image }}"
                                                         alt="{{ $post->headline }}"
                                                         class="img-responsive lazy"/>
                                                </div>
                                                <div class="heading__5 px-2">
                                                    <h2 class="my-2 lead__title">{{ $post->headline }}</h2>
                                                </div>
                                            </a>
                                            <p class="mb-2 px-2">{{ Str::limit($post->excerpt, 130) }}</p>

                                        </div>
                                    @endif
                                    @php unset($post); @endphp
                                </div>
                                <div class="col-md-6 mb__mbl">
                                    <div class="col_4_left_img_block">
                                        @php $posts = posts_by_category(4, 4, 1); @endphp
                                        @if($posts)
                                            @foreach($posts as $post)
                                                <div class="css__block__4">
                                                    <div class="link-hover-homepage mb-2">
                                                        <a href="{{ news_url($post->id) }}">
                                                            <div class="media-left thumbnail pe-2 mt-1"
                                                                 style="width: 32%;">
                                                                <img class="media-object"
                                                                     src="{{ $post->featured_image }}"
                                                                     alt="{{ $post->headline }}">
                                                            </div>
                                                            <div class="media-body">
{{--                                                                <h4 class="child__title">{{ Str::limit($post->headline, 55) }} {{ $post->headline }}</h4>--}}
                                                                <h4 class="child__title">{{ $post->headline }}</h4>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @php unset($posts, $post); @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- List group -->
                </div>
                <div class="col-md-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                             <a href="{{ category_url(2) }}">{{ category_name(2) }}</a>
                        </div>
                        <div class="block__child mb__mbl">
                            <div class="col_4_left_img_block">
                                @php $posts = posts_by_category(2, 4); @endphp
                                @if($posts)
                                    @foreach($posts as $post)
                                        <div class="css__block__4">
                                            <div class="link-hover-homepage mb-2">
                                                <a href="{{ news_url($post->id) }}">
                                                    <div class="media-left thumbnail pe-2 mt-1" style="width: 32%;">
                                                        <img class="media-object"
                                                             src="{{ $post->featured_image }}"
                                                             alt="{{ $post->headline }}">
                                                    </div>
                                                    <div class="media-body">
{{--                                                        <h4 class="child__title">{{ Str::limit($post->headline, 45) }}</h4>--}}
                                                        <h4 class="child__title">{{ $post->headline }}</h4>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @php unset($posts, $post); @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="full__row__excludive mb__mbl">
        <div class="container">
            <div class="panel-small-block-2">
                <div class="row">
                    <div class="col-md-9">
                        <div class="category-heading">
                            <a href="{{ category_url(5) }}">{{ category_name(5) }}</a>
                            {{--                            <div class="cat__bar__hm__all"></div>--}}
                        </div>
                        <div class="block__body">
                            <div class="homePageExclusive">
                                @php $posts = posts_by_category(5, 6); @endphp
                                @if($posts)
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="col-md-4 col-lg-4 col-6">
                                                <div class="link-hover-homepage mb-4 position-relative">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="media thumbnail">
                                                            <img src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                                 data-src="{{ $post->featured_image }}"
                                                                 class="img-responsive lazy"
                                                                 alt="{{ $post->headline }}"/>
                                                        </div>
                                                        <div class="media-title d-inline-block">
{{--                                                            <h4 class="">{{ Str::limit($post->headline, 50) }}</h4>--}}
                                                            <h4 class="">{{ $post->headline }}</h4>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @php unset($posts, $post); @endphp
                                {{--                                @include('_front._render.homePageExcludive')--}}
                            </div>
                        </div>
                        <div class="ads__banner text-center">
                            @php $ad = ad_by_position(7); @endphp
                            @if(!empty($ad))
                                @if(!empty($ad->url))
                                    <a href="{{$ad->url}}" target="_blank">
                                        <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                    </a>
                                @else
                                    <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                @endif
                            @endif
                            @php unset($ad) @endphp
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="matter__square text-center mb-3">
                            @php $ad = ad_by_position(4); @endphp
                            @if(!empty($ad))
                                @if(!empty($ad->url))
                                    <a href="{{$ad->url}}" target="_blank">
                                        <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                    </a>
                                @else
                                    <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                @endif
                            @endif
                            @php unset($ad) @endphp
                        </div>
                        <div class="namaj-time">
                            @php $Ptime = App\Models\Prayertime::first(); @endphp
                            <div class="category-heading text-center">
                                <span style="font-size: 23px;padding-right: 10px;">নামাজের সূচী</span>
                            </div>
                            <!--/.namaj-time-heading-->
                            <div class="namaj-time-date">

                            <!--/.namaj-time-date-->
                                <div class="namaj-time-body">
                                    <div class="namaj-time-body-left">

                                    </div>
                                    <!--/.namaj-time-body-left-->
                                    <div class="namaj-time-body-right w-100">
                                        <table class="table table-striped namaj-time-table">
                                            <tbody>
                                            <tr>
                                                <td>ফজর</td>
                                                <td>{{e_to_b_int($Ptime->fajr)}}</td>
                                            </tr>
                                            <tr>
                                                <td>জোহর</td>
                                                <td>{{e_to_b_int($Ptime->zuhr)}}</td>
                                            </tr>
                                            <tr>
                                                <td>আসর</td>
                                                <td>{{e_to_b_int($Ptime->asr)}}</td>
                                            </tr>
                                            <tr>
                                                <td>মাগরিব</td>
                                                <td>{{e_to_b_int($Ptime->maghrib)}}</td>
                                            </tr>
                                            <tr>
                                                <td>ইশা</td>
                                                <td>{{e_to_b_int($Ptime->isha)}}</td>
                                            </tr>
                                            <tr>
                                                <td>সূর্যোদয়</td>
                                                <td>{{e_to_b_int($Ptime->sun_rise)}}</td>
                                            </tr>
                                            <tr>
                                                <td>সূর্যাস্ত</td>
                                                <td>{{e_to_b_int($Ptime->sun_set)}}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!--/.namaj-time-body-right-->
                                </div>
                                <!--/.namaj-time-body-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="full__row__9 d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    <div class="panel-small-block-2">
                        <div class="category-heading">
                            <a href="{{ category_url(7) }}">{{ category_name(7) }}</a>
                        </div>
                        <div class="block__main">
                            <div class="row">
                                <div class="col-md-12 border__right">
                                    @php $post = posts_by_category(4, 1); @endphp
                                    @if($post)
                                        <div class="link-hover-homepage mb-3 d-grid">
                                            <a href="{{ news_url($post->id) }}">
                                                <div class="media">
                                                    <div class="thumbnail">
                                                        <img src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                             data-src="{{ $post->featured_image }}"
                                                             class="img-responsive lazy"
                                                             alt="{{ $post->headline }}"/>
                                                    </div>
                                                    <div class="media-title">
                                                        <h3>{{ $post->headline }}</h3>
                                                        <p style="width: 90%; color: #fff"
                                                           class="d-none d-md-block d-lg-block">{{ Str::limit($post->excerpt, 150) }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                    @php unset($post); @endphp
                                </div>
                            </div>
                        </div>
                        <div class="block__child homeCategory18_3 mb__mbl">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb__mbl">
                    <div class="panel-small-block-2">
                        <div class="category-heading" style="float: right">
                            <a href="{{ category_url(6) }}" class="v-text">{{ category_name(6) }}</a>
                        </div>
                        <div class="cat__block__main">
                            @php $posts = posts_by_category(4, 5); @endphp
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-body pe-1">
                                                <h4 class="lead__title">{!! $post->headline !!}</h4>
                                                <time class="py-1">@php $ago_time = bn_ago_time($post->created_at); $create_time = e_to_b_replace($ago_time);@endphp {{ $create_time }}</time>
                                            </div>
                                            <div class="media-left float-right" style="width: 40%;">
                                                <img class="media-object"
                                                     src="{{ $post->featured_image }}"
                                                     alt="{{ $post->headline }}">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            @php unset($posts, $post); @endphp
                        </div>
                    </div>
                    <div class="ads__section">
                        <div class="matter__square">
                            @php $ad = ad_by_position(5); @endphp
                            @if(!empty($ad))
                                @if(!empty($ad->url))
                                    <a href="{{$ad->url}}" target="_blank">
                                        <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                    </a>
                                @else
                                    <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                @endif
                            @endif
                            @php unset($ad) @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="district__block">
        <div class="container">
            <div class="category-heading">
                <a style="font-size: 23px;padding-right: 10px;">আমার এলাকার খবর</a>
            </div>
            <form action="{{ route('search_all_bd_news') }}" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mt-2 mb-3">
                            <select class="form-control form-select" aria-label="Default select example"
                                    id="division_list"
                                    name="division_id" required>
                                <option selected="" value="">বিভাগ</option>
                                @foreach($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-2 mb-3">
                            <select class="form-control form-select" aria-label="Default select example"
                                    id="district_list"
                                    name="district_id">
                                <option selected="" value="">জেলা</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-2 mb-3">
                            <select class="form-control form-select" aria-label="Default select example"
                                    id="upazila_list"
                                    name="upazila_id">
                                <option selected="" value="">উপজেলা</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-grid gap-2 btn__n__search mt-2 mb-3">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> খুঁজুন
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="block__row__4">
        <div class="container">
            <div class="css__boder__bottom">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="panel-small-block-2">
                            <div class="category-heading">
                                <a href="{{ category_url(9) }}">{{ category_name(9) }}</a>
                            </div>
                            <div class="css_bar"></div>
                            <div class="block__lead">
                                <div class="row">
                                    @php $post = posts_by_category(9, 1); @endphp
                                    @if($post)
                                        <div class="col-md-8">
                                            <div class="cat-lead-single block_comn_content">
                                                <div class="link-hover-homepage">
                                                    <div class="thumbnail1">
                                                        <a href="{{ news_url($post->id) }}"><img
                                                                    src="{{ $post->featured_image }}"
                                                                    alt="{{ $post->headline }}"
                                                                    class="img-responsive"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="business__block__content">
                                                <a href="{{ news_url($post->id) }}"><h3>
                                                        <b>
                                                            @if(!empty($post->sub_headline))
                                                                <span class="sub__heading">{!! $post->sub_headline !!}</span>
                                                                /
                                                            @endif
                                                            {!! words($post->headline, 10,'')  !!}</b></h3></a>
                                                <p>{!! words($post->excerpt, 50,'')  !!}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @php unset($post); @endphp
                                </div>
                            </div>
                            <hr style=" margin-top: 14px;margin-bottom: 14px;"/>
                            <div class="overlay_block_2 d-flex mb__mbl">
                                @php $posts = posts_by_category(9, 4, 1); @endphp
                                @if($posts)
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="border__right col-md-3 col-6 col-sm-6">
                                                <div class="link-hover-homepage">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="thumbnail">
                                                            <img src="{{ $post->featured_image }}" class="img-responsive"
                                                                 alt="{{ Str::limit($post->excerpt, 100) }}">
                                                        </div>
                                                        <h4 class="py-2">@if(!empty($post->sub_headline))
                                                                <span class="sub__heading">{!! $post->sub_headline !!}</span>
                                                                /
                                                            @endif {{ $post->headline }}</h4>
                                                    </a>
                                                </div>
                                                <p class="d-none">{{ Str::limit($post->excerpt, 100) }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @php unset($posts, $post); @endphp
                            </div>
                        </div>
                        <!-- List group -->
                    </div>
                    <div class="col-md-3 mb__mbl">
                        <div class="ads__section mb-3">
                            <div class="matter__square">
                                @php $ad = ad_by_position(6); @endphp
                                @if(!empty($ad))
                                    @if(!empty($ad->url))
                                        <a href="{{$ad->url}}" target="_blank">
                                            <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                        </a>
                                    @else
                                        <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                    @endif
                                @endif
                                @php unset($ad) @endphp
                            </div>
                        </div>
                        <div class="online__vote">
                            <div class="heading text-center">
                                <a href="{{route('polls')}}">অনলাইন ভোট</a>
                            </div>
                            <div class="body">
                                @php $polls = DB::select("select id, question from polls where date(now()) between start_date and end_date;");@endphp
                                @if(empty($polls))
                                    <div style="background-color: #f5f5f5; padding: 17px 20px; font-size: 18px;">
                                        দুঃখিত, জরিপের জন্য অপেক্ষা করুন।
                                    </div>
                                @else
                                    @foreach($polls as $poll)
                                        <div class="title mt-2 p-2">
                                            <h4>{{ $poll->question }}</h4>
                                        </div>
                                        <div class="vote__rate mt-2 p-2">
                                            <form action="{{ route('poll.choice') }}" method="post">
                                                @csrf

                                                @php
                                                $poll_choices = DB::select("select * from poll_choices where poll_id = :poll_id", array(
                                                    'poll_id' => $poll->id,
                                                ));

                                                $user_vote = \App\Models\PollAnswer::where('poll_id', $poll->id)->where('session_id', session()->getId())->first();

                                                @endphp
                                                @foreach($poll_choices as $choice)
                                                    <span class="rslt__nocmnts">
                                                        <label>
                                                        <input type="radio" name="poll_choice"
                                                        id="c{{$choice->id}}" value="{{$choice->id}}"
                                                        {{ isset($user_vote) && $user_vote->poll_answer_id == $choice->id ? 'checked' : '' }}>
                                                        {{ $choice->poll_answer }}
                                                        </label>
                                                    </span>
                                                @endforeach

                                                <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                                                <input type="hidden" name="session_id" value="{{ session()->getId() }}">
                                                <div class="btn__vote text-center">
                                                    <button class="btn btn__submit">ভোট দিন</button>
                                                </div>

                                            </form>

                                            <!---poll rate--->
                                        <div class="vote__rate mt-2 p-2">
                                            <?php
                                            $poll_choices = DB::select("select * from poll_choices where poll_id = :poll_id", array(
                                                'poll_id' => $poll->id,
                                            ));
                                            ?>

                                            <?php $total_vote = \App\Models\PollAnswer::where('poll_id', $poll->id)->count(); ?>
                                            @if($total_vote >= 1)
                                                @foreach($poll_choices as $choice)
                                                    <?php $ans_count = \App\Models\PollAnswer::where('poll_answer_id', $choice->id)->count(); $percent = Percent($total_vote, $ans_count); ?>

                                                    <div class="progress mb-2">
                                                        <div class="progress-bar progress-bar-striped"
                                                             data-option="{{$choice->poll_answer}}"
                                                             style="width:{{$percent}}%"></div>
                                                        <small class="option-name">{{$choice->poll_answer}}</small>
                                                        <small class="option-percent">{{e_to_b_int(Percent($total_vote, $ans_count))}}
                                                            %</small>
                                                    </div>
                                                @endforeach
                                            @elseif($total_vote == 0)
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped" data-option="হ্যাঁ"
                                                         style="width:0%"></div>
                                                    <small class="option-name">হ্যাঁ</small>
                                                    <small class="option-percent">০%</small>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped" data-option="না"
                                                         style="width:0%"></div>
                                                    <small class="option-name">না</small>
                                                    <small class="option-percent">০%</small>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped"
                                                         data-option="মন্তব্য নেই" style="width:0%"></div>
                                                    <small class="option-name">মন্তব্য নেই</small>
                                                    <small class="option-percent">০%</small>
                                                </div>
                                            @endif
                                        </div>
                                        <!---poll rate end--->

                                            <div class="vote-result text-center d-none">
                                                @php $total_vote = \App\Models\PollAnswer::where('poll_id', $poll->id)->count(); @endphp
                                                @unless($total_vote == 0)
                                                    @foreach($poll_choices as $choice)
                                                        @php $ans_count = \App\Models\PollAnswer::where('poll_answer_id', $choice->id)->count(); @endphp

                                                        <h5>{{ $choice->poll_answer }}:
                                                            <small>{{ e_to_b_int(Percent($total_vote, $ans_count))  }}
                                                                %</small>
                                                        </h5>
                                                    @endforeach
                                                @endunless
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @php unset($polls); @endphp
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="full__row__3 d-none">
        <div class="container">
            <div class="category-heading">
                {{--                <a href="{{ category_url(8) }}">{{ category_name(8) }}</a>--}}
                <a href="/bangladesh/economy">অর্থনীতি</a>
            </div>

            <div class="overlay_block_6">
                @php $post = posts_by_category(4, 6); @endphp
                @if($post)
                    <div class="row">
                        @foreach($post as $post)
                            <div class="border__right col-md-2 col-6 col-sm-12">
                                <div class="link-hover-homepage mb-2 mb-md-0 mb-lg-0">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="thumbnail">
                                            <img src="{{ $post->featured_image }}" class="img-responsive"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                    </a>
                                    <div class="body__content__child py-3">
                                        <a href="{{ news_url($post->id) }}">
                                            <h5><strong>@if(!empty($post->sub_headline))<span
                                                            style="color: red">{!! $post->sub_headline !!}</span>
                                                    / @endif {{ $post->headline }}</strong></h5>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
                @php unset($post); @endphp
            </div>
            <hr>
        </div>
    </section>
    <section class="full__row__11 d-none">
        <div class="container">
            <div class="panel-small-block-2">
                <div class="category-heading">
                    <a href="{{ category_url(10) }}">{{ category_name(10) }}</a>
                </div>
                <div class="block__main text-center">
                    @php $posts = posts_by_category(4, 6); @endphp
                    @if($posts)
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-md-2 col-lg-2 col-6 col-sm-6">
                                    <div class="link-hover-homepage">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="thumbnail">
                                                <img src="{{ $post->featured_image }}" class="img-responsive"
                                                     alt="{{ $post->headline }}">
                                            </div>
                                            <span class="sub__heading">{!! $post->sub_headline !!}</span>
                                            <h4 class="py-2"><strong>{{ $post->headline }}</strong></h4>
                                        </a>
                                        <p class="d-none d-md-block d-lg-block d-sm-none">{{ Str::limit($post->excerpt, 70) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @php unset($posts, $post); @endphp
                </div>
            </div>
        </div>
    </section>

    <section class="last__row__2">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(1) }}">{{ category_name(1) }}</a>
                        </div>
                        <div class="item__lead">
                            @php $post = posts_by_category(1, 1); @endphp
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="thumbnail">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @php unset($post); @endphp
                        </div>
                        <div class="block__child">
                            @php $posts = posts_by_category(1, 2, 1); @endphp
                            @if($posts)
                                @foreach($posts as $post)
                                @include('srolldown.post', ['post' => $post])
                                @endforeach
                            @endif
                            @php unset($posts, $post); @endphp
                            <div class="more__btn text-center">
                                <a href="{{ category_url(1) }}">আরও <i
                                            class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(8) }}">{{ category_name(8) }}</a>
                        </div>
                        <div class="item__lead">
                            @php $post = posts_by_category(8, 1); @endphp
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="thumbnail">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @php unset($post); @endphp
                        </div>
                        <div class="block__child">
                            @php $posts = posts_by_category(8, 2, 1); @endphp
                            @if($posts)
                                @foreach($posts as $post)
                                    @include('srolldown.post', ['post' => $post])
                                @endforeach
                            @endif
                            @php unset($posts, $post); @endphp
                            <div class="more__btn text-center">
                                <a href="{{ category_url(8) }}">আরও <i
                                            class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(15) }}">{{ category_name(15) }}</a>
                        </div>
                        <div class="item__lead">
                            @php $post = posts_by_category(15, 1); @endphp
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="thumbnail">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @php unset($post); @endphp
                        </div>
                        <div class="block__child">
                            @php $posts = posts_by_category(15, 2, 1); @endphp
                            @if($posts)
                                @foreach($posts as $post)
                                    @include('srolldown.post', ['post' => $post])
                                @endforeach
                            @endif
                            @php unset($posts, $post); @endphp
                            <div class="more__btn text-center">
                                <a href="{{ category_url(15) }}">আরও <i
                                            class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(16) }}">{{ category_name(16) }}</a>
                        </div>
                        <div class="item__lead">
                            @php $post = posts_by_category(16, 1); @endphp
                            @if($post)
                            <div class="link-hover-homepage position-relative mb-4">
                                <a href="{{ news_url($post->id) }}">
                                    <div class="thumbnail">
                                        <img src="{{ $post->featured_image }}" class="img-fluid"
                                             alt="{{ $post->headline }}">
                                    </div>
                                    <div class="caption">
                                        <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                    </div>
                                </a>
                            </div>
                            @endif
                            @php unset($post); @endphp
                        </div>
                        <div class="block__child">
                            @php $posts = posts_by_category(16, 2, 1); @endphp
                            @if($posts)
                                @foreach($posts as $post)
                                    @include('srolldown.post', ['post' => $post])
                                @endforeach
                            @endif
                            @php unset($posts, $post); @endphp
                            <div class="more__btn text-center">
                                <a href="{{ category_url(16) }}">আরও <i
                                            class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="last__row__2 r3">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(12) }}">{{ category_name(12) }}</a>
                        </div>
                        <div class="item__lead">
                            @php $post = posts_by_category(12, 1); @endphp
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="thumbnail">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @php unset($post); @endphp
                        </div>
                        <div class="block__child">
                            <div class="block__child">
                                @php $posts = posts_by_category(12, 2, 1); @endphp
                                @foreach($posts as $post)
                                    @include('srolldown.post', ['post' => $post])
                                @endforeach
                                <div class="more__btn text-center">
                                    <a href="{{ category_url(12) }}">আরও <i
                                                class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(20) }}">{{ category_name(20) }}</a>
                        </div>
                        <div class="item__lead">
                            @php $post = posts_by_category(20, 1); @endphp
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="thumbnail">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @php unset($post); @endphp
                        </div>
                        <div class="block__child">
                            @php $posts = posts_by_category(20, 2, 1); @endphp
                            @if($posts)
                            @foreach($posts as $post)
                                @include('srolldown.post', ['post' => $post])
                            @endforeach
                            @endif
                            @php unset($posts, $post); @endphp
                            <div class="more__btn text-center">
                                <a href="{{ category_url(20) }}">আরও <i
                                            class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(17) }}">{{ category_name(17) }}</a>
                        </div>
                        <div class="item__lead">
                            @php $post = posts_by_category(17, 1); @endphp
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="thumbnail">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @php unset($post); @endphp
                        </div>
                        <div class="block__child">
                            @php $posts = posts_by_category(17, 2, 1); @endphp
                            @if($posts)
                            @foreach($posts as $post)
                                @include('srolldown.post', ['post' => $post])
                            @endforeach
                            @endif
                            @php unset($posts, $post); @endphp
                            <div class="more__btn text-center">
                                <a href="{{ category_url(17) }}">আরও <i
                                            class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(19) }}">{{ category_name(19) }}</a>
                        </div>
                        <div class="item__lead">
                            @php $post = posts_by_category(19, 1); @endphp
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="thumbnail">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @php unset($post); @endphp
                        </div>
                        <div class="block__child">
                            @php $posts = posts_by_category(19, 2, 1); @endphp
                            @if($posts)
                                @foreach($posts as $post)
                                    @include('srolldown.post', ['post' => $post])
                                @endforeach
                            @endif
                            @php unset($posts, $post); @endphp
                            <div class="more__btn text-center">
                                <a href="{{ category_url(19) }}">আরও <i
                                            class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php $video = video_query(1) @endphp
    @if(!empty($video))
    <section class="block-special home__video">
        <div class="container">
            <div class="video-block-main">
                <div class="category-heading">
                    <a href="{{ route('video.gallery') }}">ভিডিও</a>
                </div>
                <div class="block-top-2 video__content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="video-top-content mb-3">
                                @if($video)
                                    <div class="item position-relative">
                                        <i class="bi bi-play-fill"></i>
                                        <a href="{{ video_url($video->uniqid) }}">
                                            <div class="thumbnail">
                                                <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}"
                                                     class="img-responsive">
                                            </div>
                                            <div class="video__cap">
                                                <h3><strong>{{ $video->title }}</strong></h3>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                @php unset($video); @endphp
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="video-list-2 homeVideo4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section id="ramadan" class="ramadan d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="TopTitle category__heading cat__bg">
                        <h4 class="mb-3 text-center">Ramadan</h4>
                    </div>
                    <div class="content">
                        @php $ramadans = ramadan() @endphp
                        @if(!empty($ramadans))
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <tbody>
                                    @foreach($ramadans as $ramadan)
                                        <tr class="division-row">
                                            <td><h4>{{$ramadan->division}}</h4></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">রমজান</th>
                                            <th class="text-center">তারিখ</th>
                                            <th class="text-center">বার</th>
                                            <th class="text-center">সাহরির শেষ সময়</th>
                                            <th class="text-center"> ইফতারের সময়</th>
                                        </tr>
                                        <tr>
                                            <td class="text-center">{{e_to_b_int($ramadan->ramadan_no)}}</td>
                                            <td class="text-center">{{ engMonth_to_banMonth_replace(e_to_b_int(\Carbon\Carbon::createFromFormat('Y-m-d', $ramadan->date)
                            ->format('d F')))}}</td>
                                            <td class="text-center">{{ day_replace(\Carbon\Carbon::createFromFormat('Y-m-d', $ramadan->date)
                            ->format('l'))}}</td>
                                            <td class="text-center">{{e_to_b_int(date('h:i', strtotime($ramadan->sehri)))}}</td>
                                            <td class="text-center">{{e_to_b_int(date('h:i', strtotime($ramadan->iftar)))}} </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php $photo = photo_query(1, 0, 'desc') @endphp
    @if(!empty($photo))
    <section class="block-special home__photo">
        <div class="container">
            <div class="category-heading">
                <a href="{{ route('photo.gallery') }}">ছবি</a>
            </div>
            <div class="photo__content">
                <div class="row"></div>
            </div>
            <div id="photo" class="photo__gallery__section">
                <div class="row">
                    <div class="col-md-6">
                        <div class="main__photo">
                            <div class="img__lead position-relative single__img">
                                @if(!empty($photo))
                                    <i class="bi bi-images position-absolute"></i>
                                    <a href="{{ $photo->featured_image }}" data-gallery="photoGallery1"
                                       class="portfolio-lightbox preview-link" title="{{ $photo->title }}">
                                        <div class="thumbnail">
                                            <img src="{{ $photo->featured_image }}" class="img-fluid "
                                                 alt="{{ $photo->title }}"/>
                                        </div>
                                    </a>
                                    <div class="portfolio-info">
                                        <div class="photo__title2">
                                            <a href="{{ $photo->featured_image }}" data-gallery="photoGallery1"
                                               class="portfolio-lightbox preview-link"
                                               title="{{ $photo->title }}">{{ $photo->title }}</a>
                                        </div>
                                        @php $multiple_photos = multiple_photo($photo->id) @endphp
                                        @foreach($multiple_photos as $multiple_photo)
                                            @if(!empty($multiple_photo->thumbnail))
                                                <a href="{{ $multiple_photo->thumbnail }}"
                                                   data-gallery="photoGallery1"
                                                   class="portfolio-lightbox preview-link"
                                                   title="{{ $multiple_photo->caption }}"></a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                @php unset($photo) @endphp
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="photo__item__4">
                                <div class="row">
                                    @php $photos = photo_query(4, 1, 'desc') @endphp
                                    @if(!empty($photos))
                                        @foreach($photos as $photo)
                                            <div class="col-md-6 col-6">
                                                <div class="photo__3rd1 item position-relative mb-3">
                                                    <i class="bi bi-images position-absolute"></i>
                                                    <a href="{{ $photo->featured_image }}"
                                                       data-gallery="photoGallery3"
                                                       class="portfolio-lightbox preview-link"
                                                       title="{{ $photo->title }}">
                                                        <div class="thumbnail">
                                                            <img src="{{$photo->featured_image}}"
                                                                 class="img-fluid" alt="{{$photo->title}}">
                                                        </div>
                                                    </a>
                                                    <div class="portfolio-info">
                                                        <div class="photo__title2">
                                                            <a href="{{$photo->featured_image}}"
                                                               class="portfolio-lightbox preview-link"
                                                               title="{{$photo->title}}"><p
                                                                        class="m-0">{{$photo->title}}</p></a>
                                                        </div>
                                                        @php $multiple_photos = multiple_photo($photo->id) @endphp
                                                        @foreach($multiple_photos as $multiple_photo)
                                                            @if(!empty($multiple_photo->thumbnail))
                                                                <a href="{{ $multiple_photo->thumbnail }}"
                                                                   data-gallery="photoGallery3"
                                                                   class="portfolio-lightbox preview-link"
                                                                   title="{{ $multiple_photo->caption }}"></a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    @php unset($photos) @endphp
                                </div>
                            </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    @endif

    <!--modal-->
    @php $popup = App\Models\Popup::where([['position', 'home'], ['status', 1]])->orderBy('id', 'desc')->first(); @endphp
    @if(!empty($popup))
        <div class="modal homeModal" id="myModal">
            <div class="modal-dialog modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="btn-close" data-bs-dismiss="modal"></span>
                    </div>
                    <div class="modal-body">
                        <a href="{{$popup->link}}"><img style="width:100%;"
                                                        src="{{ asset('/img/popup/'.$popup->image)}}"></a>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#myModal").modal('show');
            });
        </script>
    @endif
    <!--Modal End-->

    <!-- push-notification modal open -->
    <div id="pushengage" class="pushengage">
        <div class="pushengage-content">
            <div class="icon"><img src="https://www.dataenvelope.com/settings/1730355836_favicon.ico"></div>
            <div class="title-message"><p>আপনার পছন্দের সংবাদ পেতে সাবস্ক্রাইব করুন</p></div>
        </div>
        <div class="pushengage-opt-container">
            <div class="pushengage-allow-btn" id="pushengageAllowBtn"><p>হ্যাঁ</p></div>
            <div class="pushengage-close-btn" id="pushengageCloseBtn"><p>না</p></div>
        </div>
    </div>
    <!-- push-notification modal end -->
    @include('_front.lazy_load')
@endsection

@section('extra_js')
    <script src="{{ asset('/assets/js/index.js') }}"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script>
        navigator.serviceWorker.register("{{ URL::asset('service-worker.js') }}")
        // push-notification modal open
        let objEndpoint;
        let get_expired = localStorage.getItem('expired');
        let get_PushEngageSDK = localStorage.getItem('PushEngageSDK');
        let current = moment().format('YYYYMMDD');
        let uuid = window.crypto.randomUUID();
        if (get_PushEngageSDK !== null) {
            let obj = JSON.parse(get_PushEngageSDK);
            objEndpoint = obj.endpoint;
        }
        const pushengageAllowBtn = document.getElementById("pushengageAllowBtn");
        const pushengageCloseBtn = document.getElementById("pushengageCloseBtn");
        pushengageAllowBtn.addEventListener("click", pushengageAllowBtnFun);
        pushengageCloseBtn.addEventListener("click", pushengageCloseBtnFun);
        function pushengageAllowBtnFun() {
            askForPermission()
            pushengage.style.display = "none";
        }
        function pushengageCloseBtnFun() {
            let moment_expired = moment().add(3, 'days').format('YYYYMMDD');
            let moment_current = moment().format('YYYYMMDD');
            localStorage.setItem('expired', moment_expired);
            localStorage.setItem('action', moment_current);
            localStorage.setItem('uuid', uuid);
            pushengage.style.display = "none";
        }
        if (objEndpoint === null || get_expired === current || get_expired === null) {
            const pushengage = document.getElementById("pushengage");
            window.addEventListener('load', function () {
                function openPopup() {
                    pushengage.style.display = "block";
                };
                setTimeout(function () {
                    openPopup();
                }, 3000);
            })
        }
        // push-notification modal end
    </script>

    @include('MultipleDependencies')
    @include('_front.pages.home_ajax')
@endsection




@extends('layouts.frontend')
@php $settings = setting(); @endphp
@section('meta_info')
    <title>{{ $settings->site_title }}</title>
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
@section('main_content')


    @if($settings->scroll_bar == 1)
        <div class="newsticker pt-2">
            <div class="container">
                <div class="scroll-news">
                    <marquee scrollamount="6" scrolldelay="5" direction="left" onmouseover="this.stop()"
                             onmouseout="this.start()">
                        <ul class="list-inline m-0">
                            @foreach(post_scroll_query(10,0,'desc') as $post)
                                <li class="">
                                    <a href="{{news_url($post->id)}}">{{ $post->headline }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </marquee>
                </div>
            </div>
        </div>
    @endif

    @if($settings->popular_tag == 1)
        <div class="popular-topic">
            <div class="container">
                <div class="topic__item d-flex justify-content-center">
                    <div class="heading">
                        ট্রেন্ডিং
                    </div>
                    <div class="body">
                        <?php
                        $tags = popular_tags(5);
                        ?>
                        @foreach($tags as $tag)
                            <a href="{{tag_url(tag_name($tag->id))}}">{{tag_name($tag->id)}} <i
                                    class="bi bi-chevron-right"></i></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <section class="home__top sec__lead pt-4">
        @php
            $tag = tag($settings->feature_tag_id);
        @endphp

        @if($settings->feature_tag_status == 1 && is_object($tag))
            @php
                $leadTagPost = posts_by_tag($tag->id, 1);
                $leadTagPosts = posts_by_tag($tag->id, 4, 1);
            @endphp
            <div class="container"> <!--tap post open-->
                @if(!empty($settings->feature_tag_banner))
                    <div class="keyword__banner">
                        <img src="{{$settings->feature_tag_banner}}" class="img-fluid w-100"/>
                    </div>
                @endif
                <div class="keyword__block p-3">
                    <div class="row">
                        <div class="col-md-6 border__right">
                            <div class="block__lead">
                                <div class="row">
                                    @if(!empty($leadTagPost))
                                        <div class="col-md-6">
                                            <div class="cat-lead-single">
                                                <div class="link-hover-homepage">
                                                    <div class="thumbnail1">
                                                        <a href="{{ news_url($leadTagPost->id) }}"><img
                                                                src="{{ $leadTagPost->featured_image }}"
                                                                alt="{{ $leadTagPost->headline }}"
                                                                class="img-fluid"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="block__content">
                                                <a href="{{ news_url($leadTagPost->id) }}"><h4>
                                                        <b>
                                                            @if(!empty($leadTagPost->sub_headline))
                                                                <span
                                                                    class="sub__heading">{!! $leadTagPost->sub_headline !!}</span>
                                                                /
                                                            @endif
                                                            {!! words($leadTagPost->headline, 10,'')  !!}</b></h4></a>
                                                <p class="mb-0">{!! words($leadTagPost->excerpt, 25,'')  !!}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @php unset($leadTagPost); @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="child__block">
                                @if(!empty($leadTagPosts))
                                    <div class="row">
                                        @foreach($leadTagPosts as $post)
                                            <div class="col-md-6">
                                                <div class="link-hover-homepage mb-3">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="media-left thumbnail pe-2 mt-1"
                                                             style="width: 32%;">
                                                            <img class="media-object"
                                                                 src="{{ $post->featured_image }}"
                                                                 alt="{{ $post->headline }}">
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="child__title">{{ $post->headline }}</h4>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @php unset($leadTagPosts, $post); @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!--//tag post-->
        @endif


        <div class="container">
            <div class="row">
                <div class="border__right col-lg-3 order-2 order-lg-1">
                    <div class="left__block">
                        <?php $posts = sticky_posts_by_position(4, 9); ?>
                        @if($posts)
                            @foreach($posts as $post)
                                <div class="link-hover-homepage border__btm mb-3 pb-3">
                                    <div class="row">
                                        <div class="col-md-8 col-8 ">
                                            <div class="media-body pe-2">
                                                <a href="{{ news_url($post->id) }}"><h4>{{ $post->headline }}</h4></a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-4">
                                            <div class="media">
                                                <a href="{{ news_url($post->id) }}">
                                                    <img class="img-fluid"
                                                         src="{{$post->featured_image}}" alt="{{ $post->headline }}">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="intro">
                                        <p class="d-none d-md-block d-lg-block mb-0 mt-3"
                                           style="display: inline-block !important;">{{ Str::limit($post->excerpt, 110) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <?php unset($posts, $post); ?>
                    </div>
                    <div class="left__block d-none">
                        <div class="category__heading position-relative">
                            <a href="{{ category_url(2) }}">{{ category_name(2) }}</a>
                        </div>
                        <?php $posts = sticky_posts_by_position(4, 1); ?>
                        @if($posts)
                            @foreach($posts as $post)
                                <div class="link-hover-homepage border__btm mb-3 pb-3">
                                    <div class="row">
                                        <div class="col-md-8 col-8 ">
                                            <div class="media-body pe-2">
                                                <a href="{{ news_url($post->id) }}"><h4>{{ $post->headline }}</h4></a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-4">
                                            <div class="media">
                                                <a href="{{ news_url($post->id) }}">
                                                    <img class="img-fluid"
                                                         src="{{$post->featured_image}}" alt="{{ $post->headline }}">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="intro">
                                        <p class="d-none d-md-block d-lg-block mb-0 mt-3"
                                           style="display: inline-block !important;">{{ Str::limit($post->excerpt, 110) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <?php unset($posts, $post); ?>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="middle__block">
                        <?php $sticky_post = sticky_posts_by_position(1); ?>
                        @if($sticky_post)
                            <div class="link-hover-homepage border__btm mb-3 pb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="media">
                                            <a href="{{ news_url($sticky_post->id) }}">
                                                <img src="{{ $sticky_post->featured_image }}"
                                                     data-src="{{ $sticky_post->featured_image }}"/>
                                            </a>
                                            <small>{{ Str::limit($sticky_post->featured_image_caption, 40) }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="media-body pe-2">
                                            <a href="{{ news_url($sticky_post->id) }}">
                                                <h3>{!! $sticky_post->headline !!}</h3>
                                            </a>
                                            <div class="intro">
                                                <p class="d-none d-md-block d-lg-block mb-0 mt-3"
                                                   style="display: inline-block !important;">{{ Str::limit($sticky_post->excerpt, 110) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <?php unset($sticky_post); ?>

                        <div class="middle__block2 border__btm mb-3 pb-3 d-none d-md-block">
                            <?php $posts = sticky_posts_by_position(2, 1); ?>
                            @if($posts)
                                <div class="row">
                                    @foreach($posts as $post)
                                        <div class="col-md-6">
                                            <div class="link-hover-homepage">
                                                <div class="row">
                                                    <div class="col-md-8 col-8 ">
                                                        <div class="media-body pe-2">
                                                            <a href="{{ news_url($post->id) }}">
                                                                <h4>{{ $post->headline }}</h4></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-4">
                                                        <div class="media">
                                                            <a href="{{ news_url($post->id) }}">
                                                                <img class="img-fluid"
                                                                     src="{{$post->featured_image}}"
                                                                     alt="{{ $post->headline }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="intro">
                                                    <p class="d-none d-md-block d-lg-block mb-0 mt-3"
                                                       style="display: inline-block !important;">{{ Str::limit($post->excerpt, 110) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <?php unset($posts, $post); ?>
                        </div>

                        <div class="middle__block2 block__lead__mbl mb-3 pb-3 d-block d-md-none">
                            <?php $posts = sticky_posts_by_position(6, 1); ?>
                            @if($posts)
                                <div class="row">
                                    @foreach($posts as $post)
                                        <div class="col-md-6">
                                            <div class="link-hover-homepage">
                                                <div class="row">
                                                    <div class="col-md-8 col-7">
                                                        <div class="media-body pe-2">
                                                            <a href="{{ news_url($post->id) }}">
                                                                <h4>{{ $post->headline }}</h4></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-5">
                                                        <div class="media">
                                                            <a href="{{ news_url($post->id) }}">
                                                                <img class="img-fluid"
                                                                     src="{{$post->featured_image}}"
                                                                     alt="{{ $post->headline }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="intro">
                                                    <p class="d-none d-md-block d-lg-block mb-0 mt-3"
                                                       style="display: inline-block !important;">{{ Str::limit($post->excerpt, 110) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <?php unset($posts, $post); ?>
                        </div>
                        <div class="middle__block3 pb-3 mb-3 d-none d-md-block">
                            <?php $posts = sticky_posts_by_position(6, 1); ?>
                            @if($posts)
                                <div class="row">
                                    @foreach($posts as $post)
                                        <div class="col-md-4 border__right col-6">
                                            <div class="link-hover-homepage">
                                                <div class="media">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <img class="img-fluid"
                                                             src="{{$post->featured_image}}"
                                                             alt="{{ $post->headline }}">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a href="{{ news_url($post->id) }}"><h4>{{ $post->headline }}</h4>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            @endif
                            <?php unset($posts, $post); ?>
                        </div>
                        <div class="middle__block4 d-none">
                            <?php $posts = sticky_posts_by_position(3, 1); ?>
                            @if($posts)
                                <div class="row">
                                    @foreach($posts as $post)
                                        <div class="col-md-4">
                                            <div class="link-hover-homepage">
                                                <div class="media-body">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="caption">
                                                            <h4>{{ $post->headline }}</h4>
                                                        </div>
                                                    </a>
                                                    <p class="d-none d-md-block d-lg-block mb-0"
                                                       style="display: inline-block !important;">{{ Str::limit($post->excerpt, 90) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <?php unset($posts, $post); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 border__left order-3 order-lg-3">
                    <div class="right__block">
                        <div class="latest">
                            <div class="latest-popular">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab"
                                                data-bs-toggle="pill"
                                                data-bs-target="#pills-home" type="button" role="tab"
                                                aria-controls="pills-home" aria-selected="true">সর্বশেষ
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-profile" type="button" role="tab"
                                                aria-controls="pills-profile" aria-selected="false">জনপ্রিয়
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                         aria-labelledby="pills-home-tab">
                                        <div class="news latestNews">
                                            @include('_front._render.latestNews')
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                         aria-labelledby="pills-profile-tab">
                                        <div class="news popularNews">
                                            @include('_front._render.popularNews')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        </div>
    </section>
    <div class="ads__section py-3">
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
    <section class="full__row row__3">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="category-heading position-relative">
                        <a href="{{ category_url(4) }}">{{ category_name(4) }}</a>
                    </div>
                    <div class="block__lead">
                        <div class="row">
                            <div class="col-md-8">
                                <?php $post = posts_by_category(4, 1); ?>
                                @if($post)
                                    <div class="link-hover-homepage cat__lead position-relative">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media">
                                                <img
                                                    src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                    data-src="{{ $post->featured_image }}"
                                                    alt="{{ $post->headline }}"
                                                    class="img-responsive lazy"/>
                                            </div>
                                            <div class="caption1">
                                                <h3 class="my-2 lead__title">{{ $post->headline }}</h3>
                                            </div>
                                        </a>
                                        <p class="mb-2 px-2">{{ Str::limit($post->excerpt, 130) }}</p>
                                    </div>
                                @endif
                                <?php unset($post); ?>
                            </div>
                            <div class="col-md-4">
                                <div class="right">
                                    <?php $posts = posts_by_category(4, 2, 1); ?>
                                    @if($posts)
                                        @foreach($posts as $post)
                                            <div class="link-hover-homepage mb-2">
                                                <a href="{{ news_url($post->id) }}">
                                                    <div class="position-relative media mt-1">
                                                        <img class="media-object img-fluid"
                                                             src="{{ $post->featured_image }}"
                                                             alt="{{ $post->headline }}">
                                                        <div class="caption">
                                                            <h4 class="child__title mb-0 text-white">{{ $post->headline }}</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                    <?php unset($posts, $post); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="overlay_block_2 d-flex mb__mbl mt-3">
                                <?php $posts = posts_by_category(4, 4, 1); ?>
                                @if($posts)
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="border__right col-md-3 col-6 col-sm-6">
                                                <div class="link-hover-homepage">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="media">
                                                            <img src="{{ $post->featured_image }}"
                                                                 class="img-responsive"
                                                                 alt="{{ Str::limit($post->excerpt, 100) }}">
                                                        </div>
                                                        <h4 class="py-2">@if(!empty($post->sub_headline))
                                                                <span
                                                                    class="sub__heading">{!! $post->sub_headline !!}</span>
                                                                /
                                                            @endif {{ Str::limit($post->headline, 40) }}</h4>
                                                    </a>
                                                </div>
                                                <p class="d-none">{{ Str::limit($post->excerpt, 100) }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <?php unset($posts, $post); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(2) }}">{{ category_name(2) }}</a>
                        </div>
                        <div class="block__child mb__mbl">
                            <div class="col_4_left_img_block">
                                <?php $posts = posts_by_category(2, 6); ?>
                                @if($posts)
                                    @foreach($posts as $post)
                                        <div class="css__block__4">
                                            <div class="link-hover-homepage mb-1">
                                                <a href="{{ news_url($post->id) }}">
                                                    <div class="media-left media mt-1" style="width: 32%;">
                                                        <img class="media-object"
                                                             src="{{ $post->featured_image }}"
                                                             alt="{{ $post->headline }}">
                                                    </div>
                                                    <div class="media-body ps-2">
                                                        {{--                                                        <h4 class="child__title">{{ Str::limit($post->headline, 45) }}</h4>--}}
                                                        <h4 class="child__title">{{ $post->headline }}</h4>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <?php unset($posts, $post); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="full__row__3" style="background-color: #efefef !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-small-block-2">
                        <!-- Default panel contents -->
                        <div class="category-heading position-relative">
                            <a href="{{ category_url(1) }}">{{ category_name(1) }}</a>
                        </div>
                        <div class="css_bar"></div>
                        <div class="cat-lead-single block-top-2">
                            <div class="row">
                                <div class="col-md-6 mb__mbl">
                                    <?php $post = posts_by_category(4, 1); ?>
                                    @if($post)
                                        <div class="link-hover-homepage cat__lead">
                                            <a href="{{ news_url($post->id) }}">
                                                <div class="media">
                                                    <img
                                                        src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                        data-src="{{ $post->featured_image }}"
                                                        alt="{{ $post->headline }}"
                                                        class="img-responsive lazy"/>
                                                </div>
                                                <div class="heading__5 px-2 pb-5">
                                                    <h3 class="my-2 lead__title">{{ $post->headline }}</h3>
                                                </div>
                                            </a>
                                            <p class="mb-2 px-2 d-none">{{ Str::limit($post->excerpt, 130) }}</p>

                                        </div>
                                    @endif
                                    <?php unset($post); ?>
                                </div>
                                <div class="col-md-6 mb__mbl">
                                    <div class="col_4_left_img_block">
                                        <?php $posts = posts_by_category(4, 4, 1); ?>
                                        @if($posts)
                                            @foreach($posts as $post)
                                                <div class="css__block__4">
                                                    <div class="link-hover-homepage mb-2">
                                                        <a href="{{ news_url($post->id) }}">
                                                            <div class="media-left pe-2 mt-1" style="width: 32%;">
                                                                <div class="media"><img class="media-object"
                                                                                        src="{{ $post->featured_image }}"
                                                                                        alt="{{ $post->headline }}">
                                                                </div>
                                                            </div>
                                                            <div class="media-body">
                                                                {{--                                                                <h4 class="child__title">{{ Str::limit($post->headline, 55) }} {{ $post->headline }}</h4>--}}
                                                                <h4 class="child__title">{{ Str::limit($post->headline, 55) }}</h4>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <?php unset($posts, $post); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- List group -->
                </div>
                <div class="col-md-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(15) }}">{{ category_name(15) }}</a>
                        </div>
                        <div class="block__child mb__mbl">
                            <div class="col_4_left_img_block">
                                <?php $posts = posts_by_category(2, 4); ?>
                                @if($posts)
                                    @foreach($posts as $post)
                                        <div class="css__block__4">
                                            <div class="link-hover-homepage mb-2">
                                                <a href="{{ news_url($post->id) }}">
                                                    <div class="media-left pe-2 mt-1" style="width: 32%;">
                                                        <div class="media"><img class="media-object"
                                                                                src="{{ $post->featured_image }}"
                                                                                alt="{{ $post->headline }}"></div>
                                                    </div>
                                                    <div class="media-body">
                                                        {{--                                                        <h4 class="child__title">{{ Str::limit($post->headline, 45) }}</h4>--}}
                                                        <h4 class="child__title">{{ Str::limit($post->headline, 45) }}</h4>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <?php unset($posts, $post); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="full__row__excludive mb__mbl">
        <div class="container">
            <div class="panel-small-block-2">
                <div class="row">
                    <div class="col-md-9">
                        <div class="category-heading">
                            <a href="{{ category_url(5) }}">{{ category_name(5) }}</a>
                            {{--                            <div class="cat__bar__hm__all"></div>--}}
                        </div>
                        <div class="block__body">
                            <div class="homePageExclusive">
                                <?php $posts = posts_by_category(4, 6); ?>
                                @if($posts)
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="col-md-4 col-lg-4 col-6">
                                                <div class="link-hover-homepage mb-4 position-relative">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="media media">
                                                            <img
                                                                src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                                data-src="{{ $post->featured_image }}"
                                                                class="img-responsive lazy"
                                                                alt="{{ $post->headline }}"/>
                                                        </div>
                                                        <div class="media-title d-inline-block">
                                                            {{--                                                            <h4 class="">{{ Str::limit($post->headline, 50) }}</h4>--}}
                                                            <h4 class="">{{ $post->headline }}</h4>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <?php unset($posts, $post); ?>
                                {{--                                @include('_front._render.homePageExcludive')--}}
                            </div>
                        </div>
                        <div class="ads__banner text-center">
                            <?php $ad = ad_by_position(7); ?>
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
                    <div class="col-md-3">
                        <div class="matter__square text-center mb-3">
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
                        <div class="namaj-time">
                            <?php $Ptime = App\Models\Prayertime::first(); ?>
                            <div class="category-heading">
                                <span style="font-size: 23px;padding-right: 10px;">নামাজের সূচী</span>
                            </div>
                            <!--/.namaj-time-heading-->
                            <div class="namaj-time-date">
                            {{--                                <i class="fa fa-calendar" aria-hidden="true"></i>--}}
                            {{--                                মঙ্গলবার, ৩০ জানুয়ারী ২০২৪    </div>--}}
                            <!--/.namaj-time-date-->
                                <div class="namaj-time-body position-relative">
                                    <div class="namaj-time-body-left">
                                        <img class="img-fluid"
                                             src="/img/minar.png"
                                             alt="Masjid">
                                    </div>
                                    <!--/.namaj-time-body-left-->
                                    <div class="namaj-time-body-right">
                                        <table class="table table-striped namaj-time-table">
                                            <tbody>
                                            <tr>
                                                <td>ফজর</td>
                                                <td>{{e_to_b_int($Ptime->fajr)}}</td>
                                            </tr>
                                            <tr>
                                                <td>জোহর</td>
                                                <td>{{e_to_b_int($Ptime->zuhr)}}</td>
                                            </tr>
                                            <tr>
                                                <td>আসর</td>
                                                <td>{{e_to_b_int($Ptime->asr)}}</td>
                                            </tr>
                                            <tr>
                                                <td>মাগরিব</td>
                                                <td>{{e_to_b_int($Ptime->maghrib)}}</td>
                                            </tr>
                                            <tr>
                                                <td>ইশা</td>
                                                <td>{{e_to_b_int($Ptime->isha)}}</td>
                                            </tr>
                                            <tr>
                                                <td>সূর্যোদয়</td>
                                                <td>{{e_to_b_int($Ptime->sun_rise)}}</td>
                                            </tr>
                                            <tr>
                                                <td>সূর্যাস্ত</td>
                                                <td>{{e_to_b_int($Ptime->sun_set)}}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!--/.namaj-time-body-right-->
                                </div>
                                <!--/.namaj-time-body-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="full__row__9">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    <div class="panel-small-block-2">
                        <div class="category-heading">
                            <a href="{{ category_url(7) }}">{{ category_name(7) }}</a>
                        </div>
                        <div class="block__main">
                            <div class="row">
                                <div class="col-md-12 border__right">
                                    <?php $post = posts_by_category(4, 1); ?>
                                    @if($post)
                                        <div class="link-hover-homepage mb-3 d-grid">
                                            <a href="{{ news_url($post->id) }}">
                                                <div class="media">
                                                    <div class="media">
                                                        <img
                                                            src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                            data-src="{{ $post->featured_image }}"
                                                            class="img-fluid lazy w-100"
                                                            alt="{{ $post->headline }}"/>
                                                    </div>
                                                    <div class="media-title">
                                                        <h3>{{ $post->headline }}</h3>
                                                        <p style="width: 90%; color: #fff"
                                                           class="d-none d-md-block d-lg-block">{{ Str::limit($post->excerpt, 150) }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                    <?php unset($post); ?>
                                </div>
                            </div>
                        </div>
                        <div class="block__child mb__mbl">
                            <?php $posts = posts_by_category(4, 3, 1); ?>
                            @if($posts)
                                <div class="row">
                                    @foreach($posts as $post)
                                        <div class="col-md-4 col-12">
                                            <div class="link-hover-homepage mb-3">
                                                <a href="{{ news_url($post->id) }}">
                                                    <div class="box__shadow">
                                                        <div class="media">
                                                            <img src="{{ asset('/defaults/lazy_logo.jpg') }}"
                                                                 data-src="{{ !empty($post->featured_mini) ? $post->featured_mini : $post->featured_image }}"
                                                                 alt="{{ $post->headline }}" class="img-fluid lazy"/>
                                                        </div>
                                                        <div class="title__box p-2 pb-4">
                                                            <h4>{{ $post->headline }}</h4>
                                                            <p class="mb-0 mt-2">{{ Str::limit($post->excerpt, 90) }}</p>
                                                            <span class="cat__name">{{ category_name(7) }}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <?php unset($posts, $post); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb__mbl">
                    <div class="panel-small-block-2">
                        <div class="category-heading">
                            <a href="{{ category_url(6) }}" class="v-text">{{ category_name(6) }}</a>
                        </div>
                        <div class="cat__block__main">
                            <?php $posts = posts_by_category(4, 5); ?>
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-body pe-1">
                                                <h4 class="lead__title">{!! $post->headline !!}</h4>
                                                <time
                                                    class="py-1"><?php $ago_time = bn_ago_time($post->created_at); $create_time = e_to_b_replace($ago_time);?> {{ $create_time }}</time>
                                            </div>
                                            <div class="media-left float-right" style="width: 40%;">
                                                <img class="media-object"
                                                     src="{{ $post->featured_image }}"
                                                     alt="{{ $post->headline }}">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                        </div>
                    </div>
                    <div class="ads__section">
                        <div class="matter__square">
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
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="district__block">
        <div class="container">
            <div class="category-heading">
                <a style="font-size: 23px;padding-right: 10px;">আমার এলাকার খবর</a>
            </div>
            <form action="{{ route('search_all_bd_news') }}" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mt-2 mb-3">
                            <select class="form-control form-select" aria-label="Default select example"
                                    id="division_list"
                                    name="division_id" required>
                                <option selected="" value="">বিভাগ</option>
                                @foreach($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-2 mb-3">
                            <select class="form-control form-select" aria-label="Default select example"
                                    id="district_list"
                                    name="district_id">
                                <option selected="" value="">জেলা</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-2 mb-3">
                            <select class="form-control form-select" aria-label="Default select example"
                                    id="upazila_list"
                                    name="upazila_id">
                                <option selected="" value="">উপজেলা</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-grid gap-2 btn__n__search mt-2 mb-3">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> খুঁজুন
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="block__row__4">
        <div class="container">
            <div class="css__boder__bottom">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="panel-small-block-2">
                            <div class="category-heading">
                                <a href="{{ category_url(9) }}">{{ category_name(9) }}</a>
                            </div>
                            <div class="css_bar"></div>
                            <div class="block__lead">
                                <div class="row">
                                    <?php $post = posts_by_category(9, 1); ?>
                                    @if($post)
                                        <div class="col-md-8">
                                            <div class="cat-lead-single block_comn_content">
                                                <div class="link-hover-homepage">
                                                    <div class="media1">
                                                        <a href="{{ news_url($post->id) }}"><img
                                                                src="{{ $post->featured_image }}"
                                                                alt="{{ $post->headline }}"
                                                                class="img-responsive"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="business__block__content">
                                                <a href="{{ news_url($post->id) }}"><h3>
                                                        <b>
                                                            @if(!empty($post->sub_headline))
                                                                <span
                                                                    class="sub__heading">{!! $post->sub_headline !!}</span>
                                                                /
                                                            @endif
                                                            {!! words($post->headline, 10,'')  !!}</b></h3></a>
                                                <p>{!! words($post->excerpt, 50,'')  !!}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <?php unset($post); ?>
                                </div>
                            </div>
                            <hr style=" margin-top: 14px;margin-bottom: 14px;"/>
                            <div class="overlay_block_2 d-flex mb__mbl">
                                <?php $posts = posts_by_category(9, 4, 1); ?>
                                @if($posts)
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="border__right col-md-3 col-6 col-sm-6">
                                                <div class="link-hover-homepage">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="media">
                                                            <img src="{{ $post->featured_image }}"
                                                                 class="img-responsive"
                                                                 alt="{{ Str::limit($post->excerpt, 100) }}">
                                                        </div>
                                                        <h4 class="py-2">@if(!empty($post->sub_headline))
                                                                <span
                                                                    class="sub__heading">{!! $post->sub_headline !!}</span>
                                                                /
                                                            @endif {{ $post->headline }}</h4>
                                                    </a>
                                                </div>
                                                <p class="d-none">{{ Str::limit($post->excerpt, 100) }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <?php unset($posts, $post); ?>
                            </div>
                        </div>
                        <!-- List group -->
                    </div>
                    <div class="col-md-3 mb__mbl">
                        <div class="ads__section mb-3">
                            <div class="matter__square">
                                <?php $ad = ad_by_position(6); ?>
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
                        <div class="online__vote">
                            <div class="heading text-center">
                                <a href="{{route('polls')}}">অনলাইন ভোট</a>
                            </div>
                            <div class="body">
                                @php $polls = DB::select("select id, question from polls where date(now()) between start_date and end_date;");@endphp
                                @if(empty($polls))
                                    <div style="background-color: #f5f5f5; padding: 17px 20px; font-size: 18px;">
                                        দুঃখিত, জরিপের জন্য অপেক্ষা করুন।
                                    </div>
                                @else
                                    @foreach($polls as $poll)
                                        <div class="title mt-2 p-2">
                                            <h4>{{ $poll->question }}</h4>
                                        </div>
                                        <div class="vote__rate mt-2 p-2">
                                            <form action="{{ route('poll.choice') }}" method="post">
                                                @csrf

                                                @php
                                                    $poll_choices = DB::select("select * from poll_choices where poll_id = :poll_id", array(
                                                        'poll_id' => $poll->id,
                                                    ));

                                                    $user_vote = \App\Models\PollAnswer::where('poll_id', $poll->id)->where('session_id', session()->getId())->first();

                                                @endphp
                                                @foreach($poll_choices as $choice)
                                                    <span class="rslt__nocmnts">
                                                        <label>
                                                        <input type="radio" name="poll_choice"
                                                               id="c{{$choice->id}}" value="{{$choice->id}}"
                                                        {{ isset($user_vote) && $user_vote->poll_answer_id == $choice->id ? 'checked' : '' }}>
                                                        {{ $choice->poll_answer }}
                                                        </label>
                                                    </span>
                                                @endforeach

                                                <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                                                <input type="hidden" name="session_id" value="{{ session()->getId() }}">
                                                <div class="btn__vote text-center">
                                                    <button class="btn btn__submit">ভোট দিন</button>
                                                </div>

                                            </form>
                                            <div class="vote-result text-center d-none">
                                                @php $total_vote = \App\Models\PollAnswer::where('poll_id', $poll->id)->count(); @endphp
                                                @unless($total_vote == 0)
                                                    @foreach($poll_choices as $choice)
                                                        @php $ans_count = \App\Models\PollAnswer::where('poll_answer_id', $choice->id)->count(); @endphp

                                                        <h5>{{ $choice->poll_answer }}:
                                                            <small>{{ e_to_b_int(Percent($total_vote, $ans_count))  }}
                                                                %</small>
                                                        </h5>
                                                    @endforeach
                                                @endunless
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @php unset($polls); @endphp
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="full__row__3">
        <div class="container">
            <div class="category-heading">
                <a href="{{ category_url(20) }}">{{ category_name(20) }}</a>
            </div>

            <div class="overlay_block_6">
                <?php $post = posts_by_category(4, 4); ?>
                @if($post)
                    <div class="row">
                        @foreach($post as $post)
                            <div class="border__right col-md-3 col-6 col-sm-12">
                                <div class="link-hover-homepage mb-2 mb-md-0 mb-lg-0">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="media">
                                            <img src="{{ $post->featured_image }}" class="img-responsive"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="body__content__child py-3">
                                            <h5>@if(!empty($post->sub_headline))<span
                                                    style="color: red">{!! $post->sub_headline !!}</span>
                                                / @endif {{ $post->headline }}</h5>
                                        </div>
                                    </a>
                                    <p class="d-none d-md-block d-lg-block">{{ Str::limit($post->excerpt, 110) }}</p>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
                <?php unset($post); ?>
            </div>
            <hr>
        </div>
    </section>
    <section class="full__row__11">
        <div class="container">
            <div class="panel-small-block-2">
                <div class="category-heading">
                    <a href="{{ category_url(10) }}">{{ category_name(10) }}</a>
                </div>
                <div class="block__main text-center">
                    <?php $posts = posts_by_category(4, 6); ?>
                    @if($posts)
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-md-2 col-lg-2 col-6 col-sm-6">
                                    <div class="link-hover-homepage">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media">
                                                <img src="{{ $post->featured_image }}" class="img-responsive"
                                                     alt="{{ $post->headline }}">
                                            </div>
                                            <span class="sub__heading">{!! $post->sub_headline !!}</span>
                                            <h4 class="py-2">{{ Str::limit($post->headline, 45) }}</h4>
                                        </a>
                                        <p class="d-none d-md-block d-lg-block d-sm-none">{{ Str::limit($post->excerpt, 70) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <?php unset($posts, $post); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="block-special home__video bg-dark">
        <div class="container">
            <div class="border__cat__top mb-2"></div>
            <div class="video-block-main position-relative">
                <div class="category-heading">
                    <a href="{{ route('video.gallery') }}" class="text-white">ভিডিও</a>
                </div>
                <div class="block-top-2 video__content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="video-top-content my-3 pb-3">
                                <?php $video = video_query(1); ?>
                                @if($video)
                                    <a href="{{ video_url($video->uniqid) }}">
                                        <div class="media position-relative">
                                            <i class="bi bi-play-fill"></i>
                                            <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}"
                                                 class="img-responsive">
                                        </div>

                                        <div class="video__cap">
                                            <h3 class="text-bold-500 pt-3">{{ $video->title }} </h3>
                                        </div>
                                    </a>
                                @endif
                                <?php unset($video); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="video-list-2">
                                <?php $videos = video_query(5, 0); ?>
                                @if(!empty($videos))
                                    @foreach($videos as $video)
                                        <div class="item my-3">
                                            <a href="{{ video_url($video->uniqid) }}">
                                                <div class="row">
                                                    <div class="col-lg-5 col-4">
                                                        <div class="video__thumb position-relative">
                                                            <i class="bi bi-play-fill"></i>
                                                            <img src="{{ $video->thumbnail }}"
                                                                 alt="{{ $video->title }}"
                                                                 class="img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 col-8">
                                                        <div class="video__caption">
                                                            <h4>{{ Str::limit($video->title, 50) }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="ads__section py-5">
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
    <section class="last__row__2">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(12) }}">{{ category_name(12) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(1, 1); ?>
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="media">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            <?php unset($post); ?>
                        </div>
                        <div class="block__child">
                            <?php $posts = posts_by_category(1, 3, 1); ?>
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-left pe-2">
                                                <div class="media">
                                                    <img class="img-fluid"
                                                         src="{{ $post->featured_image }}"
                                                         alt="{{ $post->headline }}">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="mb-0">{{ $post->headline }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(12) }}">আরও <i
                                        class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(17) }}">{{ category_name(17) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(8, 1); ?>
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="media">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            <?php unset($post); ?>
                        </div>
                        <div class="block__child">
                            <?php $posts = posts_by_category(1, 3, 1); ?>
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-left pe-2">
                                                <div class="media">
                                                    <img class="img-fluid"
                                                         src="{{ $post->featured_image }}"
                                                         alt="{{ $post->headline }}">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="mb-0">{{ $post->headline }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(17) }}">আরও <i
                                        class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(21) }}">{{ category_name(21) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(15, 1); ?>
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="media">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            <?php unset($post); ?>
                        </div>
                        <div class="block__child">
                            <?php $posts = posts_by_category(1, 3, 1); ?>
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-left pe-2">
                                                <div class="media">
                                                    <img class="img-fluid"
                                                         src="{{ $post->featured_image }}"
                                                         alt="{{ $post->headline }}">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="mb-0">{{ $post->headline }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(21) }}">আরও <i
                                        class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(22) }}">{{ category_name(22) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(16, 1); ?>
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="media">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            <?php unset($post); ?>
                        </div>
                        <div class="block__child">
                            <?php $posts = posts_by_category(1, 3, 1); ?>
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-left pe-2">
                                                <div class="media">
                                                    <img class="img-fluid"
                                                         src="{{ $post->featured_image }}"
                                                         alt="{{ $post->headline }}">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="mb-0">{{ $post->headline }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(22) }}">আরও <i
                                        class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="last__row__2 r3">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(23) }}">{{ category_name(23) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(12, 1); ?>
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="media">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            <?php unset($post); ?>
                        </div>
                        <div class="block__child">
                            <?php $posts = posts_by_category(4, 3, 1); ?>
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-left pe-2">
                                                <div class="media">
                                                    <img class="img-fluid"
                                                         src="{{ $post->featured_image }}"
                                                         alt="{{ $post->headline }}">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="mb-0">{{ $post->headline }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(23) }}">আরও <i
                                        class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(24) }}">{{ category_name(24) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(20, 1); ?>
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="media">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            <?php unset($post); ?>
                        </div>
                        <div class="block__child">
                            <?php $posts = posts_by_category(4, 3, 1); ?>
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-left pe-2">
                                                <div class="media">
                                                    <img class="img-fluid"
                                                         src="{{ $post->featured_image }}"
                                                         alt="{{ $post->headline }}">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="mb-0">{{ $post->headline }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(24) }}">আরও <i
                                        class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(19) }}">{{ category_name(19) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(17, 1); ?>
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="media">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            <?php unset($post); ?>
                        </div>
                        <div class="block__child">
                            <?php $posts = posts_by_category(4, 3, 1); ?>
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-left pe-2">
                                                <div class="media">
                                                    <img class="img-fluid"
                                                         src="{{ $post->featured_image }}"
                                                         alt="{{ $post->headline }}">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="mb-0">{{ $post->headline }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(19) }}">আরও <i
                                        class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(18) }}">{{ category_name(18) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(19, 1); ?>
                            @if($post)
                                <div class="link-hover-homepage position-relative mb-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="media">
                                            <img src="{{ $post->featured_image }}" class="img-fluid"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                        <div class="caption">
                                            <h4 class="mb-0 p-2">{{ $post->headline }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            <?php unset($post); ?>
                        </div>
                        <div class="block__child">
                            <?php $posts = posts_by_category(4, 3, 1); ?>
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-left pe-2">
                                                <div class="media">
                                                    <img class="img-fluid"
                                                         src="{{ $post->featured_image }}"
                                                         alt="{{ $post->headline }}">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="mb-0">{{ $post->headline }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(18) }}">আরও <i
                                        class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="block-special home__photo d-none">
        <div class="container">
            <div class="category-heading">
                <a href="{{ route('photo.gallery') }}">ছবি</a>
            </div>
            <div class="photo__content">
                <div class="row"></div>
            </div>
            <div id="photo" class="photo__gallery__section">
                <div class="row">
                    <div class="col-md-6">
                        <div class="main__photo">
                            <div class="img__lead position-relative single__img">
                                <?php $photo = photo_query(1, 0, 'desc') ?>
                                @if(!empty($photo))
                                    <i class="bi bi-images position-absolute"></i>
                                    <a href="{{ $photo->featured_image }}" data-gallery="photoGallery1"
                                       class="portfolio-lightbox preview-link" title="{{ $photo->title }}">
                                        <div class="media">
                                            <img src="{{ $photo->featured_image }}" class="img-fluid "
                                                 alt="{{ $photo->title }}"/>
                                        </div>
                                    </a>
                                    <div class="portfolio-info">
                                        <div class="photo__title2">
                                            <a href="{{ $photo->featured_image }}" data-gallery="photoGallery1"
                                               class="portfolio-lightbox preview-link"
                                               title="{{ $photo->title }}">{{ $photo->title }}</a>
                                        </div>
                                        <?php $multiple_photos = multiple_photo($photo->id) ?>
                                        @foreach($multiple_photos as $multiple_photo)
                                            @if(!empty($multiple_photo->media))
                                                <a href="{{ $multiple_photo->media }}"
                                                   data-gallery="photoGallery1"
                                                   class="portfolio-lightbox preview-link"
                                                   title="{{ $multiple_photo->caption }}"></a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                <?php unset($photo) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="photo__item__4">
                            <div class="row">
                                <?php $photos = photo_query(4, 1, 'desc') ?>
                                @if(!empty($photos))
                                    @foreach($photos as $photo)
                                        <div class="col-md-6 col-6">
                                            <div class="photo__3rd1 item position-relative mb-3">
                                                <i class="bi bi-images position-absolute"></i>
                                                <a href="{{ $photo->featured_image }}"
                                                   data-gallery="photoGallery3"
                                                   class="portfolio-lightbox preview-link"
                                                   title="{{ $photo->title }}">
                                                    <div class="media">
                                                        <img src="{{$photo->featured_image}}"
                                                             class="img-fluid" alt="{{$photo->title}}">
                                                    </div>
                                                </a>
                                                <div class="portfolio-info">
                                                    <div class="photo__title2">
                                                        <a href="{{$photo->featured_image}}"
                                                           class="portfolio-lightbox preview-link"
                                                           title="{{$photo->title}}"><p
                                                                class="m-0">{{$photo->title}}</p></a>
                                                    </div>
                                                    <?php $multiple_photos = multiple_photo($photo->id) ?>
                                                    @foreach($multiple_photos as $multiple_photo)
                                                        @if(!empty($multiple_photo->media))
                                                            <a href="{{ $multiple_photo->media }}"
                                                               data-gallery="photoGallery3"
                                                               class="portfolio-lightbox preview-link"
                                                               title="{{ $multiple_photo->caption }}"></a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <?php unset($photos) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @php $NPopupCheck = checkNewsPopupStatus(34029,session()->getId()) @endphp
    @if(empty($NPopupCheck))
        <div class="menu-box d-none">
            <nav id="myNav">
                <div id="newsPopupDisBtn" data-leadId="34029">
                    <span class="close-icon">&times;</span>
                    <input type="hidden" name="session_id" id="session_id" value="{{ session()->getId() }}">
                </div>
                <ul class="main-menu">
                    @php $posts =  post_query(5) @endphp
                    @if(!empty($posts))
                        @foreach($posts as $postItem)
                            <div class="link-hover-homepage position-relative bg__fff mb">
                                <a href="{{ news_url($postItem->id) }}">
                                    <div class="media-left" style="width: 45%;">
                                        <img src="https://www.newsflash71.com/photos/meta-image-2024-02-04-08-03-55.jpg"
                                             alt="{{ $postItem->headline }}" class="{{ $postItem->featured_image }}">
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $postItem->headline }}</h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </ul>
            </nav>
        </div>
    @endif

    <!--modal-->
    <?php $popup = App\Models\Popup::where([['position', 'home'], ['status', 1]])->orderBy('id', 'desc')->first(); ?>
    @if(!empty($popup))
        <div class="modal homeModal" id="myModal">
            <div class="modal-dialog modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="btn-close" data-bs-dismiss="modal"></span>
                    </div>
                    <div class="modal-body">
                        <a href="{{$popup->link}}"><img style="width:100%;"
                                                        src="{{ asset('/img/popup/'.$popup->image)}}"></a>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#myModal").modal('show');
            });
        </script>
    @endif
    <!--Modal End-->
@endsection


@section('extra_js')


    <script src="{{ asset('/assets/js/index.js') }}"></script>
    <script>
        $(document).ready(function () {
            //ajax district
            $('#division_list').on('change', function (e) {
                var division_id = e.target.value;

                $("#district_list").empty();
                $("#district_list").append('<option selected  value="">জেলা</option>');
                $("#upazila_list").empty();
                $("#upazila_list").append('<option selected  value="">উপজেলা</option>');

                if (division_id) {
                    $.ajax({
                        url: "{{ route('division.district.news') }}/" + division_id,
                        type: "get",
                        dataType: "json",

                        success: function (data) {
                            $("#district_list").empty();
                            $("#district_list").append('<option selected  value="">জেলা</option>');
                            $.each(data, function (key, value) {
                                $('#district_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                            })
                        }
                    })
                } else {
                    $("#district_list").empty();
                    $("#district_list").append('<option selected  value="">জেলা</option>');
                    $("#upazila_list").empty();
                    $("#upazila_list").append('<option selected  value="">উপজেলা</option>');
                }
            });

            //ajax upazila
            $('#district_list').on('change', function (e) {
                var district_id = e.target.value;

                $("#upazila_list").append('<option selected  value="">উপজেলা</option>');

                if (district_id) {
                    $.ajax({
                        url: "{{ route('district.upazila.news') }}/" + district_id,
                        type: "get",
                        dataType: "json",

                        success: function (data) {
                            // alert('ok');
                            $("#upazila_list").empty();
                            $("#upazila_list").append('<option selected  value="">উপজেলা</option>');
                            $.each(data, function (key, value) {
                                $('#upazila_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                            })
                        }
                    })
                } else {
                    $("#upazila_list").empty();
                    $("#upazila_list").append('<option selected  value="">উপজেলা</option>');
                }
            });
        });

        window.onload = function () {
            $.ajax({
                url: "{{ route('latestNews') }}",
                method: "GET",
                success: function (res) {
                    $('.latestNews').html(res);
                }
            });

            $.ajax({
                url: "{{ route('popularNews') }}",
                method: "GET",
                success: function (res) {
                    $('.popularNews').html(res);
                }
            });

            $.ajax({
                url: "{{ route('homeCategory2') }}",
                method: "GET",
                success: function (res) {
                    $('.homeCategory2').html(res);
                }
            });


            $.ajax({
                url: "{{ route('homeCategory4_3') }}",
                method: "GET",
                success: function (res) {
                    $('.homeCategory4_3').html(res);
                }
            });

            $.ajax({
                url: "{{ route('homeCategory3_3') }}",
                method: "GET",
                success: function (res) {
                    $('.homeCategory3_3').html(res);
                }
            });

            $.ajax({
                url: "{{ route('homePageExcludive') }}",
                method: "GET",
                success: function (res) {
                    $('.homePageExcludive').html(res);
                }
            });

            $.ajax({
                url: "{{ route('homePageCategory32') }}",
                method: "GET",
                success: function (res) {
                    $('.homePageCategory32').html(res);
                }
            });

            $.ajax({
                url: "{{ route('homePageCat1') }}",
                method: "GET",
                success: function (res) {
                    $('.homePageCat1').html(res);
                }
            });

            $.ajax({
                url: "{{ route('homePageCat3') }}",
                method: "GET",
                success: function (res) {
                    $('.render-results').html(res);
                }
            });
            $.ajax({
                url: "{{ route('homeCategory6_3') }}",
                method: "GET",
                success: function (res) {
                    $('.homeCategory6_3').html(res);
                }
            });
            $.ajax({
                url: "{{ route('homeCategory5_3') }}",
                method: "GET",
                success: function (res) {
                    $('.homeCategory5_3').html(res);
                }
            });
            $.ajax({
                url: "{{ route('homeCategory54_3') }}",
                method: "GET",
                success: function (res) {
                    $('.homeCategory54_3').html(res);
                }
            });
            $.ajax({
                url: "{{ route('homeVideo4') }}",
                method: "GET",
                success: function (res) {
                    $('.homeVideo4').html(res);
                }
            });
            $.ajax({
                url: "{{ route('homeCategory7_3') }}",
                method: "GET",
                success: function (res) {
                    $('.homeCategory7_3').html(res);
                }
            });
            $.ajax({
                url: "{{ route('homeCategory58_3') }}",
                method: "GET",
                success: function (res) {
                    $('.homeCategory58_3').html(res);
                }
            });
            $.ajax({
                url: "{{ route('homeCategory11_3') }}",
                method: "GET",
                success: function (res) {
                    $('.homeCategory11_3').html(res);
                }
            });

            $.ajax({
                url: "{{ route('homeCategory18_3') }}",
                method: "GET",
                success: function (res) {
                    $('.homeCategory18_3').html(res);
                }
            });
        };
    </script>
    <script>
        window.onload = function () {
            setTimeout(function () {
                $(".menu-box").show();
            }, 1000);
        }
        $('#newsPopupDisBtn').on('click', function (e) {
            e.preventDefault();
            let post_id = $(this).attr('data-leadId');
            let session_id = $("#session_id").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('newsPopupStatus') }}",
                data: {'post_id': post_id, 'session_id': session_id},
                success: function (data) {
                    console.log(data.success)
                    $("#myNav").hide();
                }
            });
        })
    </script>
@endsection

