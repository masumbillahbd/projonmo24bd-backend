@extends('layouts.backend')

@section('title')
    Admin | Add new photo
@endsection

@section('extra_css')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('assets/css/pmanager.css') }}" rel="stylesheet">
    <style>

        #lfm,
        #featureImage,
        .height {
            height: 44px;
        }
    .pmanager-file-input-field-label{
        color: white;
        padding: 0.5rem;
        font-family: sans-serif;
        border-radius: 0.3rem;
        cursor: pointer;
        margin-top: 1rem;
        background: linear-gradient(to left, #2a81c0 50%, #397baa 50%) right;
        background-size: 200%;
        transition: .5s ease-out;
    }
    .pmanager-file-input-field-label img{
        width: 50px;
    }
    </style>
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                        <div class="card-header">
                            <div class="pg__name float-left">
                                <h4 class="font-weight-light my-1">Add New Photo</h4>
                            </div>
                            <div class="pg__btn float-right">
                                <a href="{{ route('photo.index') }}" class="btn btn__view">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('photo.store') }}">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control" maxlenght="200"
                                           required="required">
                                </div>

                                <!--<div class="form-group">-->
                                <!--    <label>feature image</label>-->
                                <!--    <div class="input-group">-->
                                <!--        <input id="featured_image" class="form-control" maxlenght="250" type="text"-->
                                <!--               name="featured_image">-->
                                <!--        <span class="input-group-btn"> <a id="feature_lfm" data-input="featured_image"-->
                                <!--                                          data-preview="holder"-->
                                <!--                                          class="btn btn-primary btn-height"> <i-->
                                <!--                        class="fa fa-image"></i> Choose </a> </span>-->
                                <!--    </div>-->
                                <!--</div>-->


                                <div class="form-group">
                                    <label>Featured Image</label>
                                    <div class="input-group">
                                        <input id="thumbnail" class="form-control pmanager-input-field" type="text"
                                               name="featured_image">
                                        <span class="input-group-btn pmanagerModal" id="featureImage"> <a
                                                    data-input="thumbnail" data-preview="holder"
                                                    class="btn btn-primary height"> <svg
                                                        class="svg-inline--fa fa-image fa-w-16" aria-hidden="true"
                                                        focusable="false" data-prefix="fa" data-icon="image" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        data-fa-i2svg=""><path fill="currentColor"
                                                                               d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z"></path></svg>Choose</a> </span>
                                    </div>
                                    <span class="text-danger">{{ $errors->has('featured_image') ? $errors->first('featured_image'):''}}</span>
                                    <div id="pmanager-image-preview"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label>Thumbnail</label>
                                            <div class="input-group">
                                                <input id="thumbnail2" class="form-control" maxlenght="250" type="text"
                                                       name="thumbnail[]">
                                                <span class="input-group-btn"> <a id="lfm" data-input="thumbnail2"
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

                                <div id="append-content"></div>

                                <div class="form-group mt-4 mb-0 float-right">
                                    <button type="submit" class="btn btn-success submit">Create</button>
                                </div>


                            </form>
                        </div>

                    </div>
                </div> <!--col-->

            </div>
        </div>
    </main>

    <!--pmanagerModal open-->
    <div class="modal" id="pmanagerModal">
        <div class="modal-dialog w-80" style="max-width: 100%;">
            <div class="modal-content mt-0 mt-md-4 mtlg-4 mt-xl-4">
                <div class="modal__header d-flex align-items-center justify-content-between">
                    <div class="heading__title">
                        <h3 class="m-0">Media Gallery</h3>
                    </div>
                    <div class="btn__close">
                        <button type="button" id="modalCloseBtn" data-bs-dismiss="modal"
                                style="border: 0px !important;background: none !important;">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-x" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="#ff4500" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M18 6l-12 12"/>
                                <path d="M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="modal-body pt-0" id="modalBody">
                    <div id="modal_preloader"></div>
                    <div class="modal-body-content">
                        <!--tabs open-->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#mediaUpload" class="nav-link active" data-bs-toggle="tab" role="tab">
                                    Upload
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#allMedia" class="nav-link" data-bs-toggle="tab" role="tab">
                                    Media
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane  show active" id="mediaUpload" role="tabpanel">
                                <div class="panel-body">
                                    <form method="POST" enctype="multipart/form-data" id="image-upload"
                                          action="javascript:void(0)">
                                        <div class="row mt-4">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <input type="file" name="image" placeholder="Choose image" class="pmanager-file-input-field" id="image" hidden>
                                                    <label class="pmanager-file-input-field-label" for="image"><img src="{{ asset('defaults/img__uploader.png')}}"/></label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <img id="preview-image-before-upload"
                                                     src="{{ asset('defaults/default.jpeg')}}" alt="preview image"
                                                     style="max-height: 250px;">
                                                <div id="pmanager-server-message"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" id="submit">Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="allMedia" role="tabpanel">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="my-2 w-80">
                                                <input id="search" class="form-control rounded search-bar" type="text"
                                                       placeholder="Search by name and date" required=""
                                                       autocomplete="on">
                                            </div>
                                            <div class="row pb-1" id="realtimedata" style="text-align:center;"></div>
                                            <div class="row pb-1" id="load_more_product"
                                                 style="text-align:center;"> {{ csrf_field() }} </div>
                                            <div class="row pb-1" id="search-results" style="text-align:center;"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="pmanager-single-details mr-3 pe-3">
                                                <h6>Media Details</h6>
                                                <div class="pmanager-single-img"></div>
                                                <div class="pmanager-single-img-name"></div>
                                                <div class="pmanager-single-img-delete-permanently text-danger"
                                                     data-id="">Delete permanently
                                                </div>
                                                <a title="Copy URL" class="pmanager-single-img-copy-url"
                                                   href="javascript:void(0);"
                                                   onclick="CopyToClipboard(this.getAttribute('data-src'))" data-src="">Copy
                                                    URL</a>
                                                <span class="text-success clipboard-message"
                                                      aria-hidden="false">Copied!</span>

                                                <div class="pmanager-single-message"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--pmanagerModal end-->
        @endsection




        @section('extra_js')

            <script>
                $(document).ready(function () {
                    $('#lfm').filemanager('image');
                    $('#thumbnail2').filemanager('image');
                    $('#feature_lfm').filemanager('image');
                });
            </script>

            <script>

                $(document).ready(function () {
                    let DID = 0;
                    $("#plusBtn").click(function (ele) {
                        ele.preventDefault();
                        DID++;
                        $("#append-content").append('<div id="containerbox"><div class="row"> <div class="col-md-10 mt-2"><label>Thumbnail</label><div class="form-group"><div class="input-group"><input id="thumbnail' + DID + '" class="form-control" maxlenght="250" type="text" name="thumbnail[]"><span class="input-group-btn"> <a  id="lfm' + DID + '" data-input="thumbnail' + DID + '" data-preview="holder" class="btn btn-primary btn-height"> <i class="fa fa-image"></i> Choose </a> </span></div></div> <label for="caption">Content</label><textarea class="form-control" id="caption" name="caption[]" rows="5"></textarea> </div><div class="col-md-2 mt-5"><button class="btn btn-danger removeBtn">-</button></div></div></div>')
                        $("#lfm" + DID).filemanager('image');
                    })

                    $(document).on('click', '.removeBtn', function () {
                        $(this).closest('#containerbox').remove();
                        // alert('om');
                    });
                });
            </script>

        <!--<script src="{{ asset('assets/js/pmanager.js') }}"></script>-->
            <script type="text/javascript">
                //modal show
                $(document).ready(function () {
                    $(".pmanagerModal").click(function () {
                        $("#pmanagerModal").show()
                    })
                    $("#modalCloseBtn").click(function () {
                        $("#pmanagerModal").hide()
                        $("body").css('position', 'unset')
                    })
                })
                //image store
                $(document).ready(function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#image').change(function () {
                        let reader = new FileReader();
                        reader.onload = (e) => {
                            $('#preview-image-before-upload').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(this.files[0]);
                    });

                    $('#image-upload').submit(function (e) {
                        e.preventDefault();
                        $("#pmanager-server-message").empty();
                        let formData = new FormData(this);
                        $.ajax({
                            type: 'post',
                            url: "{{ route('pmanager.store')}}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                this.reset();
                                $("#realtimedata").show();
                                $("#preview-image-before-upload").attr('src', "{{ asset('defaults/default.jpeg')}}");
                                $("#pmanager-server-message").append('<span class="text-success">Image uploaded successfully</span>');
                            },
                            error: function (data) {
                                $("#pmanager-server-message").append('<span class="text-danger">Something is wrong</span>');
                            }
                        });
                        setTimeout(function () {
                            $("#pmanager-server-message").empty();
                        }, 10000);
                    });
                });

                // image load
                let _token = $('input[name="_token"]').val();
                load_data('', _token);

                function load_data(id = "", _token) {
                    $.ajax({
                        url: "{{ route('loadmore.pmanager') }}",
                        method: "POST",
                        data: {id: id, _token: _token},
                        success: function (data) {
                            $('#load_more_button').remove();
                            $('#load_more_product').append(data);
                        }
                    })
                }

                // image load
                $(document).on('click', '#load_more_button', function () {
                    var id = $(this).data('id');
                    $('#load_more_button').html('<i style="padding:0 25px;" class="ai ai-loader"></i>');
                    load_data(id, _token);
                });

                // pmanagerUse for you content
                $(document).on('click', '.pmanagerUse', function (e) {
                    e.preventDefault();
                    let pmanagerUse = $(this).attr("data-id");
                    if (pmanagerUse) {
                        $("#pmanager-image-preview").html('')
                        $.ajax({
                            url: "{{ route('pmanager.single') }}/" + pmanagerUse,
                            type: "get",
                            dataType: "json",
                            success: function (result) {
                                $(".pmanager-input-field").val(result.photo);
                                $("#pmanager-image-preview").append('<img src="' + result.photo + '"/>')
                                $("#pmanagerModal").hide();
                            },
                            error: function (result) {
                                console.log('error');
                            }
                        })
                    }
                });

                // single Image show
                $(document).on('click', '.pmanagerShow', function (e) {
                    e.preventDefault();
                    let pmanagerShow = $(this).attr("data-id");
                    $(".pmanager-single-img").empty();
                    $(".pmanager-single-img-name").empty();
                    $(".pmanager-single-img-copy-url").show();
                    $(".pmanager-single-img-delete-permanently").show();
                    if (pmanagerShow) {
                        $.ajax({
                            url: "{{ route('pmanager.single') }}/" + pmanagerShow,
                            type: "get",
                            dataType: "json",
                            success: function (result) {
                                $(".pmanager-single-img").append('<img src="' + result.photo + '"/>');
                                $(".pmanager-single-img-name").append('<span>' + result.name + '</span>');
                                $(".pmanager-single-img-copy-url").attr('data-src', result.photo);
                                $(".pmanager-single-img-delete-permanently").attr('data-id', result.id);
                            },
                            error: function (result) {
                                console.log('error');
                            }
                        })
                    }
                });

