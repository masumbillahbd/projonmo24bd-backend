@extends('layouts.backend')
@section('title')
    Admin | User Account
@endsection
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="font-weight-normal  my-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-award" width="28" height="28"
                                             viewBox="0 0 24 24" stroke-width="1" stroke="#ff4500" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <circle cx="12" cy="9" r="6"/>
                                            <polyline points="9 14.2 9 21 12 19 15 21 15 14.2"
                                                      transform="rotate(-30 12 9)"/>
                                            <polyline points="9 14.2 9 21 12 19 15 21 15 14.2"
                                                      transform="rotate(30 12 9)"/>
                                        </svg>
                                        Add New User
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.index') }}" class="btn btn__view float-right">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('admin.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3" for="name">Name <span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="name" placeholder="Name" type="text"
                                               autocomplete="off" required>
                                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                <label class="col-md-3" for="short_name">Short Name <span class="text-danger"></span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="short_name" placeholder="Short Name" type="text" autocomplete="off">
                  <span class="text-danger">{{ $errors->has('short_name') ? $errors->first('short_name'):''}}</span>
                </div>
              </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="email">Email <span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="email" name="email" placeholder="Email"
                                               autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('email') ? $errors->first('email'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="role">Role <span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="role" required>
                                            <option value="admin">Super Admin</option>
                                            <option value="manager admin">Manager Admin</option>
                                            <option value="editor">Editor</option>
                                            <option value="user">User</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('role') ? $errors->first('role'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="password">Password <span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="password" name="password"
                                               placeholder="Password" autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('password') ? $errors->first('password'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="confirm_password">Confirm Password <span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="password" name="confirm_password"
                                               placeholder="Confirm Password" autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('confirm_password') ? $errors->first('confirm_password'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="photo">Photo <small>(200x200)</small> <span
                                                class="text-danger"></span></label>
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
                </div> <!--col-5-->
            </div>
        </div>
    </main>
@endsection
