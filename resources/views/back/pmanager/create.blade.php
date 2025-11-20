<!DOCTYPE html>
<html lang="en">
<head>
  <title>Media Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.16/clipboard.min.js"></script>
  <style type="text/css">
    .modal-dialog{
      width: 80% !important;
    }
    .modalCloseBtn{
      border: 0px !important;
      background: none !important;
    }
    #pmanagerModal{
      height: 486px;
    overflow-y: clip;
    }
    #allMedia{
      height: 350px;
    overflow-y: scroll;
    overflow-x: hidden;
    }
    .pmanager-box{
      display: inline-block;
      padding:5px 0;
/*      background: #eee;*/
    }
    .pmanager-img{
      width: 120px;
      height: 120px;
    }
    .pmanager-single-details{
      margin-right: 10px;
    }
    .pmanager-single-img{
      padding-bottom: 10px;
    }
    .pmanager-single-img img{
      width: 100%;
      border: 2px solid #eee;
    }
    #pmanager-image-preview img{
      margin-top:10px;
      margin-bottom:10px;
      max-width:100px;
    }
    .pmanagerShow{
      color: #28a745 !important;
    }
    .pmanager-single-img-copy-url{
      text-decoration: none;
      color: #000;
    }
    .pmanager-single-img-delete-permanently{
      padding: 5px 0;
    }
    .pmanager-single-img-delete-permanently,
    .pmanagerShow,
    .pmanagerUse{
      cursor: pointer;
    }
    .pmanager-single-img-copy-url,
    .pmanager-single-img-delete-permanently,
    .pmanager-single-message,
    .clipboard-message{
      display: none;
    }

  </style>
</head>
<body>

<div class="container mt-3">
  <h2> form</h2>
  @if(Session::has('success'))
<div class="alert alert-success show">
  {{ Session::get('success') }}
</div>
@endif
  <form method="POST" action="">
    @csrf
    <div class="mb-3 mt-3">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">

                <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
    </div>
    <div class="mb-3">
      <label for="pwd">Test:</label>
      <textarea class="form-control" name="content" placeholder="Comment" rows="5"></textarea>
      <span class="text-danger">{{ $errors->has('content') ? $errors->first('content'):''}}</span>
    </div>
 
    <div class="form-group">
        <label>Featured Image</label>
        <div class="input-group">
            <input id="thumbnail" class="form-control pmanager-input-field" type="text" name="featured_image">
            <span class="input-group-btn pmanagerModal" id="featureImage" > <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary"> <svg class="svg-inline--fa fa-image fa-w-16" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="image" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z"></path></svg>Choose</a> </span> 
        </div>
        <span class="text-danger">{{ $errors->has('featured_image') ? $errors->first('featured_image'):''}}</span>
        <div id="pmanager-image-preview"></div>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Submit</button>
  </form>
  
</div>
 <!--pmanagerModal open-->
    <div class="modal" id="pmanagerModal">
        <div class="modal-dialog w-80" style="max-width: 100%;">
            <div class="modal-content mt-0 mt-md-4 mtlg-4 mt-xl-4">
                <div class="modal-header d-inline-block pb-0" style="border-bottom:none;">
                    <div class="float-start">
                      <h6>Media Gallery</h6>
                    </div>
                    <div class="float-end">
                      <button type="button" id="modalCloseBtn" data-bs-dismiss="modal" style="border: 0px !important;background: none !important;">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="icon icon-tabler icon-tabler-x" width="34"
                             height="34" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="#fff" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M18 6l-12 12"/>
                            <path d="M6 6l12 12"/>
                        </svg>
                    </button>
                    </div>
                </div>
                <div class="modal-body pt-0" id="modalBody">
                    <div id="modal_preloader"></div>
                    <div class="modal-body-content">
                      
                      <!--tabs open-->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a href="#mediaUpload" class="nav-link " data-bs-toggle="tab" role="tab">
                                Upload
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#allMedia" class="nav-link active" data-bs-toggle="tab" role="tab">
                                Media
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade  " id="mediaUpload" role="tabpanel">
                            <div class="panel-body">
                              <form method="POST" enctype="multipart/form-data" id="image-upload" action="javascript:void(0)" >
                                <div class="row mt-4">
                                  <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <input type="file" name="image" placeholder="Choose image" id="image">
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-2">
                                      <img id="preview-image-before-upload" src="{{ asset('defaults/default.jpeg')}}" alt="preview image" style="max-height: 250px;">
                                      <div id="pmanager-server-message"></div>
                                  </div>
                                  <div class="col-md-12">
                                      <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                  </div>
                                </div>     
                              </form>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="allMedia" role="tabpanel">
                          <div class="container">
                            <div class="row">
                              <div class="col-md-8">
                                <div class="my-2 w-80">
                                  <input id="search" class="form-control rounded search-bar" type="text" placeholder="Search by name and date" required="" autocomplete="on">
                                </div>
                                <div class="row pb-1" id="realtimedata" style="text-align:center;">  </div>
                                <div class="row pb-1" id="load_more_product" style="text-align:center;"> {{ csrf_field() }} </div>
                                <div class="row pb-1" id="search-results" style="text-align:center;"></div>
                              </div>
                              <div class="col-md-4 text-center">
                                <div class="pmanager-single-details mr-3 pe-3">
                                  <h6>Media Details</h6>
                                  <div class="pmanager-single-img"></div>
                                  <div class="pmanager-single-img-name"></div>
                                  <div class="pmanager-single-img-delete-permanently text-danger" data-id="">Delete permanently</div>
                                  <a title="Copy URL" class="pmanager-single-img-copy-url" href="javascript:void(0);" onclick="CopyToClipboard(this.getAttribute('data-src'))" data-src="">Copy URL</a> 
                                  <span class="text-success clipboard-message" aria-hidden="false">Copied!</span>

                                  <div class="pmanager-single-message"></div>
                                </div>
                              </div>
                            </div>
                          </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--pmanagerModal end-->

