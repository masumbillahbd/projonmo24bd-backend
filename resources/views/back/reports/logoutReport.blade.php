@extends('layouts.backend')
@section('title')
     Admin | Logout information
@endsection
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <div class="pg__name float-left">
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
                                    Logout Information
                                </h4>
                            </div>
                            <div class="pg__btn float-right">
                                <a href="{{ route('loginReport') }}" class="btn btn__view">View Login</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-center">Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <div class="pagination-info">
                                       <p>Showing {{$logout_info->firstItem()}} to {{$logout_info->lastItem()}} of {{$logout_info->total()}}</p>
                                    </div>
                                    @foreach($logout_info as $logout)
                                        <tr>
                                            <td>{{$logout->user_name}}</td>
                                            <td class="text-center">{{$logout->logout_time}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-list ">
                                    {!! $logout_info->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


