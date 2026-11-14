function SetIntervalMBP(){
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
        url: "setinterval_monthlybestperformers",
        method: "post",
        data: $('#formSetIntervalmthlybestperfs').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#ibtnsetinterval").addClass('fa fa-spinner fa-pulse');
            $("#btnsetinterval").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#modalsetintervalmthlybestperfs").modal('hide');
              $("#formSetIntervalmthlybestperfs")[0].reset();
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

function ChangeMthlyBestPerfContentStatus(){
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
        url: "change_monthlybestperformers_stat",
        method: "post",
        data: $('#formChangeMthlyBestPerfContentStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangeMthlyBestPerfContentStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnChangeMthlyBestPerfContentStat").prop('disabled', 'disabled');
        },
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
                $("#modalChangeMthlyBestPerfsContentStat").modal('hide');
                $("#formChangeMthlyBestPerfContentStat")[0].reset();

                dataTableMthlyBestPerformers.draw();

                if($("#txtChangeMthlyBestPerfContentStatMthlyBestPerfContentStat").val() == 1){
                    toastr.success('Content Approval Success!');
                }else if($("#txtChangeMthlyBestPerfContentStatMthlyBestPerfContentStat").val() == 2){
                    toastr.success('Content Disapproved!');
                }else{
                    toastr.success('Content Deleted!');
                }
            }
            else{
                if($("#txtChangeMthlyBestPerfContentStatMthlyBestPerfContentStat").val() == 1){
                    toastr.error('Content Approval Failed!');
                }else if($("#txtChangeMthlyBestPerfContentStatMthlyBestPerfContentStat").val() == 2){
                    toastr.error('Content Disapproval Failed!');
                }else {
                    toastr.error('Content Deletion Failed!');
                }
            }

            $("#iBtnChangeMthlyBestPerfContentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeMthlyBestPerfContentStat").removeAttr('disabled');
            $("#iBtnChangeMthlyBestPerfContentStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangeMthlyBestPerfContentStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeMthlyBestPerfContentStat").removeAttr('disabled');
            $("#iBtnChangeMthlyBestPerfContentStatIcon").addClass('fa fa-check');
        }
    });
}

function GetBatchNumberMBP(cboElement, status){
    let result = '<option value="0" selected disabled> -- Select Batch -- </option>';
    $.ajax({
        url: 'get_monthlybestperformers_by_stat',
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

function ApprovePerBatchFormMBP(){
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
              url: "change_monthlybestperformers_stat_by_batch",
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

                      dataTableMthlyBestPerformers.draw();
                  
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