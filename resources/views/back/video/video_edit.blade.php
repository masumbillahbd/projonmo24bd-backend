@extends('layouts.backend')
@section('title')
admin | Video edit
@endsection
@section('extra_js')
    @include('back.video.js')
@endsection
@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                    <div class="card-header"><h4 class="text-center font-weight-light my-2">Edit Video</h4></div>
                    
                    
                    <div class="card-body">
                        <form role="form" method="post" action="{{ route('video.update',['id'=>$video->id]) }}" >
                            
                            {{ csrf_field() }}
                            
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" value="{{$video->title}}" maxlenght="250" class="form-control" required="required">
                                <span class="text-danger">{{ $errors->has('title') ? $errors->first('title'):''}}</span>
                            </div>
                            <div class="form-group">
                                <label class="mb-1" for="video_url">Video URL</label>
                                            <input type="text" id="video_url" name="video_url" value="{{$video->video_url}}"
                                                   class="form-control" required="required"
                                                   placeholder="paste video link here...">
                            </div>
                            <div class="form-group">
                                <label class="mb-1">Video Streaming From</label>
                                <input name="streaming_site" value="{{$video->streaming_site}}" id="streaming_site" type="text" maxlenght="250" placeholder="facebook or youtube" class="form-control">
                            </div>
                            <div class="form-group">
                                            <label class="mb-1" for="title">Video Id</label>
                                            <input type="text" id="video_id" name="video_id" maxlenght="250" value="{{$video->video_id}}"
                                                   class="form-control" required="required">

                                        </div>
                                        
                            <div class="form-group">
                                            <label for="name" class="control-label mb-1">Select Picture</label>
                                            <div class="input-group">
                                                <input id="thumbnail" class="form-control" type="text" maxlenght="250"
                                                       name="featured_image" value="{{$video->thumbnail}}">
                                                <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                   class="btn btn-primary btn-height">
                                                  <i class="fa fa-image"></i> Choose
                                                </a>
                                              </span>

                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;" @if($video->thumbnail) src="{{ $video->thumbnail }}" @endif>
                                        </div>
                                        
                         
                                <div class="form-group float-right mt-4 mb-0">
                                    <button type="submit" class="btn btn-success submit">Update</button>
                                </div>
                            
                            
                        </form>
                    </div>
                    
                </div>
            </div> <!--col-->
            
            
            
        </div>
    </div>
</main>

@endsection


