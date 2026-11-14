// Add Engineering Content
function AddListofDocsContent(){
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
        url: "add_listofdocs",
        method: "post",
        data: $('#ListOfDocsAddContentForm').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddListOfDocsIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditListOfDocs").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#ListOfDocsAddContentModal").modal('hide');
              $("#ListOfDocsAddContentForm")[0].reset();
              $("#selDocumentType").val('0').trigger('change');
              $("#txtDocumentNo").removeClass('is-invalid');
              $("#txtDocumentTitle").removeClass('is-invalid');
              $("#txtRevisionDetails").removeClass('is-invalid');
              $("#txtStart_Date").removeClass('is-invalid');
              $("#txtEnd_Date").removeClass('is-invalid');


              dataTableListofDocuments.draw();
              toastr.success('Content was succesfully saved!');       
            }
            else{
                toastr.error(' Saving Content Failed!');

                if(JsonObject['error']['documenttype'] === undefined){
                    $("#selDocumentType").removeClass('is-invalid');
                    $("#selDocumentType").attr('title', '');
                }
                else{
                    $("#selDocumentType").addClass('is-invalid');
                    $("#selDocumentType").attr('title', JsonObject['error']['documenttype']);
                }

                if(JsonObject['error']['documentno'] === undefined){
                    $("#txtDocumentNo").removeClass('is-invalid');
                    $("#txtDocumentNo").attr('title', '');
                }
                else{
                    $("#txtDocumentNo").addClass('is-invalid');
                    $("#txtDocumentNo").attr('title', JsonObject['error']['documentno']);
                } 

                if(JsonObject['error']['documenttitle'] === undefined){
                    $("#txtDocumentTitle").removeClass('is-invalid');
                    $("#txtDocumentTitle").attr('title', '');
                }
                else{
                    $("#txtDocumentTitle").addClass('is-invalid');
                    $("#txtDocumentTitle").attr('title', JsonObject['error']['documenttitle']);
                }
                if(JsonObject['error']['revisiondetails'] === undefined){
                    $("#txtRevisionDetails").removeClass('is-invalid');
                    $("#txtRevisionDetails").attr('title', '');
                }
                else{
                    $("#txtRevisionDetails").addClass('is-invalid');
                    $("#txtRevisionDetails").attr('title', JsonObject['error']['revisiondetails']);
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

            $("#iBtnAddListOfDocsIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditListOfDocs").removeAttr('disabled');
            $("#iBtnAddListOfDocsIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
            $("#iBtnAddListOfDocsIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditListOfDocs").removeAttr('disabled');
            $("#iBtnAddListOfDocsIcon").addClass('fa fa-check');
        }
    });
}

function SetIntervalLD(){
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
        url: "setinterval_listofdocs",
        method: "post",
        data: $('#formSetIntervallistofdocs').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#ibtnsetinterval").addClass('fa fa-spinner fa-pulse');
            $("#btnsetinterval").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#modalsetintervallistofdocs").modal('hide');
              $("#formSetIntervallistofdocs")[0].reset();
              $("#txtCarouselSlide").removeClass('is-invalid');
              $("#txtSlideInterval").removeClass('is-invalid');

              toastr.success('Setting Slide Interval successful!');       
            }
            else{
                toastr.error(' Setting Slide Interval Failed!');

                if(JsonObject['error']['carousel_slide'] === undefined){
                    $("#txtCarouselSlide").removeClass('is-invalid');
                    $("#txtCarouselSlide").attr('title', '');
                }
                else{
                    $("#txtCarouselSlide").addClass('is-invalid');
                    $("#txtCarouselSlide").attr('title', JsonObject['error']['carousel_slide']);
                }

                if(JsonObject['error']['slide_interval'] === undefined){
                    $("#txtSlideInterval").removeClass('is-invalid');
                    $("#txtSlideInterval").attr('title', '');
                }
                else{
                    $("#txtSlideInterval").addClass('is-invalid');
                    $("#txtSlideInterval").attr('title', JsonObject['error']['slide_interval']);
                }                                                  
            }

            $("#ibtnsetinterval").removeClass('fa fa-spinner fa-pulse');
            $("#btnsetinterval").removeAttr('disabled');
            $("#ibtnsetinterval").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
            $("#ibtnsetinterval").removeClass('fa fa-spinner fa-pulse');
            $("#btnsetinterval").removeAttr('disabled');
            $("#ibtnsetinterval").addClass('fa fa-check');
        }
    });
}

