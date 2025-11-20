<script>
    $(document).ready(function () {

        var _token = $('input[name="_token"]').val();
        var total_click = 0;
        load_data('', _token);
        function load_data(id = "", _token) {
            let category_id = {{$category->id}};
            $.ajax({
                url: "{{ route('loadmore.category.post') }}/" + category_id,
                method: "POST",
                data: {id: id, _token: _token, total_click: total_click},
                success: function (data) {
                    $('#load_more_button').remove();
                    $('#load_more_post').append(data);
                }
            })
        }
        $(document).on('click', '#load_more_button', function () {
            total_click++;
            var id = $(this).data('id');
            $('#load_more_button').html('আরও <i style="padding:0 2px;" class="fa fa-spinner"></i>');
            load_data(id, _token);
        });

    });
</script>