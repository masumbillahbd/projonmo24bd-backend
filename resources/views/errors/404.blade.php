@extends('layouts.frontend')

@section('meta_info')
    @php
        $settings = \App\Models\Setting::find('1');
    @endphp
    <title>404 | {{ $settings->site_title }}</title>
@endsection

@section('extra_css')
<style>
    .btn-search {
    color: #252525;
    background-color: #fff;
    padding: 2px 13px 0 14px;
    font-size: 24px;
    height: 47px;
    border-radius: 0;
    border-left: none;
}
.btn {
    border: 1px solid #ddd!important;
}
</style>
@endsection

@section('main_content')
<div class="container mb-5">
  <div class="row justify-content-md-center">
    <div class="col-lg-6 ">
        <div class="text-center">
            <span style="font-size: 78px;color: #555;font-family: system-ui;">4</span>   
            <span style="font-size: 78px;color: #555;font-family: system-ui;">0</span>   
            <span style="font-size: 78px;color: #555;font-family: system-ui;">4</span>   
        </div>
        <div class="title">
            <h2 class=" text-center" style="font-weight: bold;"> দুঃখিত! কিছু পাওয়া যায়নি</h2>
        </div>
        
        <div class="text-center mt-3">
            <form action="{{ route('search') }}" class="form-group" role="search" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" style="    height: 47px;" name="x" placeholder="কি খুঁজতে চান?">
                    <span class="input-group-btn">
                        <button class="btn btn-search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </div>
            </form>
        </div>
        
        <div class="text-center mt-3">
            <a href="{{ url('/')}}" type="button" class="btn btn-info">প্রচ্ছদে ফিরে যান </a>
        </div>
    </div>
    
  </div>
</div>
@endsection


@section('extra_js')


@endsection