<div class="latest-popular">
    <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-home" type="button" role="tab"
                    aria-controls="pills-home" aria-selected="true">সর্বশেষ
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-profile" type="button" role="tab"
                    aria-controls="pills-profile" aria-selected="false">জনপ্রিয়
            </button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
             aria-labelledby="pills-home-tab">
            <div class="news">
                @foreach(\App\Models\Post::where('post_status', '1')->orderBy('id', 'desc')->take(20)->get() as $post)
                    <div class="row row-cols-1 no-gutters mb-4">
                        <div class="col-md-12 item">
                            <div class="col-3">
                                <a href="{{ news_url($post->id) }}">
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->headline}}"/>
                                </a>
                            </div>
                            <div class="col-9 align-self-center px-2">
                                <a href="{{ news_url($post->id) }}">
                                    <h6><strong>{{ $post->headline}}</strong></h6>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
             aria-labelledby="pills-profile-tab">
            <div class="news">
                <?php
                $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
                $tillDate = Carbon\Carbon::now()->toDateString();

                $posts = \App\Models\Post::whereBetween('created_at', [$fromDate, $tillDate])
                        ->orderBy('view_count', 'desc')
                        ->take(20)
                        ->get();
                ?>
                @foreach($posts as $post)
                    <div class="row row-cols-1 no-gutters mb-4 item">
                        <div class="col-md-12 item">
                            <div class="col-3">
                                <a href="{{ news_url($post->id) }}">
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->headline}}"/>
                                </a>
                            </div>
                            <div class="col-9 align-self-center px-2">
                                <a href="{{ news_url($post->id) }}">
                                    <h6><strong>{{ $post->headline}}</strong></h6>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>