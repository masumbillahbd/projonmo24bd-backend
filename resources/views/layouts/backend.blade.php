<!DOCTYPE html>
<html lang="en">
<head>
    <?php $setting = \App\Models\Setting::find(1); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" href="{{ url($setting->favicon) }}">
    <link rel="shortcut icon" href="{{ url($setting->favicon) }}">
    <!-- important -->
    <link href="{{ asset('/back/css/de.css') }}" rel="stylesheet">
    <link href="{{ asset('/back/boot4.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset('assets/js/jquery-2.2.4.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('/assets/fonts/font-awesome/font-awesome.min.js') }}" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css"
          rel="stylesheet"/>
    <link href="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/toastr/toastr.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/css/jquery.tagit.min.css" rel="stylesheet"
          type="text/css">

    @yield('extra_css')
    <link href='{{ asset("/assets/select/css/select2.min.css") }}' rel='stylesheet' type='text/css'>
    <script src='{{ asset("/assets/select/js/select2.js") }}' type='text/javascript'></script>
    <link href="{{ asset('/back/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/back/css/button.css') }}" rel="stylesheet">
    {{--    <link href="{{ asset('/back/css/mixed.css') }}" rel="stylesheet">--}}
    <style>
        /*select2 */
        :focus-visible {
            outline: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #6e707e !important;
        }

        .select2-container .select2-selection--single {
            display: block;
            width: 100%;
            height: 44px !important;
            font-size: 14px;
            padding: .375rem .75rem;
            font-weight: 400;
            line-height: 1.5;
            color: #6e707e;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d1d3e2;
            border-radius: 2px;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;

        }

        .select2-selection__arrow {
            height: 42px !important;
        }

        .tox-notifications-container {
            display: none;
        }

        .table-responsive {
            padding-bottom: 10px;
        }
    </style>

</head>

<body class="nav-md sb-nav-fixed" id="backend" style="background: ;">


@include('back.parts.header')
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('back.parts.sidebar')
    </div>

    <div id="layoutSidenav_content">
        @yield('content')

        @include('back.parts.footer')
    </div>
</div>
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
                             class="icon icon-tabler icon-tabler-x" width="34"
                             height="34" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="#fff" fill="none" stroke-linecap="round"
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
                                                <input type="file" name="image" placeholder="Choose image"
                                                       class="pmanager-file-input-field" id="image" hidden>
                                                <label class="pmanager-file-input-field-label" for="image"><img
                                                        src="{{ asset('defaults/img__uploader.png')}}"/></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <img id="preview-image-before-upload"
                                                 src="{{ asset('defaults/default.jpeg')}}" alt="preview image"
                                                 style="max-height: 250px;">
                                            <div id="pmanager-server-message"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary submitButton_101" id="submit">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="allMedia" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="my-2">
                                        <input id="search" class="form-control rounded search-bar" type="text"
                                               placeholder="Search by name and date" required=""
                                               autocomplete="on">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="pb-1 row" id="realtimedata" style="text-align:center;"></div>
                                    <div class="pb-1" id="load_more_product"
                                         style="text-align:center;"> {{ csrf_field() }} </div>
                                    <div class="pb-1" id="search-results" style="text-align:center;"></div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="pmanager-single-details mr-3 pe-3">
                                        <h4>Media Details</h4>
                                        <div class="pmanager-single-img"></div>
                                        <div class="pmanager-single-img-name"></div>
                                        <div class="pmanager-single-img-delete-permanently text-danger"
                                             data-id="">Delete
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
<!--pmanagerModal end-->

@if(Session::has('success-toaster'))
    <div id="toater">
        <div>
            <p>{{ Session::get('success-toaster') }}</p>
        </div>
    </div>
@endif

<!-- important link-->
<script src="{{ asset('assets/js/jquery-2.2.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.map"></script>
<script src="{{ asset('/back/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/back/js/js.js') }}"></script> <!-- sb-admin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js.map"></script>

<script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
<!-- //toaster notice -->
<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            $('#toater').fadeOut(1000);
        }, 1500);
    });
</script>

<script type="text/javascript">
    // get file and show
    $(document).ready(function () {

        $("#file_preview_01").hide();

        $('.getInputFile').change(function (e) {

            $("#file_preview_01").show();

            $file_name = e.target.files[0].name;
            $file_size = e.target.files[0].size;
            $file_size = $file_size / 1000;
            $file_size = parseInt($file_size);

            var reader = new FileReader();
            reader.onload = function (e) {
                $("#file_preview_02").hide()
                var img = $('<img class="order-first" id="file_preview_02">'); //Equivalent: $(document.createElement('img'))
                //   $('#file_preview_02').hide();
                img.attr('src', e.target.result);
                img.appendTo('#file_preview_01');
                $('#file_preview_name_03').html($file_name);
                $('#file_preview_size_04').html($file_size + ' KB');
            }
            //   $('#file_preview_01').after("<span id='file_preview_name_03'></span>");
            reader.readAsDataURL(e.target.files['0']);
        })
    });
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script src="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
        type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/js/tag-it.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=6eEQ6t5njG6CbhhmQfj9U1vzpp1BalkmsOf0S56O',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=6eEQ6t5njG6CbhhmQfj9U1vzpp1BalkmsOf0S56O'
    };
