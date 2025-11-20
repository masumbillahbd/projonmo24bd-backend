//modal show
$(document).ready(function () {
    $(".pmanagerModal").click(function () {
        $("#pmanagerModal").show()
    })
    $("#modalCloseBtn").click(function () {
        $("#pmanagerModal").hide()
        $("body").css('position', 'unset')
    })
})
//image store
$(document).ready(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#image').change(function () {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-image-before-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('#image-upload').submit(function (e) {
        e.preventDefault();
        $("#pmanager-server-message").empty();
        let formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: "{{ route('pmanager.store')}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                this.reset();
                $("#realtimedata").show();
                $("#preview-image-before-upload").attr('src', "{{ asset('defaults/default.jpeg')}}");
                $("#pmanager-server-message").append('<span class="text-success">Image uploaded successfully</span>');
            },
            error: function (data) {
                $("#pmanager-server-message").append('<span class="text-danger">Something is wrong</span>');
            }
        });
        setTimeout(function () {
            $("#pmanager-server-message").empty();
        }, 10000);
    });
});

// image load
let _token = $('input[name="_token"]').val();
load_data('', _token);

function load_data(id = "", _token) {
    $.ajax({
        url: "{{ route('loadmore.pmanager') }}",
        method: "POST",
        data: {id: id, _token: _token},
        success: function (data) {
            $('#load_more_button').remove();
            $('#load_more_product').append(data);
        }
    })
}

// image load
$(document).on('click', '#load_more_button', function () {
    var id = $(this).data('id');
    $('#load_more_button').html('<i style="padding:0 25px;" class="ai ai-loader"></i>');
    load_data(id, _token);
});

// pmanagerUse for you content
$(document).on('click', '.pmanagerUse', function (e) {
    e.preventDefault();
    let pmanagerUse = $(this).attr("data-id");
    if (pmanagerUse) {
        $("#pmanager-image-preview").html('')
        $.ajax({
            url: "{{ route('pmanager.single') }}/" + pmanagerUse,
            type: "get",
            dataType: "json",
            success: function (result) {
                $(".pmanager-input-field").val(result.photo);
                $("#pmanager-image-preview").append('<img src="' + result.photo + '"/>')
                $("#pmanagerModal").hide();
            },
            error: function (result) {
                console.log('error');
            }
        })
    }
});

// single Image show
$(document).on('click', '.pmanagerShow', function (e) {
    e.preventDefault();
    let pmanagerShow = $(this).attr("data-id");
    $(".pmanager-single-img").empty();
    $(".pmanager-single-img-name").empty();
    $(".pmanager-single-img-copy-url").show();
    $(".pmanager-single-img-delete-permanently").show();
    if (pmanagerShow) {
        $.ajax({
            url: "{{ route('pmanager.single') }}/" + pmanagerShow,
            type: "get",
            dataType: "json",
            success: function (result) {
                $(".pmanager-single-img").append('<img src="' + result.photo + '"/>');
                $(".pmanager-single-img-name").append('<span>' + result.name + '</span>');
                $(".pmanager-single-img-copy-url").attr('data-src', result.photo);
                $(".pmanager-single-img-delete-permanently").attr('data-id', result.id);
            },
            error: function (result) {
                console.log('error');
            }
        })
    }
});

//delete 
$(document).on('click', '.pmanager-single-img-delete-permanently', function (ele) {
    ele.preventDefault();
    let photoDeleteID = $(this).attr("data-id");
    if (photoDeleteID){
      let confirmation = confirm("Are you sure?");
      if(confirmation){
        $(".pmanager-single-message").show();
        $(".pmanager-single-message").empty();
        $.ajax({
            url: "{{ route('pmanager.delete') }}/"+photoDeleteID,
            type: "get",
            dataType: "json",
            success: function (result){
              $(".pmanager-single-message").append('<span class="text-success">Successfully Deleted</span>');
              $(".pmanager-single-img").empty();
              $(".pmanager-single-img-name").empty();
              $(".pmanager-single-img-copy-url").attr('data-src', '');
              $(".pmanager-single-img-delete-permanently").attr('data-id', '');
              $(".pmanager-single-img-copy-url").hide();
              $(".pmanager-single-img-delete-permanently").hide();
            },
            error: function(result){
              $(".pmanager-single-message").append('<span class="text-danger">Something Error</span>');
            }
        })
        setTimeout(function() { 
          $(".pmanager-single-message").hide();
        }, 3000);
      }
    }
})

//copy URL
function CopyToClipboard(txt) {
    let input = document.createElement('input');
    input.value = txt;
    document.body.append(input);
    input.select();
    document.execCommand('copy');
    input.remove();
    $(".clipboard-message").show();

    setTimeout(function () {
        $(".clipboard-message").hide();
    }, 2000);
}

//live search
$(document).on('keyup', '#search', function () {
    let searchQuery = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if (searchQuery.length > 0) {
        $('#search-results').show();
        $.ajax({
            method: 'POST',
            url: '{{ route("pmanager.live.search") }}',
            dataType: 'json',
            data: {
                searchQuery: searchQuery
            },
            success: function (results) {
                let result = '';
                $('#realtimedata').hide();
                $('#load_more_product').hide();
                $('#search-results').html('');
                if (Object.keys(results).length !== 0) {
                    $.each(results, function (index, value) {
                        let photoName = value.name;
                        if (photoName.length > 10) {
                            photoName = photoName.substring(0, 10) + '...';
                        }
                        result = '<div class="pmanager-box col-md-2"><img class="pmanager-img pmanagerUse" data-id="' + value.id + '" src="' + value.photo + '" alt="' + value.id + '"/><br><span>' + photoName + '</span><div class="pmanagerShow" data-id="' + value.id + '">view</div></div>'
                        $('#search-results').append(result);
                    })
                } else {
                    result = '<div class="col-md-12 col-lg-12 col-12 mt-2 mb-2 text-center">No data found</div>';
                    $('#search-results').append(result);
                }
            },
            error: function (results) {
                console.log(results)
            }
        });
    } else {
        $('#realtimedata').show();
        $('#load_more_product').show();
        $('#search-results').hide();
    }
});

//realtimedata
function loadXMLDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("realtimedata").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "{{ route('realtime.pmanager') }}", true);
    xhttp.send();
}

setInterval(function () {
    loadXMLDoc();
}, 1000)
window.onload = loadXMLDoc;