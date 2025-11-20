<div class="link-hover-homepage mb-3">
    <a href="{{ news_url($post->id) }}">
        <div class="media-left pe-2">
            <img class="img-fluid" src="{{ $post->featured_image }}" alt="{{ $post->headline }}">
        </div>
        <div class="media-body">
            <h4 class="mb-0">{{ $post->headline }}</h4>
        </div>
    </a>
</div>
