@extends('layouts.backend')
@section('title')
    Admin | Trash Post View
@endsection
@section('extra_css')

    <style type="text/css">
        .category__filter button {
            margin-left: 10px;
        }

        .create__post svg {
            stroke: #fff !important;
            width: 18px !important;
            height: 18px !important;
            margin-right: -4px;
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-12">
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
                                        Trash Post View
                                    </h4>
                                </div>
                                <div class="col-md-1 create__post">
                                    <a href="{{ url()->previous() }}" class="btn btn-danger float-right"><i class="fa fa-reply mr-2"></i> Go Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tbody>
                                    <tr>
                                        <th width="50px">ID</th>
                                        <td>{{ $trashpost->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>publisher_name</th>
                                        <td>{{ $trashpost->publisher_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>headline</th>
                                        <td>{{ $trashpost->headline }}</td>
                                    </tr>
                                    <tr>
                                        <th>single_page_headline</th>
                                        <td>{{ $trashpost->single_page_headline }}</td>
                                    </tr>
                                    <tr>
                                        <th>sub_headline</th>
                                        <td>{{ $trashpost->sub_headline }}</td>
                                    </tr>
                                    <tr>
                                        <th>excerpt</th>
                                        <td>{{ $trashpost->excerpt }}</td>
                                    </tr>
                                    <tr>
                                        <th>facebook_description</th>
                                        <td>{{ $trashpost->facebook_description }}</td>
                                    </tr>
                                    <tr>
                                        <th>post_content</th>
                                        <td>{!! $trashpost->post_content !!}</td>
                                    </tr>
                                    <tr>
                                        <th>featured_image_caption</th>
                                        <td>{{ $trashpost->featured_image_caption}}</td>
                                    </tr>
                                    <tr>
                                        <th>featured_image</th>
                                        <td><img src="{{ $trashpost->featured_image}}"/></td>
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


