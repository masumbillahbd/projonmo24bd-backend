@extends('layouts.backend')
@section('title')
    Admin | Poll create
@endsection
@section('extra_css')
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://www.newsflash71.com/assets/vendors/google-code-prettify/bin/prettify.min.css">
    <style>
        .input-group {
            margin-bottom: 10px;
        }

        .table-condensed > thead > tr > th, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > tbody > tr > td, .table-condensed > tfoot > tr > td {
            padding: 5px 7px;
            text-align: center;
        }

        /*//my*/
        textarea.form-control {
            height: auto !important;
        }

        .table-condensed > thead > tr > th.prev,
        .table-condensed > thead > tr > th.next {
            cursor: pointer;
            background: #eee;
        }
    </style>
@endsection

@section('extra_js')
    <script src="https://www.newsflash71.com/assets/vendors/parsleyjs/dist/parsley.min.js"></script>
    <script
        src="https://www.newsflash71.com/assets/vendors/bootstrap-datepicker-1.6.1/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: "linked"
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="pg__name float-left">
                            <h4 class="font-weight-light my-1">Edit Survey</h4>
                        </div>
                        <div class="pg__btn float-right">
                            <a href="{{ route('poll.index') }}" class="btn btn__view">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post"
                              action="{{ route('poll.update', ['id' => $pollEdit->id ]) }}) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="mb-1">Question</label>
                                <textarea name="question" required="" id="question" class="form-control"
                                          rows="5">{{ $pollEdit->question }}</textarea>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="start">Starting Date</label>
                                    <div class="input-group date">
                                        <input value="{{ $pollEdit->start_date }}" name="start_date" required=""
                                               id="start" type="text" class="form-control datepicker">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th "></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="end">Ending Date</label>
                                    <div class="input-group date">
                                        <input value="{{ $pollEdit->end_date }}" name="end_date"
                                               data-provide="datepicker" value="" data-date-format="yyyy-mm-dd"
                                               required="" id="end" type="text" class="form-control datepicker">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th "></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="form-control btn-success" value="Update">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



