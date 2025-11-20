@if(!empty($posts))
    @foreach($posts as $post)
        <div class="media">
            <div class="link-hover-homepage">
                <a href="{{ news_url($post->id) }}">
                    <h3 class="media-heading">{{ Str::limit($post->headline, 78) }} </h3>
                </a>
                <div class="media-left">
                    <p>{{ Str::limit($post->excerpt, 90) }}</p>

                </div>
                <div class="media-body">
                    <img src="{{ asset('/defaults/lazy_logo.jpg') }}" data-src="{{ !empty($post->featured_mini) ? $post->featured_mini : $post->featured_image }}" alt="{{ $post->headline }}" class="media-object img-responsive lazy"/>
                </div>
            </div>
        </div>
    @endforeach
@endif