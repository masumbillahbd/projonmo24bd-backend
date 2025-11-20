@if(!empty($post))
    <div class="col-md-4">
        <div class="main__title mb">
            <a href="{{ news_url($post->id) }}">
                <h3>{{ Str::limit($post->headline, 80) }}</h3></a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="cat-lead-single block_comn_content">
            <div class="link-hover-homepage mb">
                <div class="">
                    <a href="{{ news_url($post->id) }}">
                        <img src="{{ asset('/defaults/lazy_logo.jpg') }}" data-src="{{ !empty($post->featured_mini) ? $post->featured_mini : $post->featured_image }}" alt="{{ $post->headline }}" class="img-responsive lazy"/>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endif