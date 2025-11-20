@extends('layouts.backend')
@section('title')
    Admin | Category Setup
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">Update Category</h4></div>
                        <div class="card-body">
                            <form role="form" method="post"
                                  action="{{ route('category.update',['id'=>$category->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="name" value="{{$category->name}}"
                                               placeholder="Name" type="text" autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="slug">Slug <span class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="slug" value="{{$category->slug}}"
                                               placeholder="Slug" type="text" autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('slug') ? $errors->first('slug'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="possition">Position <span
                                                class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="number" name="position"
                                               value="{{$category->position}}" placeholder="Position" min="1"
                                               autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('position') ? $errors->first('position'):''}}</span>
                                    </div>
                                </div>
                                <button type="submit" class="float-right btn btn-success">Update</button>
                                <a href="{{ route('category.index') }}" class="float-right btn btn-danger mx-3">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->

                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">All Category</h4></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px">ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th class="text-center">Total Post</th>
                                        <th class="text-center">Position</th>
                                        <th class="text-center d-none" style="width: 150px">Home Page</th>
                                        <th class="text-center" style="width: 150px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Models\Category::all() as $row)
                                        <tr>
                                            <td class="text-center">{{$row->id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->slug}}</td>
                                            <td class="text-center">{{ $row->posts()->count() ?? 0 }}</td>
                                            <td class="text-center">{{$row->position}}</td>
                                            <td class="text-center">
                                                <a title="view" target="_blank" href="{{ url($row->slug)}}"
                                                   class="btn btn-soft-success btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-eye"></i></a>
                                                <a title="edit" href="{{ route('category.edit', ['id' => $row->id])}}"
                                                   class="btn btn-soft-success btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-edit"></i></a>

                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('category.delete', ['id' => $row->id])}}">
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
                </div> <!--col-6-->
            </div>
        </div>
    </main>
@endsection
