// Add Engineering Content
function AddNonConfProdContent(){
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
        url: "add_nonconformingproducts",
        method: "post",
        data: $('#NonConfProdAddContentForm').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddNonConfProdIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddNonConfProd").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#NonConfProdAddContentModal").modal('hide');
              $("#NonConfProdAddContentForm")[0].reset();
              $("#txtProductName").removeClass('is-invalid');
              $("#txtPO_Number").removeClass('is-invalid');
              $("#txtProblem").removeClass('is-invalid');
              $("#txtPTIS_NG_ReportNumber").removeClass('is-invalid');
              $("#txtStatus_Disposition").removeClass('is-invalid');
              $("#txtCont_Date").removeClass('is-invalid');
              $("#txtStart_Date").removeClass('is-invalid');
              $("#txtEnd_Date").removeClass('is-invalid');

          	  dataTableNonConfProducts.draw();
              toastr.success('Content was succesfully saved!');       
            }
            else{
                toastr.error(' Saving Content Failed!');

                if(JsonObject['error']['productname'] === undefined){
                    $("#txtProductName").removeClass('is-invalid');
                    $("#txtProductName").attr('title', '');
                }
                else{
                    $("#txtProductName").addClass('is-invalid');
                    $("#txtProductName").attr('title', JsonObject['error']['productname']);
                }

                if(JsonObject['error']['po_number'] === undefined){
                    $("#txtPO_Number").removeClass('is-invalid');
                    $("#txtPO_Number").attr('title', '');
                }
                else{
                    $("#txtPO_Number").addClass('is-invalid');
                    $("#txtPO_Number").attr('title', JsonObject['error']['po_number']);
                } 

                if(JsonObject['error']['problem'] === undefined){
                    $("#txtProblem").removeClass('is-invalid');
                    $("#txtProblem").attr('title', '');
                }
                else{
                    $("#txtProblem").addClass('is-invalid');
                    $("#txtProblem").attr('title', JsonObject['error']['problem']);
                }

                if(JsonObject['error']['ptis_ng_reportnumber'] === undefined){
                    $("#txtPTIS_NG_ReportNumber").removeClass('is-invalid');
                    $("#txtPTIS_NG_ReportNumber").attr('title', '');
                }
                else{
                    $("#txtPTIS_NG_ReportNumber").addClass('is-invalid');
                    $("#txtPTIS_NG_ReportNumber").attr('title', JsonObject['error']['ptis_ng_reportnumber']);
                } 
                if(JsonObject['error']['status_disposition'] === undefined){
                    $("#txtStatus_Disposition").removeClass('is-invalid');
                    $("#txtStatus_Disposition").attr('title', '');
                }
                else{
                    $("#txtStatus_Disposition").addClass('is-invalid');
                    $("#txtStatus_Disposition").attr('title', JsonObject['error']['status_disposition']);
                } 
                if(JsonObject['error']['cont_date'] === undefined){
                    $("#txtCont_Date").removeClass('is-invalid');
                    $("#txtCont_Date").attr('title', '');
                }
                else{
                    $("#txtCont_Date").addClass('is-invalid');
                    $("#txtCont_Date").attr('title', JsonObject['error']['cont_date']);
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

            $("#iBtnAddNonConfProdIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddNonConfProd").removeAttr('disabled');
            $("#iBtnAddNonConfProdIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
            $("#iBtnAddNonConfProdIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddNonConfProd").removeAttr('disabled');
            $("#iBtnAddNonConfProdIcon").addClass('fa fa-check');
        }
    });
}

