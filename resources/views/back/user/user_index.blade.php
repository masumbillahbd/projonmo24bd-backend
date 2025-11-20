

@extends('layouts.backend')
@section('title')
Admin
@endsection

@section('extra_css')
    <style type="text/css">
      .toggle-off.btn {
     padding-left: 0px; 
      }
    </style>
@endsection
@section('content')
  <main>
  <div class="container-fluid">
    <div class="row justify-content-center">  
      @include('back.parts.message')
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
          <div class="row p-3">
            <div class="col-md-6">
              <h4 class=" font-weight-light my-2 float-left">All Staffs</h4>
            </div>
            <div class="col-md-6">
              <a href="{{ route('staff.create') }}" class="btn btn-primary float-right">Add New Staff</a>
            </div>
          </div>
          <hr>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach(\App\Models\User::all() as $user)
                    <tr>
                      <td>{{$user->id}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->role}}</td>
                      <td>
                        <img width="100px" src="{{ $user->photo ? asset('profile/'.$user->photo) : asset('defaults/avatar01.png')  }}">
                      </td>
                      <td>
                        
                        <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ $user->status ? 'checked' : '' }}>

                      </td>

                      <td class="text-center">
                        <a href="{{ route('user.edit', ['id' => $user->id])}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('user.destroy', ['id' => $user->id])}}"  onclick="return confirm('Are you sure to delete this!')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
@section('extra_js')
<script>
  $(document).ready(function () {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
        
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ route('changeStatus') }}",
            data: {'status': status, 'id': id},
            success: function(data){
              console.log('success')
            }
        });
    })
  })
</script>
@endsection