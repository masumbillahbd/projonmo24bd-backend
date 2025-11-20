<div class="row">
    @if(!empty($posts))
        <?php  $settings = \App\Models\Setting::find('1'); ?>
        @foreach($posts as $post)
            <div class="col-md-4 col-lg-4 col-6">
                <div class="link-hover-homepage mb-4 position-relative">
                    <a href="{{ news_url($post->id) }}">
                        <div class="media thumbnail">
                            <img src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                 data-src="{{ $post->featured_mini }}" class="img-responsive lazy"
                                 alt="{{ $post->headline }}"/>
                        </div>
                        <div class="media-title d-inline-block">
                            @foreach($post->Category as $category)
                                <span>{{$category->name}}</span>
                            @endforeach
                            <h4 class="">{{ Str::limit($post->headline, 50) }}</h4>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    @endif
</div>

