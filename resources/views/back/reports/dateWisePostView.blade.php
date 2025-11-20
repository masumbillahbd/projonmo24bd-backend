@extends('layouts.backend')
@section('title')
    Admin | Page view report
@endsection
@section('extra_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <style>
        .callout-card {
            margin-bottom: 20px;
        }

        /*date search box*/
        .dateSearch {
            position: relative;
            top: 0;
            width: 100%;
        }

        .dateSearch .form-sub .search-input {
            position: ;
            top: 0;
            right: 0;
            border: 1px solid #ced4da;
            border-radius: 4px;
            outline: none;
            background: #fff;
            width: 100%;
            height: 35px;
            margin: 0;
            padding: 7px 65px 7px 10px;
            font-family: sans-serif;
            font-size: 16px;
            color: #2c3e50;
        }

        .dateSearch .form-sub .submit-btn {
            top: 0;
            right: 0;
            position: absolute;
            outline: none;
            border: none;
            width: 55px;
            height: 44px;
            background: #28a745;
            color: white;
            padding: 0 14px;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
        }
    </style>
@endsection

@section('extra_js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>

$(function() {

var start = moment().subtract(29, 'days');
var end = moment();

function cb(start, end) {
    $('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
}

$('#reportrange').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'This Year': [moment().startOf('year'), moment().endOf('year')],
        'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
    }
}, cb);

cb(start, end);

});

        // $(function () {
        //     $('input[name="date"]').daterangepicker({
        //         opens: 'left'
        //     }, function (start, end, label) {
        //         console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        //     });
        // });
    </script>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">

                @include('back.parts.message')

                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-2">View Date Wise Report</h4></div>

                        <div class="card-body">

                            <div class="dateSearch mb-4" id="dateSrcBox">
                                <form class="form-sub" action="{{ route('date.wise.view') }}" method="get"
                                      id="date-form">
                                    <input id="reportrange" class="form-control" style="height: 36px;" type="text" name="date"
                                           required="" placeholder="date to date search">
                                    <button class="submit-btn" type="submit" name="button"><i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>

                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr class="table-active">
                                    <th>Date</th>
                                    <th class="text-center">Page View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($views as $view)
                                    <tr>
                                        <td>{{ view_date_format($view->date, 'd-m-Y') ?? 'N/A' }}</td>
                                        <td class="text-center">{{$view->view ?? 0 }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot class="mt-3">
                                <tr>
                                    <td><b>Total</b></td>
                                    <td class="text-center"><b>{{$total_views}}</b></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
