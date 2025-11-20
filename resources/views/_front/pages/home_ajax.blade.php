<script>
    // ========== dropdown
    window.onload = function () {
        $.ajax({
            url: "{{ route('latestNews') }}",
            method: "GET",
            success: function (res) {
                $('.latestNews').html(res);
            }
        });

        $.ajax({
            url: "{{ route('popularNews') }}",
            method: "GET",
            success: function (res) {
                $('.popularNews').html(res);
            }
        });

        $.ajax({
            url: "{{ route('homeCategory2') }}",
            method: "GET",
            success: function (res) {
                $('.homeCategory2').html(res);
            }
        });


        $.ajax({
            url: "{{ route('homeCategory4_3') }}",
            method: "GET",
            success: function (res) {
                $('.homeCategory4_3').html(res);
            }
        });

        $.ajax({
            url: "{{ route('homeCategory3_3') }}",
            method: "GET",
            success: function (res) {
                $('.homeCategory3_3').html(res);
            }
        });

        $.ajax({
            url: "{{ route('homePageExcludive') }}",
            method: "GET",
            success: function (res) {
                $('.homePageExcludive').html(res);
            }
        });

        $.ajax({
            url: "{{ route('homePageCategory32') }}",
            method: "GET",
            success: function (res) {
                $('.homePageCategory32').html(res);
            }
        });

        $.ajax({
            url: "{{ route('homePageCat1') }}",
            method: "GET",
            success: function (res) {
                $('.homePageCat1').html(res);
            }
        });

        $.ajax({
            url: "{{ route('homePageCat3') }}",
            method: "GET",
            success: function (res) {
                $('.render-results').html(res);
            }
        });
        $.ajax({
            url: "{{ route('homeCategory6_3') }}",
            method: "GET",
            success: function (res) {
                $('.homeCategory6_3').html(res);
            }
        });
        $.ajax({
            url: "{{ route('homeCategory5_3') }}",
            method: "GET",
            success: function (res) {
                $('.homeCategory5_3').html(res);
            }
        });
        $.ajax({
            url: "{{ route('homeCategory54_3') }}",
            method: "GET",
            success: function (res) {
                $('.homeCategory54_3').html(res);
            }
        });
        $.ajax({
            url: "{{ route('homeVideo4') }}",
            method: "GET",
            success: function (res) {
                $('.homeVideo4').html(res);
            }
        });
        $.ajax({
            url: "{{ route('homeCategory7_3') }}",
            method: "GET",
            success: function (res) {
                $('.homeCategory7_3').html(res);
            }
        });
        $.ajax({
            url: "{{ route('homeCategory58_3') }}",
            method: "GET",
            success: function (res) {
                $('.homeCategory58_3').html(res);
            }
        });
        $.ajax({
            url: "{{ route('homeCategory11_3') }}",
            method: "GET",
            success: function (res) {
                $('.homeCategory11_3').html(res);
            }
        });

        $.ajax({
            url: "{{ route('homeCategory18_3') }}",
            method: "GET",
            success: function (res) {
                $('.homeCategory18_3').html(res);
            }
        });
    };
</script>