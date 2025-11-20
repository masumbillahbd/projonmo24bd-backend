@extends('layouts.backend')
@section('title')
    Admin | User post
@endsection

@section('extra_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <style type="text/css">
        .category__filter button {
            margin-left: 10px;
        }

        .card-header svg {
            stroke: #fff !important;
            width: 16px !important;
            height: 16px !important;
            margin-right: -4px;
        }
    </style>
@endsection

@section('extra_js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function () {
            $('input[name="date"]').daterangepicker({
                opens: 'left'
            }, function (start, end, label) {
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
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 justify-content-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fa fa-reply mr-2" style="font-size: 15px"></i> Back</a>
                                </div>
                            </div>
                            <div class="text-center user__post__data d-block pt-3">
                                <hr class="my-3 pb-3">

                                <h5><strong>User Name:</strong> {{ $user->name ?? 'N/A'}}</h5>
                                <h5><strong>Email:</strong> {{ $user->email ?? 'N/A'}}</h5>
                                <h5><strong>Date:</strong> {{ view_date_format($start_date, 'd-m-Y') ?? 'N/A'}} to {{ view_date_format($end_date, 'd-m-Y') ?? 'N/A'}}
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th class="text-center">Total Post</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $totalPosts = 0;  // Initialize a variable to track the total count
                                    @endphp

                                    @foreach($dateRange as $date)
                                        @php
                                            $totalUserPost = DB::select('SELECT count(id) as userPost FROM posts WHERE (DATE(created_at) BETWEEN "'.$date.'" AND "'.$date.'") AND user_id='.$user->id.' ');
                                        @endphp

                                        @if($totalUserPost[0]->userPost > 0)
                                            <tr>
                                                <td>{{ view_date_format($date, 'd-m-Y') }}</td>
                                                <td class="text-center">{{$totalUserPost[0]->userPost}}</td>
                                            </tr>

                                            @php
                                                $totalPosts += $totalUserPost[0]->userPost ?? 0;  // Add to the total count
                                            @endphp
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td><strong>Total Posts</strong></td>
                                        <td class="text-center"><strong>{{$totalPosts}}</strong></td>
                                    </tr>
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


