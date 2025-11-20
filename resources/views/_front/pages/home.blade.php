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
                    <div class="left__block d-none d-lg-block d-xl-block d-xxl-block">
                        <?php $posts = sticky_posts_by_position(6, 6); ?>
                        @if($posts)
                            @foreach($posts as $post)
                                <div class="link-hover-homepage border__btm mb-3 pb-3">
                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <div class="media-body">
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
                                    {{--                                    <div class="intro">--}}
                                    {{--                                        <p class="d-none mb-0 mt-3"--}}
                                    {{--                                           style="display: inline-block !important;">{{ Str::limit($post->excerpt, 110) }}--}}
                                    {{--                                        </p>--}}
                                    {{--                                    </div>--}}
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
                            <?php $posts = sticky_posts_by_position(3, 3); ?>
                            @if($posts)
                                <div class="row">
                                    @foreach($posts as $post)
                                        <div class="col-md-4 border__right__2 col-6">
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
                        <div class="ads ads_6 ads__mbl mb-3" align="center">
                            <?php $ad = ad_by_position(1); ?>
                            @if(!empty($ad))
                                @if(!empty($ad->url))
                                    <a href="{{$ad->url}}" target="_blank">
                                        <img src="{{ $ad->photo }}"/>
                                    </a>
                                @else
                                    <img src="{{ $ad->photo }}"/>
                                @endif
                            @endif
                            <?php unset($ad) ?>
                        </div>
                        {{--                        <div class="ads ads_6 ads__mbl mb-3" align="center">--}}
                        {{--                            <?php $ad = ad_by_position(2); ?>--}}
                        {{--                            @if(!empty($ad))--}}
                        {{--                                @if(!empty($ad->url))--}}
                        {{--                                    <a href="{{$ad->url}}" target="_blank">--}}
                        {{--                                        <img src="{{ $ad->photo }}"/>--}}
                        {{--                                    </a>--}}
                        {{--                                @else--}}
                        {{--                                    <img src="{{ $ad->photo }}"/>--}}
                        {{--                                @endif--}}
                        {{--                            @endif--}}
                        {{--                            <?php unset($ad) ?>--}}
                        {{--                        </div>--}}

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
    <div class="ads__section py-3">
        <div class="container">
            <div class="matter__banner">
                <?php $ad = ad_by_position(3); ?>
                @if(!empty($ad))
                    @if(!empty($ad->url))
                        <a href="{{$ad->url}}" target="_blank">
                            <img src="{{ $ad->photo }}"/>
                        </a>
                    @else
                        <img src="{{ $ad->photo }}"/>
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
                    <div class="border__cat__top mb-2"></div>
                    <div class="category-heading position-relative">
                        <a href="{{ category_url(4) }}">{{ category_name(4) }}</a>
                    </div>
                    <div class="block__lead">
                        <div class="lead__1__2 border__btm__2">
                            <div class="row">
                                <div class="col-md-8 border__right__2">
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
                                            <div class="row">
                                                @foreach($posts as $post)
                                                    <div class="col-lg-12 col-6">
                                                        <div class="link-hover-homepage mb-2">
                                                            <a href="{{ news_url($post->id) }}">
                                                                <div class="position-relative media mt-0">
                                                                    <img class="media-object img-fluid"
                                                                         src="{{ $post->featured_image }}"
                                                                         alt="{{ $post->headline }}">
                                                                    <div class="caption__t2">
                                                                        <h4 class="child__title pt-2">{{ $post->headline }}</h4>
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
                        </div>
                        <div class="row">
                            <div class="overlay_block_2 d-flex mb__mbl mt-3">
                                <?php $posts = posts_by_category(4, 4, 3); ?>
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
                    <div class="border__cat__top mb-2"></div>
                    <div class="category-bg-2 mb__block">
                        <div class="category-heading">
                            <a href="{{ category_url(15) }}">{{ category_name(15) }}</a>
                        </div>
                        <div class="block__child mb__mbl">
                            <div class="col_4_left_img_block">
                                <?php $posts = posts_by_category(15, 6); ?>
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
    <section class="full__row row__3 sec__4">
        <div class="container">
            <div class="border__cat__top mb-2"></div>
            <div class="category-heading position-relative">
                <a href="{{ category_url(1) }}">{{ category_name(1) }}</a>
            </div>
            <div class="block__lead">
                <div class="row">
                    <div class="col-md-5 border__right__2">
                        <?php $post = posts_by_category(1, 1); ?>
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
                                <p class="mb-2 px-1">{{ Str::limit($post->excerpt, 150) }}</p>
                            </div>
                        @endif
                        <?php unset($post); ?>
                    </div>
                    <div class="col-md-7">
                        <div class="child__top">
                            <div class="right">
                                <?php $posts = posts_by_category(1, 2, 1); ?>
                                @if($posts)
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="col-lg-6 col-6 border__right">
                                                <div class="link-hover-homepage mb-2">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="position-relative media">
                                                            <img class="media-object img-fluid"
                                                                 src="{{ $post->featured_image }}"
                                                                 alt="{{ $post->headline }}">
                                                            <div class="caption__t3">
                                                                <h4 class="child__title pt-3 mb-0">{{ $post->headline }}</h4>
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
                        <hr style="background-color: #05483482; opacity: 1;">
                        <div class="child__bottom">
                            <div class="right">
                                <?php $posts = posts_by_category(1, 2, 3); ?>
                                @if($posts)
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="col-lg-6 col-6 border__right">
                                                <div class="link-hover-homepage mb-2">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="position-relative media">
                                                            <img class="media-object img-fluid"
                                                                 src="{{ $post->featured_image }}"
                                                                 alt="{{ $post->headline }}">
                                                            <div class="caption__t3">
                                                                <h4 class="child__title pt-3 mb-0">{{ $post->headline }}</h4>
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
                </div>
            </div>
        </div>
    </section>
    <section class="full__row__excludive mb__mbl">
        <div class="container">
            <div class="border__cat__top mb-2"></div>
            <div class="panel-small-block-2">
                <div class="row">
                    <div class="col-md-9">
                        <div class="category-heading">
                            <a href="{{ category_url(2) }}">{{ category_name(2) }}</a>
                            {{--                            <div class="cat__bar__hm__all"></div>--}}
                        </div>
                        <div class="block__body">
                            <div class="homePageExclusive">
                                <?php $posts = posts_by_category(2, 6); ?>
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
                                                            <h4 class="mb-0">{{ $post->headline }}</h4>
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
                        <div class="ads__banner text-center d-none">
                            <?php $ad = ad_by_position(4); ?>
                            @if(!empty($ad))
                                @if(!empty($ad->url))
                                    <a href="{{$ad->url}}" target="_blank">
                                        <img src="{{ $ad->photo }}"/>
                                    </a>
                                @else
                                    <img src="{{ $ad->photo }}"/>
                                @endif
                            @endif
                            <?php unset($ad) ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="matter__square text-center mb-3 d-none">
                            <?php $ad = ad_by_position(5); ?>
                            @if(!empty($ad))
                                @if(!empty($ad->url))
                                    <a href="{{$ad->url}}" target="_blank">
                                        <img src="{{ $ad->photo }}"/>
                                    </a>
                                @else
                                    <img src="{{ $ad->photo }}"/>
                                @endif
                            @endif
                            <?php unset($ad) ?>
                        </div>
                        <div class="namaj-time" style="margin-top: 3.6rem;">
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
                        <div class="border__cat__top mb-2"></div>
                        <div class="category-heading">
                            <a href="{{ category_url(7) }}">{{ category_name(7) }}
                            </a>
                        </div>
                        <div class="block__main">
                            <div class="row">
                                <div class="col-md-12 border__right">
                                    <?php $post = posts_by_category(7, 1); ?>
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
                            <?php $posts = posts_by_category(7, 3, 1); ?>
                            @if($posts)
                                <div class="row d-flex justify-content-center">
                                    @foreach($posts as $post)
                                        <div class="col-md-4 col-12">
                                            <div class="link-hover-homepage mb-3">
                                                <a href="{{ news_url($post->id) }}">
                                                    <div class="box__shadow">
                                                        <div class="media">
                                                            <img
                                                                src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                                data-src="{{ $post->featured_image }}"
                                                                class="img-fluid lazy w-100"
                                                                alt="{{ $post->headline }}"/>
                                                        </div>
                                                        <div class="title__box p-2 p-lg-4">
                                                            <h4>{{ $post->headline }}</h4>
                                                            <p class="mb-0 mt-2 d-none d-md-block d-lg-block d-xl-block d-xxl-block">{{ Str::limit($post->excerpt, 90) }}</p>
                                                            <span class="cat__name d-none d-md-block d-lg-block d-xl-block d-xxl-block">{{ category_name(7) }}</span>
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
                        <div class="border__cat__top mb-2"></div>
                        <div class="category-heading">
                            <a href="{{ category_url(20) }}" class="v-text">{{ category_name(20) }}</a>
                        </div>
                        <div class="cat__block__main">
                            <?php $posts = posts_by_category(20, 5); ?>
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
                        <div class="matter__square text-center">
                            <?php $ad = ad_by_position(6); ?>
                            @if(!empty($ad))
                                @if(!empty($ad->url))
                                    <a href="{{$ad->url}}" target="_blank">
                                        <img src="{{ $ad->photo }}"/>
                                    </a>
                                @else
                                    <img src="{{ $ad->photo }}"/>
                                @endif
                            @endif
                            <?php unset($ad) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="full__row__9 sec__6">
        <div class="container">
            <div class="border__cat__top mb-2"></div>
            <div class="category-heading">
                <a href="{{ category_url(6) }}">{{ category_name(6) }}</a>
            </div>
            <div class="block__main">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1 border__right__2">
                        <div class="ads__section mb-3">
                            <div class="matter__square text-center">
                                <?php $ad = ad_by_position(7); ?>
                                @if(!empty($ad))
                                    @if(!empty($ad->url))
                                        <a href="{{$ad->url}}" target="_blank">
                                            <img src="{{ $ad->photo }}"/>
                                        </a>
                                    @else
                                        <img src="{{ $ad->photo }}"/>
                                    @endif
                                @endif
                                <?php unset($ad) ?>
                            </div>
                        </div>
                        <div class="cat__block__main">
                            <?php $posts = posts_by_category(6, 3, 6); ?>
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3 border__btm">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-left" style="width: 40%;">
                                                <img class="media-object"
                                                     src="{{ $post->featured_image }}"
                                                     alt="{{ $post->headline }}">
                                            </div>
                                            <div class="media-body ps-1">
                                                <h4 class="lead__title">{!! $post->headline !!}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                        </div>
                    </div>
                    <div class="border__right__2 col-lg-6 order-1 order-lg-2">
                        <div class="panel-small-block-2">
                            <div class="block__main">
                                <div class="row">
                                    <div class="col-md-12 border__right">
                                        <?php $post = posts_by_category(6, 1); ?>
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
                                                            <h3>{{ Str::limit($post->headline, 70) }}</h3>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                        <?php unset($post); ?>
                                    </div>
                                </div>
                            </div>
                            <hr style="background-color: #05483482; opacity: 1;">
                            <div class="block__child mb__mbl">
                                <?php $posts = posts_by_category(6, 2, 1); ?>
                                @if($posts)
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="col-md-6 col-6 border__right">
                                                <div class="link-hover-homepage mb-3">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="media">
                                                            <img
                                                                src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                                data-src="{{ $post->featured_image }}"
                                                                class="img-fluid lazy w-100"
                                                                alt="{{ $post->headline }}"/>
                                                        </div>
                                                        <div class="title__box py-2">
                                                            <h4>{{ $post->headline }}</h4>
                                                            <p class="d-none mb-0 mt-2">{{ Str::limit($post->excerpt, 90) }}</p>
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
                    <div class="col-lg-3 order-3 order-lg-3">
                        <div class="ads__section mb-3">
                            <div class="matter__square text-center">
                                <?php $ad = ad_by_position(8); ?>
                                @if(!empty($ad))
                                    @if(!empty($ad->url))
                                        <a href="{{$ad->url}}" target="_blank">
                                            <img src="{{ $ad->photo }}"/>
                                        </a>
                                    @else
                                        <img src="{{ $ad->photo }}"/>
                                    @endif
                                @endif
                                <?php unset($ad) ?>
                            </div>
                        </div>
                        <div class="cat__block__main">
                            <?php $posts = posts_by_category(6, 3, 3); ?>
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="link-hover-homepage mb-3 border__btm">
                                        <a href="{{ news_url($post->id) }}">
                                            <div class="media-body pe-1">
                                                <h4 class="lead__title">{!! $post->headline !!}</h4>
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
                </div>
            </div>
        </div>
    </section>
    <section class="district__block container">
        <div class="container1">
            <div class="category-heading">
                <a style="font-size: 23px;padding-right: 10px;">আমার এলাকার খবর</a>
            </div>
            <form action="{{ route('search_all_bd_news') }}" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group my-2">
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
                        <div class="form-group my-2">
                            <select class="form-control form-select" aria-label="Default select example"
                                    id="district_list"
                                    name="district_id">
                                <option selected="" value="">জেলা</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group my-2">
                            <select class="form-control form-select" aria-label="Default select example"
                                    id="upazila_list"
                                    name="upazila_id">
                                <option selected="" value="">উপজেলা</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-grid gap-2 btn__n__search my-2">
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
                            <div class="border__cat__top mb-2"></div>
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
                            <hr style=" margin-top: 14px;margin-bottom: 14px;background-color: #05483482; opacity: 1"/>
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
                        <div class="ads__section mb-3 d-none">
                            <div class="matter__square">
                                <?php $ad = ad_by_position(9); ?>
                                @if(!empty($ad))
                                    @if(!empty($ad->url))
                                        <a href="{{$ad->url}}" target="_blank">
                                            <img src="{{ $ad->photo }}"/>
                                        </a>
                                    @else
                                        <img src="{{ $ad->photo }}"/>
                                    @endif
                                @endif
                                <?php unset($ad) ?>
                            </div>
                        </div>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="full__row__3">
        <div class="container">
            <div class="border__cat__top mb-2"></div>
            <div class="category-heading">
                <a href="{{ category_url(21) }}">{{ category_name(21) }}</a>
            </div>
            <div class="overlay_block_6">
                <?php $post = posts_by_category(21, 4); ?>
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
                <div class="border__cat__top mb-2"></div>
                <div class="category-heading">
                    <a href="{{ category_url(10) }}">{{ category_name(10) }}</a>
                </div>
                <div class="block__main text-center">
                    <?php $posts = posts_by_category(10, 6); ?>
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
    <section class="block-special home__video bg-dark position-relative">
        <div class="container">
            <div class="border__cat__top mb-2"></div>
            <div class="video-block-main position-relative">
                <div class="category-heading">
                    <a href="{{ route('video.gallery') }}" class="text-white">ভিডিও</a>
                </div>
                <div class="block-top-2 video__content pb-5 position-relative" style="z-index: 2">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="video-top-content pb-3">
                                <?php $video = video_query(1); ?>
                                @if($video)
                                    <a href="{{ video_url($video->uniqid) }}">
                                        <div class="media position-relative">
                                            <i class="bi bi-play-fill"></i>
                                            <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}"
                                                 class="img-responsive">
                                        </div>

                                        <div class="video__cap">
                                            <h2 class="text-bold-500 py-3 mb-4">{{ $video->title }} </h2>
                                        </div>
                                    </a>
                                @endif
                                <?php unset($video); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="video-list-2">
                                <?php $videos = video_query(5, 1); ?> 
                                @if(!empty($videos))
                                    @foreach($videos as $video)
                                        <div class="item mb-3">
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
        <div class="brand__icon">
            <img src="/img/icon.png" class="img-fluid"/>
        </div>
    </section>
    <div class="ads__section py-5">
        <div class="container">
            <div class="matter__banner">
                <?php $ad = ad_by_position(10); ?>
                @if(!empty($ad))
                    @if(!empty($ad->url))
                        <a href="{{$ad->url}}" target="_blank">
                            <img src="{{ $ad->photo }}"/>
                        </a>
                    @else
                        <img src="{{ $ad->photo }}"/>
                    @endif
                @endif
                <?php unset($ad) ?>
            </div>
        </div>
    </div>
    <section class="block__row__4 sec__5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="category-heading text-center mt-2">
                        <a href="{{ category_url(27) }}">{{ category_name(27) }}</a>
                    </div>
                    <div class="block__lead">
                        <div class="row">
                            <?php $post = posts_by_category(27, 1); ?>
                            @if($post)
                                <div class="col-md-6 border__right__2">
                                    <div class="cat-lead-single">
                                        <div class="link-hover-homepage">
                                            <div class="media">
                                                <a href="{{ news_url($post->id) }}"><img
                                                        src="{{ $post->featured_image }}"
                                                        alt="{{ $post->headline }}"
                                                        class="img-responsive"></a>
                                            </div>
                                            <div class="business__block__content">
                                                <a href="{{ news_url($post->id) }}"><h4>
                                                        <b>
                                                            @if(!empty($post->sub_headline))
                                                                <span
                                                                    class="sub__heading">{!! $post->sub_headline !!}</span>
                                                                /
                                                            @endif
                                                            {!! words($post->headline, 10,'')  !!}</b></h4></a>
                                                <p>{!! words($post->excerpt, 50,'')  !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cat__block__main">
                                        <?php $posts = posts_by_category(27, 4, 1); ?>
                                        @if($posts)
                                            @foreach($posts as $post)
                                                <div class="link-hover-homepage mb-3 border__btm">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="media-body pe-2">
                                                            <h4 class="lead__title">{!! $post->headline !!}</h4>
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
                            @endif
                            <?php unset($post); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 block__2">
                    <div class="category-heading text-center mt-2">
                        <a href="{{ category_url(28) }}">{{ category_name(28) }}</a>
                    </div>
                    <div class="block__lead">
                        <div class="row">
                            <?php $post = posts_by_category(28, 1); ?>
                            @if($post)
                                <div class="col-md-6 border__right__2">
                                    <div class="cat-lead-single">
                                        <div class="link-hover-homepage">
                                            <div class="media">
                                                <a href="{{ news_url($post->id) }}"><img
                                                        src="{{ $post->featured_image }}"
                                                        alt="{{ $post->headline }}"
                                                        class="img-responsive"></a>
                                            </div>
                                            <div class="business__block__content">
                                                <a href="{{ news_url($post->id) }}"><h4>
                                                        <b>
                                                            @if(!empty($post->sub_headline))
                                                                <span
                                                                    class="sub__heading">{!! $post->sub_headline !!}</span>
                                                                /
                                                            @endif
                                                            {!! words($post->headline, 10,'')  !!}</b></h4></a>
                                                <p>{!! words($post->excerpt, 20,'')  !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cat__block__main">
                                        <?php $posts = posts_by_category(28, 4, 1); ?>
                                        @if($posts)
                                            @foreach($posts as $post)
                                                <div class="link-hover-homepage mb-3 border__btm">
                                                    <a href="{{ news_url($post->id) }}">
                                                        <div class="media-body pe-2">
                                                            <h4 class="lead__title">{!! $post->headline !!}</h4>
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
                            @endif
                            <?php unset($post); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="block__row__4">
        <div class="container">
            <div class="css__boder__bottom">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel-small-block-2">
                            <div class="border__cat__top mb-2"></div>
                            <div class="category-heading">
                                <a href="{{ category_url(23) }}">{{ category_name(23) }}</a>
                            </div>
                            <div class="css_bar"></div>
                            <div class="block__lead">
                                <div class="row">
                                    <?php $post = posts_by_category(23, 1); ?>
                                    @if($post)
                                        <div class="col-md-7">
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
                                        <div class="col-md-5">
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
                            <hr style=" margin-top: 14px;margin-bottom: 14px;background-color: #05483482; opacity: 1"/>
                            <div class="overlay_block_2 d-flex mb__mbl">
                                <?php $posts = posts_by_category(23, 3, 1); ?>
                                @if($posts)
                                    <div class="row">
                                        @foreach($posts as $post)
                                            <div class="border__right col-md-4 col-6 col-sm-6">
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
                    <div class="col-md-4 mb__mbl">
                        <div class="panel-small-block-2">
                            <div class="border__cat__top mb-2"></div>
                            <div class="category-heading">
                                <a href="{{ category_url(18) }}" class="v-text">{{ category_name(18) }}</a>
                            </div>
                            <div class="cat__block__main">
                                <?php $posts = posts_by_category(18, 4); ?>
                                @if($posts)
                                    @foreach($posts as $post)
                                        <div class="link-hover-homepage mb-3 border__btm">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="last__row__2">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="border__cat__top mb-2"></div>
                        <div class="category-heading">
                            <a href="{{ category_url(8) }}">{{ category_name(8) }}</a>
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
                            <?php $posts = posts_by_category(8, 3, 1); ?>
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
                                                <h4 class="mb-0">{{ Str::limit($post->headline, 45) }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(8) }}">আরও
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="border__cat__top mb-2"></div>
                        <div class="category-heading">
                            <a href="{{ category_url(17) }}">{{ category_name(17) }}</a>
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
                            <?php $posts = posts_by_category(17, 3, 1); ?>
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
                                                <h4 class="mb-0">{{ Str::limit($post->headline, 45) }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(17) }}">আরও
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="border__cat__top mb-2"></div>
                        <div class="category-heading">
                            <a href="{{ category_url(12) }}">{{ category_name(12) }}</a>
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
                            <?php $posts = posts_by_category(12, 3, 1); ?>
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
                                                <h4 class="mb-0">{{ Str::limit($post->headline, 45) }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(12) }}">আরও
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="border__cat__top mb-2"></div>
                        <div class="category-heading">
                            <a href="{{ category_url(16) }}">{{ category_name(16) }}</a>
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
                            <?php $posts = posts_by_category(16, 3, 1); ?>
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
                                                <h4 class="mb-0">{{ Str::limit($post->headline, 45) }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(16) }}">আরও
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="last__row__2">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="border__cat__top mb-2"></div>
                        <div class="category-heading">
                            <a href="{{ category_url(5) }}">{{ category_name(5) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(5, 1); ?>
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
                            <?php $posts = posts_by_category(5, 3, 1); ?>
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
                                                <h4 class="mb-0">{{ Str::limit($post->headline, 45) }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(5) }}">আরও
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="border__cat__top mb-2"></div>
                        <div class="category-heading">
                            <a href="{{ category_url(29) }}">{{ category_name(29) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(29, 1); ?>
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
                            <?php $posts = posts_by_category(29, 3, 1); ?>
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
                                                <h4 class="mb-0">{{ Str::limit($post->headline, 45) }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(29) }}">আরও
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="border__cat__top mb-2"></div>
                        <div class="category-heading">
                            <a href="{{ category_url(26) }}">{{ category_name(26) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(26, 1); ?>
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
                            <?php $posts = posts_by_category(26, 3, 1); ?>
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
                                                <h4 class="mb-0">{{ Str::limit($post->headline, 45) }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(26) }}">আরও
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-bg-2 mb__block">
                        <div class="border__cat__top mb-2"></div>
                        <div class="category-heading">
                            <a href="{{ category_url(24) }}">{{ category_name(24) }}</a>
                        </div>
                        <div class="item__lead">
                            <?php $post = posts_by_category(24, 1); ?>
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
                            <?php $posts = posts_by_category(24, 3, 1); ?>
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
                                                <h4 class="mb-0">{{ Str::limit($post->headline, 45) }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <?php unset($posts, $post); ?>
                            <div class="more__btn text-center">
                                <a href="{{ category_url(24) }}">আরও
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
