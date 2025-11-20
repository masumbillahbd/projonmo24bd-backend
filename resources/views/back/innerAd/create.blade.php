@extends('layouts.backend')
@section('title')
    Admin | Inner content ads
@endsection

@section('extra_js')
    <script>
        $(document).ready(function() {
            $('.toggleStatus').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).attr("data-id");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('change_inner_ad_status') }}",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
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
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">Inner Ads</h4></div>
                        <div class="card-body">
                            <form role="form" name="form" method="post"
                            action="{{ route('innerAd.store') }}"  enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-3" for="url">URL <span class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="url" value="" class="form-control"/>
                                        <span class="text-danger">{{ $errors->has('url') ? $errors->first('url'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="photo">Photo<span class="text-danger">*</span></label>
                                    <div class="col-md-9">

                                        <div class="image-uploader">
                                            <label for="imageFile" class="image-uploader__label">
                                                <img src="{{ asset('/defaults/default3.png') }}" alt="Preview image"
                                                     class="image-uploader__preview-image img-thumbnail p-1"
                                                     style="width: 170px; height: 90px;">
                                                <input type="file" name="photo" class="image-uploader__input"
                                                       id="imageFile" accept="image/*">
                                            </label>
                                            @error('photo')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                </div>
                                <button type="submit" class="float-right btn btn-success">Create</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->

                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <h4 class="text-center font-weight-light my-1">Inner Ads</h4>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>URL</th>
                                        <th class="text-center">Ads</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Models\InnerAd::orderBy('id','desc')->get() as $row)
                                        <tr>
                                            <td>{{$row->url }}</td>
                                            <td class="text-center"><img src="{{ asset('/ads/'.$row->photo) }}" style="max-width:250px;">
                                            </td>
                                            <td class="text-center">
                                                <label class="switch">
                                                    <input id="banner_status" class="toggleStatus"
                                                        data-id="{{ $row->id }}" type="checkbox"
                                                        {{ $row->status == 1 ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('innerAd.edit', ['id' => $row->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-edit"></i></a>

                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('innerAd.delete', ['id' => $row->id]) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_confirm"
                                                                data-toggle="tooltip" title='Delete'><i
                                                                    class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!--col-6-->

            </div>
        </div>
    </main>
    <script type="text/javascript">
        document.forms['form'].elements['status'].value = "{{ $ad->status ?? '' }}";
    </script>
@endsection