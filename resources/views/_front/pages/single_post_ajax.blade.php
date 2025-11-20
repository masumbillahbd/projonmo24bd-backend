
<script type="text/javascript">
    window.onload = function () {
        setTimeout(function () {
            $("div#side-popup-news-content").css({"right": "0px"});
        }, 5000);

        $('#newsPopupDisBtn').on('click', function (e) {
            // $("div#side-popup-news-content").css({"right": "-350px"});
            e.preventDefault();
            let post_id = $(this).attr('data-leadId');
            let session_id = $("#session_id").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('newsPopupStatus') }}",
                data: {'post_id': post_id, 'session_id': session_id},
                success: function (data) {
                    $("div#side-popup-news-content").css({"right": "-350px"});
                }
            });
        })

        let category_id = {{$category->id}};
        let post_id = {{$postIdFNP}};

        $.ajax({
            url: "{{ route('latestNews') }}",
            method: "GET",
            success: function (res) {
                $('.latestNews').html(res);
            }
        });

        $.ajax({
            url: "{{ route('popularNewsByCat') }}/" + category_id,
            method: "GET",
            success: function (res) {
                $('.popularNewsByCat').html(res);
            }
        });


        $.ajax({
            url: "{{ route('singlePageRelPost1') }}/" + category_id,
            method: "GET",
            success: function (res) {
                $('.singlePageRelPost1').html(res);
            }
        });

        $.ajax({
            url: "{{ route('singlePageRelPost2') }}/" + category_id + '/' + post_id,
            method: "GET",
            success: function (res) {
                $('.singlePageRelPost2').html(res);
            }
        });

        $.ajax({
            url: "{{ route('singlePageRelPost3') }}/" + category_id,
            method: "GET",
            success: function (res) {
                $('.singlePageRelPost3').html(res);
            }
        });

    };
</script>