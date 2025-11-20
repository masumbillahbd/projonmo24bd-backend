@extends('layouts.frontend')
@section('meta_info')
@php $settings = setting(); @endphp
    <title>Ramadan | {{ $settings->site_title }}</title>
    <meta name="keywords" content="{{$settings->meta_keywords}}"/>
    <meta name="description" content="{{$settings->meta_description}}">
    <meta name="classification" content="Magazine, Newspaper, Artical"/>
    <meta property="og:title" content="{{$settings->meta_title}}"/>
    <meta property="og:description" content="{{$settings->meta_description}}">
    <meta property="og:image" content="{{url($settings->meta_image)}}"/>
    <meta property="og:url" content="{{$settings->site_url}}"/>
    <meta property="og:site_name" content="{{$settings->site}}">
@endsection


@section('extra_css')
<style>
    /*today ramadan*/
    .romadan__block {
        border: 1px solid #c7e6ee;
        margin-bottom: 11px;
    }
    .romadan__block .banner img {
        border-radius: 0;
        margin-bottom: 5px;
    }
    .romadan__block .date {
        margin: 0 3px;
        background: #c7e6ee;
        display: block;
        padding: 4px;
    }
    .romadan__block ul {
        width: 100%;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .romadan__block .col__head li {
        background: #008cb1;
        margin: 3px 3px 5px;
        text-align: center;
        font-size: 15px;
    }
    .romadan__block .col__head li span {
        color: #fff;
        font-weight: bold;
    }
    .romadan__block span {
        color: #000;
        padding: 3px;
        display: inline-flex;
        font-size: 13px;
    }
    .romadan__block ul > li {
        width: 33%;
        background: #008cb138;
        margin: 0 3px 6px;
        text-align: center;
        font-size: 15px;
    }
    .romadan__block span {
        color: #000;
        padding: 3px;
        display: inline-flex;
        font-size: 13px;
    }
    /*today ramadan end*/
    .ramadan-table table{
        border: none;
    }
    .ramadan-table table thead tr{
        height: 60px;
        color: #e9f6e9;
        background-color: #3a8232;
            font-size: 20px;
    }
    .ramadan-table table thead tr th{
        text-align: center;
        border-color: #fff;
        border-width: 4px;
    }
   .ramadan-table table tbody tr:nth-child(odd) {
        background-color: #fff;
    }
    .ramadan-table table tbody tr:nth-child(even) {
        background-color: #e9f6e9;
    }
    .ramadan-table table tbody tr{
        height: 60px;
        font-size: 20px;
    }
    .ramadan-table table tbody tr td{
        /*text-align: center;*/
        border-color: #fff;
        border-width: 4px;
    }
    .ramadan-table table{
        width: 100%;
    border-spacing: 4px;
    font-size: 1.125rem;
    border-bottom: 2px solid #42aa36;
    }
</style>
@endsection


@section('main_content')
<div class="container mb-5 mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="heading mb-4 mt-4">
                <div class="row">
                    <div class="col-md-12">
                        @php  $oneRamadan = today_one_ramadan(); @endphp
                        @if(!empty($oneRamadan))
                        <div class="romadan__block" id="ramadan">
                            <div class="banner">
                                <img src="https://voice7news.tv/img/v7_romadan.gif">
                            </div>
                            <div class="date text-center">
                                <p class="mb-0">Today: {{ \Carbon\Carbon::createFromFormat('Y-m-d', $oneRamadan->date)->format('l, F d, Y')}}<br>
                                {{$oneRamadan->ramadan_no}} Ramadan</p>
                            </div>
                            <ul class="list-ustyled col__head d-flex align-items-center">
                                <li class="dev__name">
                                    <span>Division</span>
                                </li>
                                <li class="sehri__time">
                                    <span>Sehri Time</span>
                                </li>
                                <li class="iftar__time">
                                    <span>Iftar Time</span>
                                </li>
                            </ul>
                            @if($item = today_ramadan('ঢাকা'))
                                <ul class="list-ustyled d-flex aling-items-center">
                                    <li class="dev__name">
                                        <span>{{$item->division}}</span>
                                    </li>
                                    <li class="sehri__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->sehri)))}} মি.</span>
                                    </li>
                                    <li class="iftar__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->iftar)))}} মি.</span>
                                    </li>
                                </ul>
                            @endif
                            @if($item = today_ramadan('চট্টগ্রাম'))
                                <ul class="list-ustyled d-flex aling-items-center">
                                    <li class="dev__name">
                                        <span>{{$item->division}}</span>
                                    </li>
                                    <li class="sehri__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->sehri)))}} মি.</span>
                                    </li>
                                    <li class="iftar__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->iftar)))}} মি.</span>
                                    </li>
                                </ul>
                            @endif
                            @if($item = today_ramadan('রাজশাহী'))
                                <ul class="list-ustyled d-flex aling-items-center">
                                    <li class="dev__name">
                                        <span>{{$item->division}}</span>
                                    </li>
                                    <li class="sehri__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->sehri)))}} মি.</span>
                                    </li>
                                    <li class="iftar__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->iftar)))}} মি.</span>
                                    </li>
                                </ul>
                            @endif
                            @if($item = today_ramadan('বরিশাল'))
                                <ul class="list-ustyled d-flex aling-items-center">
                                    <li class="dev__name">
                                        <span>{{$item->division}}</span>
                                    </li>
                                    <li class="sehri__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->sehri)))}} মি.</span>
                                    </li>
                                    <li class="iftar__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->iftar)))}} মি.</span>
                                    </li>
                                </ul>
                            @endif
                            @if($item = today_ramadan('সিলেট'))
                                <ul class="list-ustyled d-flex aling-items-center">
                                    <li class="dev__name">
                                        <span>{{$item->division}}</span>
                                    </li>
                                    <li class="sehri__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->sehri)))}} মি.</span>
                                    </li>
                                    <li class="iftar__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->iftar)))}} মি.</span>
                                    </li>
                                </ul>
                            @endif
                            @if($item = today_ramadan('খুলনা'))
                                <ul class="list-ustyled d-flex aling-items-center">
                                    <li class="dev__name">
                                        <span>{{$item->division}}</span>
                                    </li>
                                    <li class="sehri__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->sehri)))}} মি.</span>
                                    </li>
                                    <li class="iftar__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->iftar)))}} মি.</span>
                                    </li>
                                </ul>
                            @endif
                            @if($item = today_ramadan('রংপুর'))
                                <ul class="list-ustyled d-flex aling-items-center">
                                    <li class="dev__name">
                                        <span>{{$item->division}}</span>
                                    </li>
                                    <li class="sehri__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->sehri)))}} মি.</span>
                                    </li>
                                    <li class="iftar__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->iftar)))}} মি.</span>
                                    </li>
                                </ul>
                            @endif
                            @if($item = today_ramadan('ময়মনসিংহ'))
                                <ul class="list-ustyled d-flex aling-items-center">
                                    <li class="dev__name">
                                        <span>{{$item->division}}</span>
                                    </li>
                                    <li class="sehri__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->sehri)))}} মি.</span>
                                    </li>
                                    <li class="iftar__time">
                                        <span>{{e_to_b_int(date('h-i', strtotime($item->iftar)))}} মি.</span>
                                    </li>
                                </ul>
                            @endif
                        </div>
                        @endif
                    </div>
                    
                    <div class="col-md-4">
                        রমজান
                    </div>
                    <div class="col-md-8">
                        <form id="ramadan-filter" action="{{route('sahri.iftar.time')}}" method="get">
                            <select name="division" id="division">
                                @if(!empty($division))
                                <option selected value="{{$division}}">{{$division}}</option>
                                @else
                                <option value=""></option>
                                @endif
                                <option value="ঢাকা">ঢাকা</option>
                                <option value="চট্টগ্রাম">চট্টগ্রাম</option>
                                <option value="রাজশাহী">রাজশাহী</option>
                                <option value="খুলনা">খুলনা</option>
                                <option value="সিলেট">সিলেট</option>
                                <option value="বরিশাল">বরিশাল</option>
                                <option value="রংপুর">রংপুর</option>
                                <option value="ময়মনসিংহ">ময়মনসিংহ</option>
                            </select><span> জেলায় ইফতার শুরু</span>
                        </form>
                    </div>
                </div>
            </div>
            <div class="body">
                    @if(!empty($ramadans))
                    <div class="table-responsive ramadan-table">
                        <table class="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>রমজান</th>
                                <th>তারিখ</th>
                                <th>সাহরি শেষ</th>
                                <th>ইফতার শুরু</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ramadans as $ramadan)
                                <tr>
                                    <td class="text-center">{{e_to_b_int($ramadan->ramadan_no)}}</td>
                                    <td>{{ day_replace(engMonth_to_banMonth_replace(e_to_b_int(\Carbon\Carbon::createFromFormat('Y-m-d', $ramadan->date)->format('d F, l'))))}}</td>
                                    <td class="text-center">{{e_to_b_int(date('h-i', strtotime($ramadan->sehri)))}} মি.</td>
                                    <td class="text-center">{{e_to_b_int(date('h-i', strtotime($ramadan->iftar)))}} মি.</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_js')
<script type="text/javascript">
    $(document).ready(function () {
        $("#division").on('change',function(){
            $('#ramadan-filter').submit()
        });
    })
</script>
@endsection