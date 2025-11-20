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
      <div class="col-lg-7">
        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
          <div class="card-header"><h4 class=" font-weight-normal my-1">Role Information</h4></div>          
          <div class="card-body">
            <form role="form" method="post" action="{{ route('role.update',['id'=>$role->id]) }}" >
              @csrf
              <div class="form-group row">
                <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="name" placeholder="Name" type="text" value="{{$role->name}}" required>
                  <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                </div>  
              </div>

              <div class="card-header">
                <h5 class="mb-0 ">Permissions</h5>
              </div>

                @php
                    $permissions = json_decode($role->permissions);
                @endphp

              <div class="form-group row mt-2 justify-content-center">
                <div class="col-md-8 ">

                  <div class="row mt-1 mb-1">
                      <label class="col-md-10 label-text">Settings</label>
                      <div class="col-md-2">
                        <label class="switch">
                          <input class="permissions" name="permissions[]" type="checkbox" value="1" @php if(in_array(1, $permissions)) echo "checked"; @endphp >
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>

                  <div class="row mt-1 mb-1">
                      <label class="col-md-10 label-text">Menu Setting</label>
                      <div class="col-md-2">
                        <label class="switch">
                          <input class="permissions" name="permissions[]" type="checkbox" value="2" @php if(in_array(2, $permissions)) echo "checked"; @endphp >
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>

                  <div class="row mt-1 mb-1">
                      <label class="col-md-10 label-text">Category Setting</label>
                      <div class="col-md-2">
                        <label class="switch">
                          <input class="permissions" name="permissions[]" type="checkbox" value="3" @php if(in_array(3, $permissions)) echo "checked"; @endphp >
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>
                  
                  <div class="row mt-1 mb-1">
                      <label class="col-md-10 label-text">Country Setting</label>
                      <div class="col-md-2">
                        <label class="switch">
                          <input class="permissions" name="permissions[]" type="checkbox" value="4" @php if(in_array(4, $permissions)) echo "checked"; @endphp >
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>

                  <div class="row mt-1 mb-1">
                      <label class="col-md-10 label-text">News Manage</label>
                      <div class="col-md-2">
                        <label class="switch">
                          <input class="permissions" name="permissions[]" type="checkbox" value="5" @php if(in_array(5, $permissions)) echo "checked"; @endphp>
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>

                  <div class="row mt-1 mb-1">
                      <label class="col-md-10 label-text">Photo Gallery</label>
                      <div class="col-md-2">
                        <label class="switch">
                          <input class="permissions" name="permissions[]" type="checkbox" value="6" @php if(in_array(6, $permissions)) echo "checked"; @endphp>
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>

                  <div class="row mt-1 mb-1">
                      <label class="col-md-10 label-text">Video Gallery</label>
                      <div class="col-md-2">
                        <label class="switch">
                          <input class="permissions" name="permissions[]" type="checkbox" value="7" @php if(in_array(7, $permissions)) echo "checked"; @endphp>
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>


                  <div class="row mt-1 mb-1">
                      <label class="col-md-10 label-text">Report</label>
                      <div class="col-md-2">
                        <label class="switch">
                          <input class="permissions" name="permissions[]" type="checkbox" value="8" @php if(in_array(8, $permissions)) echo "checked"; @endphp>
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>

                

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
