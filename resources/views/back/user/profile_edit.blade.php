@extends('layouts.backend')
@section('title')
    Admin | Edit Profile
@endsection
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-normal  my-1">Profile Edit</h4>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('user.profile.update') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="name" value="{{$user->name}}"
                                               placeholder="Name" type="text" autocomplete="off" required>
                                        <span
                                            class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="email">Email <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="email" name="email" value="{{$user->email}}"
                                               placeholder="Email">
                                        <span
                                            class="text-danger">{{ $errors->has('email') ? $errors->first('email'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="photo">Photo <small>(200x200)</small> <span
                                            class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <div class="image-uploader">
                                            <label for="imageFile" class="image-uploader__label">
                                                <img src="{{ !empty($user->photo) ? asset('/profile/'.$user->photo) : asset('/defaults/default3.png') }}" alt="Preview image"
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

                                <button type="submit" class="float-right btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-5-->
            </div>
        </div>
    </main>
@endsection
