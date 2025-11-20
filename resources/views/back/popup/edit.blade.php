@extends('layouts.backend')
@section('title')
    Admin | Popup adv. update
@endsection
@section('extra_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.getInputFile').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.profileImgShow').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })

            $('.publicationStatus').change(function () {
                var post_status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                console.log(id)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('PopupStatusChange') }}",
                    data: {'status': post_status, 'id': id},
                    success: function (data) {
                        toastr.success(data.success)
                    }
                });
            });
        });
    </script>
@endsection
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header"><h4 class="text-center">Edit Popup Adv.</h4></div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('popup.update',['id'=>$popup->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="name" value="{{$popup->name}}"
                                               placeholder="Name" type="text"
                                               autocomplete="off" maxlength="95">
                                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                                </div>

                                <div class="form-group">
                                    <label for="link">Link</label>
                                        <input class="form-control" name="link" value="{{$popup->link}}"
                                               placeholder="Link" type="text"
                                               autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('link') ? $errors->first('link'):''}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="position">Visible to</label>
                                        <select name="position" id="position" class="form-control">
                                            <option {{ $popup->position == 'home' ? 'selected' : '' }} value="home">Home Page</option>
                                            <option {{ $popup->position == 'single' ? 'selected' : '' }}  value="single">Single Page</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('position') ? $errors->first('position'):''}}</span>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4" for="image">Image<small>(740x740)</small><span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="image-uploader">
                                            <label for="imageFile" class="image-uploader__label">
                                                <img src="{{ asset('img/popup/'.$popup->image) ?? asset('/defaults/default3.png') }}" alt="Preview image"
                                                     class="image-uploader__preview-image img-thumbnail p-1"
                                                     style="width: 170px; height: 90px;">
                                                <input type="file" name="image" class="image-uploader__input"
                                                       id="imageFile" accept="image/*">
                                            </label>
                                            @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="float-right btn btn-success submit">Update</button>
                                <a href="{{ route('popup.index') }}" class="float-right btn btn-danger submit mr-2">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->

                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header"><h4 class="text-center">All Popup Adv.</h4></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-center">Visible for</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center" style="width: 170px">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(App\Models\Popup::orderBy('id','desc')->get() as $key=> $row)
                                            <tr>
                                                <td>{{$row->name}}</td>
                                                <td class="text-center">{{ Str::ucfirst($row->position.' Page') }}</td>
                                                <td class="text-center">
                                                    <label class="switch">
                                                        <input id="publicationStatus" class="publicationStatus" data-id="{{$row->id}}"
                                                               type="checkbox" {{ $row->status == 1 ? 'checked' : '' }} >
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    <img width="100px" src="{{ asset('img/popup/'.$row->image)}}" class="float-none">
                                                </td>
                                                <td class="text-center col__action__body">
                                                    <a href="{{ route('popup.edit', ['id' => $row->id])}}"
                                                       class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                                    <a href="{{ route('popup.destroy', ['id' => $row->id])}}"
                                                       onclick="return confirm('Are you sure to delete this!')"
                                                       class="btn btn-soft-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i> </a>
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
@endsection
