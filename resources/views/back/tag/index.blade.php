@extends('layouts.backend')
@section('title')
    Admin | Tags
@endsection
@section('extra_js')
    <script>
        $(document).ready(function () {
            $('.featureTagStatus').change(function () {
                var feature = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                console.log(id)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('featureTagStatus') }}",
                    data: {
                        'feature': feature,
                        'id': id
                    },
                    success: function (data) {
                        toastr.success(data.success)
                    }
                });
            });
        })
    </script>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                    <div class="card-header">
                        <h4 class="text-center font-weight-light my-1">Tag Managers</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="search-box">
                                    <div class="input-group">
                                        <form action="{{ route('tag.search') }}" role="search" class="d-flex"
                                              method="GET" style="margin: 0;">
                                            <input type="text" class="form-control" placeholder="Write a tag name..."
                                                   name="value" value="{{ $query ?? '' }}">
                                            <button class="btn btn-success px-4 ms-3" type="submit">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="col-md-4 mb-5">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Tag Name</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if ($search_tags->isNotEmpty())
                                            @foreach ($search_tags as $tag)
                                                <!-- Chunk the tags into groups of 3 -->
                                                <tr>
                                                    <td>{{ $tag->name }} <span title="Related Posts"
                                                                               class="label label-danger float-right">{{ $tag->getTagPostCountAttribute() }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="switch">
                                                            <input class="featureTagStatus"
                                                                   data-id="{{ $tag->id }}" type="checkbox"
                                                                {{ $tag->feature == 1 ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @php
                                                unset($search_tags, $tag);
                                            @endphp
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Feature Tag Name</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if ($feature_tags->isNotEmpty())
                                            @foreach ($feature_tags as $tag)
                                                <!-- Chunk the tags into groups of 3 -->
                                                <tr>
                                                    <td>{{ $tag->name }} <span title="Related Posts"
                                                                               class="label label-danger float-right">{{ $tag->getTagPostCountAttribute() }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="switch">
                                                            <input class="featureTagStatus"
                                                                   data-id="{{ $tag->id }}" type="checkbox"
                                                                {{ $tag->feature == 1 ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @php
                                                unset($feature_tags, $tag);
                                            @endphp
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Top Used Tag</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if ($popular_tags->isNotEmpty())
                                            @foreach ($popular_tags as $tag)
                                                <!-- Chunk the tags into groups of 3 -->
                                                <tr>
                                                    <td>{{ $tag->name }} <span title="Related Posts"
                                                                               class="label label-danger float-right">{{ $tag->getTagPostCountAttribute() }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="switch">
                                                            <input class="featureTagStatus"
                                                                   data-id="{{ $tag->id }}" type="checkbox"
                                                                {{ $tag->feature == 1 ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @php
                                                unset($popular_tags, $tag);
                                            @endphp
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!--col-6-->
        </div>
    </div>
@endsection
