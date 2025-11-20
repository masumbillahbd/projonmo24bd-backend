@if(!empty($posts))
<?php  $settings = \App\Models\Setting::find('1'); ?>
    @foreach($posts as $post)
        <div class="link-hover-homepage mb-3 pb-2">
            <a href="{{ news_url($post->id) }}">

                <div class="media-left pe-2" style="width: 60%">
                    <h5 class="media-heading">
                        {{ Str::limit($post->headline, 85) }}
                    </h5>
                </div>
                <div class="media-body">
                   <img src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}" data-src="{{ !empty($post->featured_mini) ? $post->featured_mini : $post->featured_image }}" alt="{{ $post->headline }}" class="img-responsive lazy"/>
                        
                </div>
            </a>
        </div>
       
    @endforeach
@endif
