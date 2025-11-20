@extends('layouts.backend')
@section('title')
Admin | edit
@endsection

@section('extra_css')

<style type="text/css">

</style>
@endsection

@section('extra_js')
<script>
  $(document).ready(function () {

jQuery("#division_id option[value='"+{{$edit->id}}+"']").attr('selected', 'selected'); 

  })
</script>
@endsection

@section('content')
  <main>
  <div class="container-fluid">
    <div class="row justify-content-center">  
      @include('back.parts.message')
      <div class="col-lg-4">
        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
          <div class="card-header"><h4 class="text-center font-weight-light my-1">Edit District</h4></div>          
          <div class="card-body">
            <form role="form" name="form" method="post" action="{{ route('district.update',['id'=>$edit->id]) }}">
              @csrf
                
                <div class="form-group row">
                <label class="col-md-3" for="name">Division <span class="text-danger">*</span></label>
                <div class="col-md-9">
                <select class=" form-control" id="division_id" name="division_id" required >
                    <option value="">--Select--</option>
                    @foreach($divisions as $division)
                    <option value="{{$division->id}}">{{$division->name}}</option>
                    @endforeach
                </select>
                  <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                </div>  
              </div>
              
              <div class="form-group row">
                <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="name" value="{{$edit->name}}" placeholder="Name" required type="text" autocomplete="off">
                  <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                </div>  
              </div>
              <div class="form-group row">
                <label class="col-md-3" for="slug">Slug <span class="text-danger"></span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="slug" value="{{$edit->slug}}" placeholder="Slug" type="text" autocomplete="off">
                  <span class="text-danger">{{ $errors->has('slug') ? $errors->first('slug'):''}}</span>
                </div>  
              </div>

              <button type="submit" class="float-right btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div> <!--col-6-->
      
      <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
          
          <div class="card-header"><h4 class="text-center font-weight-light my-1">All District</h4></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-center">ID</th>
                    <th>Division</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th class="text-center" style="width: 150px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <div class="pagination-info">
                     <p>Showing {{$districts->firstItem()}} to {{$districts->lastItem()}} of {{$districts->total()}}</p>
                  </div>
                  @foreach($districts as $row)
                    <tr>
                      <td class="text-center">{{$row->id}}</td>
                      <td>{{$row->division->name}}</td>
                      <td>{{$row->name}}</td>
                      <td>{{$row->slug}}</td>
                      <td class="text-center">
                          <a title="view" target="_blank" href=""
                                                   class="btn btn-soft-success btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-eye"></i></a>
                        <a title="edit" href="{{ route('district.edit', ['id' => $row->id])}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                        <div class="" style="display: inline-block;">
                          <form method="POST" action="{{ route('district.delete', ['id' => $row->id])}}">
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
                {{ $districts->links() }}
            </div>
          </div>
        </div>
      </div> <!--col-6-->
      
    </div>
  </div>
</main>

<script type="text/javascript"> 
	document.forms['form'].elements['division_id'].value={{ $edit->division_id }}
</script>
@endsection
