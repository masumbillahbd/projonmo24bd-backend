

    <!--single page content ads-->
    <?php $inads = \App\Models\InnerAd::where('status', 1)->orderBy('id', 'desc')->first(); ?>
    @if(!empty($inads))
        <script>
            $(document).ready(function () {
                // $(".singleContent360 div").last().append("<h2>Demo</h2>");
                $(".singleContent360 p").first().addClass("selected-div-inner-ad");
                $(".selected-div-inner-ad").next().addClass("content-inner-ads360");
                $(".content-inner-ads360").after().append("<div class='content-ad-block360'> <a href='{{$inads->url}}' target='_blank'>  <center> <p class='content-ads-title-360' style='margin:0px;font-size:13px;color:#838383;margin-top: 5px;'>  বিজ্ঞাপন</p>   <img class='adcontente01' src='{{ asset('/ads/'.$inads->photo)}}'/>  </center> </a> </div>");
            });
        </script>
    @endif
    <?php unset($inads) ?>

    <?php $readmore = \App\Models\ReadMore::where('leader', $post->id)->orderBy('id', 'desc')->first();  ?>
    @if(!empty($readmore))
        @if(!empty($readmore->post->id))
            <script>
                $(document).ready(function () {
                    $(".singleContent360 p").first().addClass("story-element");
                    $(".story-element").next().next().addClass("story-container");
                    $(".story-container").after().append("<div class='story-content'> <div class='also-read-text'>আরও পড়ুন</div> <div class='story-content-inner'><a href='{{  news_url_for_readmore($readmore->post->id) }}' class='link' target='_self'> <h2 class='heading'>{{ $readmore->post->headline }}</h2> <img class='image' src='{{ $readmore->post->featured_image }}'/>  </a></div> </div>");
                });
            </script>
        @endif
    @endif
    <?php unset($readmore) ?>

    <?php $readmore = \App\Models\ReadMore::where('leader', $post->id)->orderBy('id', 'desc')->skip(1)->first();  ?>
    @if(!empty($readmore))
        @if(!empty($readmore->post->id))
            <script>
                $(document).ready(function () {
                    $(".singleContent360 p").first().addClass("story-element");
                    $(".story-element").next().next().next().next().addClass("story-container101");
                    $(".story-container101").after().append("<div class='story-content'> <div class='also-read-text'>আরও পড়ুন</div> <div class='story-content-inner'><a href='{{  news_url_for_readmore($readmore->post->id) }}' class='link' target='_self'> <h2 class='heading'>{{ $readmore->post->headline }}</h2> <img class='image' src='{{ $readmore->post->featured_image }}'/>  </a></div> </div>");
                });
            </script>
        @endif
    @endif
    <?php unset($readmore) ?>


    <?php $readmores = \App\Models\ReadMore::where('leader', $post->id)->orderBy('id', 'desc')->skip(2)->take(5)->get();  ?>
    @if(!empty($readmores))
        @foreach($readmores as $readmore)
            @if(!empty($readmore->post->id))
                <script>
                    $(document).ready(function () {
                        $(".singleContent360 p").first().addClass("story-element");
                        $(".story-element").next().next().next().next().next().next().next().addClass("story-container103");
                        $(".story-container103").after().append("<div class='story-content'> <div class='also-read-text'>আরও পড়ুন</div> <div class='story-content-inner'><a href='{{  news_url_for_readmore($readmore->post->id) }}' class='link' target='_self'> <h2 class='heading'>{{ $readmore->post->headline }}</h2> <img class='image' src='{{ $readmore->post->featured_image }}'/>  </a></div> </div>");
                    });
                </script>
            @endif
        @endforeach
    @endif
    <?php unset($readmores) ?>
