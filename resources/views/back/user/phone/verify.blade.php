@extends('layouts.frontend')

@section('title', 'single page')

@section('meta_info')

@endsection

@section('extra_css')

@endsection

@section('extra_js')


@endsection

@section('main_content')

  <!-- Reviews-->
  <section class="pb-4 pt-2 " id="">
    <div class="container">
      <div class="panel m-auto" style="max-width: 400px;">
        <div class="panel-head">
          @include('back.parts.message')
          <!-- <h2 style="font-weight: normal;margin: 0 0 15px;font-size: 22px;color: black;">Register Account</h2> -->
          
        </div>
        <div class="panel-body">
          <form method="post" action="/verify" >
            @CSRF
            <div class="mb-3 mt-3">
              <label class="pb-1" style="color: black;font-size: 13px;" for="code">Code <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="code" style="border-radius: 3px;" placeholder="XXXX" name="code" required>
              <span class="text-danger">{{ $errors->has('code') ? $errors->first('code'):''}}</span>
            </div>

            <div class="d-grid gap-3">
              <button type="submit" style="border-radius: 3px;" class="btn btn-primary btn-block">Verify</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
 
</main>
  


@endsection


