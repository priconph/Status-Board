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
          <h1>Non-Conforming Products</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Non-Conforming Products</li>
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
              <button class="btn btn-primary" data-toggle="modal" data-target="#NonConfProdAddContentModal" id="btnShowAddNonConfProdModal"><i class="fa fa-plus"></i> Add Content</button>
              <button class="btn btn-warning" data-toggle="modal" data-target="#modalimport" title="Import Non-Conforming Products"><i class="fa fa-file-excel"></i> Import</button>         
              @if (Auth::user()->user_level_id == 2)
              <button class="btn btn-info" data-toggle="modal" data-target="#modalsetinterval" title="Set Non-Conforming Products Interval"><i class="far fa-clock"></i> Set Slide Interval</button>                   
              <button class="btn btn-success" data-toggle="modal" data-target="#modalapproveperbatch" title="Approve Per Import Batch"><i class="far fa-check-circle"></i> Approve</button>
              @endif
              <br>
              <br>
                <div class="table-responsive dt-responsive">
                <table id="tblNonConfProducts" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Status</th>
                        <th>Date</th>                        
                        <th>Product Name</th> 
                        <th>PO Number</th> 
                        <th>Problem</th> 
                        <th>PTIS/NG Report Number</th> 
                        <th>Status/Disposition</th>
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

            <!-- MODALS -->

            <!-- /.Add Modal  -->
            <div class="modal fade" id="NonConfProdAddContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Non-Conforming Products</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="NonConfProdAddContentForm">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Product Name</label>
                              <input type="text" class="form-control" name="productname" id="txtProductName">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>PO Number</label>
                              <input type="text" class="form-control" name="po_number" id="txtPO_Number">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Problem</label>
                              <input type="text" class="form-control" name="problem" id="txtProblem">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>PTIS/NG Report Number</label>
                              <input type="text" class="form-control" name="ptis_ng_reportnumber" id="txtPTIS_NG_ReportNumber">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Status/Disposition</label>
                              <input type="text" class="form-control" name="status_disposition" id="txtStatus_Disposition">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Date</label>
                              <input type="date" class="form-control" name="cont_date" id="txtCont_Date">
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
                      <button type="submit" id="btnAddNonConfProd" class="btn btn-primary"><i id="iBtnAddNonConfProdIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

            <!-- /.Edit Modal  -->
            <div class="modal fade" id="EditNonConfProdContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Edit Contents</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="EditNonConfProdContentForm">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <input type="hidden" class="form-control" name="nonconfprod_id" id="txtEditNonConfProdId">
                          <div class="form-group">
                            <label>Product Name</label>
                              <input type="text" class="form-control" name="productname" id="txtEditProductName">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>PO Number</label>
                              <input type="text" class="form-control" name="po_number" id="txtEditPO_Number">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Problem</label>
                              <input type="text" class="form-control" name="problem" id="txtEditProblem">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>PTIS/NG Report Number</label>
                              <input type="text" class="form-control" name="ptis_ng_reportnumber" id="txtEditPTIS_NG_ReportNumber">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Status/Disposition</label>
                              <input type="text" class="form-control" name="status_disposition" id="txtEditStatus_Disposition">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Date</label>
                              <input type="date" class="form-control" name="cont_date" id="txtEditCont_Date">
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
                      <button type="submit" id="btnEditNonConfProd" class="btn btn-primary"><i id="iBtnEditNonConfProdIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

          <div class="modal fade" id="modalsetinterval" data-backdrop="static"data-backdrop="static">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="far fa-clock"></i> Set slide interval for Non-Conforming Products</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" id="formSetInterval" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <input type="hidden" name="carousel_interval_id" id="carousel_interval_id">
                        <div class="form-group">
                          <label>Slide</label>
                            <input type="text" class="form-control" name="carousel_slide" id="txtCarouselSlide" value="Non-Conforming Products" readonly>
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

            <div class="modal fade" id="modalChangeNonConfProdContentStat" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content modal-sm">
                  <div class="modal-header">
                    <h4 class="modal-title" id="h4ChangeNonConfProdContentTitle"><i class="fa fa-default"></i> Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="formChangeNonConfProdContentStat">
                    @csrf
                    <div class="modal-body">
                      <label id="lblChangeNonConfProdContentStatLabel">Are you sure to ?</label>
                      <input type="hidden" name="nonconfprod_id" placeholder="Content Id" id="txtChangeNonConfProdContentStatNonConfProdContentId">
                      <input type="hidden" name="status" placeholder="Status" id="txtChangeNonConfProdContentStatNonConfProdContentStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" id="btnChangeNonConfProdContentStat" class="btn btn-primary"><i id="iBtnChangeNonConfProdContentStatIcon" class="fa fa-check"></i> Yes</button>
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
                            <select class="form-control select2bs4 selectImportBatch" name="approveperbatch" id="selImportbyBatch" style="width: 100%;">
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
                          <label>Non-Conforming Products</label>
                            <input type="file" class="form-control" name="import_file_nonconfprod" id="fileImportNonConfProd">   
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
  let dataTableNonConfProducts;
  $(document).ready(function () {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

    dataTableNonConfProducts = $("#tblNonConfProducts").DataTable({
      "processing" : false,
        "serverSide" : true,
        "ajax" : {
          url: "view_nonconformingproducts",
          // data: function (param){
          //     param.status = $("#selEmpStat").val();
          // }
        },
        
        "columns":[
          { "data" : "label1" },
          { "data" : "content_date" },
          { "data" : "product_name" },
          { "data" : "po_number" },
          { "data" : "problem" },
          { "data" : "ptis_ng_report_number" },
          { "data" : "status_disposition" },
          { "data" : "batch_number" },
          { "data" : "start_date" },
          { "data" : "expiry_date" },
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
  $("#NonConfProdAddContentForm").submit(function(event){
    event.preventDefault();
    AddNonConfProdContent();
  });

  // Set Slide Interval
  $("#formSetInterval").submit(function(event){
    event.preventDefault();
    SetInterval();
  });

  // Edit Content 
  $(document).on('click', '.aEditNonConfProdContent', function(){
    let nonconfprodcontId = $(this).attr('nonconformingproducts-id');
    $("#txtEditNonConfProdId").val(nonconfprodcontId);
    GetNonConfProdByIdToEdit(nonconfprodcontId);
    $("#txtEditProductName").removeClass('is-invalid');
    $("#txtEditProductName").attr('title', '');
  });
  
  $("#EditNonConfProdContentForm").submit(function(event){
    event.preventDefault();
    EditNonConfProdContent();
  });

  // Change Content Status
  $(document).on('click', '.aChangeNonConfProdContentStat', function(){
    let contStat = $(this).attr('status');
    let nonprodconfcontId = $(this).attr('nonconformingproducts-id');

    $("#txtChangeNonConfProdContentStatNonConfProdContentId").val(nonprodconfcontId);
    $("#txtChangeNonConfProdContentStatNonConfProdContentStat").val(contStat);

    if(contStat == 1){
      $("#lblChangeNonConfProdContentStatLabel").text('Are you sure to approve?'); 
      $("#h4ChangeNonConfProdContentTitle").html('<i class="fa fa-default"></i> Approve Content');
    }else if(contStat == 2){
      $("#lblChangeNonConfProdContentStatLabel").text('Are you sure to Disapprove?');
      $("#h4ChangeNonConfProdContentTitle").html('<i class="fa fa-default"></i> Disapprove Content');
    }else{
      $("#lblChangeNonConfProdContentStatLabel").text('Are you sure to Delete?');
      $("#h4ChangeNonConfProdContentTitle").html('<i class="fa fa-default"></i> Delete Content');      
    }
  });
  
  $("#formChangeNonConfProdContentStat").submit(function(event){
    event.preventDefault();
    ChangeNonConfProdContentStatus();
  });

  $("#formImport").submit(function(event){
      event.preventDefault();
      $.ajax({
          url: 'import_nonconformingproducts',
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
                dataTableNonConfProducts.draw();
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

  GetBatchNumber($(".selectImportBatch"), 2);

  $("#ApprovePerBatchForm").submit(function(event){
    event.preventDefault();
    ApprovePerBatchForm();
  });

});

</script>
@endsection
@endauth
