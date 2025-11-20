@extends('layouts.frontend')
<?php $settings = \App\Models\Setting::find(1); ?>
@section('meta_info')
<title>ভিডিও গ্যালারী | {{ $settings->site_title }}</title>
@endsection

@section('extra_js')
    <script>
        $(function () {
            var $a = $(".tabs li");
            $a.click(function () {
                $a.removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
@endsection

@section('main_content')
    <div class="section_all_cat_vdo pt-3">
        <?php $videos = all_video_query('desc', 24) ?>
        @if($videos)
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-body">
                                <div class="row">
                                    @foreach($videos as $video)
                                        <div class="col-md-3 col-6">
                                            <div class="item mb-4 position-relative">
                                                <a href="{{ video_url($video->uniqid) }}"><i
                                                            class="bi bi-play-fill"></i><img
                                                            src="{{ $video->thumbnail }}" alt="{{ $video->title }}"
                                                            class="img-responsive">
                                                    <div class="caption">
                                                        <h4>{{ $video->title }}</h4>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ $videos->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection
        
	
	