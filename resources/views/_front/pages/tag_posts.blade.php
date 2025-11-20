@extends('layouts.frontend')

@php $settings = setting(); @endphp
@section('meta_info')
    <title>{{ $tag->name ?? '' }} | {{ $settings->site_title }}</title>
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
    <section class="tag__page">
        <div class="container">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <div class="breadcrumb">
                        <a style="font-size: 30px; color: red; text-transform: capitalize;"
                           href="{{ tag_url($tag->name) }}">{{ $tag->name }}</a>
                    </div>
                    <hr>
                    @foreach($posts as $post)
                        <div class="callout-card">
                            <div class="row"
                                 style="margin-bottom: 15px;border-bottom: 1px solid #ececec; padding-bottom: 5px;">

                                <div class="col-md-3 col-xs-4 col-sm-4">
                                    <a href="{{ news_url($post->id) }}">
                                        <div class="media">
                                            <img style="margin: 6px 0;"
                                                 class="media-object img-fluid"
                                                 src="{{$post->featured_image}}"
                                                 alt="{{ $post->headline }}">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-9 col-xs-8 col-sm-8">
                                    <div class="media-body">
                                        <h3 class="media-heading"><a
                                                href="{{ news_url($post->id) }}">{{ $post->headline }}</a></h3>

                                        <div class="pull-right"><i
                                                class="bi bi-clock"></i> {{ bangla_published_time($post->created_at) }}
                                        </div>
                                        <p class="d-none d-none d-md-block"
                                           style="margin: 8px 0 5px 0">{{  Str::limit($post->excerpt, 140) }} <a
                                                href="{{ news_url($post->id) }}" class="text-danger">বিস্তারিত</a></p></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {!! $posts->links() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@include('_front.lazy_load')
@endsection
