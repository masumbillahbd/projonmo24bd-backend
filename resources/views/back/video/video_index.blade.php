@extends('layouts.backend')
@section('title')
    Admin | Index
@endsection
@section('content')
    <main>
        <div class="container-fluid">
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
                                    All Videos
                                </h4>
                            </div>
                            <div class="pg__btn float-right">
                                <a href="{{ route('video.create') }}" class="btn btn__new">+ Add</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Thumbnail</th>
                                        <th>Headline</th>
                                        <th class="text-center">View</th>
                                        <th class="text-center" style="width: 180px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($videos as $video)
                                        <tr>
                                            <td class="text-center">{{$video->id}}</td>
                                            <td class="text-center"><img src="{{$video->thumbnail}}"/></td>
                                            <td class="post__name"><p>{{ Str::limit($video->title, 55) }}</p>
                                            </td>
                                            <td class="text-center">{{$video->view_count}}</td>
                                            <td class="text-center">
                                                <a title="view" target="_blank" href="{{ video_url($video->uniqid) }}"
                                                   class="btn btn-soft-success btn-icon btn-circle btn-sm"><i
                                                        class="fa fa-eye"></i></a>
                                                <a title="edit" href="{{ route('video.edit', ['id' => $video->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                        class="fa fa-edit"></i></a>
                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('video.destroy', ['id' => $video->id])}}">
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

                                {{ $videos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


