@extends('layouts.backend')
<title>General Settings</title>
@section('extra_css')
    <style>
        .form-horizontal .form-group {
            margin-right: 0px;
            margin-left: 0px;
        }

        .my-file-icon333 label {
            float: left;
            font-size: 11px !important;
            background: #ccc;
            width: 18px;
            height: 18px;
            padding: 3px 7px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .my-file-icon333 label:hover {
            cursor: help;
        }

        .setting__header {
            background: #7c7c7c1c;
            padding: 1px 10px 1px;
            line-height: 1;
            border-radius: 2px;
            height: 39px;
        }

        .form-control {
            border: none !important;
            -webkit-box-shadow: inset 0 0px 2px rgb(0 0 0 / 23%) !important;
            box-shadow: inset 0 0px 2px rgb(0 0 0 / 23%) !important;
        }

        .setting__body .admin__img .form-group {
            padding: 20px 10px;
            box-shadow: 0px 0px 12px #bbbbbb;
            border-radius: 5px;
        }
    </style>
@endsection

@section('extra_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>
    <script src="{{ asset('assets/vendors/switchery/dist/switchery.min.js') }}"></script>
    <script>tinymce.init({selector: 'textarea'});</script>
    <script>
        $(document).ready(function () {

            $('.toggle_banner_status').change(function () {
                var sm_banner = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('sm_banner_status') }}",
                    data: {'sm_banner': sm_banner, 'id': id},
                    success: function (data) {
                        toastr.success(data.success)
                    }
                });
            });

            $('.scrollBarToggle').change(function () {
                var scroll_bar = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('scrollBarToggle') }}",
                    data: {'scroll_bar': scroll_bar, 'id': id},
                    success: function (data) {
                        toastr.success(data.success)
                    }
                });
            });

            $('.menuBarToggle').change(function () {
                var desktop_menu_bar = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('menuBarToggle') }}",
                    data: {'desktop_menu_bar': desktop_menu_bar, 'id': id},
                    success: function (data) {
                        toastr.success(data.success)
                    }
                });
            });

            $('.popularTagToggle').change(function () {
                var popular_tag = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('popularTagToggle') }}",
                    data: {'popular_tag': popular_tag, 'id': id},
                    success: function (data) {
                        toastr.success(data.success)
                    }
                });
            });


            //image preview
            // Meta Image
            const input2 = document.getElementById('imageFile2');
            const previewImage2 = document.getElementById('preview-image2');
            input2.addEventListener('change', () => {
                const file2 = input2.files[0]; // <-- fixed this line
                const reader2 = new FileReader();
                reader2.onload = (event) => {
                    previewImage2.src = event.target.result;
                };
                if (file2) {
                    reader2.readAsDataURL(file2);
                }
            });

            const input3 = document.getElementById('imageFile3');
            const previewImage3 = document.getElementById('preview-image3');
            input3.addEventListener('change', () => {
                const file3 = input3.files[0]; // <-- fixed this line
                const reader3 = new FileReader();
                reader3.onload = (event) => {
                    previewImage3.src = event.target.result;
                };
                if (file3) {
                    reader3.readAsDataURL(file3);
                }
            });

            const input4 = document.getElementById('imageFile4');
            const previewImage4 = document.getElementById('preview-image4');
            input4.addEventListener('change', () => {
                const file4 = input4.files[0]; // <-- fixed this line
                const reader4 = new FileReader();
                reader4.onload = (event) => {
                    previewImage4.src = event.target.result;
                };
                if (file4) {
                    reader4.readAsDataURL(file4);
                }
            });

        })
    </script>
