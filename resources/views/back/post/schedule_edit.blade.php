@extends('layouts.backend')
@section('title')
    Admin | Edit Schedule Post
@endsection
@section('extra_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/css/jquery.tagit.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/pmanager.css') }}" rel="stylesheet">        
    <style>
        .body__edit #post_content_ifr{
            height: 405px !important;
        }
        .tag__list {
            width: 100% !important;
        }
        .btn__create button, .btn__create a{
            width: 140px;
            height: 40px;
            font-size: 18px;
        }
        .textarea{
            display: block;
            width: 100%;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
    </style>
@endsection
@section('content')
@php
    $category_id = json_decode($post->category_id, true);
    $sub_category_id = json_decode($post->sub_category_id, true);
    $division_id = json_decode($post->division_id, true);
    $district_id = json_decode($post->district_id, true);
    $upzila_id = json_decode($post->upazila_id, true);
    $array = json_decode($post->tag_list, true); // Decode as an array
    // Ensure $array is an array and not null
    if (is_array($array)) {
        $modifiedArray = array_map(function ($item) {
            return preg_replace('/^\S+\s/', '', $item); // Remove first word
        }, $array);
        // Join modified elements with a comma and a space
        $tag_list = implode(', ', $modifiedArray);
    } else {
        $tag_list = is_string($array) ? $array : ''; // Handle single string case
    }
@endphp


    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                
            </div>
        
            <form role="form" method="post" action="{{ route('post.schedule.update',['id'=>$post->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-4 mt-2"></div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg rounded-lg mt-2 mb-5">
                            <div class="card-header"><h4 class="text-center font-weight-light my-2">Edit Schedule Post</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="mb-1">Headline <span class="text-danger">*</span></label>
                                    <input name="headline" value="{{ old('headline') ?? $post->headline }}" type="text" maxlength="250" class="form-control" required>
                                    @error('headline')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="mb-1">Sub Headline</label>
                                    <input name="sub_headline" value="{{ old('sub_headline') ?? $post->sub_headline}}" type="text" maxlength="100" class="form-control">
                                    @error('sub_headline')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="mb-1">Excerpt (Intro) <span class="text-danger">*</span></label>
                                    <textarea name="excerpt" maxlength="400" rows="5" class="textarea" required>{!! old('excerpt') ?? $post->excerpt !!}</textarea>
                                    @error('excerpt')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group body__edit">
                                    <label class="mb-1">Post Content <span class="text-danger">*</span></label>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>
                                    <textarea id="post_content" name="post_content" class="form-control my-editor" rows="15">{{ old('post_content') ?? $post->post_content }}</textarea>
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
                                    <div class="col-md-4">
                                        <label class="mb-1">Is Lead?</label>
                                        <input type="checkbox" id="sticky" value="{{ old('sticky') ?? 1 }}" name="sticky" @if($post->sticky == 1) checked="checked" @endif>
                                        <?php $leadpost = \App\Models\LeadPost::where('post_id', $post->id)->first(); ?>
                                        <div  @if($post->sticky == 1)  @else style="display:none;" @endif id="sticky_position_input">
                                            <label style="display: flex;">
                                                <input id="sticky_position" type="number" @if($leadpost) value="{{ old('sticky_position') ?? $leadpost->position }}"@endif name="sticky_position" placeholder="Position" style="width: 100%;border: 1px solid #ccc;padding: 5px 10px;border-radius: 4px;margin-top: 6px;">
                                            </label>
                                        </div>
                                        <?php unset($leadpost) ?>
                                    </div>
                                    
                                <div class="col-md-4">
                                    <label class="mb-1">RSS</label>
                                    <input type="checkbox" id="rss" name="rss" value="{{ old('rss') ?? $post->rss }}" @if($post->rss == 1) checked="checked" @endif>
                                </div>
                                   
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Featured Image <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input id="feature_thumbnail" class="form-control pmanager-input-field" type="text" value="{{ old('featured_image') ?? $post->featured_image }}" name="featured_image" required>
                                            <span class="input-group-btn pmanagerModal" id="featureImage"> <a
                                                        data-input="feature_thumbnail" data-preview="holder"
                                                        class="btn btn-primary height" style="padding:8px 13px;height: 44px;font-size: 16px;border-bottom-left-radius: 0;border-top-left-radius: 0;">Choose</a></span>
                                        </div>
                                        
                                        @error('featured_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div id="pmanager-image-preview"></div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mb-1">Featured Image Caption</label>
                                                <input name="featured_image_caption" value="{{ old('featured_image_caption') ??  $post->featured_image_caption}}" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-1">Publisher Name</label>
                                    <input name="publisher_name" value="{{ old('publisher_name') ?? $post->publisher_name }}" type="text" class="form-control">
                                </div>
                                </div>
                                
                                
                                <div class="col-md-12">
                                <div class="form-group ui-front">
                                    <label class="mb-1" for="title">Keywords <span class="text-danger">(Do not use # ! @ / " ' in this field)</span></label>
                                    <input type="text" id="myTags" name="tag_list" value="{{ $tag_list }}"class="form-control ">
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                          
                                                <label for="category_list"> Category <span class="text-danger">*</span></label>
                                                <select class="form-control" id="category_list" name="category_id" required>
                                                    <option value="{{ $category_id }}" selected>{{ category_name($category_id) }}</option>
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
                                                <label for="sub_cat_list"> Sub Category</label>
                                                <select class="form-control" id="sub_cat_list" name="sub_category_id">
                                                    <option value="">--Select Sub Category--</option>
                                                    <option value="{!! $post->sub_category_id !!}" selected>{{ sub_category_name($sub_category_id) ?? '' }}</option>
                                                </select>
                                                
                                                @error('sub_category_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="division_list">Division</label>
                                            <select class="form-control" id="division_list" name="division_id" >
                                                <option value="{!! $post->division_id !!}" selected>{{ division_name($division_id) }}</option>

                                                @foreach($divisions as $division)
                                                    <option value="{{$division->id}}" {{ $division->id == old('division_id') ? 'selected' : '' }}>{{$division->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('division_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="district_list">District</label>
                                            <select class="form-control" id="district_list" name="district_id" >
                                                <option value="{!! $post->district_id !!}" selected>{{ district_name($district_id) }}</option>
                                            </select>
                                            @error('district_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="upazila_list">Upazila</label>
                                            <select class="form-control" id="upazila_list" name="upazila_id" >
                                                <option value="{!! $post->upazila_id !!}" selected>{{ upazila_name($upzila_id) }}</option>
                                            </select>
                                            @error('upazila_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6" id="publish_time_wrapper">
                                            <div class="form-group">
                                                <label class="mb-1" for="publish_time">Publish Time</label>
                                                <input type="datetime-local" id="publish_time" name="publish_time" class="form-control" 
                                                    value="{{ old('publish_time', $post->publish_time ? date('Y-m-d\TH:i', strtotime($post->publish_time)) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                                
                                <div class="form-group btn__create">
                                    <div class="form-group mt-4 mb-0">
                                      <button type="submit" class="btn btn-success submit">Update Post</button>
                                        <a href="{{ route('post.index') }}" class="btn btn-danger submit">Cancel</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/js/tag-it.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#myTags").tagit({
        singleField: true,
        singleFieldNode: $('#mySingleField'),
        allowSpaces: true,
        minLength: 2,
        removeConfirmation: true,
        tagSource: function(request, response ) {
            let keyword = request.term;
            $.ajax({
                url: "{{ route('tagLiveSearch') }}/"+keyword, 
                data: { term:request.term },
                dataType: "json",
                success: function( data ) {
                    response( $.map( data, function( item ) {
                        return {
                            label: item.name,
                            value: item.name
                        }
                    }));
                }
            });
        }});
    });
</script>

    <script>

        $(document).ready(function () {

            let post_status = $("#post_status");
            post_status.click(function () {
                if (post_status.is(':checked')) {
                    post_status.val(1);  // checked
                } else {
                    post_status.val(0);
                }
            });


            let sticky = $("#sticky");
            if (sticky.is(':checked')) {
                $("#sticky_position_input").css("display", "block");
            }
            sticky.on('click', function () {
                if (sticky.is(':checked')) {
                    sticky.val(1);  // checked
                    $("#sticky_position_input").css("display", "block");
                } else {
                    sticky.val(0);
                    $("#sticky_position_input").css("display", "none");
                    $("#sticky_position").val('');
                }
            });


            let watermark = $("#watermark");
            watermark.click(function () {
                if (watermark.is(':checked')) {
                    watermark.val(1);  // checked
                } else {
                    watermark.val(0);
                }
            });


            let show_user_photo = $("#show_user_photo");
            show_user_photo.click(function () {
                if (show_user_photo.is(':checked')) {
                    show_user_photo.val(1);  // checked
                } else {
                    show_user_photo.val(0);
                }
            });

            $('#lfm').filemanager('image');
            $('#lfm2').filemanager('image');
      
            $('#category_list').select2();
            $('#reporter_id').select2();
            $('#division_list').on('change', function (e) {
                var division_id = e.target.value;
            });
        });
        
        $(document).ready(function () {
            document.getElementById("sticky_position").addEventListener("keyup", function() {
              this.value = this.value.replace(/[^0-9]/g,"");
            });
        })

    </script>

    <script>
        $(document).ready(function () {
          //ajax category subCsategory
          $('#category_list').on('change', function (e) {
              var category_id = e.target.value;
              console.log(category_id);
              if (category_id) {
                  $.ajax({
                      url: "{{ route('category.subcategory.ajax') }}/" + category_id,
                      type: "get",
                      dataType: "json",
                      success: function (data) {
                          $("#sub_cat_list").empty();
                          $("#sub_cat_list").append('<option selected value="">--Select Sub Category--</option>')
                          $.each(data, function (key, value) {
                            // console.log(value.id);
                              $('#sub_cat_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                          })
                      }
                  })
              } else {
              }
          });

        });
    </script>

<script>
    $(document).ready(function() {
        //ajax district
        $('#division_list').on('change', function (e) {
            var division_id = e.target.value;
            
            $("#district_list").empty();
            $("#district_list").append('<option selected  value="">Select District</option>');
            $("#upazila_list").empty();
             $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
            
            if(division_id){
            $.ajax({
                url:"{{ route('division.district') }}/"+division_id,
                type:"get",
                dataType:"json",
                
                success:function(data){
                  $("#district_list").empty();
                $("#district_list").append('<option selected  value="">Select District</option>');
                  $.each(data,function(key, value){
                    $('#district_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                  })
                }
              })
            }else{
             $("#district_list").empty();
             $("#district_list").append('<option selected  value="">Select District</option>');
             $("#upazila_list").empty();
             $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
            }
        });
        
        //ajax upazila
        $('#district_list').on('change', function (e) {
            var district_id = e.target.value;
            
            $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
            
            if(district_id){
            $.ajax({
                url:"{{ route('district.upazila') }}/"+district_id,
                type:"get",
                dataType:"json",
                
                success:function(data){
                    // alert('ok');
                    $("#upazila_list").empty();
                    $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
                  $.each(data,function(key, value){
                    $('#upazila_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                  })
                }
              })
            }else{
             $("#upazila_list").empty();
             $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
            }
        });
       
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.profile-img-input').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.profileImgShow').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    });
</script>

@include('back.video.js')

@endsection