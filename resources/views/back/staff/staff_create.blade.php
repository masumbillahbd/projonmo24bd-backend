@extends('layouts.backend')
@section('title')
    Admin
@endsection

@section('extra_css')
    <style type="text/css">
        .toggle-off.btn {
            padding-left: 0px;
        }

        .label-text {
            font-family: serif;
            line-height: 1.5;
        }

    </style>
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
                              Add New Staff
                            </h4>
                          </div>
                          <div class="col-md-6">
                            <a href="{{ route('staff.index') }}" class="btn btn-primary float-right">View All</a>
                          </div>
                        </div>
                      </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('staff.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3" for="name">Name <span class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="name" placeholder="Name" type="text"
                                               required>
                                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="email">Email <span class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="email" placeholder="Email" type="email"
                                               required>
                                        <span class="text-danger">{{ $errors->has('email') ? $errors->first('email'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="phone">Phone <span class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="phone" placeholder="Phone" type="text"
                                               required>
                                        <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="password">Password <span
                                                class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="password" placeholder="Password"
                                               type="password" required>
                                        <span class="text-danger">{{ $errors->has('password') ? $errors->first('password'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="role">Role <span class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <select name="role_id" required class="form-control aiz-selectpicker">
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->has('role') ? $errors->first('role'):''}}</span>
                                    </div>
                                </div>


                                <button type="submit" class="float-right btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-5-->
            </div>
        </div>
    </main>
@endsection
