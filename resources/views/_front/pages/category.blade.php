@extends('layouts.frontend')
@section('meta_info')
@php $settings = setting(); @endphp
    <title>{{ $category->name }} | {{ $settings->site_title }}</title>
    <meta name="keywords" content="{{ $settings->meta_keywords }}"/>
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta name="classification" content="Magazine, Newspaper, Artical"/>
    <meta property="og:title" content="{{ $category->name }} | {{ $settings->meta_title }}"/>
    <meta property="og:description" content="{{ $settings->meta_description }}">
    <meta property="og:image" content="{{ url($settings->meta_image) }}"/>
    <meta property="og:url" content="{{ $settings->site_url }}"/>
    <meta property="og:site_name" content="{{ $settings->site }}">
    <meta name="twitter:url" content="{{ $settings->site_url }}"/>
    <meta name="twitter:title" content="{{ $category->name }} | {{ $settings->site_title }}"/>
    <meta name="twitter:description" content="{{ $settings->meta_description }}"/>
    <meta name="twitter:image" content="{{ url($settings->meta_image) }}"/>
    <meta name="twitter:creator" content="">
@endsection

@section('extra_css')
    <style>
        #load_more {
            margin: 25px 0;
        }
        .section_page .link-hover-homepage:hover h4, .section_page .link-hover-homepage:hover a {
            color: var(--bs-blue) !important;
        }
    </style>
@endsection


@section('main_content')
    <section class="section_page pt-0">
        <div class="ads__banner bg__grey py-3 m-auto" align="center">
            <div class="container">
                <img src="/ads/1677944913.gif" class="ads__file">
            </div>
        </div>
        <div class="section__page__heading py-5 mb-5" style="background: #f5f5f5;">
            <div class="container">
                <div class="section_heading">
                    <a href="{{ category_url($category->id) }}">{{ $category->name }}</a>
                </div>
                <div class="sub">
                    @foreach($category->SubCategory->all() as $sub_cat)
                        <a href="{{ route('sub_cat.post', ['cat' => $category->slug, 'sub_cat' => $sub_cat->slug]) }}"
                           class="pt-3">{{ $sub_cat->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        @if($category->id == 9)
            <div class="district__block mt-4">
                <div class="container">
                    <form action="{{ route('search_all_bd_news') }}" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mt-2 mb-3">
                                    <?php $divisions = App\Models\Division::orderBy('name', 'asc')->get();?>
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
            </div>
        @endif

        <div class="container">
            <div class="cat__pg__top__1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="section__page__lead col-lg-9 mb-3 mb-md-0 mb-lg-0">
                                <?php $post = posts_by_category($category->id, 1); ?>
                                @if($post)
                                    <div class="row news__item d-flex align-items-center">
                                        <div class="col-lg-4 order-2 order-lg-1">
                                            <div class="left__top my-3">
                                                <a href="{{ news_url($post->id) }}">
                                                    <h2 class="text-600">{{ $post->headline }}</h2>
                                                </a>
                                                <p class="">{{ Str::limit($post->excerpt, 110) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 order-1 order-lg-2">
                                            <div class="media">
                                                <a href="{{ news_url($post->id) }}">
                                                    <img
                                                        src="{{ $post->featured_image }}"
                                                        alt="{{ $post->headline }}"
                                                        class="img-fluid"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-3">
                                <div class="sidebar">
                                    <div class="block__ads sqr text-center">
                                        <div class="title">
                                            <span>বিজ্ঞাপন</span>
                                        </div>
                                        <div class="ads__thumb mb-4">
                                            <img src="/ads/1680259813.jpg" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <?php $posts = posts_by_category($category->id, 4, 1); ?>
                            @foreach($posts as $post)
                                <div class="col-lg-3 border__right">
                                    <div class="content__col">
                                        <div class="news__item">
                                            <a href="{{ news_url($post->id) }}">
                                                <div class="media">
                                                    <img
                                                        src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                        data-src="{{ $post->featured_image }}"
                                                        class="img-fluid lazy" alt="{{ $post->headline }}">
                                                </div>
                                                <span class="media-body">
                                                    <h4 class="py-2 text-600">{!! $post->headline !!}</h4>
                                                </span>
                                            </a>
                                            <p class="d-none d-md-block d-lg-block">{{ Str::limit($post->excerpt, 120) }}</p>
                                            <time><?php $ago_time = bn_ago_time($post->created_at); $create_time = e_to_b_replace($ago_time);?> {{ $create_time }}</time>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <?php unset($posts); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block__ads sqr d-block d-md-none d-lg-none text-center">
                <hr>
                <div class="title">
                    <span>Advertisement</span>
                </div>
                <div class="ads__thumb mb-4">
                    <img src="/ads/1680259813.jpg" class="img-fluid"/>
                </div>
            </div>
            <hr>
        </div>
    </section>


    <div class="container mt-1">
        <div class="row">
            <div class="col-md-3 col-lg-3">
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="content-body">
                    <div class="pb-1" id="load_more_post">
                        {{ csrf_field() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
            </div>
        </div>
    </div>
    
    
@include('_front.pages.category_autoload_js')    
@include('_front.lazy_load')    
@endsection

@section('extra_js')
@include('MultipleDependencies')
<script>
    window.onload = function () {
        let catID = {{$category->id}};
        $.ajax({
            url: "{{ route('latestNews') }}",
            method: "GET",
            success: function (res) {
                $('.latestNews').html(res);
            }
        });
        $.ajax({
            url: "{{ route('popularNewsByCat') }}/" + catID,
            method: "GET",
            success: function (res) {
                $('.popularNewsByCat').html(res);
            }
        });

    };
</script>
@endsection
