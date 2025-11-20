@extends('layouts.backend')
@section('title')
    All Staffs
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
                                        All Staffs
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('staff.create') }}" class="btn btn-primary float-right">Add New Staff</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width: 170px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($staffs))
                                        @foreach($staffs as $key => $staff)
                                            <tr>
                                                <td class="text-center">{{$staff->id}}</td>
                                                <td>{{$staff->user->name}}</td>
                                                <td>{{$staff->user->email}}</td>
                                                <td class="text-center">{{$staff->user->phone}}</td>
                                                <td class="text-center">{{$staff->role->name}}</td>

                                                <td class="text-center">
                                                    <label class="switch">
                                                        <input class="changeUserStatus" type="checkbox"
                                                               data-id="{{$staff->user->id}}" {{ $staff->user->status ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td class="text-center">
                                                    <a title="edit"
                                                       href="{{ route('staff.edit', ['id' => $staff->id])}}"
                                                       class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                                class="fa fa-edit"></i></a>
                                                    
                                                    <div class="" style="display: inline-block;">
                                                  <form method="POST" action="{{ route('staff.destroy', ['id' => $staff->id])}}">
                                                      @csrf
                                                      <input name="_method" type="hidden" value="DELETE">
                                                      <button type="submit" class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i></button>
                                                  </form>  
                                                </div>
                                                
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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

            $('.changeUserStatus').change(function () {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                console.log(id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('changeUserStatus') }}",
                    data: {'status': status, 'id': id},
                    success: function (data) {
                        toastr.success(data.success)
                    }
                });
            });

        })
    </script>
@endsection