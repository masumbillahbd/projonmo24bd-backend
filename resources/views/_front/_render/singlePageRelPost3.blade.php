<div class="row">
    @if(!empty($posts))
        @foreach($posts as $post)
            <div class="col-md-3 col-sm-6 col-6">
                <div class="single-page-block mb-3">
                    <div class="link-hover-homepage">
                        <a href="{{ news_url($post->id) }}">
                            <img src="{{ asset('/defaults/lazy_logo.jpg') }}"
                                 data-src="{{ $post->featured_image }}"
                                 class="img-responsive lazy"
                                 alt="{{ Str::limit($post->headline, 60) }}">
                            <h5 class="pt-2">
                                {{ Str::limit($post->headline, 60) }}
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach                  
    @endif
</div>