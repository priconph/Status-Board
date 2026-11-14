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
          <h1>Monthly Best Performers</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Monthly Best Performers</li>
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
              <button class="btn btn-primary" data-toggle="modal" data-target="#AddMthlyBestPerfsContentModal" id="btnShowAddMthlyBestPerfsModal"><i class="fa fa-plus"></i> Add Content</button>
              <button class="btn btn-warning" data-toggle="modal" data-target="#modalimport" title="Import WIP and FGS Summaries"><i class="fa fa-file-excel"></i> Import</button>
              @if (Auth::user()->user_level_id == 2)
              <button class="btn btn-info" data-toggle="modal" data-target="#modalsetintervalmthlybestperfs" title="Set Monthly Best Performers Slide Interval"><i class="far fa-clock"></i> Set Slide Interval</button>
              <button class="btn btn-success" data-toggle="modal" data-target="#modalapproveperbatch" title="Approve Per Import Batch"><i class="far fa-check-circle"></i> Approve</button>
              @endif
              <br>
              <br>
                <div class="table-responsive dt-responsive">
                <table id="tblMthlyBestPerfs" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Status</th>
                        <th>Employee Name</th>
                        <th>Category of Award</th>
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
            <div class="modal fade" id="AddMthlyBestPerfsContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Monthly Best Performer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="AddMthlyBestPerfsContentForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Employee Name</label>
                              <input type="text" class="form-control" name="empname" id="txtEmployeeName">
                          </div>
                        </div>
                      <div class="form-group">
                        <label>Award Category</label>
                        <select class="form-control select2bs4" name="award_category" id="selAwardCategory" style="width: 100%;">
                          <option value="0" selected disabled>-- Select Award Category --</option>
                          <option value="1">Best Operator</option>
                          <option value="2">Best Machine Operator</option>
                          <option value="3">Best Material Handler</option>
                          <option value="4">Best Supervisor</option>
                          <option value="5">Best Clerk</option>
                          <option value="6">Best Warehouse MH</option>
                          <option value="7">Best Inspector</option>
                          <option value="8">Best QC Supervisor</option>
                          <option value="9">Best Planner</option>
                          <option value="10">Best Technician</option>
                          <option value="11">Best Engineer</option>
                          <option value="12">Best Kaizen(Staff)</option>
                          <option value="13">Best Kaizen(Non-Staff)</option>
                          <option value="14">Best in Productivity</option>
                          <option value="15">Most # of Defect Escalate</option>
                          <option value="16">Best 5S</option>
                          <option value="17">Best Poka-Yoke</option>
                          <option value="18">Best in Quality</option>
                          <option value="19">Best in Attendance</option>
                        </select>
                      </div>
                        <div class="form-group">
                          <label for="images" class="col-sm-10 control-label">Upload Image</label>
                            <input required type="file" accept="image/*" class="form-control" name="images" accept="image/*" multiple>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Month</label>
                              <input type="text" class="form-control" name="month" id="txtMonth">
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
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btnAddMthlyBestPerfs" class="btn btn-primary"><i id="iBtnAddMthlyBestPerfsIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

          <!-- /.Edit Modal  -->
            <div class="modal fade" id="EditMthlyBestPerfsContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Edit Contents</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="EditMthlyBestPerfsContentForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <input type="hidden" class="form-control" name="mthlybestperf_id" id="txtEditMthlyBestPerfId">
                          <div class="form-group">
                            <label>Employee Name</label>
                              <input type="text" class="form-control" name="empname" id="txtEditEmployeeName">
                          </div>
                        </div>
                      <div class="form-group">
                        <label>Award Category</label>
                        <select class="form-control select2bs4" name="award_category" id="selEditAwardCategory" style="width: 100%;">
                          <option value="0" selected disabled>-- Select Award Category --</option>
                          <option value="1">Best Operator</option>
                          <option value="2">Best Machine Operator</option>
                          <option value="3">Best Material Handler</option>
                          <option value="4">Best Supervisor</option>
                          <option value="5">Best Clerk</option>
                          <option value="6">Best Warehouse MH</option>
                          <option value="7">Best Inspector</option>
                          <option value="8">Best QC Supervisor</option>
                          <option value="9">Best Planner</option>
                          <option value="10">Best Technician</option>
                          <option value="11">Best Engineer</option>
                          <option value="12">Best Kaizen(Staff)</option>
                          <option value="13">Best Kaizen(Non-Staff)</option>
                          <option value="14">Best in Productivity</option>
                          <option value="15">Most # of Defect Escalate</option>
                          <option value="16">Best 5S</option>
                          <option value="17">Best Poka-Yoke</option>

                        </select>
                      </div>
                        <div class="form-group">
                          <label for="images" class="col-sm-10 control-label">Upload Image</label>
                            <input type="file" accept="image/*" class="form-control" name="images" accept="image/*" multiple>
                        </div>
                         <div class="col-sm-12">
                          <div class="form-group">
                            <label>Month</label>
                              <input type="text" class="form-control" name="month" id="txtEditMonth">
                          </div>
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
                      <button type="submit" id="btnEditMthlyBestPerfs" class="btn btn-primary"><i id="iBtnEditMthlyBestPerfsIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

          <div class="modal fade" id="modalsetintervalmthlybestperfs" data-backdrop="static"data-backdrop="static">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="far fa-clock"></i> Set slide interval for Monthly Best Performers</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" id="formSetIntervalmthlybestperfs" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <input type="hidden" name="carousel_interval_id" id="carousel_interval_id">
                        <div class="form-group">
                          <label>Slide</label>
                            <input type="text" class="form-control" name="carousel_slide" id="txtCarouselSlide" value="Monthly Best Performers" readonly>
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

            <div class="modal fade" id="modalChangeMthlyBestPerfsContentStat" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content modal-sm">
                  <div class="modal-header">
                    <h4 class="modal-title" id="h4ChangeMthlyBestPerfContentTitle"><i class="fa fa-default"></i> Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="formChangeMthlyBestPerfContentStat">
                    @csrf
                    <div class="modal-body">
                      <label id="lblChangeMthlyBestPerfContentStatLabel">Are you sure to ?</label>
                      <input type="hidden" name="mthlybestperf_id" placeholder="Content Id" id="txtChangeMthlyBestPerfContentStatMthlyBestPerfContentId">
                      <input type="hidden" name="status" placeholder="Status" id="txtChangeMthlyBestPerfContentStatMthlyBestPerfContentStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" id="btnChangeMthlyBestPerfContentStat" class="btn btn-primary"><i id="iBtnChangeMthlyBestPerfContentStatIcon" class="fa fa-check"></i> Yes</button>
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
                          <select class="form-control select2bs4 selectImportBatchMBP" name="approveperbatch" id="selImportbyBatch" style="width: 100%;">
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
                          <label>Monthly Best Performers</label>
                            <input type="file" class="form-control" name="import_file_mthlybestperfs" id="fileImportLotOutDefs">
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
let dataTableMthlyBestPerformers;
$(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

    dataTableMthlyBestPerformers = $("#tblMthlyBestPerfs").DataTable({
      "processing" : true,
      "aaSorting"  : [[4, 'desc']],
        "serverSide" : true,
        "ajax" : {
          url: "view_monthlybestperformers",
          // data: function (param){
          //     param.status = $("#selEmpStat").val();
          // }
        },

        "columns":[
          { "data" : "label1" },
          { "data" : "employee_name" },
          { "data" : "award_category_label" },
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
  $("#AddMthlyBestPerfsContentForm").submit(function(event){
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
       url: 'add_monthlybestperformers',
        method: 'post',
        data: new FormData(this),
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            $("#iBtnAddMthlyBestPerfsIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddLotOutDef").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#AddMthlyBestPerfsContentModal").modal('hide');
              $("#AddMthlyBestPerfsContentForm")[0].reset();
              $("#txtEmployeeName").removeClass('is-invalid');
              $("#selAwardCategory").val('0').trigger('change');
              $("#txtMonth").removeClass('is-invalid');
              $("#txtStart_Date").removeClass('is-invalid');
              $("#txtEnd_Date").removeClass('is-invalid');

              dataTableMthlyBestPerformers.draw();
              toastr.success('Content was succesfully saved!');
            }else if(JsonObject['result'] == 2){ //nmodify clark 04/30/2025
                toastr.error('Duplicate category on the selected date range, please use another category');
            }else{
                toastr.error(' Saving Content Failed!');

                if(JsonObject['error']['empname'] === undefined){
                    $("#txtEmployeeName").removeClass('is-invalid');
                    $("#txtEmployeeName").attr('title', '');
                }
                else{
                    $("#txtEmployeeName").addClass('is-invalid');
                    $("#txtEmployeeName").attr('title', JsonObject['error']['empname']);
                }

                if(JsonObject['error']['award_category'] === undefined){
                    $("#selAwardCategory").removeClass('is-invalid');
                    $("#selAwardCategory").attr('title', '');
                }
                else{
                    $("#selAwardCategory").addClass('is-invalid');
                    $("#selAwardCategory").attr('title', JsonObject['error']['award_category']);
                }
                if(JsonObject['error']['month'] === undefined){
                    $("#txtMonth").removeClass('is-invalid');
                    $("#txtMonth").attr('title', '');
                }
                else{
                    $("#txtMonth").addClass('is-invalid');
                    $("#txtMonth").attr('title', JsonObject['error']['month']);
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

            $("#iBtnAddMthlyBestPerfsIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddMthlyBestPerfs").removeAttr('disabled');
            $("#iBtnAddMthlyBestPerfsIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddMthlyBestPerfsIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddMthlyBestPerfs").removeAttr('disabled');
            $("#iBtnAddMthlyBestPerfsIcon").addClass('fa fa-check');
        }
    });
  });

    $("#formSetIntervalmthlybestperfs").submit(function(event){
    event.preventDefault();
    SetIntervalMBP();
  });

  // Edit Content
  $(document).on('click', '.aEditMthlyBestPerfsContent', function(){
    let mthlybestperfsId = $(this).attr('mthlybestperfs-id');
    $("#txtEditMthlyBestPerfId").val(mthlybestperfsId);
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
        url: "get_monthlybestperformers_by_id",
        method: "get",
        data: {
            mthlybestperfs_id: mthlybestperfsId
        },
        dataType: "json",
        beforeSend: function(){
            $("#txtEditEmployeeName").val("");
            $("#txtEditMonth").val("");
            $("#txtEditStart_Date").val("");
            $("#txtEditEnd_Date").val("");
            $("#txtEditEmployeeName").removeClass('is-invalid');
            $("#txtEditMonth").removeClass('is-invalid');
            $("#txtEditStart_Date").removeClass('is-invalid');
            $("#txtEditEnd_Date").removeClass('is-invalid');
        },
        success: function(JsonObject){
            let result = JsonObject['mthlybestperformers'];
            if(result.length > 0){
                $("#txtEditEmployeeName").val(result[0].employee_name);
                $("#selEditAwardCategory").val(result[0].category).trigger('change');
                $("#txtEditMonth").val(result[0].content_month);
                $("#txtEditStart_Date").val(result[0].start_date);
                $("#txtEditEnd_Date").val(result[0].expiry_date);
            }
            else{
                toastr.warning('No Monthly Best Performer Content Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
  });

  $("#EditMthlyBestPerfsContentForm").submit(function(event){
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
        url: "edit_monthlybestperformers",
        method: "post",
        data: new FormData(this),
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            $("#iBtnEditMthlyBestPerfsIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditMthlyBestPerfs").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
                $("#EditMthlyBestPerfsContentModal").modal('hide');
                $("#EditMthlyBestPerfsContentForm")[0].reset();

                $("#txtEditEmployeeName").removeClass('is-invalid');
                $("#txtEditMonth").removeClass('is-invalid');
                $("#txtEditStart_Date").removeClass('is-invalid');
                $("#txtEditEnd_Date").removeClass('is-invalid');

                dataTableMthlyBestPerformers.draw();
                toastr.success('Content was succesfully saved!');
            }
            else if(JsonObject['result'] == 2){ //nmodify clark 04/30/2025
                toastr.error('Duplicate category on the selected date range, please use another category');
            }else{
                toastr.error('Updating Content Failed!');

                if(JsonObject['error']['empname'] === undefined){
                    $("#txtEditEmployeeName").removeClass('is-invalid');
                    $("#txtEditEmployeeName").attr('title', '');
                }
                else{
                    $("#txtEditEmployeeName").addClass('is-invalid');
                    $("#txtEditEmployeeName").attr('title', JsonObject['error']['empname']);
                }
                if(JsonObject['error']['month'] === undefined){
                    $("#txtEditEmployeeName").removeClass('is-invalid');
                    $("#txtEditMonth").attr('title', '');
                }
                else{
                    $("#txtEditEmployeeName").attr('title', JsonObject['error']['month']);
                    $("#txtEditMonth").addClass('is-invalid');
                }
                if(JsonObject['error']['start_date'] === undefined){
                    $("#txtEditMonth").removeClass('is-invalid');
                    $("#txtEditStart_Date").attr('title', '');
                }
                else{
                    $("#txtEditMonth").attr('title', JsonObject['error']['start_date']);
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

            $("#iBtnEditMthlyBestPerfsIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditMthlyBestPerfs").removeAttr('disabled');
            $("#iBtnEditMthlyBestPerfsIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditMthlyBestPerfsIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditMthlyBestPerfs").removeAttr('disabled');
            $("#iBtnEditMthlyBestPerfsIcon").addClass('fa fa-check');
        }
    });
  });

  // Change Content Status
  $(document).on('click', '.aChangeMthlyBestPerfsContentStat', function(){
    let contStat = $(this).attr('status');
    let mthlybestperfcontId = $(this).attr('mthlybestperfs-id');

    $("#txtChangeMthlyBestPerfContentStatMthlyBestPerfContentId").val(mthlybestperfcontId);
    $("#txtChangeMthlyBestPerfContentStatMthlyBestPerfContentStat").val(contStat);

    if(contStat == 1){
      $("#lblChangeMthlyBestPerfContentStatLabel").text('Are you sure to approve?');
      $("#h4ChangeMthlyBestPerfContentTitle").html('<i class="fa fa-default"></i> Approve Content');
    }else if(contStat == 2){
      $("#lblChangeMthlyBestPerfContentStatLabel").text('Are you sure to Disapprove?');
      $("#h4ChangeMthlyBestPerfContentTitle").html('<i class="fa fa-default"></i> Disapprove Content');
    }else{
      $("#lblChangeMthlyBestPerfContentStatLabel").text('Are you sure to Delete?');
      $("#h4ChangeMthlyBestPerfContentTitle").html('<i class="fa fa-default"></i> Delete Content');
    }  });
  $("#formChangeMthlyBestPerfContentStat").submit(function(event){
    event.preventDefault();
    ChangeMthlyBestPerfContentStatus();
  });


  $("#formImport").submit(function(event){
      event.preventDefault();
      $.ajax({
          url: 'import_monthlybestperformers',
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
                dataTableMthlyBestPerformers.draw();
                location.reload();
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

  GetBatchNumberMBP($(".selectImportBatchMBP"), 2);

  $("#ApprovePerBatchForm").submit(function(event){
    event.preventDefault();
    ApprovePerBatchFormMBP();
  });
});
</script>
@endsection
@endauth
