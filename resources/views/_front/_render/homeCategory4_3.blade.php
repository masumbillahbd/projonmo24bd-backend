<div class="row">
  @if(!empty($posts))
      @foreach($posts as $post)
          <div class="col-md-4 col-lg-4 col-sm-6 col-12 d-flex align-items-stretch mb-lg-0">
                <div class="link-hover-homepage mb-3">
                    <a href="{{ news_url($post->id) }}">
                        <img src="{{ asset('/defaults/lazy_logo.jpg') }}" data-src="{{ !empty($post->featured_mini) ? $post->featured_mini : $post->featured_image }}" alt="{{ $post->headline }}" class="img-responsive lazy"/>
                    </a>
                    <div class="body">
                        <a href="{{ news_url($post->id) }}">
                            <h4 class="p-2">
                                <strong>{{ $post->headline }}</strong>
                            </h4>
                        </a>
                    </div>
                </div>
            </div>
      @endforeach
  @endif
</div>
