@extends('layouts.backend')
@section('title')
    Admin | Trash Post
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
                                <div class="col-md-6">
                                    <h4 class=" font-weight-light my-2 float-left">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff9300" stroke-linecap="round" stroke-linejoin="round" width="38" height="38" stroke-width="1">
                                            <path d="M12 17l-2 2l2 2"></path>
                                            <path d="M10 19h9a2 2 0 0 0 1.75 -2.75l-.55 -1"></path>
                                            <path d="M8.536 11l-.732 -2.732l-2.732 .732"></path>
                                            <path d="M7.804 8.268l-4.5 7.794a2 2 0 0 0 1.506 2.89l1.141 .024"></path>
                                            <path d="M15.464 11l2.732 .732l.732 -2.732"></path>
                                            <path d="M18.196 11.732l-4.5 -7.794a2 2 0 0 0 -3.256 -.14l-.591 .976"></path>
                                        </svg>
                                        All Trash Post
                                    </h4>
                                </div>
                                <div class="col-md-6 create__post text-right">
                                    <a href="{{ route('post.create') }}" class="btn btn__new pt-3 pb-3 float-right">+
                                        Create Post</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Headline</th>
                                        <th class="text-center" style="width: 120px">Time</th>
                                        <th>Created By</th>
                                        <th>Deleted By</th>
                                        <th class="text-center th__action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <div class="pagination-info">
                                        <p>Showing {{$trashposts->firstItem()}} to {{$trashposts->lastItem()}}
                                            of {{$trashposts->total()}}</p>
                                    </div>
                                    @foreach($trashposts as $post)
                                        <tr>
                                            <td class="text-center">{{$post->post_id}}</td>
                                            <td class="post__name">
                                                <p>{{ Str::limit($post->headline, 80) }}</p>
                                            </td>
                                            <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('H:i/d-m') }}</td>
                                            <td>
                                                @if( $post->user_id != null)
                                                    @if( $user = \App\Models\User::where('id',$post->user_id)->first() )
                                                        {{$user->name}}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if( $post->deleted_by != null)
                                                    @if( $user = \App\Models\User::where('id',$post->deleted_by)->first() )
                                                        {{$user->name}}
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a title="view" target="_self"
                                                   href="{{ route('trashpost.view',['id'=>$post->id]) }}"
                                                   class="btn btn-soft-success btn-icon btn-circle btn-sm"><i
                                                        class="fa fa-eye"></i></a>
                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('trashpost.destroy', ['id' => $post->id]) }}">
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
                                {{ $trashposts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