@endsection
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-12 col-md-10 col-sm-12 m-auto">
                    <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                        <div class="card-header"><h4 class="text-center font-weight-light my-2">Website Setup</h4></div>
                        <div class="card-body">
                            <form action="{{ route('general_setting.update') }}" enctype="multipart/form-data"
                                  method="post" id="demo-form2" data-parsley-validate
                                  class="form-horizontal form-label-left">
                                {{ csrf_field() }}

                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Site Information</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Site URL</label>
                                                    <input class="form-control py-4" id="inputFirstName" type="text"
                                                           name="site_url"
                                                           value="{{ $setting->site_url }}"
                                                           placeholder="www.yourdomain.com">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Website Name</label>
                                                    <input class="form-control py-4" id="inputFirstName" type="text"
                                                           name="site" value="{{ $setting->site }}"
                                                           placeholder="Bangla News">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Website Title</label>
                                                    <input class="form-control py-4" id="site_title" type="text"
                                                           name="site_title" value="{{ $setting->site_title }}"
                                                           placeholder="News Portal | Best performance news website Bangladesh">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>File Information</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="admin__img mt-5">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="my-file-icon333">
                                                            <label for="" data-toggle="tooltip" data-placement="top"
                                                                   title="Please use standard logo size"><i
                                                                    class="fa fa-info"></i></label>
                                                        </div>
                                                        <label class="mb-5" for="inputFirstName"
                                                               style="margin-right: 18px;">Website Logo:</label>

                                                        <div class="image-uploader">
                                                            <label for="imageFile" class="image-uploader__label">
                                                                <img src="{{ asset($setting->logo) ?? asset('/defaults/default3.png') }}" alt="Preview image"
                                                                     class="image-uploader__preview-image img-thumbnail p-1"
                                                                     style="width: 170px; height: 90px;">
                                                                <input type="file" name="logo" class="image-uploader__input"
                                                                       id="imageFile" accept="image/*">
                                                            </label>
                                                            @error('logo')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="my-file-icon333">
                                                            <label for="" data-toggle="tooltip" data-placement="top"
                                                                   title="Meta Image size should be width: 640px & height: 360px"><i
                                                                    class="fa fa-info"></i></label>
                                                        </div>
                                                        <label class="mb-5" for="inputFirstName">Meta Image: </label>

                                                        <div class="image-uploader">
                                                            <label for="imageFile2" class="image-uploader__label">
                                                                <img id="preview-image2" src="{{ asset($setting->meta_image) ?? asset('/defaults/default3.png') }}" alt="Preview image"
                                                                     class=" img-thumbnail p-1"
                                                                     style="width: 170px; height: 90px;">
                                                                <input type="file" name="meta_image" class="image-uploader__input"
                                                                       id="imageFile2" accept="image/*">
                                                            </label>
                                                            @error('meta_image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="my-file-icon333">
                                                            <label for="" data-toggle="tooltip" data-placement="top"
                                                                   title="Favicon size should be width: 100px & height: 100px"><i
                                                                    class="fa fa-info"></i></label>
                                                        </div>
                                                        <label class="mb-5" for="inputFirstName">Favicon:</label>
                                                        <div class="image-uploader">
                                                            <label for="imageFile3" class="image-uploader__label">
                                                                <img id="preview-image3" src="{{ asset($setting->favicon) ?? asset('/defaults/default3.png') }}" alt="Preview image"
                                                                     class="image-uploader__preview-image img-thumbnail p-1"
                                                                     style="width: 170px; height: 90px;">
                                                                <input type="file" name="favicon" class="image-uploader__input"
                                                                       id="imageFile3" accept="image/*">
                                                            </label>
                                                            @error('favicon')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="my-file-icon333">
                                                            <label for="" data-toggle="tooltip" data-placement="top"
                                                                   title="Lazy image size should be width: 640px & height: 360px"><i
                                                                    class="fa fa-info"></i></label>
                                                        </div>
                                                        <label class="mb-5" for="inputFirstName">Preloader:</label>
                                                        <div class="image-uploader">
                                                            <label for="imageFile4" class="image-uploader__label">
                                                                <img id="preview-image4" src="{{ asset($setting->lazy_image) ?? asset('/defaults/default3.png') }}" alt="Preview image"
                                                                     class="image-uploader__preview-image img-thumbnail p-1"
                                                                     style="width: 170px; height: 90px;">
                                                                <input type="file" name="lazy_image" class="image-uploader__input"
                                                                       id="imageFile4" accept="image/*">
                                                            </label>
                                                            @error('lazy_image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Meta Information</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Meta Title</label>
                                                    <input class="form-control py-4" id="inputFirstName" type="text"
                                                           name="meta_title" value="{{ $setting->meta_title }}"
                                                           placeholder="News Portal | Best performance news website Bangladesh">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Meta Keywords</label>
                                                    <input class="form-control py-4" id="inputFirstName" type="text"
                                                           name="meta_keywords" value="{{ $setting->meta_keywords }}"
                                                           placeholder="news, bdnews, politics, sports">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Meta Description (<span
                                                            class="text-danger">Standard Between 155 to 160 characters</span>
                                                        )</label>
                                                    <input class="form-control py-4" id="inputFirstName" type="text"
                                                           name="meta_description"
                                                           value="{{ $setting->meta_description }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="inputFirstName">FB App ID </label>
                                                    <input class="form-control py-4" id="fb_app_id" type="text"
                                                           name="fb_app_id" value="{{ $setting->fb_app_id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Printers Line / Footer</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Editors Name</label>
                                                    <input id="text" name="editor" value="{{ $setting->editor }}"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="inputEmailAddress">Email</label>
                                                    <input class="form-control py-4" id="inputEmailAddress" type="email"
                                                           aria-describedby="emailHelp" name="site_email"
                                                           value="{{ $setting->site_email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="inputEmailAddress">Mobile</label>
                                                    <input class="form-control py-4" id="site_mobile" type="text"
                                                           name="site_mobile" value="{{ $setting->site_mobile }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Address</label>
                                                    <input id="google_map" name="address"
                                                           value="{{ $setting->address }}" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Others</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Google AdSense (<span
                                                            class="text-danger">Paste Google AdSense Script</span>)</label>
                                                    <input id="google_adsense" name="google_adsense"
                                                           value="{{ $setting->google_adsense }}" class="form-control"
                                                           placeholder='<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-000000000" crossorigin="anonymous"></script>"'/>
                                                </div>
                                            </div>
                                            <div class="col-md-4 d-none">
                                                <div class="form-group">
                                                    <label for="inputEmailAddress">Google Analytic (<span
                                                            class="text-danger">Do not include G- </span>)</label>
                                                    <input class="form-control py-4" id="google_analytic" type="text"
                                                           name="google_analytic"
                                                           value="{{ $setting->google_analytic }}"
                                                           placeholder="W6G27RCXKB">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Google Map (<span
                                                            class="text-danger">Paste Google <ifram></ifram> Embed Code</span>)</label>
                                                    <input class="form-control py-4" id="google_map" type="text"
                                                           name="google_map" value="{{ $setting->google_map }}" rows="3"
                                                           placeholder='<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.2448873585727!2d90.4276720467015!3d2...></iframe>'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Social Link</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="facebook">Facebook </label>
                                                    <input class="form-control py-4" id="facebook" type="text"
                                                           name="facebook" value="{{ $setting->facebook }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="youtube">Youtube </label>
                                                    <input class="form-control py-4" id="youtube" type="text"
                                                           name="youtube" value="{{ $setting->youtube }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="twitter">Twitter </label>
                                                    <input class="form-control py-4" id="twitter" type="text"
                                                           name="twitter" value="{{ $setting->twitter }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Linkedin</label>
                                                    <input id="linkedin" name="linkedin"
                                                           value="{{ $setting->linkedin }}" class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="inputFirstName">Instagram</label>
                                                    <input id="instagram" name="instagram"
                                                           value="{{ $setting->instagram }}" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Option Settings</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="scrollBar">Scroll Bar<span
                                                            class="text-danger">*</span></label>
                                                    <div>
                                                        <label class="switch">
                                                            <input id="scrollBar" class="scrollBarToggle"
                                                                   type="checkbox" {{ $setting->scroll_bar == 1 ? 'checked' : '' }} >
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="menuBar">Menu Bar<span class="text-danger">*</span></label>
                                                    <div>
                                                        <label class="switch">
                                                            <input id="menuBar" class="menuBarToggle"
                                                                   type="checkbox" {{ $setting->desktop_menu_bar == 1 ? 'checked' : '' }} >
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="popularTag">Popular Tag<span
                                                            class="text-danger">*</span></label>
                                                    <div>
                                                        <label class="switch">
                                                            <input id="popularTag" class="popularTagToggle"
                                                                   type="checkbox" {{ $setting->popular_tag == 1 ? 'checked' : '' }} >
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Admin Settings</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="form-group">
                                            <label for="inputFirstName">Admin Prefix <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control py-4" id="inputFirstName" type="text"
                                                   name="admin_prefix"
                                                   value="{{ $setting->admin_prefix }}">
                                            <span class="text-warning">(Must fill up it carefully, if you put prefix and press submit, your url will be change with new prefix)</span>
                                            <br>
                                            <span
                                                class="text-danger">{{ $errors->has('admin_prefix') ? $errors->first('admin_prefix'):''}}</span>
                                        </div>
                                    </div>
                                </div>

                                <button tupe="submit" class="btn btn-success py-2 text-center float-right">Update
                                </button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
