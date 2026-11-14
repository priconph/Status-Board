@php $layout = 'layouts.super_user_layout'; @endphp
@auth
  @php
    if(Auth::user()->user_level_id == 2){
      $layout = 'layouts.admin_layout';
    }
    else if(Auth::user()->user_level_id == 3){
      $layout = 'layouts.user_layout';
    }
  @endphp
@endauth

@auth
  @extends($layout)

@section('title', 'Blank')

@section('content_page')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Lot Out Defects</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Lot Out Defects</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Contents</h3>
            </div>

            <!-- Start Page Content -->
            <div class="card-body">
              <button class="btn btn-primary" data-toggle="modal" data-target="#AddLotOutDefContentModal" id="btnShowAddLotOutDefModal"><i class="fa fa-plus"></i> Add Content</button>
              <button class="btn btn-warning" data-toggle="modal" data-target="#modalimport" title="Import WIP and FGS Summaries"><i class="fa fa-file-excel"></i> Import</button>              
              @if (Auth::user()->user_level_id == 2)
              <button class="btn btn-info" data-toggle="modal" data-target="#modalsetintervallotoutdefs" title="Set Lot Out Defects and Customer Claim Slide Interval"><i class="far fa-clock"></i> Set Slide Interval</button>               
              <button class="btn btn-success" data-toggle="modal" data-target="#modalapproveperbatch" title="Approve Per Import Batch"><i class="far fa-check-circle"></i> Approve</button>
              @endif
              <br>
              <br>
                <div class="table-responsive dt-responsive">
                <table id="tblLotOutDefect" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Status</th>                        
                        <th>Device Name</th> 
                        <th>Mode of Defect</th> 
                        <th>Contributing Line</th> 
                        <th>Date Detected</th> 
                        <th>Import Batch</th> 
                        <th>Content Duration Start</th> 
                        <th>Content Duration Expiry</th> 
                        <th>Image</th>
                        <th>Action</th>                          
                      </tr>
                    </thead>
                </table>
              </div>                  
            </div>
            <!-- !-- End Page Content -->
            </div>

            <!-- MODALS -->

            <!-- /.Add Modal  -->
            <div class="modal fade" id="AddLotOutDefContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Lot Out Defect</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="AddLotOutDefContentForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Device Name</label>
                              <input type="text" class="form-control" name="devicename" id="txtDeviceName">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Mode of Defect</label>
                              <input type="text" class="form-control" name="modeofdefect" id="txtModeOfDefect">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Contributing Line</label>
                              <input type="text" class="form-control" name="contributingline" id="txtContributingLine">
                          </div>
                        </div> 
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Date Detected</label>
                              <input type="date" class="form-control" name="datedetected" id="txtDateDetected">
                          </div>
                        </div>  
                        <div class="form-group">
                          <label for="images" class="col-sm-10 control-label">Upload Image</label>                      
                            <input required type="file" accept="image/*" class="form-control" name="images" accept="image/*" multiple>
                        </div>
                        <div class="container">
                          <label>Set Content Expiry Date</label>
                          <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="txtStart_Date">
                            </div>
                            <div class="form-group col-sm-6">
                              <label>End Date</label>
                                <input type="date" class="form-control" name="end_date" id="txtEnd_Date">
                            </div>                           
                          </div>                            
                        </div>                                                                                                                                                            
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btnAddLotOutDef" class="btn btn-primary"><i id="iBtnAddLotOutDefIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

            <!-- /.Edit Modal  -->
            <div class="modal fade" id="EditLotOutDefContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Edit Contents</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="EditLotOutDefContentForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <input type="hidden" class="form-control" name="lotoutdef_id" id="txtEditLotOutDefId">
                          <div class="form-group">
                            <label>Device Name</label>
                              <input type="text" class="form-control" name="devicename" id="txtEditDeviceName">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Mode of Defect</label>
                              <input type="text" class="form-control" name="modeofdefect" id="txtEditModeOfDefect">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Contributing Line</label>
                              <input type="text" class="form-control" name="contributingline" id="txtEditContributingLine">
                          </div>
                        </div> 
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Date Detected</label>
                              <input type="date" class="form-control" name="datedetected" id="txtEditDateDetected">
                          </div>
                        </div>  
                        <div class="form-group">
                          <label for="images" class="col-sm-10 control-label">Upload Image</label>                      
                            <input type="file" accept="image/*" class="form-control" name="images" accept="image/*" multiple>
                        </div>
                        <div class="container">
                          <label>Set Content Expiry Date</label>
                          <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="txtEditStart_Date">
                            </div>
                            <div class="form-group col-sm-6">
                              <label>End Date</label>
                                <input type="date" class="form-control" name="end_date" id="txtEditEnd_Date">
                            </div>                           
                          </div>                            
                        </div>                          
                      </div>                      
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btnEditLotOutDef" class="btn btn-primary"><i id="iBtnEditLotOutDefIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="modalsetintervallotoutdefs" data-backdrop="static">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="far fa-clock"></i> Set slide interval for Lot Out Defects and Customer Claim</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" id="formSetIntervallotoutdefs" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <input type="hidden" name="carousel_interval_id" id="carousel_interval_id">
                        <div class="form-group">
                          <label>Slide</label>
                            <input type="text" class="form-control" name="carousel_slide" id="txtCarouselSlide" value="Lot Out Defects" readonly>
                        </div>
                          <div class="form-group">
                            <label>Interval (Seconds)</label>
                              <input type="text" class="form-control" name="slide_interval" id="txtSlideInterval">
                          </div>                        
                      </div>                                         
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnsetinterval" class="btn btn-primary"><i id="ibtnsetinterval" class="fa fa-check"></i> Save</button>
                  </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

            <div class="modal fade" id="modalChangeLotOutDefContentStat" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content modal-sm">
                  <div class="modal-header">
                    <h4 class="modal-title" id="h4ChangeLotOutDefContentTitle"><i class="fa fa-default"></i> Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="formChangeLotOutDefContentStat">
                    @csrf
                    <div class="modal-body">
                      <label id="lblChangeLotOutDefContentStatLabel">Are you sure to ?</label>
                      <input type="hidden" name="lotoutdef_id" placeholder="Content Id" id="txtChangeLotOutDefContentStatLotOutDefContentId">
                      <input type="hidden" name="status" placeholder="Status" id="txtChangeLotOutDefContentStatLotOutDefContentStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" id="btnChangeLotOutDefContentStat" class="btn btn-primary"><i id="iBtnChangeLotOutDefContentStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

          <!-- /.modal -->
          <div class="modal fade" id="modalapproveperbatch" data-backdrop="static">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="far fa-check-circle"></i> Approve Per Import Batch</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" id="ApprovePerBatchForm" enctype="multipart/form-data">
                  <meta name="csrf-token" content="{{ csrf_token() }}" />
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Batch Number</label>
                          <select class="form-control select2bs4 selectImportBatchLOD" name="approveperbatch" id="selImportbyBatch" style="width: 100%;">
                            <!-- Code generated -->
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnApprovePerBatch" class="btn btn-primary"><i id="iBtnApprovePerBatch" class="fa fa-check"></i> Save</button>
                  </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

          <!-- /.card -->
          <div class="modal fade" id="modalimport" data-backdrop="static"data-backdrop="static">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="fa fa-file-excel"></i> Import Contents</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" id="formImport" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Lot Out Defects</label>
                            <input type="file" class="form-control" name="import_file_lotoutdefs" id="fileImportLotOutDefs">   
                      </div>
                    </div> 
                      <div class="container">
                        <label>Set Content Expiry Date</label>
                        <div class="row">
                          <div class="form-group col-sm-6">
                              <label>Start Date</label>
                              <input type="date" class="form-control" name="start_date" id="txtStart_Date">
                          </div>
                          <div class="form-group col-sm-6">
                            <label>End Date</label>
                              <input type="date" class="form-control" name="end_date" id="txtEnd_Date">
                          </div>                           
                        </div>                            
                      </div>                                        
                    </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnimport" class="btn btn-primary"><i id="ibtnimport" class="fa fa-check"></i> Import</button>
                  </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js_content')
