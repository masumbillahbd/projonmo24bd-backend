@extends('layouts.frontend')
@section('page_title', 'এক্সক্লুসিভ ' )
@section('main_content')
    <section class="exclusive">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="border__left"></div>
                    <div class="heading pb-4 ps-3">
                        <span>বিশেষ প্রতিবেদন</span>
                    </div>
                </div>
                @foreach($exclusive as $post)
                    <div class="col-md-3 col-lg-3">
                        <div class="content-body">
                            <div class="callout-card pb-2 mb-4 border__btm">
                                <div class="media-body">
                                    <a href="{{ news_url($post->id) }}">
                                        <img class="media-object img-responsive" src="{{$post->featured_image}}"
                                             alt="{{ $post->headline }}">
                                        <h4 class="exclusive__t pt-2 pb-3">{{ $post->headline }}</h4>
                                    </a>
                                    <i class="bi bi-clock" style="font-size: 11px;"></i> {{ bangla_published_time($post->created_at) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    {!! $exclusive->links() !!}
                </div>
            </div>
        </div>

    </section>
@endsection