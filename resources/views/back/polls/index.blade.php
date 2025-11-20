@extends('layouts.backend')
@section('title')
    Admin | All Surveys
@endsection

@section('extra_css')
    <style type="text/css">

    </style>
@endsection

@section('extra_js')

@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            @include('back.parts.message')
            <div class="col-lg-10 m-auto">
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
                                All Surveys
                            </h4>
                        </div>
                        <div class="pg__btn float-right">
                            <a href="{{ route('poll.create') }}" class="btn btn__new">+ Add</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Survey Questions</th>
                                    <th class="text-center" style="width: 190px">Start Date</th>
                                    <th class="text-center" style="width: 190px">End Date</th>
                                    <th class="text-center" style="width: 180px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $polls = \App\Models\Poll::paginate(20); ?>
                                @foreach(\App\Models\Poll::all() as $poll)
                                    <tr>
                                        <td class="text-center">{{ $poll->id }}</td>
                                        <td>{{ $poll->question}}</td>
                                        <td class="text-center">{{ view_date_format($poll->start_date) }}</td>
                                        <td class="text-center">{{ view_date_format($poll->end_date) }}</td>
                                        <td class="text-center">
                                            <a title="edit" href="{{ route('poll.edit', ['id' => $poll->id])}}"
                                               class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                    class="fa fa-edit"></i></a>

                                            <div style="display: inline-block;">
                                                <form method="POST"
                                                      action="{{ route('poll.delete', ['id' => $poll->id])}}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit"
                                                            class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_confirm"
                                                            data-toggle="tooltip" title='Delete'><i
                                                            class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination px-3 pb-2">
                                {{$polls->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


