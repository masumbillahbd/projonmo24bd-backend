@extends('layouts.backend')
@section('title')
Admin
@endsection

@section('extra_css')
<style type="text/css">
  .toggle-off.btn{
    padding-left: 0px;
  }

.label-text{
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
          <div class="card-header"><h4 class=" font-weight-normal my-1">Staff Information</h4></div>          
          <div class="card-body">
            <form role="form" method="post" action="{{ route('staff.update',['id'=>$staff->id]) }}" >
              @csrf
              <div class="form-group row">
                <label class="col-md-3" for="name">Name <span class="text-danger"></span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="name" placeholder="Name" type="text" value="{{$staff->user->name}}" required>
                  <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="email">Email <span class="text-danger"></span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="email" placeholder="Email" value="{{$staff->user->email}}" type="email"  required>
                  <span class="text-danger">{{ $errors->has('email') ? $errors->first('email'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="phone">Phone <span class="text-danger"></span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="phone" placeholder="Phone" value="{{$staff->user->phone}}" type="text"  required>
                  <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="password">Password <span class="text-danger"></span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="password" placeholder="Password" type="password"  required>
                  <span class="text-danger">{{ $errors->has('password') ? $errors->first('password'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="role">Role <span class="text-danger"></span></label>
                <div class="col-md-9">
                  <select name="role_id" required class="form-control aiz-selectpicker">
                      @foreach($roles as $role)
                        <option {{ $role->id === $staff->role->id ? 'selected': '' }}  value="{{$role->id}}">{{$role->name}}</option>
                      @endforeach
                  </select>
                  <span class="text-danger">{{ $errors->has('role') ? $errors->first('role'):''}}</span>
                </div>  
              </div>

              <button type="submit" class="float-right btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div> <!--col-5-->
    </div>  
  </div>
</main>
@endsection
