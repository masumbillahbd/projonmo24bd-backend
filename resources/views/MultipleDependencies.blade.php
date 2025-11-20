<script>
    $(document).ready(function () {

        // Cached DOM references
        const $division = $('#division_list');
        const $district = $('#district_list');
        const $upazila = $('#upazila_list');

        // Helper to reset select dropdown
        function resetSelect($select, placeholder) {
            $select.empty().append(`<option selected value="">${placeholder}</option>`);
        }

        // 🔁 Division to District AJAX
        $division.on('change', function () {
            const divisionId = $(this).val();

            resetSelect($district, 'জেলা');
            resetSelect($upazila, 'উপজেলা');

            if (divisionId) {
                $.ajax({
                    url: "{{ route('division.district.news') }}/" + divisionId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        resetSelect($district, 'জেলা');
                        $.each(data, function (key, value) {
                            $district.append(`<option value="${value.id}">${value.name}</option>`);
                        });
                    },
                    error: function () {
                        alert('জেলা লোড করতে ব্যর্থ হয়েছে।');
                    }
                });
            }
        });

        // 🔁 District to Upazila AJAX
        $district.on('change', function () {
            const districtId = $(this).val();

            resetSelect($upazila, 'উপজেলা');

            if (districtId) {
                $.ajax({
                    url: "{{ route('district.upazila.news') }}/" + districtId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        resetSelect($upazila, 'উপজেলা');
                        $.each(data, function (key, value) {
                            $upazila.append(`<option value="${value.id}">${value.name}</option>`);
                        });
                    },
                    error: function () {
                        alert('উপজেলা লোড করতে ব্যর্থ হয়েছে।');
                    }
                });
            }
        });

    });
</script>