// Edit engineering Content
function GetListofDocsByIdToEdit(listofdocscontId){
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
        url: "get_listofdocs_by_id",
        method: "get",
        data: {
            listofdocs_id: listofdocscontId
        },
        dataType: "json",
        beforeSend: function(){
            $("#txtEditDocumentNo").val("");
            $("#txtEditDocumentTitle").val("");
            $("#txtEditRevisionDetails").val("");
            $("#txtEditStart_Date").val("");
            $("#txtEditEnd_Date").val("");
            $("#txtEditDocumentNo").removeClass('is-invalid');
            $("#txtEditDocumentTitle").removeClass('is-invalid');
            $("#txtEditRevisionDetails").removeClass('is-invalid');
            $("#txtEditStart_Date").removeClass('is-invalid');              
            $("#txtEditEnd_Date").removeClass('is-invalid');                      
        },
        success: function(JsonObject){
            let result = JsonObject['listofdocuments'];
            if(result.length > 0){
                $("#selEditDocumentType").val(result[0].document_category).trigger('change');                
                $("#txtEditDocumentNo").val(result[0].document_no);
                $("#txtEditDocumentTitle").val(result[0].document_title); 
                $("#txtEditRevisionDetails").val(result[0].revision_details); 
                $("#txtEditStart_Date").val(result[0].start_date);          
                $("#txtEditEnd_Date").val(result[0].expiry_date);                          
            }
            else{
                toastr.warning('No List of Document Content Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });

}

function EditListOfDocsContent(){
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
        url: "edit_listofdocs",
        method: "post",
        data: $('#ListOfDocsEditContentForm').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditListOfDocsIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditListOfDocs").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
                $("#ListOfDocsEditContentModal").modal('hide');
                $("#ListOfDocsEditContentForm")[0].reset();

                $("#txtEditDocumentNo").removeClass('is-invalid');
                $("#txtEditDocumentTitle").removeClass('is-invalid');
                $("#txtEditRevisionDetails").removeClass('is-invalid');
                $("#txtEditStart_Date").removeClass('is-invalid');
                $("#txtEditEnd_Date").removeClass('is-invalid');                

                dataTableListofDocuments.draw();
                toastr.success('Content was succesfully saved!');
            }
            else{
                toastr.error('Updating Content Failed!');

                if(JsonObject['error']['documentno'] === undefined){
                    $("#txtEditDocumentNo").removeClass('is-invalid');
                    $("#txtEditDocumentNo").attr('title', '');
                }
                else{
                    $("#txtEditDocumentNo").addClass('is-invalid');
                    $("#txtEditDocumentNo").attr('title', JsonObject['error']['documentno']);
                }

                if(JsonObject['error']['documenttitle'] === undefined){
                    $("#txtEditDocumentNo").removeClass('is-invalid');
                    $("#txtEditDocumentTitle").attr('title', '');
                }
                else{
                    $("#txtEditDocumentNo").attr('title', JsonObject['error']['documenttitle']);
                    $("#txtEditDocumentTitle").addClass('is-invalid');
                }
                if(JsonObject['error']['revisiondetails'] === undefined){
                    $("#txtEditDocumentTitle").removeClass('is-invalid');
                    $("#txtEditRevisionDetails").attr('title', '');
                }
                else{
                    $("#txtEditDocumentTitle").attr('title', JsonObject['error']['revisiondetails']);
                    $("#txtEditRevisionDetails").addClass('is-invalid');
                }                
                if(JsonObject['error']['start_date'] === undefined){
                    $("#txtEditRevisionDetails").removeClass('is-invalid');
                    $("#txtEditStart_Date").attr('title', '');
                }
                else{
                    $("#txtEditRevisionDetails").attr('title', JsonObject['error']['start_date']);
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

            $("#iBtnEditListOfDocsIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditListOfDocs").removeAttr('disabled');
            $("#iBtnEditListOfDocsIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditListOfDocsIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditListOfDocs").removeAttr('disabled');
            $("#iBtnEditListOfDocsIcon").addClass('fa fa-check');
        }
    });
}

function ChangeListofDocsContentStatus(){
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
        url: "change_listofdocs_stat",
        method: "post",
        data: $('#formChangeListOfDocsContentStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangeListOfDocsContentStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnChangeListOfDocsContentStat").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
                $("#modalChangeListOfDocsContentStat").modal('hide');
                $("#formChangeListOfDocsContentStat")[0].reset();

                dataTableListofDocuments.draw();

                if($("#txtChangeListOfDocsContentStatListOfDocsContentStat").val() == 1){
                    toastr.success('Content Approval Success!');
                }else if($("#txtChangeListOfDocsContentStatListOfDocsContentStat").val() == 2){
                    toastr.success('Content Disapproved!');
                }else{
                    toastr.success('Content Deleted!');
                }
            }
            else{
                if($("#txtChangeListOfDocsContentStatListOfDocsContentStat").val() == 1){
                    toastr.error('Content Approval Failed!');
                }else if($("#txtChangeListOfDocsContentStatListOfDocsContentStat").val() == 2){
                    toastr.error('Content Disapproval Failed!');
                }else {
                    toastr.error('Content Deletion Failed!');
                }
            }

            $("#iBtnChangeListOfDocsContentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeListOfDocsContentStat").removeAttr('disabled');
            $("#iBtnChangeListOfDocsContentStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangeListOfDocsContentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeListOfDocsContentStat").removeAttr('disabled');
            $("#iBtnChangeListOfDocsContentStatIcon").addClass('fa fa-check');
        }
    });
}

