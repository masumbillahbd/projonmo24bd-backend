@extends('layouts.frontend')
@section('meta_info')
   @section('meta_info')
   @php $setting = setting(); @endphp
    <title>{!! $page->title !!}</title>
    <meta name="title" content="{!! $page->title !!}">
    <meta name="description" content="{{$setting->meta_description}}">
    <meta name="keywords" content="{{$setting->meta_keywords}}">
    <meta name="author" content="{{$setting->meta_author}}">
    <meta name="robots" content="ALL"/>
    <meta name="robots" content="index, follow"/>
    <meta name="googlebot" content="index, follow"/>
    <meta property="og:type" content="website"/>
    <meta name="twitter:site" content="{{$setting->twitter}}"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:url" content="{{ page_url($page->slug) }}">
    <meta name="twitter:title" content="{!! $page->title !!}">
    <meta name="twitter:description" content="{{$setting->meta_description}}">
    <meta name="twitter:image" content="{{asset('/settings/'.$setting->meta_image) }}">
    <meta name="twitter:creator" content="{{$setting->twitter}}">
    <meta name="classification" content="Products"/>
    <meta property="og:title" content="{!! $page->title !!}"/>
    <meta property="og:description" content="{{$setting->meta_description}}">
    <meta property="og:image" content="{{asset('/settings/'.$setting->meta_image) }}"/>
    <meta property="fb:app_id" content="{{$setting->fb_app_id}}"/>
    <meta property="og:url" content="{{ page_url($page->slug) }}"/>
    <meta property="og:site_name" content="{{$setting->site_name}}">
    <link rel="canonical" href="{{ page_url($page->slug) }}"/>
    <meta name="brand_name" content="{{$setting->site_name}}">
@endsection

@endsection
@section('extra_css')
   <style>
       .single_page{
           font-family: sans-serif;
       }
   </style>
@endsection

@section('main_content')
    <section class="single_page">
        <div class="container">
            <div class="row align-items-center">
              <div class="col-md-10 m-auto ">
                  <div class="heading mb-4">
                      <h3>{!! $page->title !!}</h3>
                  </div>
                  <div class="page__body">
                      <div class="content">{!! $page->content !!}</div>
                  </div>
              </div>
            </div>
        </div>
    </section>
@endsection