</script>
<script src="{{ asset('assets/js/stand-alone-button.js')}}"></script>

<script type="text/javascript">
    $('#lfm').filemanager('image');
    $('.delete_confirm').click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>

@yield('extra_js')

<script>
    @if(Session::has('message'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.success("{{ session('message') }}");
    @endif

        @if(Session::has('success'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.success("{{ session('success') }}");
    @endif

        @if(Session::has('danger'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.error("{{ session('danger') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>

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

        // Image preview before upload
        $('#image').change(function () {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        // Form submit event
        $('#image-upload').submit(function (e) {
            e.preventDefault();

            // Disable the submit button to prevent double submission
            $('#submit').prop('disabled', true);
            $('#submit').text('Submitting...');

            // Clear previous messages
            $("#pmanager-server-message").empty();

            let formData = new FormData(this);

            // AJAX request to submit the form
            $.ajax({
                type: 'post',
                url: "{{ route('pmanager.store')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $(".pmanager-input-field").val(data);
                    $("#pmanager-image-preview").append('<img src="' + data + '"/>')
                    this.reset(); // Reset the form after success
                    $("#realtimedata").show();
                    $("#preview-image-before-upload").attr('src', "{{ asset('defaults/default.jpeg')}}"); // Reset the preview
                    $("#pmanager-server-message").append('<span class="text-success">Image Uploaded Successfully</span>');

                    // Re-enable the submit button and change the text
                    $('#submit').prop('disabled', false);
                    $('#submit').text('Submit');
                    $("#pmanagerModal").hide();
                },
                error: function (data) {
                    // Display error message if the request fails
                    $("#pmanager-server-message").append('<span class="text-danger">Something is wrong</span>');

                    // Re-enable the submit button and change the text
                    $('#submit').prop('disabled', false);
                    $('#submit').text('Try Again');
                }
            });
            // Clear the message after 10 seconds
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
        if (photoDeleteID) {
            let confirmation = confirm("Are you sure?");
            if (confirmation) {
                $(".pmanager-single-message").show();
                $(".pmanager-single-message").empty();
                $.ajax({
                    url: "{{ route('pmanager.delete') }}/" + photoDeleteID,
                    type: "get",
                    dataType: "json",
                    success: function (result) {
                        $(".pmanager-single-message").append('<span class="text-success">Successfully Deleted</span>');
                        $(".pmanager-single-img").empty();
                        $(".pmanager-single-img-name").empty();
                        $(".pmanager-single-img-copy-url").attr('data-src', '');
                        $(".pmanager-single-img-delete-permanently").attr('data-id', '');
                        $(".pmanager-single-img-copy-url").hide();
                        $(".pmanager-single-img-delete-permanently").hide();
                    },
                    error: function (result) {
                        $(".pmanager-single-message").append('<span class="text-danger">Something Error</span>');
                    }
                })
                setTimeout(function () {
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
                            result = '<div class="pmanager-box col-md-2 col-4"><img class="pmanager-img pmanagerUse" data-id="' + value.id + '" src="' + value.photo + '" alt="' + value.id + '"/><br><span>' + photoName + '</span><div class="pmanagerShow" data-id="' + value.id + '">view</div></div>'
                            $('#search-results').append(result);
                        })
                    } else {
                        result = '<div class="text-center">No Data Found</div>';
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
    // function loadXMLDoc() {
    //     var xhttp = new XMLHttpRequest();
    //     xhttp.onreadystatechange = function () {
    //         if (this.readyState == 4 && this.status == 200) {
    //             document.getElementById("realtimedata").innerHTML =
    //                 this.responseText;
    //         }
    //     };
    //     xhttp.open("GET", "{{ route('realtime.pmanager') }}", true);
    //     xhttp.send();
    // }

    // setInterval(function () {
    //     loadXMLDoc();
    // }, 1000)

    // window.onload = loadXMLDoc;
</script>

<script>
$("input[type='number']").on("keyup", function() {
    this.value = this.value.replace(/[^0-9]/g, "");
});



    const input = document.querySelector('.image-uploader__input');
    const previewImage = document.querySelector('.image-uploader__preview-image');
    const removeBtn = document.getElementById('removeImage');
    const defaultImage = "{{ asset('/defaults/default3.png') }}";

    input.addEventListener('change', () => {
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = (event) => {
            previewImage.src = event.target.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });

    removeBtn.addEventListener('click', () => {
        input.value = ""; // Clear file input
        previewImage.src = defaultImage; // Reset preview image
    });
</script>

</body>
</html>
