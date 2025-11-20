@extends('layouts.backend')
@section('title')
     Admin | User post
@endsection

@section('extra_css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style type="text/css">
        .category__filter button {
            margin-left: 10px;
        }
        .create__post svg{
            stroke: #fff !important;
            width: 18px !important;
            height: 18px !important;
            margin-right: -4px;
        }
    </style>
@endsection

@section('extra_js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(function() {
  $('input[name="date"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>

@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2">
                                    <h4 class=" font-weight-light my-2 float-left">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-brand-asana" width="38" height="38"
                                             viewBox="0 0 24 24" stroke-width="1" stroke="#ff9300" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="6" height="6" rx="1"/>
                                            <rect x="4" y="14" width="6" height="6" rx="1"/>
                                            <rect x="14" y="14" width="6" height="6" rx="1"/>
                                            <line x1="14" y1="7" x2="20" y2="7"/>
                                            <line x1="17" y1="4" x2="17" y2="10"/>
                                        </svg>
                                        All Posts
                                    </h4>
                                </div>
                                <div class="col-md-8">
                                    <div style="margin: auto;display: table;"> 
                                        <form method="get" class="form-sub" id="date-form" action="{{ route('user.post.by.date')}}">
                                            <div class="form-group d-flex">
                                               <div class="dateSearch w-90" id="dateSrcBox">
                                                   <input class="form-control"  type="text" name="date" value="" required="" placeholder="date" >                   
                                                </div>
                                                <button type="submit" class="w-10 btn btn-info float-right ">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-2 create__post">
                                    <a href="{{ route('post.create') }}" class="btn btn-info pt-3 pb-3 float-right">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-plus" width="8" height="8"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <line x1="12" y1="5" x2="12" y2="19"/>
                                            <line x1="5" y1="12" x2="19" y2="12"/>
                                        </svg>
                                        Create Post</a>
                                </div>
                                <div class="col-md-12 text-center">
                                    <h4>{{$start_date}} <b>To</b> {{$end_date}}</h4>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th class="text-center">Total Post</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                    <?php $user = \App\Models\User::findOrFail($post->user_id) ;
                                        $totalUserPost = DB::select('SELECT count(id) as userPost FROM posts WHERE (DATE(created_at) BETWEEN "'.$start_date.'" AND "'.$end_date.'") AND user_id='.$user->id.' ');
                                    ?>
                                        <tr>
                                            <td><a href="{{route('userPostCountByDate',['id'=>$user->id,'start_date'=>$start_date,'end_date'=>$end_date])}}">{{$user->name}}</a></td>
                                            <td>{{$user->email}}</td>
                                            <td class="text-center">{{$totalUserPost[0]->userPost}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


