@php 
$settings = \App\Models\Setting::find('1');
@endphp
@if(!empty($posts))
@foreach($posts as $post)
    <div class="item">
        <div class="row">
            <div class="col-4">
                <a href="{{ news_url($post->id) }}">
                    <img src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}" data-src="{{ !empty($post->featured_mini) ? $post->featured_mini : $post->featured_image }}" alt="{{ $post->headline }}" class="img-responsive lazy"/>
                </a>
            </div>
            <div class="col-8 align-self-center px-2">
                <a href="{{ news_url($post->id) }}">
                    <h6 class="mb-0 pt-1">{{ $post->headline}}</h6>
                </a>
            </div>
        </div>
    </div>
@endforeach
@endif