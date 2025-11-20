@extends('layouts.backend')
@section('title')
    Admin | Post create
@endsection
@section('extra_css')
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/pmanager.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
            @include('back.parts.message')
        </div>
            <form role="form" method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 mt-2"></div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg rounded-lg mt-2 mb-5">
                            <div class="card-header"><h4 class="text-center font-weight-light my-2">Create Post</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Headline <span class="text-danger">*</span></label>
                                    <input name="headline" value="{{ old('headline') }}" type="text" maxlength="250" class="form-control" required>
                                    @error('headline')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Sub Headline</label>
                                    <input name="sub_headline" value="{{ old('sub_headline') }}" type="text" maxlength="100" class="form-control">
                                    @error('sub_headline')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="excerpt">Excerpt (Intro) <span class="text-danger">*</span></label>
                                    <textarea name="excerpt" id="excerpt" maxlength="400" rows="5" class="textarea" required>{{ old('excerpt') }}</textarea>
                                    @error('excerpt')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group body__edit">
                                    <label>Post Content <span class="text-danger">*</span></label>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>
                                    <textarea id="post_content" name="post_content" class="form-control my-editor" rows="15" >{{ old('post_content') }}</textarea>
                                    <script>
                                        var editor_config = {
                                            path_absolute: "/",
                                            selector: "#post_content",
                                            plugins: [
                                                "textcolor advlist autolink lists link image charmap print preview hr anchor pagebreak",
                                                "searchreplace wordcount visualblocks visualchars code fullscreen",
                                                "insertdatetime media nonbreaking save table directionality",
                                                "emoticons template paste textcolor colorpicker textpattern"
                                            ],
                                            toolbar: "forecolor backcolor insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                                            relative_urls: false,
                                            file_browser_callback: function (field_name, url, type, win) {
                                                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                                                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                                                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                                                if (type == 'image') {
                                                    cmsURL = cmsURL + "&type=Images";
                                                } else {
                                                    cmsURL = cmsURL + "&type=Files";
                                                }

                                                tinyMCE.activeEditor.windowManager.open({
                                                    file: cmsURL,
                                                    title: 'Filemanager',
                                                    width: x * 0.8,
                                                    height: y * 0.8,
                                                    resizable: "yes",
                                                    close_previous: "no"
                                                });
                                            }
                                        };
                                        tinymce.init(editor_config);
                                    </script>
                                    @error('post_content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow-lg rounded-lg mt-2 mb-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Lead</label>
                                        <input type="checkbox" id="sticky" value="{{ old('sticky') ?? 1 }}" name="sticky">
                                        <div class=" position" style="display: none;" id="sticky_position_input">
                                            <label style="display: flex;">
                                                <input id="sticky_position" type="number" min="1" name="sticky_position" value="{{ old('sticky_position') }}" placeholder="Position" style="width: 100%;border: 1px solid #ccc;padding: 5px 10px;border-radius: 4px;margin-top: 6px;">
                                            </label>
                                            @error('sticky_position')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>RSS</label>
                                        <input type="checkbox" id="rss" title="" name="rss" value="{{ old('rss') ?? 1 }}" checked="checked">
                                        @error('rss')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label>Scroll</label>
                                        <input type="checkbox" id="scroll" title="Scroll bar" name="scroll" value="{{ old('scroll') ?? 1 }}" checked="checked">
                                        @error('scroll')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>


                                    <div class="col-md-3">
                                        <label>Special</label>
                                        <input type="checkbox" id="special" title="Special Post" name="special" value="{{ old('special') ?? 1 }}" >
                                        @error('special')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group mt-4">
                                    <label>Featured Image <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="feature_thumbnail" class="form-control pmanager-input-field" type="text" name="featured_image" value="{{ old('featured_image') }}" required>
                                        <span class="input-group-btn pmanagerModal" id="featureImage">
                                            <a data-input="feature_thumbnail" data-preview="holder"
                                                    class="btn btn-primary height" style="padding:8px 13px;height: 44px;font-size: 16px;border-bottom-left-radius: 0;border-top-left-radius: 0;">Choose</a></span>
                                    </div>
                                    <span class="text-danger">{{ $errors->has('featured_image') ? $errors->first('featured_image'):''}}</span>
                                    <div id="pmanager-image-preview"></div>
                                </div>

                                <div class="form-group">
                                    <label>Featured Image Caption</label>
                                    <input name="featured_image_caption" value="{{ old('featured_image_caption') }}" type="text" maxlength="200"
                                           class="form-control">
                                    @error('featured_image_caption')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="video_url">Video URL </label>
                                    <input name="video_url" value="{{ old('video_url') }}" id="video_url" placeholder="Youtube/Facebook video link"  maxlength="350" type="text" class="form-control">
                                    @error('featured_image_caption')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group d-none">
                                    <label for="streaming_site">Video From</label>
                                    <input name="video_from" value="{{ old('video_from') }}" id="streaming_site" placeholder="facebook or youtube"  maxlength="50" type="text" class="form-control">
                                    @error('video_from')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group d-none">
                                    <label for="video_id">Video id</label>
                                    <input name="video_id" value="{{ old('video_id') }}" id="video_id"  maxlength="350" type="text" class="form-control">
                                    @error('video_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group d-none">
                                    <label for="thumbnail">Video Thumbnail</label>
                                    <input name="video_thumbnail" value="{{ old('video_thumbnail') }}" id="thumbnail"  maxlength="350" type="text" class="form-control">
                                    @error('video_thumbnail')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Reporter</label>
                                    <select class="form-control" id="reporter_id" name="reporter_id">
                                        <option value="">- Select Reporter -</option>
                                        <?php $reporters = DB::select('select id,name from reporters ORDER BY position ASC') ?>
                                        @foreach($reporters as $reporter)
                                        <option value="{{$reporter->id}}">{{$reporter->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('reporter_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group d-none">
                                    <label>Photo Optional</label>
                                    <div class="input-group">
                                        <input id="thumbnail2" class="form-control" type="text" name="reporter_photo" value="{{ old('reporter_photo') }}">
                                        <span class="input-group-btn">
                                            <a id="lfm2" data-input="thumbnail2" data-preview="holder2"
                                               class="btn btn-primary">
                                              <i class="fa fa-image"></i> Choose
                                            </a>
                                        </span>
                                        @error('reporter_photo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <img id="holder2" style="margin-top:15px;max-height:100px;">
                                </div>
                                <div class="form-group ui-front">
                                    <label for="title">Keywords</label>
                                    <input type="text" id="myTags" name="tag_list" value="{{ old('tag_list') }}" class="form-control ui-autocomplete tag__list ">
                                    @error('tag_list')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if ($timelines->isNotEmpty())
                                    <div class="form-group">
                                        <label>Timeline</label>
                                        <select class="form-control" id="timeline_id" name="timeline_id">
                                            <option value="">Select Timeline</option>
                                            @foreach($timelines as $name => $id)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('timeline_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id">Category <span class="text-danger">*</span></label>
                                            <select class="form-control" id="category_list" name="category_id" required>
                                                <option value="" disabled="" selected="">- Select Category -</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }} >{!! $category->name !!}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sub_cat_id"> Sub Category</label>
                                            <select class="form-control" id="sub_cat_list" name="sub_category_id">
                                                <option value="">Select Sub Category</option>
                                            </select>
                                            @error('sub_category_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_cat_id">Division</label>
                                            <select class="form-control" id="division_list" name="division_id">
                                                <option value="">- Division -</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{$division->id}}" {{ $division->id == old('division_id') ? 'selected' : '' }}>{{$division->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('division_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="district_list">District</label>
                                            <select class="form-control" id="district_list" name="district_id">
                                                <option value="">- District -</option>
                                            </select>
                                            @error('district_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="upazila_list">Upazila</label>
                                            <select class="form-control" id="upazila_list" name="upazila_id">
                                                <option value="">- Upazila -</option>
                                            </select>
                                            @error('upazila_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="podcast">Podcast (<small class="text-danger">Only Audio File</small>)</label>
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="podcast" value="{{ old('podcast') }}" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" accept="audio/mp3,audio/*;capture=microphone">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                  </div>
                                  @error('podcast')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="post_status">Scheduled Post?</label>
                                            <select class="form-control" id="post_status" name="post_status">
                                                <option value="1">No</option>
                                                <option value="0">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="publish_time_wrapper" style="display: none;">
                                        <div class="form-group">
                                            <label for="publish_time">Publish Time</label>
                                            <input type="datetime-local" id="publish_time" name="publish_time" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group btn__create">
                                    <div class="form-group mt-4 mb-0">
                                        <button type="submit" class="btn btn-success submit">Create Post</button>
                                        <button type="submit" value="draft" name="draft" class="btn btn-danger"
                                                style="padding-left: 15px; padding-right: 15px;">
                                           Save as Draft
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!--col-->
                </div>
            </form>
        </div>
    </main>
@endsection
@section('extra_js')
@include('back.post.post_js')
@include('back.video.js')
@endsection
