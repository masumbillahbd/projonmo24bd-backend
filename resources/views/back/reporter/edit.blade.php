@extends('layouts.backend')
@section('title')
    Admin
@endsection
@section('extra_js')
<script>
    $(document).ready(function () {
        document.getElementById("position").addEventListener("keyup", function() {
          this.value = this.value.replace(/[^0-9]/g,"");
        });
    })
</script>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="font-weight-normal  my-1">
                                        Edit Reporter
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('reporter.index') }}" class="btn btn__view float-right">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('reporter.update',['id'=>$reporter->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name <span
                                                class="text-danger">*</span></label>
                                        <input class=" form-control" name="name" value="{{$reporter->name}}" placeholder="Name" type="text"
                                               autocomplete="off" required>
                                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                                </div>

                                <div class="form-group">
                                    <label for="designation">Designation <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="designation" value="{{$reporter->designation}}" placeholder="Designation"
                                               autocomplete="off" required>
                                        <span class="text-danger">{{ $errors->has('designation') ? $errors->first('designation'):''}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="position">Position</label>
                                        <input class="form-control" id="position" type="text" name="position" value="{{$reporter->position}}" placeholder="Position"
                                               autocomplete="off" required>
                                        <span class="text-danger">{{ $errors->has('position') ? $errors->first('position'):''}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Photo <small>(300x300)</small> <span
                                                class="text-danger"></span></label>
                                        <div class="image-uploader">
                                            <label for="imageFile" class="image-uploader__label">
                                                <img src="{{ !empty($reporter->photo) ? asset('/reporter/'.$reporter->photo) : asset('/defaults/default3.png') }}" alt="Preview image"
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
                                <button type="submit" class="float-right btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-5-->
            </div>
        </div>
    </main>
@endsection
