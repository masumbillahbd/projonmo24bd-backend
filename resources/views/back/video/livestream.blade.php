@extends('layouts.backend')
@section('title')
    Admin | Livestream
@endsection
@section('extra_js')
    <script>
        $(document).ready(function () {
            $('.changeLivestreamStatus').change(function () {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                console.log(id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('changeLivestreamStatus') }}",
                    data: {'status': status, 'id': id},
                    success: function (data) {
                        toastr.success(data.success)
                    }
                });
            });
        })
    </script>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">Livestream</h4></div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label class="switch">
                                    <input class="changeLivestreamStatus" type="checkbox"
                                           data-id="{{$item->id}}" {{ $item->status ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <form role="form" method="post" action="{{ route('livestream.update',['id'=>$item->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group body__edit">
                                    <label class="mb-1" for="content">Video Stream</label>
                                    <script
                                        src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>
                                    <textarea id="content" name="content" class="my-editor"
                                              rows="15">{!! $item->content !!}</textarea>
                                    <script>
                                        var editor_config = {
                                            path_absolute: "/",
                                            selector: "#content",
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
                                    <span
                                        class="text-danger">{{ $errors->has('content') ? $errors->first('content'):''}}</span>
                                </div>
                                <button type="submit" class="btn btn-success my-4">Update</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->
            </div>
        </div>
    </main>
@endsection
