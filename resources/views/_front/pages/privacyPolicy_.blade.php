@extends('layouts.frontend')
@php $settings = setting(); @endphp
@section('meta_info')
    <title>Privacy Policy | {{ $settings->site_title }}</title>
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
    <style>
        .google__map iframe{
            height: 500px !important;
            width: 100% !important;
        }
    </style>
@endsection

@section('main_content')
    <section class="single-section">
        <div class="container">
            <div class="row">
            <article class="col-md-12 mt-3">
                        <ul class="list-group contact-page">
                <h2 class="text-center">Privacy Policy</h2>
                            <li class="list-group-item">
                                <p class="contact-left">
                                </p>
                            </li>

                            
                        </ul>
            </article>
            </div>
        </div>
        
    </section>
@endsection