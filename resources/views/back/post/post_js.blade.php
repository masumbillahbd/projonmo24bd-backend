<script>
    $(document).ready(function () 
    {
        $('#post_status').on('click', function () {
            let postStatus = $('#post_status').val(); 
            if (postStatus == '0') {  // If 'No' is selected
                $('#publish_time_wrapper').show();
            }else if(postStatus == '1'){  // If 'Yes' is selected
                $('#publish_time_wrapper').hide();
            }
        })
        // Disable the submit button when clicked to prevent duplicate submissions
        $('form').submit(function(event) {
            // Disable all submit buttons in the form
            $(this).find('.submit').prop('disabled', true);
            // Optionally, you can change the button text to indicate submission in progress
            $(this).find('.submit').text('Submitting...');
            // Continue form submission
        });
        
        $("#myTags").tagit({
            singleField: true,
            singleFieldNode: $('#mySingleField'),
            allowSpaces: true,
            minLength: 2,
            removeConfirmation: true,
            tagSource: function(request, response) {
                let keyword = request.term;
                console.log('Searching for keyword:', keyword);
                $.ajax({
                    url: "{{ route('tagLiveSearch') }}/" + keyword,
                    data: { term: request.term },
                    dataType: "json",
                    success: function(data) {
                        console.log('Search results:', data);
                        response($.map(data, function(item) {
                            return {
                                label: item.name,
                                value: item.name
                            };
                        }));
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data: ", error);
                    }
                });
            }
        });
        

        let sticky = $("#sticky");
        if (sticky.is(':checked')) {
            $("#sticky_position_input").css("display", "block");
        }
        sticky.on('click', function () {
            if (sticky.is(':checked')) {
                sticky.val(1);  // checked
                $("#sticky_position_input").css("display", "block");
            } else {
                sticky.val(0);
                $("#sticky_position_input").css("display", "none");
                $("#sticky_position").val('');
            }
        });

        let show_user_photo = $("#show_user_photo");
        show_user_photo.click(function () {
            if (show_user_photo.is(':checked')) {
                show_user_photo.val(1);  // checked
            } else {
                show_user_photo.val(0);
            }
        });

        $('#lfm').filemanager('image');
        $('#lfm2').filemanager('image');
    
        $('#category_list').select2();
        $('#reporter_id').select2();
        $('#division_list').on('change', function (e) {
            let division_id = e.target.value;
        });
        $("#sticky_position").on("keyup", function() {
            this.value = this.value.replace(/[^0-9]/g,"");
        });
        //ajax category subCsategory
        $('#category_list').on('change', function (e) {
            let category_id = e.target.value;
            if(category_id) {
                $.ajax({
                    url: "{{ route('category.subcategory.ajax') }}/" + category_id,
                    type: "get",
                    dataType: "json",
                    success: function (data) {
                        $("#sub_cat_list").empty();
                        $("#sub_cat_list").append('<option selected value="">--Select Sub Category--</option>')
                        $.each(data, function (key, value) {
                            $('#sub_cat_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                        })
                    }
                })
            } else{
                console.log('category id not found');
            }
        });
        //ajax district
        $('#division_list').on('change', function (e) {
            let division_id = e.target.value;
            $("#district_list").empty();
            $("#district_list").append('<option selected  value="">Select District</option>');
            $("#upazila_list").empty();
            $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
            if(division_id){
                $.ajax({
                    url:"{{ route('division.district') }}/"+division_id,
                    type:"get",
                    dataType:"json",
                    success:function(data){
                        $("#district_list").empty();
                        $("#district_list").append('<option selected  value="">Select District</option>');
                        $.each(data,function(key, value){
                            $('#district_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                        })
                    }
                })
            }else{
                $("#district_list").empty();
                $("#district_list").append('<option selected  value="">Select District</option>');
                $("#upazila_list").empty();
                $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
            }
        });
        
        //ajax upazila
        $('#district_list').on('change', function (e) {
            let district_id = e.target.value;
            $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
            if(district_id){
            $.ajax({
                url:"{{ route('district.upazila') }}/"+district_id,
                type:"get",
                dataType:"json",
                success:function(data){
                    $("#upazila_list").empty();
                    $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
                    $.each(data,function(key, value){
                        $('#upazila_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                    })
                }
              })
            }else{
                $("#upazila_list").empty();
                $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
            }
        });
        //image preview
        $('.profile-img-input').change(function (e) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('.profileImgShow').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    });
</script>