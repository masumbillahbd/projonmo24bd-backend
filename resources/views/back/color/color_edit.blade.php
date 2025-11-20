@extends('layouts.backend')
@section('title')
Admin | Index
@endsection

@section('extra_css')

<style type="text/css">
  
</style>
@endsection

@section('extra_js')

@endsection

@section('content')
  <main>
  <div class="container-fluid">
    <div class="row justify-content-center">
      @include('back.parts.message')

      <div class="col-lg-7">
        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
          <div class="card-header"><h4 class="text-center font-weight-light my-1">All Colors</h4></div>          
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach(\App\Models\Color::all() as $row)
                    <tr>
                      <td>{{$row->id}}</td>
                      <td>{{$row->name}}</td>
                      <td class="text-center">
                        <a href="{{ route('color.edit', ['id' => $row->id])}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('color.destroy', ['id' => $row->id])}}"  onclick="return confirm('Are you sure to delete this!')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> <!--col-7-->


      <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
          <div class="card-header"><h4 class="text-center font-weight-light my-1">Edit Color</h4></div>          
          <div class="card-body">
            <form role="form" method="post" action="{{ route('color.update',['id'=>$color->id]) }}" >
              @csrf
              <div class="form-group row">
                <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="name" value="{{$color->name}}" placeholder="Name" required type="text" autocomplete="off">
                  <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="code">Code <span class="text-danger"></span></label>
                <div class="col-md-9">
                  <input  class="form-control" name="code" value="{{$color->code}}" placeholder="Code"  type="text" autocomplete="off">
                  <span class="text-danger">{{ $errors->has('code') ? $errors->first('code'):''}}</span>
                </div>  
              </div>
              
              <button type="submit" class="float-right btn btn-primary">Save</button>
            </form>
          </div>
        </div>
      </div> <!--col-5-->
    </div>  
  </div>
</main>
@endsection
