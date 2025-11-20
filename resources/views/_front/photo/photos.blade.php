@extends('layouts.frontend')
@section('extra_css')
    <style>
        .photo-list {
            position: relative !important;
        }

        .photo-list i {
            position: absolute;
            left: 6px;
            top: 6px;
            color: #fff;
            background: #f00000;
            font-size: 26px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            padding: 8px 12px;
        }
    </style>
@endsection

@section('extra_js')

@endsection

@section('main_content')

    <!-- ======= photo Section ======= -->
    <section id="photo" class="photos__page">
        <div class="container">
            <div class="heading pb-2">
                <h3>ছবি</h3>
            </div>
            <div class="row">
                <?php $photos = photo_query(8, 0, 'desc') ?>
                @if(!empty($photos))
                    @foreach($photos as $key=> $photo)
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="photo-list">
                                <a href="{{ $photo->featured_image }}" data-gallery="photoGallery{{$key}}"
                                   class="portfolio-lightbox preview-link" title="{{ $photo->title }}">
                                    <div class="media">
                                        <img src="{{ $photo->featured_image }}" class="img-fluid img1"
                                             alt="{{ $photo->title }}"/>
                                    </div>
                                    <i class="bi bi-images"></i>
                                </a>
                                <div class="portfolio-info">
                                    <p class="photo__caption text-600">{{ $photo->title }}</p>
                                    <?php $multiple_photos = multiple_photo($photo->id) ?>
                                    @foreach($multiple_photos as $multiple_photo)
                                        @if(!empty($multiple_photo->thumbnail))
                                            <a href="{{ $multiple_photo->thumbnail }}"
                                               data-gallery="photoGallery{{$key}}"
                                               class="portfolio-lightbox preview-link"
                                               title="{{ $multiple_photo->caption }}"></a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <?php unset($photos) ?>
            </div>
        </div>
    </section>



@endsection


