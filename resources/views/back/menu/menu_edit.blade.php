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
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">Edit Menu</h4></div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('menu.update',['id'=>$menu->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="url_text" value="{{$menu->url_text}}"
                                               placeholder="Name" type="text" required>
                                        <span class="text-danger">{{ $errors->has('url_text') ? $errors->first('url_text'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="url">URL <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="url_path" value="{{$menu->url_path}}"
                                               placeholder="URL" type="text" required>
                                        <span class="text-danger">{{ $errors->has('url_path') ? $errors->first('url_path'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="possition">Position <span
                                                class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="number" name="position" min="1"
                                               value="{{$menu->position}}" placeholder="Position" autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('position') ? $errors->first('position'):''}}</span>
                                    </div>
                                </div>

                                <button type="submit" class="float-right btn btn-primary">Update</button>
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
                                                    <svg class="svg-inline--fa fa-eye fa-w-18" aria-hidden="true"
                                                         focusable="false" data-prefix="fa" data-icon="eye" role="img"
                                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                         data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                              d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
                                                    </svg>
                                                </a>
                                                <a title="edit" href="{{ route('menu.edit', ['id' => $row->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm">
                                                    <svg class="svg-inline--fa fa-edit fa-w-18" aria-hidden="true"
                                                         focusable="false" data-prefix="fa" data-icon="edit" role="img"
                                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                         data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                              d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path>
                                                    </svg>
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
