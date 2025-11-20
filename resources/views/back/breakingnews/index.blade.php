@extends('layouts.backend')
@section('title')
    Admin | Breaking News
@endsection

@section('extra_css')

@endsection

@section('extra_js')

@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">Add Breaking News</h4>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('breakingnews.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3" for="name">Heading <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="news_text" placeholder="News Headline" type="text" required>
                                        <span class="text-danger">{{ $errors->has('news_text') ? $errors->first('news_text'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="news_link">URL</label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="news_link" placeholder="URL" type="text" >
                                        <span class="text-danger">{{ $errors->has('news_link') ? $errors->first('news_link'):''}}</span>
                                    </div>
                                </div>

                                <button type="submit" class="float-right btn btn-success">Create</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->

                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">All Breaking</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px">ID</th>
                                        <th>Breaking News</th>
                                        <th class="text-center" style="width: 150px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($breakingnews as $news)
                                        <tr>
                                            <td class="text-center">{{$news->id}}</td>
                                            <td> <a target="_blank" href="{{$news->news_link}}">{!! Str::limit($news->news_text, 200) !!}</a>  </td>
                                            <td class="text-center">
                                                <a href="{{ route('breakingnews.edit', ['id' => $news->id])}}"
                                                   class="btn btn-soft-success btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-edit"></i></a>
                                                <a href="{{ route('breakingnews.destroy', ['id' => $news->id])}}"
                                                   onclick="return confirm('Are you sure to delete this!')"
                                                   class="btn btn-soft-danger btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!--col-6-->
            </div>
        </div>
    </main>
@endsection
