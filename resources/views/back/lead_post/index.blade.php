@extends('layouts.backend')
@section('title')
    Admin | Lead News
@endsection
@section('extra_css')
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/google-code-prettify/bin/prettify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.min.css') }}">
    <style>
        .row_position td {
            cursor: pointer;
        }
    </style>

@endsection


@section('content')

    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-8 m-auto">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
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
                                        Lead News (<span style="font-size: 14px;color: var(--green);">You can drag and drop your Lead Post which will affect on Home Page</span>)
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Heading</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="row_position">

                                    @foreach($lead_posts as $lead_news)
                                        <tr id="{{ $lead_news->id }}">
                                            <td>{{ \App\Models\Post::find($lead_news->post_id)->headline}}</td>

                                            <td class="text-center">
                                                {{--<a href="{{ route('leadnews.edit', ['id' => $lead_news->id]) }}"
                                                   class="btn btn-sm btn-success" role="button"><i
                                                            class="fa fa-edit"></i></a>--}}
                                                <form action="{{ route('leadpost.destroy', ['id' => $lead_news->id]) }}"
                                                      method="post">
                                                    <input type="hidden" name="_method"
                                                           value="DELETE">
                                                    {{ csrf_field() }}
                                                    <button type="submit"
                                                            class="btn btn-soft-danger btn-icon btn-circle btn-sm permanently">
                                                        <i class="fa fa-trash"></i></button>

                                                </form>
                                            </td>
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

@section('extra_js')
    <script src="{{ asset('assets/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(".row_position").sortable({
            delay: 150,
            stop: function () {
                var selectedData = new Array();
                $('.row_position>tr').each(function () {
                    selectedData.push($(this).attr("id"));
                });
                updateOrder(selectedData);
            }
        });

        function updateOrder(data) {
            var CSRF_TOKEN = $('input[name="_token"]').attr('value');
            $.ajax({
                url: "{{ route('leadpost.position.update') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN, position: data},
                success: function () {
                    location.reload()
                }
            })
        }
    </script>
@endsection

