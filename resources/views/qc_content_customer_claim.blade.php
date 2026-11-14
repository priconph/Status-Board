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
          <h1>Customer Claim</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Customer Claim</li>
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
              <button class="btn btn-primary" data-toggle="modal" data-target="#AddCustClaimContentModal" id="btnShowAddCustClaimModal"><i class="fa fa-plus"></i> Add Content</button>
              <button class="btn btn-warning" data-toggle="modal" data-target="#modalimport" title="Import WIP and FGS Summaries"><i class="fa fa-file-excel"></i> Import</button>
              @if (Auth::user()->user_level_id == 2)
              <button class="btn btn-success" data-toggle="modal" data-target="#modalapproveperbatch" title="Approve Per Import Batch"><i class="far fa-check-circle"></i> Approve</button>
              @endif
              <br>
              <br>
                <div class="table-responsive dt-responsive">
                <table id="tblCustomerClaim" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Status</th>                        
                        <th>Device Name</th> 
                        <th>Mode of Defect</th> 
                        <th>Customer</th> 
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
            <!-- /.Add Modal  -->
            <div class="modal fade" id="AddCustClaimContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Customer Claim</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="AddCustClaimContentForm" enctype="multipart/form-data">
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
                            <label>Customer</label>
                              <input type="text" class="form-control" name="customer" id="txtCustomer">
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
                      <button type="submit" id="btnAddCustClaim" class="btn btn-primary"><i id="iBtnAddCustClaimIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

            <!-- /.Edit Modal  -->
            <div class="modal fade" id="EditCustClaimContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Edit Contents</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="EditCustClaimContentForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <input type="hidden" class="form-control" name="custcla_id" id="txtEditCustClaimId">
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
                              <input type="text" class="form-control" name="customer" id="txtEditCustomer">
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
                      <button type="submit" id="btnEditCustClaim" class="btn btn-primary"><i id="iBtnEditCustClaimIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="modalChangeCustClaimContentStat" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content modal-sm">
                  <div class="modal-header">
                    <h4 class="modal-title" id="h4ChangeCustClaimontentTitle"><i class="fa fa-default"></i> Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="formChangeCustClaimontentStat">
                    @csrf
                    <div class="modal-body">
                      <label id="lblChangeCustClaimontentStatLabel">Are you sure to ?</label>
                      <input type="hidden" name="custcla_id" placeholder="Content Id" id="txtChangeCustClaimContentStatCustClaimContentId">
                      <input type="hidden" name="status" placeholder="Status" id="txtChangeCustClaimContentStatCustClaimContentStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" id="btnChangeCustClaimContentStat" class="btn btn-primary"><i id="iBtnChangeCustClaimContentStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

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
                          <select class="form-control select2bs4 selectImportBatchCC" name="approveperbatch" id="selImportbyBatch" style="width: 100%;">
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
                          <label>Customer Claim</label>
                            <input type="file" class="form-control" name="import_file_custclaim" id="fileImportCustClaim">   
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
  let dataTableCustClaim;
  $(document).ready(function () {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

    dataTableCustClaim = $("#tblCustomerClaim").DataTable({
      "processing" : false,
        "serverSide" : true,
        "ajax" : {
          url: "view_customerclaim",
          // data: function (param){
          //     param.status = $("#selEmpStat").val();
          // }
        },
        
        "columns":[
          { "data" : "label1" },
          { "data" : "device_name" },
          { "data" : "mode_of_defect" },
          { "data" : "customer" },
          { "data" : "date_detected" },
          { "data" : "batch_number" },
          { "data" : "start_date" },
          { "data" : "expiry_date" },
          { "data" : "raw_image", orderable:false, searchable:false },
          { "data" : "action1", orderable:false, searchable:false }
        ],
        "initComplete": function(settings, json) {
              $(".chkMOD").each(function(index){
                  if(arrSelectedMOD.includes($(this).attr('custclaim-id'))){
                      $(this).attr('checked', 'checked');
                  }
              });
        },
        "drawCallback": function( settings ) {
              $(".chkMOD").each(function(index){
                  if(arrSelectedMOD.includes($(this).attr('custclaim-id'))){
                      $(this).attr('checked', 'checked');
                  }
              });
          }
      });

  // Add Content 
  $("#AddCustClaimContentForm").submit(function(event){
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
       url: 'add_customerclaim',
        method: 'post',
        data: new FormData(this),
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            $("#iBtnAddCustClaimIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddCustClaim").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#AddCustClaimContentModal").modal('hide');
              $("#AddCustClaimContentForm")[0].reset();
              $("#txtDeviceName").removeClass('is-invalid');
              $("#txtModeOfDefect").removeClass('is-invalid');
              $("#txtCustomer").removeClass('is-invalid');
              $("#txtDateDetected").removeClass('is-invalid');
              $("#txtStart_Date").removeClass('is-invalid');
              $("#txtEnd_Date").removeClass('is-invalid');

              dataTableCustClaim.draw();
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

                if(JsonObject['error']['customer'] === undefined){
                    $("#txtCustomer").removeClass('is-invalid');
                    $("#txtCustomer").attr('title', '');
                }
                else{
                    $("#txtCustomer").addClass('is-invalid');
                    $("#txtCustomer").attr('title', JsonObject['error']['customer']);
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

            $("#iBtnAddCustClaimIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddCustClaim").removeAttr('disabled');
            $("#iBtnAddCustClaimIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
            $("#iBtnAddCustClaimIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddCustClaim").removeAttr('disabled');
            $("#iBtnAddCustClaimIcon").addClass('fa fa-check');
        }
    });
  });

  // Edit Content 
  $(document).on('click', '.aEditCustClaimContent', function(){
    let custclaimcontId = $(this).attr('custclaim-id');
    $("#txtEditCustClaimId").val(custclaimcontId);
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
        url: "get_customerclaim_by_id",
        method: "get",
        data: {
            custclaimcont_id: custclaimcontId
        },
        dataType: "json",
        beforeSend: function(){
            $("#txtEditDeviceName").val("");
            $("#txtEditModeOfDefect").val("");
            $("#txtEditCustomer").val("");
            $("#txtEditDateDetected").val("");
            $("#txtEditStart_Date").val("");
            $("#txtEditEnd_Date").val("");            
            $("#txtEditDeviceName").removeClass('is-invalid');
            $("#txtEditModeOfDefect").removeClass('is-invalid');
            $("#txtEditCustomer").removeClass('is-invalid');
            $("#txtEditDateDetected").removeClass('is-invalid');
            $("#txtEditStart_Date").removeClass('is-invalid');              
            $("#txtEditEnd_Date").removeClass('is-invalid');                          
        },
        success: function(JsonObject){
            let result = JsonObject['customerclaim'];
            if(result.length > 0){
                $("#txtEditDeviceName").val(result[0].device_name);
                $("#txtEditModeOfDefect").val(result[0].mode_of_defect);
                $("#txtEditCustomer").val(result[0].customer);
                $("#txtEditDateDetected").val(result[0].date_detected);       
                $("#txtEditStart_Date").val(result[0].start_date);          
                $("#txtEditEnd_Date").val(result[0].expiry_date);                       
            }
            else{
                toastr.warning('No Customer Claim Content Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
  });
  
  $("#EditCustClaimContentForm").submit(function(event){
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
        url: "edit_customerclaim",
        method: "post",
        data: new FormData(this),
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            $("#iBtnEditCustClaimIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditCustClaim").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
                $("#EditCustClaimContentModal").modal('hide');
                $("#EditCustClaimContentForm")[0].reset();

                $("#txtEditDeviceName").removeClass('is-invalid');
                $("#txtEditModeOfDefect").removeClass('is-invalid');
                $("#txtEditCustomer").removeClass('is-invalid');
                $("#txtEditDateDetected").removeClass('is-invalid'); 
                $("#txtEditStart_Date").removeClass('is-invalid');
                $("#txtEditEnd_Date").removeClass('is-invalid');

                dataTableCustClaim.draw();
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
                if(JsonObject['error']['customer'] === undefined){
                    $("#txtEditModeOfDefect").removeClass('is-invalid');
                    $("#txtEditCustomer").attr('title', '');
                }
                else{
                    $("#txtEditModeOfDefect").attr('title', JsonObject['error']['customer']);
                    $("#txtEditCustomer").addClass('is-invalid');
                }    
                if(JsonObject['error']['datedetected'] === undefined){
                    $("#txtEditCustomer").removeClass('is-invalid');
                    $("#txtEditDateDetected").attr('title', '');
                }
                else{
                    $("#txtEditCustomer").attr('title', JsonObject['error']['datedetected']);
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

            $("#iBtnEditCustClaimIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditCustClaim").removeAttr('disabled');
            $("#iBtnEditCustClaimIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditCustClaimIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditCustClaim").removeAttr('disabled');
            $("#iBtnEditCustClaimIcon").addClass('fa fa-check');
        }
    });
  });

  // Change Content Status
  $(document).on('click', '.aChangeCustClaimContentStat', function(){
    let contStat = $(this).attr('status');
    let custclacontId = $(this).attr('custclaim-id');

    $("#txtChangeCustClaimContentStatCustClaimContentId").val(custclacontId);
    $("#txtChangeCustClaimContentStatCustClaimContentStat").val(contStat);

    if(contStat == 1){
      $("#lblChangeCustClaimontentStatLabel").text('Are you sure to approve?'); 
      $("#h4ChangeCustClaimontentTitle").html('<i class="fa fa-default"></i> Approve Content');
    }else if(contStat == 2){
      $("#lblChangeCustClaimontentStatLabel").text('Are you sure to Disapprove?');
      $("#h4ChangeCustClaimontentTitle").html('<i class="fa fa-default"></i> Disapprove Content');
    }else{
      $("#lblChangeCustClaimontentStatLabel").text('Are you sure to Delete?');
      $("#h4ChangeCustClaimontentTitle").html('<i class="fa fa-default"></i> Delete Content');      
    }
  });

  $("#formChangeCustClaimontentStat").submit(function(event){
    event.preventDefault();
    ChangeCustClaimContentStatus();
  });

  $("#formImport").submit(function(event){
      event.preventDefault();
      $.ajax({
          url: 'import_customerclaim',
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
                dataTableCustClaim.draw();
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

  GetBatchNumberCC($(".selectImportBatchCC"), 2);

  $("#ApprovePerBatchForm").submit(function(event){
    event.preventDefault();
    ApprovePerBatchFormCC();
  });

});

</script>
@endsection
@endauth