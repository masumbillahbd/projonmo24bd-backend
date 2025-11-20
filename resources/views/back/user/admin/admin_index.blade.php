@extends('layouts.backend')
@section('title')
    Admin | User Account
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
                    <div class="card shadow-lg border-0 mt-3 mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class=" font-weight-light my-2 float-left">
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
                                        All User
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.create') }}" class="btn btn__new float-right">+ Add</a>
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
                                        <th>Role</th>
                                        <th class="text-center">Total Post</th>
                                        <th class="text-center">Photo</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width: 170px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($admins as $admin)
                                        <tr>
                                            <td class="text-center">{{$admin->position}}</td>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td class="text-capitalize">{{$admin->role}}</td>
                                            <td class="text-center">{{$admin->post()->count() ?? 0 }}</td>
                                            <td class="text-center">
                                                <img width="70px"
                                                     src="{{ $admin->photo ? asset('profile/'.$admin->photo) : asset('defaults/avatar01.png')  }}">
                                            </td>
                                            <td class="text-center">
                                                <label class="switch">
                                                    <input class="changeUserStatus" type="checkbox"
                                                           data-id="{{$admin->id}}" {{ $admin->status ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.edit', ['id' => $admin->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                        class="fa fa-edit"></i></a>
                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('admin.destroy', ['id' => $admin->id])}}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_confirm"
                                                                data-toggle="tooltip" title='Delete'><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
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

