@extends('layouts.backend')
@section('title')
    Admin | All Category
@endsection

@section('extra_css')

    <!-- jQuery (required first) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-results__option {
            display: flex;
            align-items: center;
        }

        .select2-selection__rendered {
            display: none;
        }

        .select2-results__option .form-check-input {
            margin-right: 10px;
        }

        .select2-results__option {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .select2-results__option .form-check-input {
            margin-right: 5px;
        }


    </style>
@endsection

@section('extra_js')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#leader").select2();
            $('#read_more_post_id').select2({
                placeholder: 'Search by Title',
                minimumInputLength: 2,
                multiple: true, // Enable multiple selections
                closeOnSelect: false, // Prevent dropdown from closing after selection
                ajax: {
                    url: '{{ route('posts.auto.search') }}', // Adjust the route
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term // Search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(function (item) {
                                return {
                                    id: item.id,
                                    text: `${item.headline}`
                                };
                            })
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) {
                    return markup; // Allow custom HTML
                },
                templateResult: function (data) {
                    if (!data.id) {
                        return data.text;
                    }

                    // Add checkbox to each result with label click support
                    const uniqueId = `checkbox-${data.id}`; // Unique ID for each checkbox
                    return $(`
                <div class="form-check">
                    <input type="checkbox" id="${uniqueId}" class="form-check-input select2-checkbox" value="${data.id}">
                    <label for="${uniqueId}" class="form-check-label">${data.text}</label>
                </div>
            `);
                },
                templateSelection: function (data) {
                    return data.text; // Format selected items
                }
            });

            // Function to update the selected item count
            function updateSelectedCount() {
                const selectedCount = $('#read_more_post_id').val()?.length || 0;
                $('#selected-count').text(`Selected Items: ${selectedCount}`);
            }

            // Sync checkboxes with selections
            $('#read_more_post_id').on('select2:open', function () {
                // Sync checkboxes with current selected values
                const selectedValues = $('#read_more_post_id').val() || [];
                $('.select2-checkbox').each(function () {
                    const checkboxValue = $(this).val();
                    $(this).prop('checked', selectedValues.includes(checkboxValue));
                });
            });

            // Handle checkbox click events
            $(document).on('change', '.select2-checkbox', function () {
                const selectedValues = $('#read_more_post_id').val() || [];
                const checkboxValue = $(this).val();

                if (this.checked) {
                    // Add the value if checked
                    if (!selectedValues.includes(checkboxValue)) {
                        selectedValues.push(checkboxValue);
                    }
                } else {
                    // Remove the value if unchecked
                    const index = selectedValues.indexOf(checkboxValue);
                    if (index > -1) {
                        selectedValues.splice(index, 1);
                    }
                }

                // Update the Select2 field with the new selection
                $('#read_more_post_id').val(selectedValues).trigger('change');

                // Update the selected item count
                updateSelectedCount();
            });

            // Update count on initial load
            updateSelectedCount();

            // Update count whenever the value changes
            $('#read_more_post_id').on('change', function () {
                updateSelectedCount();
            });
        });
    </script>
@endsection
@section('content')
 
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">Edit Read More</h4>
                        </div>
                        <div class="card-body">
                            <form role="form" name="form" method="post"
                                  action="{{ route('readmore.update',['id'=>$edit[0]['leader']]) }}">
                                @csrf
                                <div class="form-group ">
                                    <label for="name">Leader Post <span class="text-danger">*</span></label>
                                    <select class="form-control" name="leader" id="leader">
                                        <option value="">--Select Post--</option>
                                        @foreach($posts as $post)
                                            <option
                                                value="{{$post->id}}" {{ $post->id == $edit[0]['leader'] ? 'selected':''}}>
                                                {{ Str::limit($post->headline,60) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span
                                        class="text-danger">{{ $errors->has('leader') ? $errors->first('leader'):''}}</span>
                                </div>

  <div class="container-fluid">
    <div class="row justify-content-center">  
      @include('back.parts.message')
      <div class="col-lg-4">
        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
          <div class="card-header"><h4 class="text-center font-weight-light my-1">Edit Read More</h4></div>          
          <div class="card-body"> 
            <form role="form" name="form" method="post" action="{{ route('readmore.update',['id'=>$edit[0]['leader']]) }}">
              @csrf
              <div class="form-group ">
                <label for="name">Leader Post <span class="text-danger">*</span></label>
                  <select class="form-control" name="leader" id="leader">
                    <option value="">--Select Post--</option>
                    @foreach($posts as $post)
                    <option value="{{$post->id}}" {{ $post->id == $edit[0]['leader'] ? 'selected':''}}>{{ Str::limit($post->headline,60) }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger">{{ $errors->has('leader') ? $errors->first('leader'):''}}</span>
              </div>


                                <div class="form-group">
                                    <label for="name">Read More <span class="text-danger">*</span></label>
                                    <select id="read_more_post_id" name="post_id[]" style="width: 100%;" multiple>
                                        @foreach($edit as $editItem)
                                            <option value="{{ $editItem->post_id }}"
                                                {{ in_array($editItem->post_id, $selectedPostIds) ? 'selected' : '' }}>
                                                {{ Str::limit(optional($editItem->post)->headline ?? 'N/A', 60) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="float-right btn btn-success">Updated</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->

                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">All Read More mmm</h4></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Leader Post</th>
                                        <th>Read More</th>
                                        <th>Image</th>
                                        <th class="text-center" style="width: 150px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($readmore as $post)
                                        <tr>
                                            <td>
                                                <?php $leader = \App\Models\Post::where('id', $post->leader)->first(); ?>
                                                @if(!empty($leader))
                                                    <a href="{{ news_url($post->leader) }}" target="_blank">
                                                        {{ Str::limit($leader->headline,60) }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($post->post->headline))
                                                    <a href="{{ news_url($post->post->id) }}" target="_blank">
                                                        {{ Str::limit($post->post->headline,60)  }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($post->post->featured_image))
                                                    <img src="{{ $post->post->featured_image}}"></td>
                                            @endif
                                            <td class="text-center">
                                                @if(!empty($post->post->featured_image))
                                                    <a title="edit"
                                                       href="{{ route('readmore.edit', ['leader' => $post->leader])}}"
                                                       class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-edit"></i></a>
                                                @endif
                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('readmore.delete', ['id' => $post->id])}}">
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
@endsection