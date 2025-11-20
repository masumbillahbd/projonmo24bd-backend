@extends('layouts.front')
@section('extra_css')

@endsection

@section('extra_js')
@endsection

@section('main_content')


    @if($category)
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">হোম</a></li>
                            <li><a href="{{ route('photo.gallery') }}">ছবি গ্যালারী</a></li>
                            <li><a href="{{ photo_category_url($category) }}">{{ $category->name }}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><a href="{{ video_category_url($category) }}">{{ $category->name }}</a></div>
                            <div class="panel-body">
                                <div class="row">
                                    @foreach($photos as $photo)
                                        <div class="col-md-3">
                                            <div class="thumbnail">
                                                <img src="{{ $photo->featured_image }}" alt="" class="img-responsive">
                                                <div class="caption">
                                                    <h4><a href="{{ photo_url($photo) }}"><strong>{{ $photo->title }}</strong></a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <?php echo $photos->render(); ?>
                    </div>
                </div>
            </div>
        </div>

    @endif









@endsection


