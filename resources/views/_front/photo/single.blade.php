@extends('layouts.front')
@section('extra_css')
    <style>
        .photo-content img{
            max-width: 100%;
        }
    </style>
@endsection
@section('extra_js')
    <script>
        $(document).ready(function () {
            $(".photo-content img").each(function() {
                var imageCaption = $(this).attr("alt");
                if (imageCaption != '') {
                    var imgWidth = $(this).width();
                    var imgHeight = $(this).height();
                    var position = $(this).position();
                    var positionTop = (position.top + imgHeight - 26)
                    $("<span class='img-caption'><em>" + imageCaption +
                        "</em></span>").css({
                        "position": "absolute",
                        "top": positionTop + "px",
                        "left": "0",
                        "width": imgWidth + "px"
                    }).insertAfter(this);
                }
            });
        });

    </script>
@endsection
@section('main_content')
    @if($photo)
        <div class="section-photo">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">হোম</a></li>
                            <li><a href="{{ route('photo.gallery') }}">ছবি ঘর</a></li>
                            <li><a href="{{ photo_category_url($category) }}">{{ $category->name }}</a></li>
                            <li><a href="{{ photo_url($photo) }}">{{ $photo->title }}</a></li>
                        </ol>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        <div class="section-photo">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="section">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="photo-content">
                                        <div class="panel-body" style="padding: 0;">
                                            <i class="fa fa-camera"></i> <h1> {!! $photo->title  !!}</h1>
                                            <div class="photo-img">
                                                <img src="{{ $photo->featured_image }}" alt="" class="img-responsive">
                                            </div>
                                            <div class="info">
                                                <p>{!! $photo->featured_image_caption !!}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        {!! $photo->photo_content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div style="width: 100%">
                            <p><img style="margin: 20px;" src="{{url('https://pf.wamhost.com/uploads/shares/provatferi-epaper2-2019-12-03-12-01-38.jpg')}}" border="0" alt="" class="img_ad"></p>
                        </div>
                        <div class="single_page_top_hit">
                            <div class="list-group">
                                <?php $photos = \App\Category::find($category->id)->Photos()->orderBy('created_at', 'desc')->skip(0)->take(5)->get(); ?>
                                @if($photos)
                                    @foreach($photos as $photo_item)
                                        <div class="list-group-item">
                                            <div class="media">
                                                <div class="media-left" style="width:35%">
                                                    <a href="{{ photo_url($photo_item) }}"> <i class="fa fa-camera"></i>
                                                        <img src="{{ $photo_item->featured_image }}" alt="{!! $photo_item->title !!}" class="media-object">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a
                                                                href="{{ photo_url($photo_item) }}">{!! $photo_item->title !!}
                                                        </a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt">
                    <br>
                    <br>
                    </hr>
                </div>
            </div>
        </div>
    @endif
@endsection


