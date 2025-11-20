@extends('layouts.frontend')
@section('meta_info')
    @php
        $settings = setting();
        $postIdFNP = $post->id;
    @endphp
    <title>{{ $post->headline }}</title>
    <meta name="keywords" content="@foreach($post->Tag as $tag){{$tag->name}}, @endforeach"/>
    <meta name="description" content="{{$post->excerpt}}"/>
    <meta itemscope itemtype="{{ news_url($post->id) }}"/>
    <meta property="og:title" content="{{ $post->headline }} | {{ $settings->site }}"/>
    <meta property="og:description" content="{{$post->excerpt}}">
    <meta property="og:image"
          content="{{ !empty($post->sm_image)?asset('/fb_share/'.$post->sm_image):$post->featured_image }}">
    <meta property="og:image:width" content="640"/>
    <meta property="og:image:height" content="360"/>
    <meta property="og:url" content="{{ news_url($post->id) }}">
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:alt" content="{{$post->headline}}">
    <meta property="og:type" content="website">
    <meta name="twitter:url" content="{{ news_url($post->id) }}"/>
    <meta name="twitter:title" content="{{ $post->headline }} | {{ $settings->site }}"/>
    <meta name="twitter:description" content="{{$post->excerpt}}"/>
    <meta name="twitter:image"
          content="{{ !empty($post->sm_image)?asset('/fb_share/'.$post->sm_image):$post->featured_image }}"/>
    <meta property="ia:markup_url" content="{{ news_url($post->id) }}"/>
    <meta property="ia:markup_url_dev" content="{{ news_url($post->id) }}"/>
    <meta property="ia:rules_url" content="{{ news_url($post->id) }}"/>
    <meta property="ia:rules_url_dev" content="{{ news_url($post->id) }}"/>
    <link rel="canonical" href="{{ news_url($post->id) }}"/>

@endsection
@section('extra_css')
    <style>
        /* Preloader full screen */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffffd9;
            z-index: 999999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Loader animation */
        .loader {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #347fcdd9;
            border-radius: 50%;
            width: 26px;
            height: 26px;
            animation: spin 1s linear infinite;
        }

        /* Spinner animation keyframes */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
@endsection