function GetBatchNumberLD(cboElement, status){
    let result = '<option value="0" selected disabled> -- Select Batch -- </option>';
    $.ajax({
        url: 'get_listofdocs_by_stat',
        method: 'get',
        data: {
          status: status
        },
        dataType: 'json',
        beforeSend: function(){
            result = '<option value="0" selected disabled> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(JsonObject){
            result = '';
            if(JsonObject['perbatchnumber'].length > 0){
                result = '<option value="0" selected disabled> -- Select Batch -- </option>';
                for(let index = 0; index < JsonObject['perbatchnumber'].length; index++){
                    result += '<option value="' + JsonObject['perbatchnumber'][index].batch_number + '">' + JsonObject['perbatchnumber'][index].batch_number + '</option>';
                }
            }
            else{
                result = '<option value="0" selected disabled> -- No record found -- </option>';
            }

            cboElement.html(result);
        },
        error: function(data, xhr, status){
            result = '<option value="0" selected disabled> -- Reload Again -- </option>';
            cboElement.html(result);
            console.log('Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

function ApprovePerBatchFormLD(){
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

    $.confirm({
        title: 'NOTICE!',
        content: 'Are you sure you want Approve this import batch?',
        buttons: {
        confirm: function () {
            $.ajax({
                url: "change_listofdocs_stat_by_batch",
                method: "post",
                data: $('#ApprovePerBatchForm').serialize(),
                dataType: "json",
                beforeSend: function(){
                    $("#iBtnApprovePerBatch").addClass('fa fa-spinner fa-pulse');
                    $("#btnApprovePerBatch").prop('disabled', 'disabled');

            
                },
                success: function(JsonObject){
                    if(JsonObject['result'] == 1){
                        $("#modalapproveperbatch").modal('hide');
                        $("#ApprovePerBatchForm")[0].reset();

                        dataTableListofDocuments.draw();

                        toastr.success('Content Approval Success!');

                    }else{

                        toastr.success('Content Approval Failed!');
                    }
               

                    $("#iBtnApprovePerBatch").removeClass('fa fa-spinner fa-pulse');
                    $("#btnApprovePerBatch").removeAttr('disabled');
                    $("#iBtnApprovePerBatch").addClass('fa fa-check');
                },
                error: function(data, xhr, status){
                    toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
                    $("#iBtnApprovePerBatch").removeClass('fa fa-spinner fa-pulse');
                    $("#btnApprovePerBatch").removeAttr('disabled');
                    $("#iBtnApprovePerBatch").addClass('fa fa-check');
                }
            });
        },
        cancel: function () {
            toastr.warning('Content Approval Cancelled!');
        }
      }
    });              
}