@extends('layouts.backend')
@section('title')
    Admin | Menu Setup
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">Add Menu</h4></div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('menu.store') }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="url_text" placeholder="Name" type="text"
                                               required>
                                        <span class="text-danger">{{ $errors->has('url_text') ? $errors->first('url_text'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="url">URL <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="url_path" placeholder="URL" type="text"
                                               required>
                                        <span class="text-danger">{{ $errors->has('url_path') ? $errors->first('url_path'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="possition">Position <span
                                                class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="number" name="position" placeholder="Position" min="1"
                                               autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('position') ? $errors->first('position'):''}}</span>
                                    </div>
                                </div>

                                <button type="submit" class="float-right btn btn-success">Create</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->

                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">

                        <div class="card-header"><h4 class="text-center font-weight-light my-1">All Menu</h4></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>URL</th>
                                        <th class="text-center">Position</th>
                                        <th class="text-center" style="width: 150px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($menus as $row)
                                        <tr>
                                            <td>{{$row->url_text}}</td>
                                            <td>{{$row->url_path}}</td>
                                            <td class="text-center">{{$row->position}}</td>
                                            <td class="text-center">
                                                <a title="view" target="_blank" href="{{ url($row->url_path) }}"
                                                   class="btn btn-soft-success btn-icon btn-circle btn-sm">
                                                    <i
                                                            class="fa fa-eye"></i>
                                                </a>
                                                <a title="edit" href="{{ route('menu.edit', ['id' => $row->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm">
                                                    <i
                                                            class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('menu.delete', ['id' => $row->id])}}"
                                                   onclick="return confirm('Are you sure to delete this!')"
                                                   class="btn btn-soft-danger btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div> <!--col-6-->

            </div>
        </div>
    </main>
@endsection
