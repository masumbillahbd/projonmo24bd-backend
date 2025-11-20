@extends('layouts.backend')

@section('extra_css')
    <!--<link rel="stylesheet" href="{{ asset('assets/css/custom.min.css') }}">-->
    <link rel="stylesheet" href="{{ asset('assets/vendors/google-code-prettify/bin/prettify.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/css/jquery.tagit.min.css" rel="stylesheet"
          type="text/css">
    <style>
        .ui-autocomplete {
            top: 65px !important;
            left: 10px !important;
        }
    </style>

@endsection



@section('content')


<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                    <div class="card-header"><h4 class="text-center font-weight-light my-2">Edit Headline</h4></div>
                    <div class="card-body">
                        <form id="create_video" method="post" action="{{ route('headline.update', ['id' => $headline->id])}}" name="headline" >
                                {{ csrf_field() }}
                            <label class="small mb-1" for="title">Title</label>
                                        <div class="form-group">
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>
                                            <textarea id="post_content" name="title"
                                                      class="form-control my-editor"
                                                      rows="15"> {{ $headline->title }} </textarea>
                                                      
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
                            <div class="form-group">
                                <input type="radio" id="flash" name="type" value="1" required="required">
                                <label for="flash">Flash</label>
                                <input type="radio" id="ticker" name="type" value="2">
                                <label for="ticker">Ticker</label>

                            </div>            
                            <div class="form-group">
                                <div class="form-group mt-4 mb-0">
                                    <button type="submit" class="btn btn-success submit">Create</button>
                                </div>
                            </div>
                            
                            
                        </form>
                    </div>
                    
                </div>
            </div> <!--col-->
            
            
            
        </div>
    </div>
</main>

<script type="text/javascript">
  document.forms['headline'].elements['type'].value={{ $headline->type }}
</script>
   
@endsection


