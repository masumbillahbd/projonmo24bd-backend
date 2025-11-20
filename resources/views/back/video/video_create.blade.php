@extends('layouts.backend')
@section('title')
    admin | Video create
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
                        <div class="card-header">
                            <div class="pg__name float-left">
                                <h4 class="font-weight-light my-1">Add New Video</h4>
                            </div>
                            <div class="pg__btn float-right">
                                <a href="{{ route('video.index') }}" class="btn btn__view">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('video.store') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control" maxlenght="250"
                                           required="required">
                                    <span
                                        class="text-danger">{{ $errors->has('title') ? $errors->first('title'):''}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="video_url">Video URL <span class="text-danger">*</span></label>
                                    <input type="text" id="video_url" maxlenght="250" name="video_url"
                                           class="form-control" required="required"
                                           placeholder="paste video link here...">
                                </div>
                                <div class="form-group">
                                    <label>Video Streaming From</label>
                                    <input name="streaming_site" id="streaming_site" maxlenght="250" type="text"
                                           placeholder="facebook or youtube" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="title">Video Id</label>
                                    <input type="text" id="video_id" maxlenght="250" name="video_id"
                                           class="form-control" required="required">

                                </div>

                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Select Picture</label>
                                    <div class="input-group">
                                        <input id="thumbnail" class="form-control" maxlenght="250" type="text"
                                               name="featured_image">
                                        <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                   class="btn btn-primary btn-height">
                                                  <i class="fa fa-image"></i> Choose
                                                </a>
                                              </span>

                                    </div>
                                    <img id="holder" style="margin-top:15px;max-height:100px;">
                                </div>

                                <div class="form-group float-right mt-4 mb-0">
                                    <button type="submit" class="btn btn-success submit">Create</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div> <!--col-->
            </div>
        </div>
    </main>
@endsection
