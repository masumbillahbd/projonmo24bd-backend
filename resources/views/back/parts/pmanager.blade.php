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
                         class="icon icon-tabler icon-tabler-x" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="#ff4500" fill="none" stroke-linecap="round"
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
                          <div class="col-md-4">
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