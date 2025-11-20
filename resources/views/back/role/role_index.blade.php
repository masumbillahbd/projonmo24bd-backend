@extends('layouts.backend')
@section('title')
    Admin
@endsection
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <div class="row p-3">
                                <div class="col-md-6">
                                    <h4 class=" font-weight-light my-2 float-left">All Roles</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('role.create') }}" class="btn btn-primary float-right">Add New Role</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                      <th class="text-center" style="width: 70px">ID</th>
                                      <th>Name</th>
                                      <th class="text-center" style="width: 170px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($roles as $role)
                                        <tr>
                                            <td class="text-center">{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td class="text-center">

                                                <a href="{{ route('role.edit', ['id' => $role->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="fa fa-edit"></i></a>

                                                <div style="display: inline-block;">
                                                  <form method="POST" action="{{ route('role.destroy', ['id' => $role->id])}}">
                                                      @csrf
                                                      <input name="_method" type="hidden" value="DELETE">
                                                      <button type="submit" class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i></button>
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
