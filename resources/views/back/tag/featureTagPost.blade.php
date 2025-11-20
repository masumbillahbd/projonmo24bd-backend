@extends('layouts.backend')
@section('title')
Admin | Feature Tag
@php
$setting = setting();
$featureTag = App\Models\Tag::find($setting->feature_tag_id);
@endphp
@endsection
@section('extra_css')
<link href='{{ asset("/assets/select/css/select2.min.css") }}' rel='stylesheet' type='text/css'>
@endsection
@section('content')
  <main>
  <div class="container-fluid">
    <div class="row justify-content-center">  
      <div class="col-lg-4">
        <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
          <div class="card-header">
            <h4 class="text-center font-weight-light my-1 float-left">Feature Tag Post</h4>
          </div>          
          <div class="card-body">
            <form role="form" method="post" action="{{ route('featureTagStore') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label class="col-md-12" for="tag_id">Tag <span class="text-danger">*</span></label>
                <div class="col-md-12">
                  <select class="form-control" id="tag_id" name="tag_id" style="width:100%;" required>
                    @if(!empty($featureTag))
                    <option value="{{ $setting->feature_tag_id }}">{{$featureTag->name}}</option>
                    @else
                    <option value="">--Select Tag--</option>
                    @endif
                    @foreach($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                  </select>
                  <span class="text-danger">{{ $errors->has('tag_id') ? $errors->first('tag_id'):''}}</span>
                </div>  
              </div>
              <div class="form-group row">
                <label class="col-md-3" for="photo">Banner <span class="text-danger">1200*70</span></label>
                <div class="col-md-9">
                    <div class="image-uploader">
                        <label for="imageFile" class="image-uploader__label">
                            <img src="{{ $setting->feature_tag_banner ? $setting->feature_tag_banner : asset('defaults/default3.png')  }}" alt="Preview image"
                                 class="image-uploader__preview-image img-thumbnail p-1"
                                 style="width: 170px; height: 90px;">
                            <input type="file" name="image" class="image-uploader__input"
                                   id="imageFile" accept="image/*">
                        </label>
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>
            </div>
              <button type="submit" class="float-right btn btn-success">Update</button>
            </form>
          </div>
        </div>
      </div> <!--col-6-->
      
      <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
          <div class="card-header">
            <h4 class="text-center font-weight-light my-1 float-left">Feature Tag Post</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Tag</th>
                    <th class="text-center">Feature Image</th>
                    <th class="text-center">Total Post</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @php
                        $featureTag = tag($setting->feature_tag_id);
                    @endphp

                    @if(!empty($setting->feature_tag_id))
                        @if(!empty($featureTag))
                            <td><h4>{{ $featureTag->name }}</h4></td>
                        @else
                            <td></td>
                        @endif

                        @if(!empty($setting->feature_tag_banner))
                            <td class="text-center"><img class="img-fluid" src="{{ $setting->feature_tag_banner }}"></td>
                        @else
                            <td></td>
                        @endif
                    @else
                    <td></td>    
                    <td></td>    
                    @endif

                    <td class="text-center">{{ $featureTag?->posts()?->count() ?? 0 }}</td>
                    <td>
                      <label class="switch">
                          <input class="featureTagStatusChange" type="checkbox" {{ $setting->feature_tag_status == 1 ? 'checked' : '' }} >
                          <span class="slider round"></span>
                      </label>
                    </td>
                  </tr>
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
@section('extra_js')
<script src='{{ asset("/assets/select/js/select2.js") }}' type='text/javascript'></script>
<script>
$('#tag_id').select2();

$('.featureTagStatusChange').change(function(){
    var feature_tag_status = $(this).prop('checked') == true ? 1 : 0; 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "{{ route('featureTagStatusChange') }}",
        data: {'feature_tag_status': feature_tag_status},
        success: function(data){
             toastr.success(data.success)
        }
    });
});
</script>
@endsection
