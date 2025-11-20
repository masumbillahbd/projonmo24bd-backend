@extends('layouts.backend')
@section('title')
Admin
@endsection
@section('content')
  <main>
  <div class="container-fluid">
    <div class="row justify-content-center">
      @include('back.parts.message')
      <div class="col-lg-6">
        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
          <div class="card-header"><h4 class="float-left font-weight-normal  my-1">Profile</h4> 
            <a href="{{ route('user.profile.edit') }}" class="btn btn-primary pt-3 pb-3 float-right">Edit Profile</a>
            <a href="{{ route('user.change.password') }}" class="btn btn-primary pt-3 pb-3 mr-2 ml-2 float-right">Change Password</a>

             </div>          
          <div class="card-body">
             <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Name</th>
                    <td>{{Auth::user()->name}}</td>
                  </tr>
                  <tr>
                    <th>Email</th>
                    <td>{{Auth::user()->email}}</td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td>{{Auth::user()->status == 1 ? 'Active' : 'Inactive'}}</td>
                  </tr>

                  <tr>
                    <th>Photo</th>
                    <td>  
                        @if(!empty(Auth::user()->photo))
                        <img style="width:100px; " title="{{Auth::user()->name}}" src="{{ asset('/profile/'.Auth::user()->photo)}}">
                        @else
                        <img width="100px" src="{{ asset('defaults/avatar01.png')}}">
                        @endif
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div> <!--col-5-->
    </div>  
  </div>
</main>
@endsection
