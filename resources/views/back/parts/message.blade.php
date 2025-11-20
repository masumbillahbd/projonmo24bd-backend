
  
<div class="col-lg-6 offset-lg-3 mr-auto mt-2 ">              
<div>
    @if(Session::has('success'))
<div class="alert alert-success show">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong> {{ Session::get('success') }}.
</div>
@endif

@if(Session::has('danger'))
<div class="alert alert-danger show">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Warning!</strong> {{ Session::get('danger') }}.
</div>
@endif
  
</div>
</div>  


