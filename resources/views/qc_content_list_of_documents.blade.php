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
          <h1>List of Documents</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">List of Documents</li>
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
              <button class="btn btn-primary" data-toggle="modal" data-target="#ListOfDocsAddContentModal" id="btnShowAddListOfDocsModal"><i class="fa fa-plus"></i> Add Content</button>
              <button class="btn btn-warning" data-toggle="modal" data-target="#modalimport" title="Import WIP and FGS Summaries"><i class="fa fa-file-excel"></i> Import</button>              
              @if (Auth::user()->user_level_id == 2)
              <button class="btn btn-info" data-toggle="modal" data-target="#modalsetintervallistofdocs" title="Set List of Documents Slide Interval"><i class="far fa-clock"></i> Set Slide Interval</button>                  
              <button class="btn btn-success" data-toggle="modal" data-target="#modalapproveperbatch" title="Approve Per Import Batch"><i class="far fa-check-circle"></i> Approve</button>
              @endif
              <br>
              <br>
                <div class="table-responsive dt-responsive">
                <table id="tblListofDocuments" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Status</th>                        
                        <th>Document No.</th> 
                        <th>Document Title</th> 
                        <th>Document Category</th> 
                        <th>Revision Details</th>
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
            <div class="modal fade" id="ListOfDocsAddContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add List of Document Content</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="ListOfDocsAddContentForm">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                      <div class="form-group">
                        <label>Document Type</label>
                        <select class="form-control select2bs4" name="documenttype" id="selDocumentType" style="width: 100%;">
                          <option value="0" selected disabled>-- Select Document Type --</option>
                          <option value="1">Work Instruction (A3)</option>
                          <option value="2">Point Panel (A3)</option>
                          <option value="3">PQS Document</option>
                        </select>                                                                        
                      </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Document #</label>
                              <input type="text" class="form-control" name="documentno" id="txtDocumentNo">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Document Title</label>
                              <input type="text" class="form-control" name="documenttitle" id="txtDocumentTitle">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Revision Details</label>
                              <textarea class="form-control" name="revisiondetails" id="txtRevisionDetails"></textarea> 
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
                      <button type="submit" id="btnAddListOfDocs" class="btn btn-primary"><i id="iBtnAddListOfDocsIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

            <!-- /.Edit Modal  -->
            <div class="modal fade" id="ListOfDocsEditContentModal" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Edit Contents</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="ListOfDocsEditContentForm">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                      <input type="hidden" class="form-control" name="listofdocs_id" id="txtEditListOfDocsId">
                      <div class="form-group">
                        <label>Document Type</label>
                        <select class="form-control select2bs4" name="documenttype" id="selEditDocumentType" style="width: 100%;">
                          <option value="0" selected disabled>-- Select Document Type --</option>
                          <option value="1">Work Instruction (A3)</option>
                          <option value="2">Point Panel (A3)</option>
                          <option value="3">PQS Document</option>
                        </select>                                                                        
                      </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Document #</label>
                              <input type="text" class="form-control" name="documentno" id="txtEditDocumentNo">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Document Title</label>
                              <input type="text" class="form-control" name="documenttitle" id="txtEditDocumentTitle">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Revision Details</label>
                              <textarea class="form-control" name="revisiondetails" id="txtEditRevisionDetails"></textarea> 
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
                      <button type="submit" id="btnEditListOfDocs" class="btn btn-primary"><i id="iBtnEditListOfDocsIcon" class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modalsetintervallistofdocs" data-backdrop="static"data-backdrop="static">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="far fa-clock"></i> Set slide interval for List of Documents</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" id="formSetIntervallistofdocs" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <input type="hidden" name="carousel_interval_id" id="carousel_interval_id">
                        <div class="form-group">
                          <label>Slide</label>
                            <input type="text" class="form-control" name="carousel_slide" id="txtCarouselSlide" value="List of Documents" readonly>
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

            <div class="modal fade" id="modalChangeListOfDocsContentStat" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content modal-sm">
                  <div class="modal-header">
                    <h4 class="modal-title" id="h4ChangeListOfDocsContentTitle"><i class="fa fa-default"></i> Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" id="formChangeListOfDocsContentStat">
                    @csrf
                    <div class="modal-body">
                      <label id="lblChangeListOfDocsContentStatLabel">Are you sure to ?</label>
                      <input type="hidden" name="listofdocs_id" placeholder="Content Id" id="txtChangeListOfDocsContentStatListOfDocsContentId">
                      <input type="hidden" name="status" placeholder="Status" id="txtChangeListOfDocsContentStatListOfDocsContentStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" id="btnChangeListOfDocsContentStat" class="btn btn-primary"><i id="iBtnChangeListOfDocsContentStatIcon" class="fa fa-check"></i> Yes</button>
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
                          <select class="form-control select2bs4 selectImportBatchLD" name="approveperbatch" id="selImportbyBatch" style="width: 100%;">
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
                          <label>List of Documents</label>
                            <input type="file" class="form-control" name="import_file_listofdocs" id="fileImportLotOutDefs">   
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
  let dataTableListofDocuments;
  $(document).ready(function () {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

    dataTableListofDocuments = $("#tblListofDocuments").DataTable({
      "processing" : false,
        "serverSide" : true,
        "ajax" : {
          url: "view_listofdocs",
          // data: function (param){
          //     param.status = $("#selEmpStat").val();
          // }
        },
        
        "columns":[
          { "data" : "label1" },
          { "data" : "document_no" },
          { "data" : "document_title" },
          { "data" : "list_of_docs" },
          { "data" : "revision_details" },
          { "data" : "batch_number" },
          { "data" : "start_date" },
          { "data" : "expiry_date" },
          { "data" : "action1", orderable:false, searchable:false }
        ],
        "initComplete": function(settings, json) {
              $(".chkMOD").each(function(index){
                  if(arrSelectedMOD.includes($(this).attr('listofdocuments-id'))){
                      $(this).attr('checked', 'checked');
                  }
              });
        },
        "drawCallback": function( settings ) {
              $(".chkMOD").each(function(index){
                  if(arrSelectedMOD.includes($(this).attr('listofdocuments-id'))){
                      $(this).attr('checked', 'checked');
                  }
              });
          }
      });

  // Add Content 
  $("#ListOfDocsAddContentForm").submit(function(event){
    event.preventDefault();
    AddListofDocsContent();
  });

  $("#formSetIntervallistofdocs").submit(function(event){
    event.preventDefault();
    SetIntervalLD();
  });

  // Edit Content 
  $(document).on('click', '.aEditListOfDocsContent', function(){
    let listofdocscontId = $(this).attr('listofdocuments-id');
    $("#txtEditListOfDocsId").val(listofdocscontId);
    GetListofDocsByIdToEdit(listofdocscontId);
    $("#txtEditDocumentNo").removeClass('is-invalid');
    $("#txtEditDocumentNo").attr('title', '');
  });
  
  $("#ListOfDocsEditContentForm").submit(function(event){
    event.preventDefault();
    EditListOfDocsContent();
  });

  // Change Content Status
  $(document).on('click', '.aChangeListOfDocsContentStat', function(){
    let contStat = $(this).attr('status');
    let listofdocscontId = $(this).attr('listofdocuments-id');

    $("#txtChangeListOfDocsContentStatListOfDocsContentId").val(listofdocscontId);
    $("#txtChangeListOfDocsContentStatListOfDocsContentStat").val(contStat);

    if(contStat == 1){
      $("#lblChangeListOfDocsContentStatLabel").text('Are you sure to approve?'); 
      $("#h4ChangeListOfDocsContentTitle").html('<i class="fa fa-default"></i> Approve Content');
    }else if(contStat == 2){
      $("#lblChangeListOfDocsContentStatLabel").text('Are you sure to Disapprove?');
      $("#h4ChangeListOfDocsContentTitle").html('<i class="fa fa-default"></i> Disapprove Content');
    }else{
      $("#lblChangeListOfDocsContentStatLabel").text('Are you sure to Delete?');
      $("#h4ChangeListOfDocsContentTitle").html('<i class="fa fa-default"></i> Delete Content');      
    }
  });
  $("#formChangeListOfDocsContentStat").submit(function(event){
    event.preventDefault();
    ChangeListofDocsContentStatus();
  });

  $("#formImport").submit(function(event){
      event.preventDefault();
      $.ajax({
          url: 'import_listofdocs',
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
                dataTableListofDocuments.draw();
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

  GetBatchNumberLD($(".selectImportBatchLD"), 2);

  $("#ApprovePerBatchForm").submit(function(event){
    event.preventDefault();
    ApprovePerBatchFormLD();
  });

});

</script>
@endsection
@endauth