//delete
$(document).on('click', '.pmanager-single-img-delete-permanently', function (ele) {
    ele.preventDefault();
    let photoDeleteID = $(this).attr("data-id");
    if (photoDeleteID){
      let confirmation = confirm("Are you sure?");
      if(confirmation){
        $(".pmanager-single-message").show();
        $(".pmanager-single-message").empty();
        $.ajax({
            url: "{{ route('pmanager.delete') }}/"+photoDeleteID,
            type: "get",
            dataType: "json",
            success: function (result){
              $(".pmanager-single-message").append('<span class="text-success">Successfully Deleted</span>');
              $(".pmanager-single-img").empty();
              $(".pmanager-single-img-name").empty();
              $(".pmanager-single-img-copy-url").attr('data-src', '');
              $(".pmanager-single-img-delete-permanently").attr('data-id', '');
              $(".pmanager-single-img-copy-url").hide();
              $(".pmanager-single-img-delete-permanently").hide();
            },
            error: function(result){
              $(".pmanager-single-message").append('<span class="text-danger">Something Error</span>');
            }
        })
        setTimeout(function() {
          $(".pmanager-single-message").hide();
        }, 3000);
      }
    }
})

                //copy URL
                function CopyToClipboard(txt) {
                    let input = document.createElement('input');
                    input.value = txt;
                    document.body.append(input);
                    input.select();
                    document.execCommand('copy');
                    input.remove();
                    $(".clipboard-message").show();

                    setTimeout(function () {
                        $(".clipboard-message").hide();
                    }, 2000);
                }

                //live search
                $(document).on('keyup', '#search', function () {
                    let searchQuery = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    if (searchQuery.length > 0) {
                        $('#search-results').show();
                        $.ajax({
                            method: 'POST',
                            url: '{{ route("pmanager.live.search") }}',
                            dataType: 'json',
                            data: {
                                searchQuery: searchQuery
                            },
                            success: function (results) {
                                let result = '';
                                $('#realtimedata').hide();
                                $('#load_more_product').hide();
                                $('#search-results').html('');
                                if (Object.keys(results).length !== 0) {
                                    $.each(results, function (index, value) {
                                        let photoName = value.name;
                                        if (photoName.length > 10) {
                                            photoName = photoName.substring(0, 10) + '...';
                                        }
                                        result = '<div class="pmanager-box col-md-2"><img class="pmanager-img pmanagerUse" data-id="' + value.id + '" src="' + value.photo + '" alt="' + value.id + '"/><br><span>' + photoName + '</span><div class="pmanagerShow" data-id="' + value.id + '">view</div></div>'
                                        $('#search-results').append(result);
                                    })
                                } else {
                                    result = '<div class="col-md-12 col-lg-12 col-12 mt-2 mb-2 text-center">No data found</div>';
                                    $('#search-results').append(result);
                                }
                            },
                            error: function (results) {
                                console.log(results)
                            }
                        });
                    } else {
                        $('#realtimedata').show();
                        $('#load_more_product').show();
                        $('#search-results').hide();
                    }
                });

                //realtimedata
                function loadXMLDoc() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("realtimedata").innerHTML =
                                this.responseText;
                        }
                    };
                    xhttp.open("GET", "{{ route('realtime.pmanager') }}", true);
                    xhttp.send();
                }

                setInterval(function () {
                    loadXMLDoc();
                }, 1000)
                window.onload = loadXMLDoc;
            </script>
@endsection

