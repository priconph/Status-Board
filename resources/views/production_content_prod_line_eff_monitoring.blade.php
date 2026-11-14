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
          <h1>Production Line Efficiency Monitoring</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Production Line Efficiency Monitoring</li>
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
              <button class="btn btn-primary" data-toggle="modal" data-target="#AddProdLineEffMonContentModal" id="btnShowAddProdLineEffMonModal"><i class="fa fa-plus"></i> Add Content</button>
              <button class="btn btn-warning" data-toggle="modal" data-target="#modalimport" title="Import WIP and FGS Summaries"><i class="fa fa-file-excel"></i> Import</button>
              @if (Auth::user()->user_level_id == 2)
              <button class="btn btn-info" data-toggle="modal" data-target="#modalsetintervalprodlineeffmon" title="Set Production Line Efficiency Monitoring Slide Interval"><i class="far fa-clock"></i> Set Slide Interval</button>
              <button class="btn btn-success" data-toggle="modal" data-target="#modalapproveperbatch" title="Approve Per Import Batch"><i class="far fa-check-circle"></i> Approve</button>
              @endif
              <br>
              <br>
                <div class="table-responsive dt-responsive">
                <table id="tblProdLineEffMon" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Status</th>
                        <th>Line</th>
                        <th>Target</th>
                        <th>Actual Efficiency</th>
                        <th>Result</th>
                        <th>Import Batch</th>
                        <th>Content Duration Start</th>
                        <th>Content Duration Expiry</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                </table>
              </div>
            </div>
            <!-- !-- End Page Content -->
           </div>

          <!-- /.Add Modal  -->
            <div class="modal fade" id="AddProdLineEffMonContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Production Line Efficiency Monitoring Content</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="AddProdLineEffMonContentForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                      <div class="form-group">
                        <label>Production Line</label>
                        <select class="form-control select2bs4" name="productionline" id="selProductionLine" style="width: 100%;">
                          <option value="0" selected disabled>-- Select Production Line --</option>
                          <option value="1">BGA-FP</option>
                          <option value="2">BGA / LGA</option>
                          <option value="3">QFP / TSOP</option>
                          <option value="4">SMPO</option>
                          <option value="5">PROBE</option>
                        </select>
                      </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Target</label>
                              <input type="text" class="form-control" name="target" id="txtTarget">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Actual Efficiency</label>
                              <input type="text" class="form-control" name="actualefficiency" id="txtActualEfficiency">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Result</label>
                              <input type="text" class="form-control" name="result" id="txtResult">
                          </div>
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
                      <button type="submit" id="btnAddProdLineEffMon" class="btn btn-primary"><i id="iBtnAddProdLineEffMonIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

          <!-- /.Edit Modal  -->
            <div class="modal fade" id="EditProdLineEffMonContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Edit Contents</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="EditProdLineEffMonContentForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                      <input type="hidden" class="form-control" name="prodlineeffmon_id" id="txtEditProdLineEffMonId">
                      <div class="form-group">
                        <label>Production Line</label>
                        <select class="form-control select2bs4" name="productionline" id="selEditProductionLine" style="width: 100%;">
                          <option value="0" selected disabled>-- Select Production Line --</option>
                          <option value="1">BGA-FP</option>
                          <option value="2">BGA / LGA</option>
                          <option value="3">QFP / TSOP</option>
                          <option value="4">SMPO</option>
                          <option value="5">PROBE</option>
                        </select>
                      </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Target</label>
                              <input type="text" class="form-control" name="target" id="txtEditTarget">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Actual Efficiency</label>
                              <input type="text" class="form-control" name="actualefficiency" id="txtEditActualEfficiency">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Result</label>
                              <input type="text" class="form-control" name="result" id="txtEditResult">
                          </div>
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
                      <button type="submit" id="btnEditProdLineEffMon" class="btn btn-primary"><i id="iBtnEditProdLineEffMonIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

          <div class="modal fade" id="modalsetintervalprodlineeffmon" data-backdrop="static"data-backdrop="static">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="far fa-clock"></i> Set slide interval for Production Line Efficiency Monitoring</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" id="formSetIntervalprodlineeffmon" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <input type="hidden" name="carousel_interval_id" id="carousel_interval_id">
                        <div class="form-group">
                          <label>Slide</label>
                            <input type="text" class="form-control" name="carousel_slide" id="txtCarouselSlide" value="Production Line Efficiency Monitoring" readonly>
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

            <div class="modal fade" id="modalChangeProdLineEffMonContentStat" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content modal-sm">
                  <div class="modal-header">
                    <h4 class="modal-title" id="h4ChangeProdLineEffMonContentTitle"><i class="fa fa-default"></i> Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="formChangeProdLineEffMonContentStat">
                    @csrf
                    <div class="modal-body">
                      <label id="lblChangeProdLineEffMonContentStatLabel">Are you sure to ?</label>
                      <input type="hidden" name="prodlineeffmon_id" placeholder="Content Id" id="txtChangeProdLineEffMonContentStatProdLineEffMonContentId">
                      <input type="hidden" name="status" placeholder="Status" id="txtChangeProdLineEffMonContentStatProdLineEffMonContentStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" id="btnChangeProdLineEffMonContentStat" class="btn btn-primary"><i id="iBtnChangeProdLineEffMonContentStatIcon" class="fa fa-check"></i> Yes</button>
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
                          <select class="form-control select2bs4 selectImportBatchPLEM" name="approveperbatch" id="selImportbyBatch" style="width: 100%;">
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
                          <label>Production Line Efficiency Monitoring</label>
                            <input type="file" class="form-control" name="import_file_prodlineeffmon" id="fileImportLotOutDefs">
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
let dataTableProdLineEffMon;
$(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

    dataTableProdLineEffMon = $("#tblProdLineEffMon").DataTable({
      "processing" : false,
        "serverSide" : true,
        "ajax" : {
          url: "view_prodlineeffmonitoring",
          // data: function (param){
          //     param.status = $("#selEmpStat").val();
          // }
        },

        "columns":[
          { "data" : "label1" },
          { "data" : "prod_line_label" },
          { "data" : "target_percent" },
          { "data" : "actual_eff"},
          { "data" : "result" },
          { "data" : "batch_number" },
          { "data" : "start_date" },
          { "data" : "expiry_date" },
          { "data" : "action1", orderable:false, searchable:false }
        ],
        "initComplete": function(settings, json) {
              $(".chkMOD").each(function(index){
                  if(arrSelectedMOD.includes($(this).attr('prodlineeffmon-id'))){
                      $(this).attr('checked', 'checked');
                  }
              });
        },
        "drawCallback": function( settings ) {
              $(".chkMOD").each(function(index){
                  if(arrSelectedMOD.includes($(this).attr('prodlineeffmon-id'))){
                      $(this).attr('checked', 'checked');
                  }
              });
          }
      });

  // Add Content
  $("#AddProdLineEffMonContentForm").submit(function(event){
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
       url: 'add_prodlineeffmonitoring',
        method: 'post',
        data: new FormData(this),
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            //$("#iBtnAddProdLineEffMonIcon").addClass('fa fa-spinner fa-pulse');
            //$("#btnAddProdLineEffMon").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#AddProdLineEffMonContentModal").modal('hide');
              $("#AddProdLineEffMonContentForm")[0].reset();

              $("#selProductionLine").val('0').trigger('change');
              $("#txtTarget").removeClass('is-invalid');
              $("#txtActualEfficiency").removeClass('is-invalid');
              $("#txtResult").removeClass('is-invalid');
              $("#txtMonth").removeClass('is-invalid');

              dataTableProdLineEffMon.draw();
              toastr.success('Content was succesfully saved!');
            }
            else  if(JsonObject['result'] == 0){
                toastr.error(' Saving Content Failed!');

                if(JsonObject['error']['productionline'] === undefined){
                    $("#selProductionLine").removeClass('is-invalid');
                    $("#selProductionLine").attr('title', '');
                }
                else{
                    $("#selProductionLine").addClass('is-invalid');
                    $("#selProductionLine").attr('title', JsonObject['error']['productionline']);
                }

                if(JsonObject['error']['target'] === undefined){
                    $("#txtTarget").removeClass('is-invalid');
                    $("#txtTarget").attr('title', '');
                }
                else{
                    $("#txtTarget").addClass('is-invalid');
                    $("#txtTarget").attr('title', JsonObject['error']['target']);
                }
                if(JsonObject['error']['actualefficiency'] === undefined){
                    $("#txtActualEfficiency").removeClass('is-invalid');
                    $("#txtActualEfficiency").attr('title', '');
                }
                else{
                    $("#txtActualEfficiency").addClass('is-invalid');
                    $("#txtActualEfficiency").attr('title', JsonObject['error']['actualefficiency']);
                }

                if(JsonObject['error']['result'] === undefined){
                    $("#txtResult").removeClass('is-invalid');
                    $("#txtResult").attr('title', '');
                }
                else{
                    $("#txtResult").addClass('is-invalid');
                    $("#txtResult").attr('title', JsonObject['error']['result']);
                }

                if(JsonObject['error']['month'] === undefined){
                    $("#txtMonth").removeClass('is-invalid');
                    $("#txtMonth").attr('title', '');
                }
                else{
                    $("#txtMonth").addClass('is-invalid');
                    $("#txtMonth").attr('title', JsonObject['error']['month']);
                }
            }else  if(JsonObject['result'] == 2){
                toastr.warning(' Successfully saved, but with pending. Pls Check!');
            }

            $("#iBtnAddProdLineEffMonIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddProdLineEffMon").removeAttr('disabled');
            $("#iBtnAddProdLineEffMonIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddProdLineEffMonIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddProdLineEffMon").removeAttr('disabled');
            $("#iBtnAddProdLineEffMonIcon").addClass('fa fa-check');
        }
    });
  });

    $("#formSetIntervalprodlineeffmon").submit(function(event){
    event.preventDefault();
    SetIntervalPLEM();
  });

  // Edit Content
  $(document).on('click', '.aEditProdLineMonContent', function(){
    let prodlineeffmonId = $(this).attr('prodlineeffmon-id');
    $("#txtEditProdLineEffMonId").val(prodlineeffmonId);
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
        url: "get_prodlineeffmonitoring_by_id",
        method: "get",
        data: {
            prodlineeffmon_id: prodlineeffmonId
        },
        dataType: "json",
        beforeSend: function(){
            $("#txtEditTarget").val("");
            $("#txtEditActualEfficiency").val("");
            $("#txtEditResult").val("");
            $("#txtEditMonth").val("");
            $("#txtEditStart_Date").val("");
            $("#txtEditEnd_Date").val("");
            $("#txtEditTarget").removeClass('is-invalid');
            $("#txtEditActualEfficiency").removeClass('is-invalid');
            $("#txtEditResult").removeClass('is-invalid');
            $("#txtEditMonth").removeClass('is-invalid');
            $("#txtEditStart_Date").removeClass('is-invalid');
            $("#txtEditEnd_Date").removeClass('is-invalid');
        },
        success: function(JsonObject){
            let result = JsonObject['prodlineeffmonitoring'];
            if(result.length > 0){
                $("#selEditProductionLine").val(result[0].line).trigger('change');
                $("#txtEditActualEfficiency").val(result[0].actual_efficiency);
                $("#txtEditResult").val(result[0].result);
                $("#txtEditMonth").val(result[0].content_month);
                $("#txtEditTarget").val(result[0].target);
                $("#txtEditStart_Date").val(result[0].start_date);
                $("#txtEditEnd_Date").val(result[0].expiry_date);

            }
            else{
                toastr.warning('No Produt Line Efficiency Monitoring Content Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
  });

  $("#EditProdLineEffMonContentForm").submit(function(event){
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
        url: "edit_prodlineeffmonitoring",
        method: "post",
        data: new FormData(this),
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            $("#iBtnEditProdLineEffMonIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditProdLineEffMon").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
                $("#EditProdLineEffMonContentModal").modal('hide');
                $("#EditProdLineEffMonContentForm")[0].reset();

                $("#txtEditTarget").removeClass('is-invalid');
                $("#txtEditActualEfficiency").removeClass('is-invalid');
                $("#txtEditResult").removeClass('is-invalid');
                $("#txtEditMonth").removeClass('is-invalid');
                $("#txtEditStart_Date").removeClass('is-invalid');
                $("#txtEditEnd_Date").removeClass('is-invalid');

                dataTableProdLineEffMon.draw();
                toastr.success('Content was succesfully saved!');
            }
            else{
                toastr.error('Updating Content Failed!');

                if(JsonObject['error']['target'] === undefined){
                    $("#txtEditTarget").removeClass('is-invalid');
                    $("#txtEditTarget").attr('title', '');
                }
                else{
                    $("#txtEditTarget").addClass('is-invalid');
                    $("#txtEditTarget").attr('title', JsonObject['error']['target']);
                }
                if(JsonObject['error']['actualefficiency'] === undefined){
                    $("#txtEditTarget").removeClass('is-invalid');
                    $("#txtEditActualEfficiency").attr('title', '');
                }
                else{
                    $("#txtEditTarget").attr('title', JsonObject['error']['actualefficiency']);
                    $("#txtEditActualEfficiency").addClass('is-invalid');
                }
                if(JsonObject['error']['result'] === undefined){
                    $("#txtEditActualEfficiency").removeClass('is-invalid');
                    $("#txtEditResult").attr('title', '');
                }
                else{
                    $("#txtEditActualEfficiency").attr('title', JsonObject['error']['result']);
                    $("#txtEditResult").addClass('is-invalid');
                }
                if(JsonObject['error']['month'] === undefined){
                    $("#txtEditResult").removeClass('is-invalid');
                    $("#txtEditMonth").attr('title', '');
                }
                else{
                    $("#txtEditResult").attr('title', JsonObject['error']['month']);
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

            $("#iBtnEditProdLineEffMonIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditProdLineEffMon").removeAttr('disabled');
            $("#iBtnEditProdLineEffMonIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditProdLineEffMonIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditProdLineEffMon").removeAttr('disabled');
            $("#iBtnEditProdLineEffMonIcon").addClass('fa fa-check');
        }
    });
  });

  // Change Content Status
  $(document).on('click', '.aChangeProdLineMonContentStat', function(){
    let contStat = $(this).attr('status');
    let prodlineeffmoncontId = $(this).attr('prodlineeffmon-id');

    $("#txtChangeProdLineEffMonContentStatProdLineEffMonContentId").val(prodlineeffmoncontId);
    $("#txtChangeProdLineEffMonContentStatProdLineEffMonContentStat").val(contStat);

    if(contStat == 1){
      $("#lblChangeProdLineEffMonContentStatLabel").text('Are you sure to approve?');
      $("#h4ChangeProdLineEffMonContentTitle").html('<i class="fa fa-default"></i> Approve Content');
    }else if(contStat == 2){
      $("#lblChangeProdLineEffMonContentStatLabel").text('Are you sure to Disapprove?');
      $("#h4ChangeProdLineEffMonContentTitle").html('<i class="fa fa-default"></i> Disapprove Content');
    }else{
      $("#lblChangeProdLineEffMonContentStatLabel").text('Are you sure to Delete?');
      $("#h4ChangeProdLineEffMonContentTitle").html('<i class="fa fa-default"></i> Delete Content');
    }
  });
  $("#formChangeProdLineEffMonContentStat").submit(function(event){
    event.preventDefault();
    ChangeProdLineEffMonContentStatus();
  });

  $("#formImport").submit(function(event){
      event.preventDefault();
      $.ajax({
          url: 'import_prodlineeffmonitoring',
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
                dataTableProdLineEffMon.draw();
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

  GetBatchNumberPLEM($(".selectImportBatchPLEM"), 2);

  $("#ApprovePerBatchForm").submit(function(event){
    event.preventDefault();
    ApprovePerBatchFormPLEM();
  });

});
</script>
@endsection
@endauth
