function ChangeCustClaimContentStatus(){
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
        url: "change_customerclaim_stat",
        method: "post",
        data: $('#formChangeCustClaimontentStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangeCustClaimContentStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnChangeCustClaimContentStat").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
                $("#modalChangeCustClaimContentStat").modal('hide');
                $("#formChangeCustClaimontentStat")[0].reset();

                dataTableCustClaim.draw();

                if($("#txtChangeCustClaimContentStatCustClaimContentStat").val() == 1){
                    toastr.success('Content Approval Success!');
                }else if($("#txtChangeCustClaimContentStatCustClaimContentStat").val() == 2){
                    toastr.success('Content Unapproved!');
                }else{
                    toastr.success('Content Deleted!');
                }
            }
            else{
                if($("#txtChangeCustClaimContentStatCustClaimContentStat").val() == 1){
                    toastr.error('Content Approval Failed!');
                }else if($("#txtChangeCustClaimContentStatCustClaimContentStat").val() == 2){
                    toastr.error('Content Unapproval Failed!');
                }else {
                    toastr.error('Content Deletion Failed!');
                }
            }

            $("#iBtnChangeCustClaimContentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeCustClaimContentStat").removeAttr('disabled');
            $("#iBtnChangeCustClaimContentStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangeCustClaimContentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeCustClaimContentStat").removeAttr('disabled');
            $("#iBtnChangeCustClaimContentStatIcon").addClass('fa fa-check');
        }
    });
}

function GetBatchNumberCC(cboElement, status){
    let result = '<option value="0" selected disabled> -- Select Batch -- </option>';
    $.ajax({
        url: 'get_customerclaim_by_stat',
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

function ApprovePerBatchFormCC(){
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
              url: "change_customerclaim_stat_by_batch",
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

                      dataTableCustClaim.draw();

                      toastr.success('Content Approval Success!');

                  }else{

                      toastr.warning('Content Approval Failed!');
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