<script type="text/javascript">
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
     $('#image').change(function(){   
      let reader = new FileReader();
      reader.onload = (e) => { 
        $('#preview-image-before-upload').attr('src', e.target.result); 
      }
      reader.readAsDataURL(this.files[0]); 
     });
     
      $('#image-upload').submit(function(e){
        e.preventDefault();
        $("#pmanager-server-message").empty();
        let formData = new FormData(this);
        $.ajax({
          type:'post',
          url: "{{ route('pmanager.store')}}",
          data: formData,
          cache:false,
          contentType: false,
          processData: false,
          success: (data) => {
             this.reset();
             $("#realtimedata").show();
             $("#preview-image-before-upload").hide();
             $("#pmanager-server-message").append('<span class="text-success">Image uploaded successfully</span>');
          },
          error: function(data){
            $("#pmanager-server-message").append('<span class="text-danger">Something is wrong</span>');
          }
        });
        setTimeout(function() { 
          $("#pmanager-server-message").empty();
        }, 5000);
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
    if(pmanagerUse){
      $("#pmanager-image-preview").html('')
      $.ajax({
        url: "{{ route('pmanager.single') }}/"+pmanagerUse,
        type: "get",
        dataType: "json",
        success: function (result){
          $(".pmanager-input-field").val(result.photo);
          $("#pmanager-image-preview").append('<img src="'+result.photo+'"/>')
          $("#pmanagerModal").hide();
        },
        error: function(result){
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
    if (pmanagerShow){
        $.ajax({
            url: "{{ route('pmanager.single') }}/"+pmanagerShow,
            type: "get",
            dataType: "json",
            success: function (result) {
              $(".pmanager-single-img").append('<img src="'+result.photo+'"/>');
              $(".pmanager-single-img-name").append('<span>'+result.name+'</span>');
              $(".pmanager-single-img-copy-url").attr('data-src', result.photo);
              $(".pmanager-single-img-delete-permanently").attr('data-id', result.id);
            },
            error: function(result){
              console.log('error');
            }
        })
    }
  });  

  //delete 
  $(document).on('click', '.pmanager-single-img-delete-permanently', function (pdEle) {
    pdEle.preventDefault();
    let photoDeleteID = $(this).attr("data-id");
    if (photoDeleteID){
      alert("Are you sure")
        $(".pmanager-single-message").show();
        $.ajax({
            url: "{{ route('pmanager.delete') }}/"+photoDeleteID,
            type: "get",
            dataType: "json",
            success: function (result) {
              $(".pmanager-single-message").append('<span class="text-success">Successfully Deleted</span>');
            },
            error: function(result){
              $(".pmanager-single-message").append('<span class="text-danger">Something Error</span>');
            }
        })
        setTimeout(function() { 
          $(".pmanager-single-message").hide();
        }, 3000);
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

    setTimeout(function() { 
      $(".clipboard-message").hide();
    }, 2000);
  }
 
 //live search
  $(document).on('keyup','#search', function(){
      let  searchQuery = $(this).val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    if(searchQuery.length > 0){
      $('#search-results').show();
      $.ajax({
          method: 'POST',
          url: '{{ route("pmanager.live.search") }}',
          dataType: 'json',
          data: {
              searchQuery: searchQuery
          },
          success: function(results){
              let result = '';
              $('#realtimedata').hide();
              $('#load_more_product').hide();
              $('#search-results').html('');
              if(Object.keys(results).length !== 0){
                  $.each(results, function(index, value){
                    let photoName = value.name;
                    if(photoName.length > 10){
                      photoName =  photoName.substring(0,10)+'...';
                    }
                      result = '<div class="pmanager-box col-md-2"><img class="pmanager-img pmanagerUse" data-id="'+value.id+'" src="'+value.photo+'" alt="'+value.id+'"/><br><span>'+photoName+'</span><div class="pmanagerShow" data-id="'+value.id+'">view</div></div>'
                      $('#search-results').append(result);
                  })
              }else{
                  result = '<div class="col-md-12 col-lg-12 col-12 mt-2 mb-2 text-center">No data found</div>';
                  $('#search-results').append(result);
              }  
          },
          error: function(results){
              console.log(results)
          }
      });
    }else{
        $('#realtimedata').show();
        $('#load_more_product').show();
        $('#search-results').hide();
    }
  });
  
    //realtimedata
    function loadXMLDoc() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("realtimedata").innerHTML =
          this.responseText;
        }
      };
      xhttp.open("GET", "{{ route('realtime.pmanager') }}", true);
      xhttp.send();
    }
    setInterval(function() {
      loadXMLDoc();
    },1000)
    window.onload =loadXMLDoc;
</script>

</body>
</html>
