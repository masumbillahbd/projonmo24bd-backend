@extends('layouts.backend')

@section('title')
    Admin | Edit photo
@endsection

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

        #lfm {
            height: 44px;
        }

        .btn-height {
            height: 44px;
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                        <div class="card-header"><h4 class="text-center font-weight-light my-2">Edit Photo</h4></div>


                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('photo.update',['id'=>$photo->id]) }}">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="mb-1" for="title">Title</label>
                                    <input type="text" id="title" name="title" value="{{$photo->title}}" maxlenght="200"
                                           class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label>feature image</label>
                                    <div class="input-group">
                                        <input id="featured_image" class="form-control" type="text"
                                               name="featured_image" maxlenght="250" value="{{$photo->featured_image}}">
                                        <span class="input-group-btn"> <a id="feature_lfm" data-input="featured_image"
                                                                          data-preview="holder"
                                                                          class="btn btn-primary btn-height"> <i
                                                    class="fa fa-image"></i> Choose </a> </span>
                                    </div>
                                </div>

                                @if(!empty($photobody))
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label>Thumbnail</label>
                                                <div class="input-group">
                                                    <input id="thumbnail" class="form-control" type="text"
                                                           name="thumbnail[]" maxlenght="250"
                                                           value="{{$photobody->thumbnail}}">
                                                    <span class="input-group-btn"> <a id="lfm" data-input="thumbnail"
                                                                                      data-preview="holder"
                                                                                      class="btn btn-primary"> <i
                                                                class="fa fa-image"></i> Choose </a> </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Content</label>
                                                <div class="input-group">
                                                    <textarea class="form-control" id="caption" name="caption[]"
                                                              style="height: auto !important;"
                                                              rows="5">{{$photobody->caption}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mt-5">
                                            <button id="plusBtn" class="btn btn-primary">+</button>
                                        </div>
                                    </div>
                                @endif


                                @if(!empty($photobodies))
                                    @foreach($photobodies as $body)
                                        <div class="containerbox">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label>Thumbnail</label>
                                                        <div class="input-group">
                                                            <input id="thumbnail{{$body->id}}" class="form-control"
                                                                   type="text" name="thumbnail[]"
                                                                   value="{{$body->thumbnail}}">
                                                            <span class="input-group-btn"> <a id="lfm{{$body->id}}"
                                                                                              data-input="thumbnail{{$body->id}}"
                                                                                              data-preview="holder"
                                                                                              class="btn btn-primary btn-height"> <i
                                                                        class="fa fa-image"></i> Choose </a> </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Content</label>
                                                        <div class="input-group">
                                                            <textarea class="form-control" id="caption" name="caption[]"
                                                                      style="height: auto !important;"
                                                                      rows="5">{{$body->caption}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 mt-5">
                                                    <button class="btn btn-danger removeBtn">-</button>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function () {
                                                $('#lfm{{$body->id}}').filemanager('image');
                                            });
                                        </script>

                                    @endforeach
                                @else
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label>Thumbnail</label>
                                                <div class="input-group">
                                                    <input id="thumbnail" class="form-control" type="text"
                                                           name="thumbnail[]">
                                                    <span class="input-group-btn"> <a id="lfm" data-input="thumbnail"
                                                                                      data-preview="holder"
                                                                                      class="btn btn-primary "> <i
                                                                class="fa fa-image"></i> Choose </a> </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Content</label>
                                                <div class="input-group">
                                                    <textarea class="form-control" id="caption" name="caption[]"
                                                              style="height: auto !important;" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mt-5">
                                            <button id="plusBtn" class="btn btn-primary">+</button>
                                        </div>
                                    </div>

                                    <div id="append-content">

                                    </div>
                                @endif

                                <div id="append-content">
                                </div>
                                <div class="form-group mt-4 mb-0 float-right">
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

@section('extra_js')
    <script>

        $(document).ready(function () {
            $('#lfm').filemanager('image');
            $('#feature_lfm').filemanager('image');
        });
    </script>

    <script>

        $(document).ready(function () {
            let DID = 0;
            $("#plusBtn").click(function (ele) {
                ele.preventDefault();
                DID++;

                $("#append-content").append('<div class="containerbox"><div class="row"> <div class="col-md-10 mt-2"><label>Thumbnail</label><div class="form-group"><div class="input-group"><input id="thumbnail' + DID + '" class="form-control" maxlenght="250" type="text" name="thumbnail[]"><span class="input-group-btn"> <a  id="lfm' + DID + '" data-input="thumbnail' + DID + '" data-preview="holder" class="btn btn-primary btn-height"> <i class="fa fa-image"></i> Choose </a> </span></div></div> <label for="caption">Content</label><textarea class="form-control" id="caption" name="caption[]" rows="5"></textarea> </div><div class="col-md-2 mt-5"><button class="btn btn-danger removeBtn">-</button></div></div></div>')

                $("#lfm" + DID).filemanager('image');

            })

            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.containerbox').remove();
                // alert('om');
            });


        });


    </script>


@endsection

