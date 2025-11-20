@extends('layouts.frontend')
@php $settings = setting(); @endphp
@section('meta_info')
    <title>Contact Us | {{ $settings->site_title }}</title>
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
                <article class="col-md-4 mt-3">
                    <ul class="list-group contact-page">
                        <li class="list-group-item">
                            <p class="contact-left">
                                প্রধান সম্পাদক ও প্রকাশক :
                            </p>
                            <p class="contact-right" style="font-weight: bold; font-size: 17px;">
                                {{ $settings->cr_text_1 }}
                            </p>
                        </li>

                        <li class="list-group-item">
                            <p class="contact-left">
                                যোগাযোগ :
                            </p>
                            <p class="contact-right">
                                {{ strip_tags($settings->cr_text_2) }}
                            </p>
                        </li>

                        <li class="list-group-item">
                            <p class="contact-left">
                                মোবাইল :
                            </p>
                            <div class="contact-right">
                                <p>{{ $settings->site_mobile }}</p>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <p class="contact-left">
                                ই-মেইল :
                            </p>
                            <div class="contact-right">
                                <p><a href="mailto:{{ $settings->site_email }}">{{ $settings->site_email }}</a></p>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <p class="contact-left">
                                ওয়েবসাইট :
                            </p>
                            <div class="contact-right" style="text-transform: lowercase">
                                {{ $settings->site_url }}
                            </div>
                        </li>
                    </ul>
                </article>
                <aside class="col-md-8">
                    <div class="google__map mt-3">
                        {!! $settings->google_map !!}
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection