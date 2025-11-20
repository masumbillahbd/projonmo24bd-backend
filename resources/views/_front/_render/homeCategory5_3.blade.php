@if(!empty($posts))
    @foreach($posts as $post)
        <div class="link-hover-homepage mb-3 pb-2">
            <a href="{{ news_url($post->id) }}">
                <div class="media pe-2">
                    <img src="{{ asset('/defaults/lazy_logo.jpg') }}" data-src="{{ !empty($post->featured_mini) ? $post->featured_mini : $post->featured_image }}" alt="{{ $post->headline }}" class="img-responsive lazy"/>
                </div>
                <div class="media-body">
                    <h5 class="media-heading">
                        {{ Str::limit($post->headline, 65) }}
                    </h5>
                </div>
            </a>
        </div>
    @endforeach
@endif