function SetInterval(){
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
        url: "setinterval_nonconformingproducts",
        method: "post",
        data: $('#formSetInterval').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#ibtnsetinterval").addClass('fa fa-spinner fa-pulse');
            $("#btnsetinterval").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#modalsetinterval").modal('hide');
              $("#formSetInterval")[0].reset();
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
function GetNonConfProdByIdToEdit(nonconfprodcontId){
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
        url: "get_nonconformingproducts_by_id",
        method: "get",
        data: {
            nonconfprodcont_id: nonconfprodcontId
        },
        dataType: "json",
        beforeSend: function(){
            $("#txtProductName").val("");
            $("#txtPO_Number").val("");
            $("#txtProblem").val("");
            $("#txtPTIS_NG_ReportNumber").val("");
            $("#txtStatus_Disposition").val("");
            $("#txtCont_Date").val("");
            $("#txtStart_Date").val("");
            $("#txtEnd_Date").val("");
            $("#txtProductName").removeClass('is-invalid');
            $("#txtPO_Number").removeClass('is-invalid');
            $("#txtProblem").removeClass('is-invalid');
            $("#txtPTIS_NG_ReportNumber").removeClass('is-invalid');
            $("#txtStatus_Disposition").removeClass('is-invalid');
            $("#txtCont_Date").removeClass('is-invalid');  
            $("#txtStart_Date").removeClass('is-invalid');               
            $("#txtEnd_Date").removeClass('is-invalid');    
        },
        success: function(JsonObject){
            let result = JsonObject['nonconformingproducts'];
            if(result.length > 0){
                $("#txtEditProductName").val(result[0].product_name);
                $("#txtEditPO_Number").val(result[0].po_number);
                $("#txtEditProblem").val(result[0].problem);
                $("#txtEditPTIS_NG_ReportNumber").val(result[0].ptis_ng_report_number);
                $("#txtEditStatus_Disposition").val(result[0].status_disposition); 
                $("#txtEditCont_Date").val(result[0].content_date); 
                $("#txtEditStart_Date").val(result[0].start_date); 
                $("#txtEditEnd_Date").val(result[0].expiry_date);                
            }
            else{
                toastr.warning('No Engineering Content Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });

}

function EditNonConfProdContent(){
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
        url: "edit_nonconformingproducts",
        method: "post",
        data: $('#EditNonConfProdContentForm').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditNonConfProdIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditNonConfProd").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
                $("#EditNonConfProdContentModal").modal('hide');
                $("#EditNonConfProdContentForm")[0].reset();

                $("#txtEditProductName").removeClass('is-invalid');
                $("#txtEditPO_Number").removeClass('is-invalid');
                $("#txtEditProblem").removeClass('is-invalid');
                $("#txtEditPTIS_NG_ReportNumber").removeClass('is-invalid'); 
                $("#txtEditStatus_Disposition").removeClass('is-invalid');
                $("#txtEditCont_Date").removeClass('is-invalid');
                $("#txtEditStart_Date").removeClass('is-invalid');
                $("#txtEditEnd_Date").removeClass('is-invalid');

                dataTableNonConfProducts.draw();
                toastr.success('Content was succesfully saved!');
            }
            else{
                toastr.error('Updating Content Failed!');

                if(JsonObject['error']['productname'] === undefined){
                    $("#txtEditProductName").removeClass('is-invalid');
                    $("#txtEditProductName").attr('title', '');
                }
                else{
                    $("#txtEditProductName").addClass('is-invalid');
                    $("#txtEditProductName").attr('title', JsonObject['error']['productname']);
                }

                if(JsonObject['error']['po_number'] === undefined){
                    $("#txtEditProductName").removeClass('is-invalid');
                    $("#txtEditPO_Number").attr('title', '');
                }
                else{
                    $("#txtEditProductName").attr('title', JsonObject['error']['po_number']);
                    $("#txtEditPO_Number").addClass('is-invalid');
                }
                if(JsonObject['error']['problem'] === undefined){
                    $("#txtEditPO_Number").removeClass('is-invalid');
                    $("#txtEditProblem").attr('title', '');
                }
                else{
                    $("#txtEditPO_Number").attr('title', JsonObject['error']['problem']);
                    $("#txtEditProblem").addClass('is-invalid');
                }    
                if(JsonObject['error']['ptis_ng_reportnumber'] === undefined){
                    $("#txtEditProblem").removeClass('is-invalid');
                    $("#txtEditPTIS_NG_ReportNumber").attr('title', '');
                }
                else{
                    $("#txtEditProblem").attr('title', JsonObject['error']['ptis_ng_reportnumber']);
                    $("#txtEditPTIS_NG_ReportNumber").addClass('is-invalid');
                }
                if(JsonObject['error']['status_disposition'] === undefined){
                    $("#txtEditPTIS_NG_ReportNumber").removeClass('is-invalid');
                    $("#txtEditStatus_Disposition").attr('title', '');
                }
                else{
                    $("#txtEditPTIS_NG_ReportNumber").attr('title', JsonObject['error']['status_disposition']);
                    $("#txtEditStatus_Disposition").addClass('is-invalid');
                }
                if(JsonObject['error']['cont_date'] === undefined){
                    $("#txtEditStatus_Disposition").removeClass('is-invalid');
                    $("#txtEditCont_Date").attr('title', '');
                }
                else{
                    $("#txtEditStatus_Disposition").attr('title', JsonObject['error']['cont_date']);
                    $("#txtEditCont_Date").addClass('is-invalid');
                }                
                if(JsonObject['error']['start_date'] === undefined){
                    $("#txtEditCont_Date").removeClass('is-invalid');
                    $("#txtEditStart_Date").attr('title', '');
                }
                else{
                    $("#txtEditCont_Date").attr('title', JsonObject['error']['start_date']);
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

            $("#iBtnEditNonConfProdIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditNonConfProd").removeAttr('disabled');
            $("#iBtnEditNonConfProdIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditMODIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditNonConfProd").removeAttr('disabled');
            $("#iBtnEditMODIcon").addClass('fa fa-check');
        }
    });
}

function ChangeNonConfProdContentStatus(){
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
        url: "change_nonconformingproducts_stat",
        method: "post",
        data: $('#formChangeNonConfProdContentStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangeNonConfProdContentStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnChangeNonConfProdContentStat").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
                $("#modalChangeNonConfProdContentStat").modal('hide');
                $("#formChangeNonConfProdContentStat")[0].reset();

                dataTableNonConfProducts.draw();

                if($("#txtChangeNonConfProdContentStatNonConfProdContentStat").val() == 1){
                    toastr.success('Content Approval Success!');
                }else if($("#txtChangeNonConfProdContentStatNonConfProdContentStat").val() == 2){
                    toastr.success('Content Disapproved!');
                }else{
                    toastr.success('Content Deleted!');
                }
            }
            else{
                if($("#txtChangeNonConfProdContentStatNonConfProdContentStat").val() == 1){
                    toastr.error('Content Approval Failed!');
                }else if($("#txtChangeNonConfProdContentStatNonConfProdContentStat").val() == 2){
                    toastr.error('Content Disapproval Failed!');
                }else {
                    toastr.error('Content Deletion Failed!');
                }
            }

            $("#iBtnChangeNonConfProdContentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeNonConfProdContentStat").removeAttr('disabled');
            $("#iBtnChangeNonConfProdContentStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangeNonConfProdContentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeNonConfProdContentStat").removeAttr('disabled');
            $("#iBtnChangeNonConfProdContentStatIcon").addClass('fa fa-check');
        }
    });
}

function GetBatchNumber(cboElement, status){
    let result = '<option value="0" selected disabled> -- Select Batch -- </option>';
    $.ajax({
        url: 'get_nonconformingproducts_by_stat',
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

function ApprovePerBatchForm(){
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
                url: "change_nonconformingproducts_stat_by_batch",
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

                        dataTableNonConfProducts.draw();
                        toastr.success('Content Approval Success!');

                    }else{

                        toastr.error('Content Approval Failed!');
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