@extends('layouts.backend')
@section('title')
    Admin | Pages
@endsection
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <div class="pg__name float-left">
                                <h4 class="font-weight-light my-1">Add Page</h4>
                            </div>
                            <div class="pg__btn float-right">
                                <a href="{{ route('page.create') }}" class="btn btn__new">+ Add</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width: 70px">ID</th>
                                        <th>Title</th>
                                        <th class="text-center" style="width: 170px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($pages as $row)
                                        <tr>
                                            <td class="text-center">{{$row->id}}</td>
                                            <td>{{$row->title}}</td>
                                            <td class="text-center">
                                                <a title="View" target="_blank" href="{{ page_url($row->slug) }}" class="btn btn-soft-success btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                                <a title="Edit" href="{{ route('page.edit', ['id' => $row->id])}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                                <div style="display: inline-block;">
                                                <form method="POST" action="{{ route('page.destroy', ['id' => $row->id]) }}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i></button>
                                                </form>
                                                </div>
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

