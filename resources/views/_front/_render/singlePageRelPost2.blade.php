@php $settings = setting(); @endphp
<div class="row d-flex">
    @if(!empty($posts))
        @foreach($posts as $post)
            <div class="col-md-3 col-sm-6 col-6">
                <div class="single-page-block mb-3">
                    <div class="link-hover-homepage mb-4">
                        <a href="{{ news_url($post->id) }}">
                            <div class="thumbnail position-relative">
                                <img
                                    src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                    data-src="{{ $post->featured_image }}"
                                    class="img-responsive lazy "
                                    alt="{{ $post->featured_image_caption }}">
                            </div>
                            <div class="rltd__content__title p-3">
                                <h5 class="mb-0">
                                    {{ Str::limit($post->headline, 60) }}
                                </h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
