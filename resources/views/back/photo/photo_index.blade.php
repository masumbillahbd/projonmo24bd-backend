@extends('layouts.backend')
@section('title')
    Admin | All Photos
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
                <div class="col-lg-10 m-auto">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <div class="pg__name float-left">
                                <h4 class=" font-weight-light my-2 float-left">
                                    All Photos
                                </h4>
                            </div>
                            <div class="pg__btn float-right">
                                <a href="{{ route('photo.create') }}" class="btn btn__new">+ Add</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Headline</th>
                                        <th class="text-center">Thumbnail</th>
                                        <th class="text-center th__action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($photos as $photo)
                                        <tr>
                                            <td class="text-center" width="70px">{{$photo->id}}</td>
                                            <td class="post__name">
                                                {{ Str::limit($photo->title, 55) }}
                                            </td>

                                            <td class="text-center" style="width: 130px">
                                                <img src="{{$photo->featured_image}}"
                                                     style="height: 60px; width: 80px; object-fit: cover">
                                            </td>
                                            <td class="text-center">
                                                <a title="edit" href="{{ route('photo.edit', ['id' => $photo->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                        class="fa fa-edit"></i></a>
                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('photo.destroy', ['id' => $photo->id])}}">
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

                                {{ $photos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