<script type="text/javascript">
  let dataTableLotOutDefects;
  $(document).ready(function () {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

    dataTableLotOutDefects = $("#tblLotOutDefect").DataTable({
      "processing" : false,
        "serverSide" : true,
        "ajax" : {
          url: "view_lotoutdefects",
          // data: function (param){
          //     param.status = $("#selEmpStat").val();
          // }
        },
        
        "columns":[
          { "data" : "label1" },
          { "data" : "device_name" },
          { "data" : "mode_of_defect" },
          { "data" : "contributing_line" },
          { "data" : "date_detected" },
          { "data" : "batch_number" },
          { "data" : "start_date" },
          { "data" : "expiry_date" },
          { "data" : "raw_image", orderable:false, searchable:false },
          { "data" : "action1", orderable:false, searchable:false }
        ],
        "initComplete": function(settings, json) {
              $(".chkMOD").each(function(index){
                  if(arrSelectedMOD.includes($(this).attr('nonconformingproducts-id'))){
                      $(this).attr('checked', 'checked');
                  }
              });
        },
        "drawCallback": function( settings ) {
              $(".chkMOD").each(function(index){
                  if(arrSelectedMOD.includes($(this).attr('nonconformingproducts-id'))){
                      $(this).attr('checked', 'checked');
                  }
              });
          }
      });

  // Add Content 
  $("#AddLotOutDefContentForm").submit(function(event){
    event.preventDefault();
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "3000",
      "timeOut": "3000",
      "extendedTimeOut": "3000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    };

    $.ajax({
       url: 'add_lotoutdefects',
        method: 'post',
        data: new FormData(this),
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            $("#iBtnAddLotOutDefIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddLotOutDef").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#AddLotOutDefContentModal").modal('hide');
              $("#AddLotOutDefContentForm")[0].reset();
              $("#txtDeviceName").removeClass('is-invalid');
              $("#txtModeOfDefect").removeClass('is-invalid');
              $("#txtContributingLine").removeClass('is-invalid');
              $("#txtDateDetected").removeClass('is-invalid');
              $("#txtStart_Date").removeClass('is-invalid');
              $("#txtEnd_Date").removeClass('is-invalid');

              dataTableLotOutDefects.draw();
              toastr.success('Content was succesfully saved!');       
            }
            else{
                toastr.error(' Saving Content Failed!');

                if(JsonObject['error']['devicename'] === undefined){
                    $("#txtDeviceName").removeClass('is-invalid');
                    $("#txtDeviceName").attr('title', '');
                }
                else{
                    $("#txtDeviceName").addClass('is-invalid');
                    $("#txtDeviceName").attr('title', JsonObject['error']['devicename']);
                }

                if(JsonObject['error']['modeofdefect'] === undefined){
                    $("#txtModeOfDefect").removeClass('is-invalid');
                    $("#txtModeOfDefect").attr('title', '');
                }
                else{
                    $("#txtModeOfDefect").addClass('is-invalid');
                    $("#txtModeOfDefect").attr('title', JsonObject['error']['modeofdefect']);
                } 

                if(JsonObject['error']['contributingline'] === undefined){
                    $("#txtContributingLine").removeClass('is-invalid');
                    $("#txtContributingLine").attr('title', '');
                }
                else{
                    $("#txtContributingLine").addClass('is-invalid');
                    $("#txtContributingLine").attr('title', JsonObject['error']['contributingline']);
                }

                if(JsonObject['error']['datedetected'] === undefined){
                    $("#txtDateDetected").removeClass('is-invalid');
                    $("#txtDateDetected").attr('title', '');
                }
                else{
                    $("#txtDateDetected").addClass('is-invalid');
                    $("#txtDateDetected").attr('title', JsonObject['error']['datedetected']);
                }  
                if(JsonObject['error']['start_date'] === undefined){
                    $("#txtStart_Date").removeClass('is-invalid');
                    $("#txtStart_Date").attr('title', '');
                }
                else{
                    $("#txtStart_Date").addClass('is-invalid');
                    $("#txtStart_Date").attr('title', JsonObject['error']['start_date']);
                }
                if(JsonObject['error']['end_date'] === undefined){
                    $("#txtEnd_Date").removeClass('is-invalid');
                    $("#txtEnd_Date").attr('title', '');
                }
                else{
                    $("#txtEnd_Date").addClass('is-invalid');
                    $("#txtEnd_Date").attr('title', JsonObject['error']['end_date']);
                }                                                                   
            }

            $("#iBtnAddLotOutDefIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddLotOutDef").removeAttr('disabled');
            $("#iBtnAddLotOutDefIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
            $("#iBtnAddLotOutDefIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddLotOutDef").removeAttr('disabled');
            $("#iBtnAddLotOutDefIcon").addClass('fa fa-check');
        }
    });
  });

  $("#formSetIntervallotoutdefs").submit(function(event){
    event.preventDefault();
    SetIntervalLOD();
  });

  // Edit Content 
  $(document).on('click', '.aEditLotOutDefContent', function(){
    let lotoutdefcontId = $(this).attr('lotoutdefect-id');
    $("#txtEditLotOutDefId").val(lotoutdefcontId);
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "3000",
      "timeOut": "3000",
      "extendedTimeOut": "3000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    };

    $.ajax({
        url: "get_lotoutdefects_by_id",
        method: "get",
        data: {
            lotoutdefcont_id: lotoutdefcontId
        },
        dataType: "json",
        beforeSend: function(){
            $("#txtEditDeviceName").val("");
            $("#txtEditModeOfDefect").val("");
            $("#txtEditContributingLine").val("");
            $("#txtEditDateDetected").val("");
            $("#txtEditStart_Date").val("");
            $("#txtEditEnd_Date").val("");
            $("#txtEditDeviceName").removeClass('is-invalid');
            $("#txtEditModeOfDefect").removeClass('is-invalid');
            $("#txtEditContributingLine").removeClass('is-invalid');
            $("#txtEditDateDetected").removeClass('is-invalid'); 
            $("#txtEditStart_Date").removeClass('is-invalid');              
            $("#txtEditEnd_Date").removeClass('is-invalid');   
        },
        success: function(JsonObject){
            let result = JsonObject['lotoutdefects'];
            if(result.length > 0){
                $("#txtEditDeviceName").val(result[0].device_name);
                $("#txtEditModeOfDefect").val(result[0].mode_of_defect);
                $("#txtEditContributingLine").val(result[0].contributing_line);
                $("#txtEditDateDetected").val(result[0].date_detected);    
                $("#txtEditStart_Date").val(result[0].start_date);          
                $("#txtEditEnd_Date").val(result[0].expiry_date);
            }
            else{
                toastr.warning('No Lot Out Defect Content Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
  });
  
  $("#EditLotOutDefContentForm").submit(function(event){
    event.preventDefault();
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "3000",
      "timeOut": "3000",
      "extendedTimeOut": "3000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    };

    $.ajax({
        url: "edit_lotoutdefects",
        method: "post",
        data: new FormData(this),
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            $("#iBtnEditLotOutDefIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditLotOutDef").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
                $("#EditLotOutDefContentModal").modal('hide');
                $("#EditLotOutDefContentForm")[0].reset();

                $("#txtEditDeviceName").removeClass('is-invalid');
                $("#txtEditModeOfDefect").removeClass('is-invalid');
                $("#txtEditContributingLine").removeClass('is-invalid');
                $("#txtEditDateDetected").removeClass('is-invalid'); 
                $("#txtEditStart_Date").removeClass('is-invalid');
                $("#txtEditEnd_Date").removeClass('is-invalid');

                dataTableLotOutDefects.draw();
                toastr.success('Content was succesfully saved!');
            }
            else{
                toastr.error('Updating Content Failed!');

                if(JsonObject['error']['devicename'] === undefined){
                    $("#txtEditDeviceName").removeClass('is-invalid');
                    $("#txtEditDeviceName").attr('title', '');
                }
                else{
                    $("#txtEditDeviceName").addClass('is-invalid');
                    $("#txtEditDeviceName").attr('title', JsonObject['error']['devicename']);
                }

                if(JsonObject['error']['modeofdefect'] === undefined){
                    $("#txtEditDeviceName").removeClass('is-invalid');
                    $("#txtEditModeOfDefect").attr('title', '');
                }
                else{
                    $("#txtEditDeviceName").attr('title', JsonObject['error']['modeofdefect']);
                    $("#txtEditModeOfDefect").addClass('is-invalid');
                }
                if(JsonObject['error']['contributingline'] === undefined){
                    $("#txtEditModeOfDefect").removeClass('is-invalid');
                    $("#txtEditContributingLine").attr('title', '');
                }
                else{
                    $("#txtEditModeOfDefect").attr('title', JsonObject['error']['contributingline']);
                    $("#txtEditContributingLine").addClass('is-invalid');
                }    
                if(JsonObject['error']['datedetected'] === undefined){
                    $("#txtEditContributingLine").removeClass('is-invalid');
                    $("#txtEditDateDetected").attr('title', '');
                }
                else{
                    $("#txtEditContributingLine").attr('title', JsonObject['error']['datedetected']);
                    $("#txtEditDateDetected").addClass('is-invalid');
                } 
                if(JsonObject['error']['start_date'] === undefined){
                    $("#txtEditDateDetected").removeClass('is-invalid');
                    $("#txtEditStart_Date").attr('title', '');
                }
                else{
                    $("#txtEditDateDetected").attr('title', JsonObject['error']['start_date']);
                    $("#txtEditStart_Date").addClass('is-invalid');
                }
                if(JsonObject['error']['end_date'] === undefined){
                    $("#txtEditStart_Date").removeClass('is-invalid');
                    $("#txtEditEnd_Date").attr('title', '');
                }
                else{
                    $("#txtEditStart_Date").attr('title', JsonObject['error']['end_date']);
                    $("#txtEditEnd_Date").addClass('is-invalid');
                }                                                          
            }

            $("#iBtnEditLotOutDefIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditLotOutDef").removeAttr('disabled');
            $("#iBtnEditLotOutDefIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditLotOutDefIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditLotOutDef").removeAttr('disabled');
            $("#iBtnEditLotOutDefIcon").addClass('fa fa-check');
        }
    });
  });

  // Change Content Status
  $(document).on('click', '.aChangeLotOutDefContentStat', function(){
    let contStat = $(this).attr('status');
    let lotoutdefcontId = $(this).attr('lotoutdefect-id');

    $("#txtChangeLotOutDefContentStatLotOutDefContentId").val(lotoutdefcontId);
    $("#txtChangeLotOutDefContentStatLotOutDefContentStat").val(contStat);

    if(contStat == 1){
      $("#lblChangeLotOutDefContentStatLabel").text('Are you sure to approve?'); 
      $("#h4ChangeLotOutDefContentTitle").html('<i class="fa fa-default"></i> Approve Content');
    }else if(contStat == 2){
      $("#lblChangeLotOutDefContentStatLabel").text('Are you sure to Disapprove?');
      $("#h4ChangeLotOutDefContentTitle").html('<i class="fa fa-default"></i> Disapprove Content');
    }else{
      $("#lblChangeLotOutDefContentStatLabel").text('Are you sure to Delete?');
      $("#h4ChangeLotOutDefContentTitle").html('<i class="fa fa-default"></i> Delete Content');      
    }
  });

  $("#formChangeLotOutDefContentStat").submit(function(event){
    event.preventDefault();
    ChangeLotOutDefContentStatus();
  });

  $("#formImport").submit(function(event){
      event.preventDefault();
      $.ajax({
          url: 'import_lotoutdefects',
          method: 'post',
          data: new FormData(this),
          dataType: 'json',
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function(){
            $("#ibtnimport").addClass('fa fa-spinner fa-pulse');
            $("#btnimport").prop('disabled', 'disabled');
          },
            success: function(JsonObject){
                if(JsonObject['result'] == 1){
                $("#modalimport").modal('hide');
                toastr.success('Importing Success!');
                dataTableLotOutDefects.draw();
                location.reload()
              }
              else{
                toastr.error('Importing Failed!');
              }
              $("#ibtnimport").removeClass('fa fa-spinner fa-pulse');
              $("#btnimport").removeAttr('disabled');
              $("#ibtnimport").addClass('fa fa-check');              
          },
          error: function(data, xhr, status){
              console.log('Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
              $("#ibtnimport").removeClass('fa fa-spinner fa-pulse');
              $("#btnimport").removeAttr('disabled');
              $("#ibtnimport").addClass('fa fa-check');              
          }
      });
  });

  GetBatchNumberLOD($(".selectImportBatchLOD"), 2);

  $("#ApprovePerBatchForm").submit(function(event){
    event.preventDefault();
    ApprovePerBatchFormLOD();
  });

});

</script>
@endsection
@endauth