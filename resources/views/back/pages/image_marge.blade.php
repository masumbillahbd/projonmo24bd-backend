
@extends('layouts.backend')
@section('title')
Admin
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
      <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
          <div class="card-header"><h4 class="text-center font-weight-light my-1">Add New Page</h4></div>          
          <div class="card-body">
            <form role="form" method="post" action="{{ route('imageMarge.store') }}" enctype="multipart/form-data">
              @csrf
              
              <div class="form-group row">
                  <label class="col-md-3" for="image">Feature Image <small>(750x750)</small> <span class="text-danger"></span></label>
                  <div class="col-md-9">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input getInputFile" id="validatedCustomFile" required>
                      <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                      <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    <span class="text-danger">{{ $errors->has('image') ? $errors->first('image'):''}}</span>

                    <br>
                    <label class="pt-1" id="profileLabel" for="photo">
                      <img class="getInputFileShow" width="100px" src="https://www.dailyshomosamayik.com/defaults/default3.png" >
                    </label>

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

