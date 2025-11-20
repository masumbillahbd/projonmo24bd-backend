<div class="row">
  @if(!empty($posts))
    @foreach($posts as $post)
    <div class="col-md-3 col-lg-3 col-6">
        <div class="link-hover-homepage mb-3">
            <a href="{{ news_url($post->id) }}">
                <div class="media">
                    <img src="{{ asset('/defaults/lazy_logo.jpg') }}"
                         data-src="{{ $post->featured_image }}" class="img-responsive lazy"
                         alt="{{ $post->headline }}"/>
                    <div class="media-title">
                        <h4>{{ $post->headline }}</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
 @endif
</div>
