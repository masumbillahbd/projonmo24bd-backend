<div class="row">
    @if(!empty($videos))
        @foreach($videos as $video)
            <div class="col-md-6 col-6">
                <div class="item mb-3">
                    <a href="{{ video_url($video) }}">
                        <div class="video__thumb position-relative">
                            <i class="bi bi-play-fill"></i>
                            <img src="{{ $video->thumbnail }}"
                                 alt="{{ $video->title }}"
                                 class="img-responsive">
                        </div>
                        <div class="video__caption px-2">
                            <h4>{{ Str::limit($video->title, 40) }}</h4>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    @endif
</div>
