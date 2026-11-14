function SetIntervalPLEM(){
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
        url: "setinterval_prodlineeffmonitoring",
        method: "post",
        data: $('#formSetIntervalprodlineeffmon').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#ibtnsetinterval").addClass('fa fa-spinner fa-pulse');
            $("#btnsetinterval").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#modalsetintervalprodlineeffmon").modal('hide');
              $("#formSetIntervalprodlineeffmon")[0].reset();
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

function ChangeProdLineEffMonContentStatus(){
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
        url: "change_prodlineeffmonitoring_stat",
        method: "post",
        data: $('#formChangeProdLineEffMonContentStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangeProdLineEffMonContentStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnChangeProdLineEffMonContentStat").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
                $("#modalChangeProdLineEffMonContentStat").modal('hide');
                $("#formChangeProdLineEffMonContentStat")[0].reset();

                dataTableProdLineEffMon.draw();

                if($("#txtChangeProdLineEffMonContentStatProdLineEffMonContentStat").val() == 1){
                    toastr.success('Content Approval Success!');
                }else if($("#txtChangeProdLineEffMonContentStatProdLineEffMonContentStat").val() == 2){
                    toastr.success('Content Disapproved!');
                }else{
                    toastr.success('Content Deleted!');
                }
            }
            else{
                if($("#txtChangeProdLineEffMonContentStatProdLineEffMonContentStat").val() == 1){
                    toastr.error('Content Approval Failed!');
                }else if($("#txtChangeProdLineEffMonContentStatProdLineEffMonContentStat").val() == 2){
                    toastr.error('Content Disapproval Failed!');
                }else {
                    toastr.error('Content Deletion Failed!');
                }
            }

            $("#iBtnChangeProdLineEffMonContentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeProdLineEffMonContentStat").removeAttr('disabled');
            $("#iBtnChangeProdLineEffMonContentStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangeProdLineEffMonContentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeProdLineEffMonContentStat").removeAttr('disabled');
            $("#iBtnChangeProdLineEffMonContentStatIcon").addClass('fa fa-check');
        }
    });
}

function GetBatchNumberPLEM(cboElement, status){
    let result = '<option value="0" selected disabled> -- Select Batch -- </option>';
    $.ajax({
        url: 'get_prodlineeffmonitoring_by_stat',
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

function ApprovePerBatchFormPLEM(){
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
              url: "change_prodlineeffmonitoring_stat_by_batch",
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

                      dataTableProdLineEffMon.draw();

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