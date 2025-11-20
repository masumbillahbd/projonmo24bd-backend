@php $settings = setting();
$posts = popular_post_by_date(7);
@endphp

@if(!empty($posts))
    @foreach($posts as $key => $post)
        <div class="item ps-2">
            <div class="row">
                <div class="col-2 text-end">
                    <span class="sn">{{ e_to_b_int( ++$key ) }}</span>

                </div>
                <div class="col-10 align-self-center">
                    <a href="{{ news_url($post->id) }}">
                        <h4 class="mb-0 pt-1">{{ Str::limit($post->headline, 50) }}</h4>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@endif
