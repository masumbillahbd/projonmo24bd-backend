@extends('layouts.frontend')
@section('meta_info')
<title>$category->name | {{ $settings->site_title }}</title>
@endsection

@section('main_content')

    @if($category)
        <div class="container">
            <div class="vdopg">
                <section class="section">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><a href="{{ url('/video-gallery') }}"><i class="fa fa-home"></i></a></li>
                                <li>
                                    <a href="{{ video_category_url($category) }}">{{ $category->name }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="video-top">
                                        <?php $videos = \App\Models\Category::find($category->id)->Videos()->orderBy('created_at', 'desc')->skip(0)->take(1)->get(); ?>
                                        @if($videos->count())
                                            @foreach($videos as $video)
                                                <div class="thumbnail">
                                                    <i class="bi bi-play-fill"></i>
                                                    <a href="{{ video_url($video->uniqid) }}"><img
                                                                src="{{ $video->thumbnail }}" alt="{{ $video->title }}"
                                                                class="img-responsive">
                                                        <div class="carousel-caption">
                                                            <h3><strong>{{ $video->title }}</strong></h3>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="video-block-right">
                                            <?php $videos = \App\Models\Category::find($category->id)->Videos()->orderBy('created_at', 'desc')->skip(1)->take(2)->get(); ?>
                                            @if($videos->count())
                                                @foreach($videos as $video)
                                                    <div class="col-md-12">
                                                        <div class="thumbnail" style="margin-bottom: 10px;">
                                                            <i class="bi bi-play-fill"></i>
                                                            <a href="{{ video_url($video->uniqid) }}"><img
                                                                        src="{{ $video->thumbnail }}"
                                                                        alt="{{ $video->title }}"
                                                                        class="img-responsive">
                                                                <div class="carousel-caption">
                                                                    <h4>{{ $video->title }}</h4>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="video-block-all">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <div class="content">
                                    <?php $videos = \App\Models\Category::find($category->id)->Videos()->orderBy('created_at', 'desc')->skip(3)->take(99)->get(); ?>
                                    @if($videos->count())
                                        <div class="row">
                                            @foreach($videos as $video)
                                                <div class="col-md-4 col-6">
                                                    <div class="thumbnail" style="margin-bottom: 10px;">
                                                        <i class="bi bi-play-fill"></i>
                                                        <a href="{{ video_url($video->uniqid) }}"><img
                                                                    src="{{ $video->thumbnail }}" alt="{{ $video->title }}"
                                                                    class="img-responsive">
                                                            <div class="caption">
                                                                <h4>{{ Str::limit($video->title, 60) }}</h4>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            
                        </div>
                    </div>


                </section>
            </div>
        </div>
    @endif
@endsection


