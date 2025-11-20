@extends('layouts.backend')
@section('title')
    Admin | Index
@endsection

@section('extra_css')

    <style type="text/css">

    </style>
@endsection

@section('extra_js')
    <script>
        $(document).ready(function () {

        })
    </script>
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
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <a href="{{ route('post.create') }}" class="btn btn__new pt-3 pb-3 float-right">+ Create Post</a>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width: 90px">ID</th>
                                        <th>Headline</th>
                                        <th class="">Category</th>
                                        <th class="text-center" style="width: 180px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($draft as $post)
                                        <tr>
                                            <td class="text-center">{{$post->id}}</td>
                                            <td class="post__name">
                                                <a href="" target="_blank"><p>{{ Str::limit($post->headline, 55) }}</p>
                                                </a>
                                            </td>
                                            <td class="">
                                                @foreach($post->Category as $category)
                                                    {!! $category->name !!}
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                <a title="edit" href="{{ route('draft.edit',['id'=>$post->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-edit"></i></a>
                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('draft.destroy',['id'=>$post->id])}}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_confirm"
                                                                data-toggle="tooltip" title='Delete'><i
                                                                    class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                {{ $draft->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


