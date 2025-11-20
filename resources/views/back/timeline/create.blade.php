@extends('layouts.backend')
@section('title')
    Admin | All Timeline
@endsection
@section('extra_js')
    <script>
        $(document).ready(function () {
            $('.toggle-class-pub').change(function () {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                console.log(id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('timelineStatusChange') }}",
                    data: {'status': status, 'id': id},
                    success: function (data) {
                        toastr.success(data.success)
                    }
                });
            });
        })
    </script>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">Add Timeline</h4></div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('timeline.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input class=" form-control" name="name" value="{{ old('name') }}"
                                           placeholder="Name" type="text" maxlength="150" autocomplete="off">
                                    <span
                                        class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                                </div>
                                <button type="submit" class="float-right btn btn-success">Create</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->

                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">All Timeline</h4></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px">ID</th>
                                        <th>Timeline Name</th>
                                        <th class="text-center" style="width: 150px">Status</th>
                                        <th class="text-center" style="width: 150px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $row)
                                        <tr>
                                            <td class="text-center">{{$row->id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td class="text-center">
                                                <label class="switch">
                                                    <input class="toggle-class-pub" type="checkbox"
                                                           data-id="{{$row->id}}" {{ $row->status ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <a title="edit" href="{{ route('timeline.edit', ['id' => $row->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                        class="fa fa-edit"></i></a>
                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('timeline.destroy', ['id' => $row->id])}}">
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
                            </div>
                        </div>
                    </div>
                </div> <!--col-6-->
            </div>
        </div>
    </main>
@endsection
