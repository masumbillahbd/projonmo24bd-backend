@extends('layouts.frontend')
@section('meta_info')
    @php $settings = setting(); @endphp
    <title>@yield('page_title'){{ $settings->site_title }}</title>
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
    </style>
@endsection

@section('extra_js')
    <script src="{{asset('assets/vendors/bootstrap-datepicker-1.6.1/js/bootstrap-datepicker.min.js')}}"></script>
@endsection
@section('main_content')
    <section class="container all__news__page">
        <div class="row">
            <div class="col-md-3 col-lg-3" style="margin-top: 40px">
                <h3>আর্কাইভ</h3>
                <hr>
                <div class="form-inline">
                    <div class="form-group">
                        <form action="{{ route('Archive') }}" method="get">
                            <input class="form-control" id="textDate" name="postByDate" @if(!empty($date))value="{{$date}}"@endif placeholder="yyyy-mm-dd" required type="date">
                            <button type="submit" class="btn btn-success mt-3 text-center d-block m-auto">দেখুন</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="heading py-2 mt-3">
                    <h1 class="mb-0">@if(!empty($date)) {{ e_to_b_replace(Carbon\Carbon::parse($date)->format('d-m-Y')) }} @elseসর্বশেষ@endif</h1>
                </div>
                <hr>
                @foreach($posts as $post)
                    <div class="callout-card pb-2 mb-4 border__btm">
                        <div class="row">
                            <div class="col-md-8 col-8 col-sm-8">
                                <div class="media-body">
                                    <ul class="list-inline ">
                                        <li><h4 class="media-heading"><a
                                                        href="{{ news_url($post->id) }}"><strong>{{ $post->headline }}</strong></a>
                                            </h4></li>
                                        <li class="float-left d-block" style="font-size: 15px"><i
                                                    class="bi bi-clock"
                                                    style="font-size: 12px"></i> {{ bangla_published_time($post->created_at) }}
                                        </li>
                                        <li class="clearfix"></li>
                                    </ul>
                                    <p class="d-none d-md-block d-lg-block ps-1">{{ Str::limit($post->excerpt, 110) }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-4 col-sm-4">
                                <a href="{{ news_url($post->id) }}">
                                    <img class="media-object img-responsive"
                                         src="{{$post->featured_image}}" alt="{{ $post->headline }}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <nav class="text-center">
                    {{ $posts->links() }}
                </nav>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </section>
@endsection