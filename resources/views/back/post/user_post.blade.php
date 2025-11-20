@extends('layouts.backend')
@section('title')
Admin | Index
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-asana" width="38" height="38" viewBox="0 0 24 24" stroke-width="1" stroke="#ff9300" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <rect x="4" y="4" width="6" height="6" rx="1" />
                                <rect x="4" y="14" width="6" height="6" rx="1" />
                                <rect x="14" y="14" width="6" height="6" rx="1" />
                                <line x1="14" y1="7" x2="20" y2="7" />
                                <line x1="17" y1="4" x2="17" y2="10" />
                            </svg>
                            All Posts</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('post.create') }}" class="btn btn__new pt-3 pb-3 float-right">+ Add</a>
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
                    <th class="text-center">Time</th>
                    <th class="text-center">Publisher</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Total Hit</th>
                    <th class="text-center" style="width: 180px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <div class="pagination-info">
                     <p>Showing {{$posts->firstItem()}} to {{$posts->lastItem()}} of {{$posts->total()}}</p>
                  </div>
                  @foreach($posts as $post)
                    <tr>
                      <td class="text-center">{{$post->id}}</td>
                      <td class="post__name">
                          <a href="" target="_blank"><p>{{ Str::limit($post->headline, 55) }}</p></a>
                      </td>
                      <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('H:i/d-m') }}</td>
                      <td class="text-center">{{  $post->User->name }}</td>
                      <td class="text-center">
                          @foreach($post->Category as $category)
                              <p>{!! $category->name !!}</p>
                          @endforeach
                          @foreach($post->subCategory as $subCategory)
                              <p>{!! $subCategory->name !!}</p>
                          @endforeach
                      </td>
                      <td class="text-center">{{ $post->view_count }}</td>
                      <td class="text-center">
                        <a title="view" target="_blank" href="" class="btn btn-soft-success btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                        <a title="edit" href="{{ route('post.edit', ['id' => $post->id])}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{$posts->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
