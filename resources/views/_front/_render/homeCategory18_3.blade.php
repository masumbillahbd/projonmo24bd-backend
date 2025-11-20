<div class="row">
  @if(!empty($posts))
    @foreach($posts as $post)

        <div class="col-md-4 col-12">
            <div class="link-hover-homepage mb-3">
                <a href="{{ news_url($post->id) }}">
                    <div class="media box__shadow">
                        <img src="{{ asset('/defaults/lazy_logo.jpg') }}" data-src="{{ !empty($post->featured_mini) ? $post->featured_mini : $post->featured_image }}" alt="{{ $post->headline }}" class="img-responsive lazy"/>
                        <div class="title__box p-2 pb-4">
                            <h4>{{ $post->headline }}</h4>
                            <p class="mb-0 mt-2">{{ Str::limit($post->excerpt, 90) }}</p>
                            <span class="cat__name">{{ category_name(7) }}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
@endif
</div>