@section('main_content')
    <!-- Preloader -->
    {{--<div id="preloader">--}}
    {{--    <div class="loader"></div>--}}
    {{--</div>--}}

    <div id="single-post-container">

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
                    <?php $ad = ad_by_position(11); ?>
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

        <section class="single_page">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-md-6 mb-3">
                        <div class="single__page__heading">
                            <a href="{{ category_url($category->id) }}">{{ $category->name }} sss</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="follow__btn d-flex d-none d-sm-none d-md-block d-lg-block">
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
                    </div>
                </div>
                <hr>
                <div class="main__content">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="content">
                                <div class="heading__top mb-4">
                                    <div class="sub-headline PSubTitle pb-1">
                                        <h5>{!! $post->sub_headline !!}</h5>
                                    </div>
                                    <div class="single-page-headline PTitle pb-4">
                                        <h1><b>{!! $post->headline !!}</b></h1>
                                    </div>
                                    <div class="reporter__block mb-0">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="publisher__info PPublisTime">
                                        <span class="publisher__name PrintPublisTime d-block position-relative">
{{--                                        <b>{{ $post->publisher_name }}</b>--}}
                                            @if(!empty($post->reporter_id))
                                                {{--                                            <a href="{{ route('reporter.post',['id'=>$post->reporter->id]) }}"><b>{{ $post->reporter->name }}</b></a>--}}
                                                {{ $post->reporter->name }}
                                            @endif
                                    </span>
                                                    <span> প্রকাশিত:
                                            {{engMonth_to_banMonth_replace(ampa_replace(e_to_b_replace(Carbon\Carbon::parse($post->created_at)->format('d F Y H:m a'))))}}
                                            <br>
                                            @if($post->last_update_by != null)
                                                            আপডেট: {{engMonth_to_banMonth_replace(e_to_b_replace(Carbon\Carbon::parse($post->last_update_at)->format('d F Y')))}} <?php echo ampa_replace(e_to_b_replace(date("g:i a", strtotime($post->last_update_at)))); ?> @endif
                                        </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-end float-right">
                                                <div class="share-btn mt-4">

                                                    <!-- ShareThis BEGIN -->
                                                    <div class="sharethis-inline-share-buttons" data-title="{!! $post->headline !!}" data-url="{{ news_url($post->id) }}"></div>
                                                    <!-- ShareThis END -->
                                                    {{--                                                    <div class="print-btn ms-2">--}}
                                                    {{--                                                        <button id="printFunc" class="printBtn333">--}}
                                                    {{--                                                            <i class="bi bi-printer"></i>--}}
                                                    {{--                                                        </button>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="content_body">
                                    @if( Str::of($post->video_url)->trim()->isEmpty())
                                        <img src="{{ $post->featured_image }}" class="img-fluid w-100 PImg"
                                             alt="{{ $post->featured_image_caption }}">
                                    @else
                                        <div class="video">
                                            <div class="panel-body">
                                                {!! postVideoStream($post->video_from,$post->video_id) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(!empty($post->podcast))
                                        <div class="podcast mt-3">
                                            <span>পডকাস্ট:</span>
                                            <audio controls autoplay>
                                                <source src="horse.ogg" type="audio/ogg">
                                                <source src="{{ asset('/podcast/'.$post->podcast) }}"
                                                        type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    @endif
                                </div>
                                <div class="content_text mt-3">
                                    <div id="postContent" class="PContent singleContent360">
                                        <p><b>{!! $post->excerpt !!}</b></p>
                                        {!! $post->post_content !!}
                                    </div>
                                    <div class="tag mb-4">
                                        <p>
                                            @if(!empty($post->user_id))
                                                <b>{{ $post->user->short_name }}</b>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="tag mb-4">
                                        <p>
                                            @foreach($post->Tag as $tag)
                                                <a href="{{ tag_url($tag->name) }}">{{ $tag->name }}</a>
                                            @endforeach
                                        </p>
                                    </div>

                                    <div class="comment mt-5">
                                        <p class="mb-0"><b>আপনার মূল্যবান মতামত দিন:</b></p>
                                        <div class="cmnt__bar d-none"></div>
                                        <div id="fb-root"></div>
                                        <script async defer crossorigin="anonymous"
                                                src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v8.0&appId=348966578805818&autoLogAppEvents=1"></script>
                                        <div class="fb-comments" data-href="{{ url()->current() }}"
                                             data-numposts="10"
                                             data-width=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sidebar">
                                <div class="fb__page d-block d-md-none d-lg-none text-center mb-3">
                                    <div class="fb-page" data-href="{{ $settings->facebook }}" data-tabs=""
                                         data-width="" data-height="" data-small-header="false"
                                         data-adapt-container-width="true"
                                         data-hide-cover="false" data-show-facepile="true"></div>
                                </div>
                                <div class="block__ads sqr text-center ads__mbl mb-3">
                                    <div class="title">
                                        <span>বিজ্ঞাপন</span>
                                    </div>
                                    <div class="matter__square">
                                        <?php $ad = ad_by_position(13); ?>
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
                                <div class="popular__home mb-3">
                                    <div class="popularNews__hm">
                                        <div class="heading w-100">
                                            <h4 class="mb-0">জনপ্রিয়</h4>
                                        </div>
                                        <div class="list-content">
                                            <div class=" me-2">
                                                @include('_front._render.popularNews')
                                            </div>
                                        </div>
                                    </div>


                                </div>
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

                                <div class="popular__home mb-3 d-none">
                                    <div class="popularNews__hm">
                                        <div class="heading w-100">
                                            <h4 class="mb-0">Latest</h4>
                                        </div>
                                        <div class="list-content">
                                            <div class="latestNews me-2">
                                                @include('_front._render.latestNews')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="follow__btn__mbl d-block d-md-none d-lg-none text-center my-4">
                                    <span class="d-block mb-3">- আমাদের ফলো করুন -</span>
                                    <a href="{{ $settings->facebook }}" class="facebook" target="_blank"
                                       style="background: #226ed3;"><i
                                            class="bx bxl-facebook"></i></a>
                                    <a href="{{ $settings->twitter }}" class="twitter" target="_blank"
                                       style="background: #1d9bf0"><i
                                            class="bx bxl-twitter"></i></a>
                                    <a href="{{ $settings->youtube }}" class="youtube" target="_blank"
                                       style="background: #ff0000"><i
                                            class="bx bxl-youtube"></i></a>
                                    <a href="#" class="instagram social__icon" target="_blank"
                                       style="background: #c038be"><i
                                            class="bx bxl-instagram"></i></a>
                                    <a href="#" class="linkedin social__icon d-none"
                                       style="background: #0077b5; padding: 0;"><i
                                            class="bx bxl-linkedin social__icon" target="_blank"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 m-auto">
                        <div class="single_page more_news pt-5 pb-1">
                            <h4 class="heading"><b>সম্পর্কিত খবর</b></h4>
                            <div class="cmnt__bar"></div>
                            <div class="singlePageRelPost2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--modal-->
        @php $popup = App\Models\Popup::where([['position', 'single'], ['status', 1]])->orderBy('id', 'desc')->first(); @endphp
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

        @php $NPopupCheck = checkNewsPopupStatus($postIdFNP,session()->getId()) @endphp
        @if(empty($NPopupCheck))
            @php $posts =  posts_by_category($category->id,5,9) @endphp
            @if(!empty($posts->count()))
                <div class="side-popup-news-wrapper">
                    <div id="side-popup-news-content">
                        <div id="newsPopupDisBtn" data-leadId="{{$postIdFNP}}" class="d-flex align-items-center">
                            <span class="close-icon position-relative"><i class="bi bi-x"></i></span>
                            <h3>এই খবরগুলি মিশ করেছেন</h3>
                            <input type="hidden" name="session_id" id="session_id" value="{{ session()->getId() }}">
                        </div>
                        <div class="side-popup-news-item-box">
                            @foreach($posts as $postItem)
                                <div class="link-hover-homepage position-relative bg__fff mb">
                                    <a href="{{ news_url($postItem->id) }}">
                                        <div class="media-left" style="width: 45%;">
                                            <img src="{{ $postItem->featured_image }}" alt="{{ $postItem->headline }}"
                                                 class="{{ $postItem->featured_image }}">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ Str::limit($postItem->headline, 45) }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
    @include('_front.lazy_load')

    @include('_front.pages.single_post_ajax')
@endsection
@section('extra_js')
    <script src="{{ asset('/assets/js/pr.js')}}"></script>
    <script src="{{ asset('assets/js/single.js')}}"></script>

    <script>

        // $(window).on('load', function() {
        //     $('#preloader').hide();
        //     $('#single-post-container').show();
        // });


        $('#printFunc').on("click", function () {
            $('.adcontente01').hide();
            $('.PTitle, .PSubTitle, .PPublisTime, .PImg, .PContent').printThis({
                debug: false,               // show the iframe for debugging
                importCSS: true,            // import parent page css
                importStyle: false,         // import style tags
                printContainer: true,       // print outer container/$.selector
                loadCSS: "{{ asset('/assets/css/pr.css')}}", // path to additional css file - use an array [] for multiple
                pageTitle: "{{ $settings->site }}",              // add title to print page
                removeInline: false,        // remove inline styles from print elements
                removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
                printDelay: 333,            // variable print delay
                header: '<div style="border-bottom: 1px solid #eee;margin-bottom:10px;"><img id="PLogo" style="max-width: 290px; padding-bottom: 3px; height: 80px;width:auto" src="/{{ $settings-> logo }}"/></div>',               // prefix to html
                footer: '<address style="border-top: 1px solid #ccc; padding-top: 20px;text-align: center"><strong> সম্পাদক: {{ $settings->cr_text_1 }} </strong><br><strong>যোগাযোগ: </strong> {{ strip_tags($settings->cr_text_2) }}<br><strong>মোবাইল:</strong> {{ $settings->site_mobile }}; <strong>ইমেইল:</strong> {{ $settings->site_email }}<br> </address> <p id="PFooter" style="display:block;border-top:1px solid #eee;text-align:center;padding-top:5px;">© <?php $date = date('Y'); $date = e_to_b_replace($date); echo $date; ?> {{ $settings->site }} | সর্বস্বত্ব স্বত্বাধিকার সংরক্ষিত</p>', // postfix to html
                base: false,                // preserve the BASE tag or accept a string for the URL
                formValues: true,           // preserve input/form values
                canvas: false,              // copy canvas content
                doctypeString: '',       // enter a different doctype for older markup
                removeScripts: false,       // remove script tags from print content
                copyTagClasses: false,      // copy classes from the html & body tag
                beforePrintEvent: null,     // function for printEvent in iframe
                beforePrint: null,          // function called before iframe is filled
                afterPrint: null            // function called before iframe is removed
            });
        });
    </script>
    @include('_front.pages.single_post_readmore')
@endsection
