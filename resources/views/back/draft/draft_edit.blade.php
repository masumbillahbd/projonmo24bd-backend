@extends('layouts.backend')
@section('title')
    Admin | Draft
@endsection
@section('extra_css')
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}">
    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">-->
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/> -->
    <link href='{{ asset("/assets/select/css/select2.min.css") }}' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('assets/vendors/google-code-prettify/bin/prettify.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/css/jquery.tagit.min.css" rel="stylesheet" type="text/css">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('assets/css/pmanager.css') }}" rel="stylesheet">
    
    <style>
        .body__edit #post_content_ifr {
            height: 350px !important;
        }

        .create__post svg {
            stroke: #fff !important;
            width: 18px !important;
            height: 18px !important;
            margin-right: -4px;
        }

        .select2-container, .tag__list {
            width: 100% !important;
        }
        .form-group{
            width: 100%;
        }
        .position span{
            margin-right: 10px;
        }

        .ui-front input, .ui-front{
            width: 100%;
        }

        #banner{
            text-transform: capitalize;
        }
        .form-group {
            margin-bottom: 22px;
        }
       .ui-menu.ui-widget.ui-widget-content.ui-autocomplete.ui-front{
           max-width: 300px !important;
       }
        .btn__create button{
            width: 140px;
            height: 40px;
            font-size: 18px;
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <form role="form" method="post" action="{{ route('post.store.draft2post',['id'=>$post->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-4 mt-2"></div>
                <div class="row justify-content-center">
                    <div class="col-lg-12"><a href="{{ route('post.index') }}">
                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-bars"></i> View All
                            </button>
                        </a></div>
                    <div class="col-lg-8">
                        <div class="card shadow-lg rounded-lg mt-2 mb-5">
                            <div class="card-header"><h4 class="text-center font-weight-light my-2">Create Post</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="mb-1">Headline</label>
                                    <input name="headline" value="{{$post->headline}}" type="text" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label class="mb-1">Sub Headline</label>
                                    <input name="sub_headline" value="{{$post->sub_headline}}" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="mb-1">Intro</label>
                                    <input name="excerpt" value="{{$post->excerpt}}" type="text" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class="mb-1">Post Content</label>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>
                                    <textarea id="post_content" name="post_content" class="form-control my-editor" rows="15">{{ $post->post_content }}</textarea>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow-lg rounded-lg mt-2 mb-5">
                            <div class="card-body">
                                <div class="form-group" style="width: 100px;">
                                    <label class="mb-1">Is Lead?</label>
                                    <input type="checkbox" id="sticky" value="0" name="sticky" @if($post->sticky == 1) checked="checked" @endif>
                                </div>
                                 <?php $leadpost = \App\Models\LeadPost::where('post_id', $post->id)->first(); ?>
                                <div class="form-group" style="display: none; width: 100px;" id="sticky_position_input">
                                    <label style="display: flex;">Position
                                    <input id="sticky_position" type="number" name="sticky_position"  @if($leadpost) value="{{ $leadpost->position }}"@endif>
                                    </label>
                                </div>

                                <div class="form-group mt-4">
                                    <label>Featured Image</label>
                                    <div class="input-group">
                                        <input id="thumbnail" class="form-control pmanager-input-field" type="text"
                                               name="featured_image">
                                        <span class="input-group-btn pmanagerModal" id="featureImage"> <a
                                                    data-input="thumbnail" data-preview="holder"
                                                    class="btn btn-primary height" style="padding: 11px 12px;"> <svg
                                                        class="svg-inline--fa fa-image fa-w-16" aria-hidden="true"
                                                        focusable="false" data-prefix="fa" data-icon="image" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        data-fa-i2svg=""></svg>Choose</a> </span>
                                    </div>
                                    <span class="text-danger">{{ $errors->has('featured_image') ? $errors->first('featured_image'):''}}</span>
                                    <div id="pmanager-image-preview"></div>
                                    <div class="pt-2">
                                        <img id="profileImg" class="profileImgShow" src="{{ !empty($post->featured_image) ? $post->featured_image : asset('defaults/default3.png') }}">
                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <label class="mb-1">Featured Image Caption</label>
                                    <input name="featured_image_caption" value="{{ $post->featured_image_caption }}" type="text" class="form-control" required="required">
                                </div>
                                <div class="form-group d-none">
                                    <label class="mb-1">Publisher Name</label>
                                    <input name="publisher_name" value="{{ $post->publisher_name }}" type="text" class="form-control">
                                </div>
                                <div class="form-group d-none">
                                    <label class="mb-1">Photo Optional</label>
                                    <div class="input-group">
                                        <input id="thumbnail2" class="form-control" type="text" name="reporter_photo">
                                        <span class="input-group-btn">
                                                        <a id="lfm2" data-input="thumbnail2" data-preview="holder2"
                                                           class="btn btn-primary">
                                                          <i class="fa fa-image"></i> Choose
                                                        </a>
                                                    </span>
                                    </div>
                                    <img id="holder2" style="margin-top:15px;max-height:100px;"
                                         @if($post->reporter_photo) src="{{ $post->reporter_photo }}" @endif>
                                </div>
                                <div class="form-group ui-front">
                                    <label class="mb-1" for="title">Keywords</label>
                                    <input type="text" id="myTags" name="tag_list"value="@foreach($post->Tag as $tag){{$tag->name}}, @endforeach"class="form-control ">
                                </div>
                                <div class="form-group">
                                    <label for="sub_cat_id"> Category <span class="text-danger">*</span></label>
                                    <select class="form-control" id="category_list" name="category_id[]" required="">
                                        @foreach($post->Category as $category)
                                            <option value="{!! $category->id !!}"
                                                    selected>{!! $category->name !!}</option>
                                        @endforeach
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{!! $category->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_cat_id"> Sub Category</label>
                                    <select class="form-control" id="sub_cat_list" name="sub_cat_id">
                                        <option disabled="" selected="">{{$post->sub_cat_id}}</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="special">Exclusive <span
                                                class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input type="checkbox" id="special" name="special" value="1">
                                        <span class="text-danger">{{ $errors->has('special') ? $errors->first('special'):''}}</span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="form-group mt-4 mb-0">
                                      <button type="submit" class="btn btn-success submit">Update</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"
            charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/js/tag-it.min.js" type="text/javascript"
            charset="utf-8"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>

        $(document).ready(function () {

            $("#myTags").tagit({
                 fieldName: 'tags',
                 removeConfirmation: true,
                 allowSpaces: true,
                 tagSource: [<?php echo '"'.implode('","', $tags).'"' ?>],
                 autocomplete: {
                   appendTo: ".ui-front",
                   delay: 0,
                   minLength: 2,
                   source: this.tagSource
                }
             });
            $(".ui-autocomplete").appendTo($(".ui-front"));

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

      
            // $('#category_list').select2();
            $('#division_list').select2({
                    divisions: true
                }
            );

            $('#division_list').on('change', function (e) {
                console.log(e);

                var division_id = e.target.value;

                /* Ajax */

               
            });

        });


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

@endsection

