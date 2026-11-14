// Edit engineering Content
function DisplayEnggContent(){
  // console.log(selectedUsers);
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
        url: "display_engg_content",
        method: "get",
        data: {
        },
        dataType: "json",
        beforeSend: function(){

        },
        success: function(JsonObject){
            let content = "";

            let nonconfprodinterval = 5000;

            if(JsonObject['nonconfprodinterval'].length > 0)
            {
               nonconfprodinterval = JsonObject['nonconfprodinterval'][0].data_interval * 1000;
            }

            let counter = JsonObject['dispcontentnonconfprod'].length;

            for(let index = 0; index < counter; index += 15) {

              if(JsonObject['dispcontentnonconfprod'].length > 0){

                content += '<div class="carousel-item" data-interval="'+ nonconfprodinterval +'">';
                  content += '<img style="background-position: center; background-repeat: no-repeat; background-size: cover" src="public/images/plain_white_bg.jpg" alt="First slide">';
                  content += '<div class="carousel-caption" style="top: 0%; transform: translateY(-1%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%">';
                  content += '<div style="background-color: #055C9D; width: 100%;">';
                  content += '<p style="font-size: 40px; font-family: Roboto; text-align: left; font-weight: bold;">&nbsp;<img src="public/images/Box.png" width="30" height="30" alt="Warning!" style="margin-bottom: 10px">&nbsp;&nbsp;Engineering Status Board</p>';
                  content += '</div>';
                  content += '<div style="background-color: #68BBE3; width: 100%; height: 15px; margin-top: 15px;"></div>';
                  content += '<p style="text-align: left; font-family: Roboto; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>Non-Conforming Products Monitoring Board</u></p>';
                    content += '<table class="left" id="NonConfProds" style="width: 100%; ">';
                      content += '<thead>';
                        content += '<tr>';
                          content += '<th scope="col" style="border: 2px solid black; color: black; font-size: 34px; background-color: #B1D4E0;">Date</th>';
                          content += '<th scope="col" style="border: 2px solid black; color: black; font-size: 34px; background-color: #B1D4E0;">Product Name</th>';
                          content += '<th scope="col" style="border: 2px solid black; color: black; font-size: 34px; background-color: #B1D4E0;">PO Number</th>';
                          content += '<th scope="col" style="border: 2px solid black; color: black; font-size: 34px; background-color: #B1D4E0;">Problem</th>';
                          content += '<th scope="col" style="border: 2px solid black; color: black; font-size: 34px; background-color: #B1D4E0;">PTIS / NG Report Number</th>';
                          content += '<th scope="col" style="border: 2px solid black; color: black; font-size: 34px; background-color: #B1D4E0;">Status / Disposition</th>';
                        content += '</tr>';
                      content += '</thead>';
                      content += '<tbody>';
                      content += '<tr>';

                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index].status_disposition;
                          content += '</td>';
                        content += '</tr>';

                        if (index >= counter - 1) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 1].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 1].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 1].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 1].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 1].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 1].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 2) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 2].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 2].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 2].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 2].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 2].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 2].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }

                        if (index >= counter - 3) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 3].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 3].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 3].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 3].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 3].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 3].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 4) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 4].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 4].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 4].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 4].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 4].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 4].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 5) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 5].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 5].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 5].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 5].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 5].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 5].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 6) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 6].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 6].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 6].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 6].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 6].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 6].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 7) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 7].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 7].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 7].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 7].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 7].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 7].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 8) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 8].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 8].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 8].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 8].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 8].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 8].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 9) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 9].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 9].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 9].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 9].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 9].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 9].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 10) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 10].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 10].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 10].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 10].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 10].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 10].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 11) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 11].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 11].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 11].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 11].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 11].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 11].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 12) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 12].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 12].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 12].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 12].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 12].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 12].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 13) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 13].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 13].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 13].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 13].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 13].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 13].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                        if (index >= counter - 14) {
                          if (counter % 15 != 0) {
                            content += '<tr>';

                            content += '</tr>';
                          }
                        }else{
                        content += '<tr>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += moment(JsonObject['dispcontentnonconfprod'][index + 14].content_date).format('LL');
                          content += '</td>';
                          content += '<td style=" border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 14].product_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 14].po_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 14].problem;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 14].ptis_ng_report_number;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; color: black; font-size: 34px;">';
                            content += JsonObject['dispcontentnonconfprod'][index + 14].status_disposition;
                          content += '</td>';
                        content += '</tr>';
                        }
                      content += '</tbody>';
                    content += '</table>';
                  content += '</div>';
                content += '</div>';

              }
              else{
                  // toastr.error('Failed!');
              }

            }
            $('.carousel-item').first().addClass('active');
            $(content).appendTo('.carousel-inner');

        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

        }
    });
}

function DisplayQCContentLotOutDefects(){
  // console.log(selectedUsers);
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
        url: "display_qc_content_lotoutdefects",
        method: "get",
        data: {
        },
        dataType: "json",
        async: false,
        beforeSend: function(){

        },
        success: function(JsonObject){

            let content = "";
            let counter = JsonObject['dispcontentlotoutdefs'].length;
            let countercc = JsonObject['dispcontentcustclaim'].length;
            let lotoutdefsinterval = 5000;

            if(JsonObject['lotoutdefsinterval'].length > 0)
            {
               lotoutdefsinterval = JsonObject['lotoutdefsinterval'][0].data_interval * 1000;
            }

            if (counter >= countercc) {
             for (let index = 0; index < counter; index += 2) {
                if(JsonObject['dispcontentlotoutdefs'].length > 0){

                    content += '<div class="carousel-item" data-interval="'+ lotoutdefsinterval +'">';
                      content += '<img class="d-md-block w-100" src="public/images/plain_white_bg.jpg" alt="Second slide">';
                      content += '<div class="carousel-caption" style="top: 0%; transform: translateY(-1%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%">';
                      content += '<div style="background-color: #59981A; width: 100%;">';
                        content += '<p style="font-size: 40px; font-family: Roboto; text-align: left; font-weight: bold; ">&nbsp;<img src="public/images/Box.png" width="30" height="30" alt="Warning!" style="margin-bottom: 10px">&nbsp;&nbsp;QC Status Board</p>';
                      content += '</div>';
                      content += '<div style="background-color: #59981A; width: 100%; height: 15px; margin-top: 15px;"></div>';
                        content += '<p style="text-align: left; font-family: Roboto; font-size: 36px; font-weight: bold; color: #002242; margin-top: 5px;"><u>Lot Out Defects</u></p>';
                        content += '<div class="row" id="DivLotOutDefects">';

                        content += '<div class="col-sm-6">';
                          content += '<div class="row justify-content-md-center">';
                          content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index].device_name + '</div>';
                             content += '</div>';
                             content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index].mode_of_defect + '</div>';
                             content += '</div>';
                             content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Contributing Line &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index].contributing_line + '</div>';
                             content += '</div>';
                             content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index].date_detected + '</div>';
                             content += '</div>';
                             content += '<br>';
                             content += '<div class="row">';
                                content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                 content += '<img style= "border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/storage/app/public/images/lotout_defects/' + JsonObject['dispcontentlotoutdefs'][index].imagefilename +'">';
                               content += '</div>';
                             content += '</div>';
                             content += '<br>';
                           content += '</div>';
                           content += '</div>';
                         content += '</div>';

                          if (index >= counter - 1) {
                              if (counter % 2 != 0) {
                                content += '<div class="col-sm-6">';
                                  content += '<div class="row justify-content-md-center">';
                                  content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                                    content += '<div class="row">';
                                      content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                      content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                     content += '</div>';
                                     content += '<div class="row">';
                                      content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                      content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                     content += '</div>';
                                     content += '<div class="row">';
                                      content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Contributing Line &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                      content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                     content += '</div>';
                                     content += '<div class="row">';
                                      content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                      content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                     content += '</div>';
                                     content += '<br>';
                                     content += '<div class="row">';
                                        content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                        content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                         content += '<img style= "border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/public/images/Defect.png">';
                                       content += '</div>';
                                     content += '</div>';
                                     content += '<br>';
                                   content += '</div>';
                                   content += '</div>';
                                 content += '</div>';
                              }

                          }else{
                          content += '<div class="col-sm-6">';
                            content += '<div class="row justify-content-md-center">';
                            content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index + 1].device_name + '</div>';
                               content += '</div>';
                               content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index + 1].mode_of_defect + '</div>';
                               content += '</div>';
                               content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Contributing Line &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index + 1].contributing_line + '</div>';
                               content += '</div>';
                               content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index + 1].date_detected + '</div>';
                               content += '</div>';
                               content += '<br>';
                               content += '<div class="row">';
                                  content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                  content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                   content += '<img style= "border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/storage/app/public/images/lotout_defects/' + JsonObject['dispcontentlotoutdefs'][index + 1].imagefilename +'">';
                                 content += '</div>';
                               content += '</div>';
                               content += '<br>';
                             content += '</div>';
                             content += '</div>';
                           content += '</div>';
                          }

                        content += '</div>';
                        content += '<p style="text-align: left; font-family: Roboto; font-size: 36px; font-weight: bold; color: #002242; margin-top: 5px;"><u>Customer Claim</u></p>';
                        content += '<div class="row" id="DivCustomerClaim">';
                          if (index < countercc) {
                          content += '<div class="col-sm-6">';
                            content += '<div class="row justify-content-md-center">';
                            content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                            content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index].device_name + '</div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index].mode_of_defect + '</div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index].customer + '</div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index].date_detected + '</div>';
                            content += '</div>';
                            content += '<br>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                              content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                              content += '<img style="border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/storage/app/public/images/customer_claim/' + JsonObject['dispcontentcustclaim'][index].imagefilename +'">';
                             content += '</div>';
                           content += '</div>';
                           content += '<br>';
                         content += '</div>';
                         content += '</div>';
                         content += '</div>';

                          if (index >= countercc - 1) {

                              if (countercc % 2 != 0) {
                                content += '<div class="col-sm-6">';
                                  content += '<div class="row justify-content-md-center">';
                                  content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                                  content += '<div class="row">';
                                      content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                  content += '</div>';
                                  content += '<div class="row">';
                                    content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                  content += '</div>';
                                  content += '<div class="row">';
                                    content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                  content += '</div>';
                                  content += '<div class="row">';
                                    content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                  content += '</div>';
                                  content += '<br>';
                                  content += '<div class="row">';
                                    content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                    content += '<img style="border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/public/images/Defect.png">';
                                   content += '</div>';
                                 content += '</div>';
                                 content += '<br>';
                               content += '</div>';
                               content += '</div>';
                               content += '</div>';
                            }

                          }else{

                          content += '<div class="col-sm-6">';
                            content += '<div class="row justify-content-md-center">';
                            content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                            content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index + 1].device_name + '</div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index + 1].mode_of_defect + '</div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index + 1].customer + '</div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index + 1].date_detected + '</div>';
                            content += '</div>';
                            content += '<br>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                              content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                              content += '<img style="border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/storage/app/public/images/customer_claim/' + JsonObject['dispcontentcustclaim'][index + 1].imagefilename +'">';
                             content += '</div>';
                           content += '</div>';
                           content += '<br>';
                         content += '</div>';
                         content += '</div>';
                         content += '</div>';

                          }
                        }else{
                          content += '<div class="col-sm-6">';
                            content += '<div class="row justify-content-md-center">';
                            content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                            content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                            content += '</div>';
                            content += '<br>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                              content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                              content += '<img style="border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/public/images/Defect.png">';
                             content += '</div>';
                           content += '</div>';
                           content += '<br>';
                         content += '</div>';
                         content += '</div>';
                         content += '</div>';

                          content += '<div class="col-sm-6">';
                            content += '<div class="row justify-content-md-center">';
                            content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                            content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                            content += '</div>';
                            content += '<br>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                              content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                              content += '<img style="border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/public/images/Defect.png">';
                             content += '</div>';
                           content += '</div>';
                           content += '<br>';
                         content += '</div>';
                         content += '</div>';
                         content += '</div>';
                        }
                        content += '</div>';
                      content += '</div>';
                    content += '</div>';
                }
                else{

                }

              }
            }else{
              for (let index = 0; index < countercc; index += 2) {
                if(JsonObject['dispcontentcustclaim'].length > 0){

                    content += '<div class="carousel-item" data-interval="'+ lotoutdefsinterval +'">';
                      content += '<img class="d-block w-55" src="public/images/plain_white_bg.jpg" alt="Second slide">';
                      content += '<div class="carousel-caption" style="top: 0%; transform: translateY(-1%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%">';
                      content += '<div style="background-color: #59981A; width: 100%;">';
                        content += '<p style="font-size: 40px; font-family: Roboto; text-align: left; font-weight: bold; ">&nbsp;<img src="public/images/Box.png" width="30" height="30" alt="Warning!" style="margin-bottom: 10px">&nbsp;&nbsp;QC Status Board</p>';
                      content += '</div>';
                      content += '<div style="background-color: #59981A; width: 100%; height: 15px; margin-top: 15px;"></div>';
                        content += '<p style="text-align: left; font-family: Roboto; font-size: 36px; font-weight: bold; color: #002242; margin-top: 5px;"><u>Lot Out Defects</u></p>';
                        content += '<div class="row" id="DivLotOutDefects">';
                          if (index < counter) {
                            content += '<div class="col-sm-6">';
                              content += '<div class="row justify-content-md-center">';
                              content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                                content += '<div class="row">';
                                  content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                  content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index].device_name + '</div>';
                                 content += '</div>';
                                 content += '<div class="row">';
                                  content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                  content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index].mode_of_defect + '</div>';
                                 content += '</div>';
                                 content += '<div class="row">';
                                  content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Contributing Line &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                  content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index].contributing_line + '</div>';
                                 content += '</div>';
                                 content += '<div class="row">';
                                  content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                  content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index].date_detected + '</div>';
                                 content += '</div>';
                                 content += '<br>';
                                 content += '<div class="row">';
                                    content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                     content += '<img style= "border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/storage/app/public/images/lotout_defects/' + JsonObject['dispcontentlotoutdefs'][index].imagefilename +'">';
                                   content += '</div>';
                                 content += '</div>';
                                 content += '<br>';
                               content += '</div>';
                               content += '</div>';
                             content += '</div>';

                            if (index >= counter - 1) {

                              if (counter % 2 != 0) {

                                content += '<div class="col-sm-6">';
                                  content += '<div class="row justify-content-md-center">';
                                  content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                                    content += '<div class="row">';
                                      content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                      content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                     content += '</div>';
                                     content += '<div class="row">';
                                      content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                      content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                     content += '</div>';
                                     content += '<div class="row">';
                                      content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Contributing Line &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                      content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                     content += '</div>';
                                     content += '<div class="row">';
                                      content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                      content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                     content += '</div>';
                                     content += '<br>';
                                     content += '<div class="row">';
                                        content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                        content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                         content += '<img style= "border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/public/images/Defect.png">';
                                       content += '</div>';
                                     content += '</div>';
                                     content += '<br>';
                                   content += '</div>';
                                   content += '</div>';
                                 content += '</div>';
                              }

                            }else{
                            content += '<div class="col-sm-6">';
                              content += '<div class="row justify-content-md-center">';
                              content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                                content += '<div class="row">';
                                  content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                  content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index + 1].device_name + '</div>';
                                 content += '</div>';
                                 content += '<div class="row">';
                                  content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                  content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index + 1].mode_of_defect + '</div>';
                                 content += '</div>';
                                 content += '<div class="row">';
                                  content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Contributing Line &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                  content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index + 1].contributing_line + '</div>';
                                 content += '</div>';
                                 content += '<div class="row">';
                                  content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                  content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentlotoutdefs'][index + 1].date_detected + '</div>';
                                 content += '</div>';
                                 content += '<br>';
                                 content += '<div class="row">';
                                    content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                     content += '<img style= "border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/storage/app/public/images/lotout_defects/' + JsonObject['dispcontentlotoutdefs'][index + 1].imagefilename +'">';
                                   content += '</div>';
                                 content += '</div>';
                                 content += '<br>';
                               content += '</div>';
                               content += '</div>';
                             content += '</div>';
                          }
                        }else{
                          content += '<div class="col-sm-6">';
                            content += '<div class="row justify-content-md-center">';
                            content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                               content += '</div>';
                               content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                               content += '</div>';
                               content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Contributing Line &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                               content += '</div>';
                               content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                               content += '</div>';
                               content += '<br>';
                               content += '<div class="row">';
                                  content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                  content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                   content += '<img style= "border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/public/images/Defect.png">';
                                 content += '</div>';
                               content += '</div>';
                               content += '<br>';
                             content += '</div>';
                             content += '</div>';
                           content += '</div>';

                          content += '<div class="col-sm-6">';
                            content += '<div class="row justify-content-md-center">';
                            content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                               content += '</div>';
                               content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                               content += '</div>';
                               content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Contributing Line &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                               content += '</div>';
                               content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                               content += '</div>';
                               content += '<br>';
                               content += '<div class="row">';
                                  content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                  content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                   content += '<img style= "border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/public/images/Defect.png">';
                                 content += '</div>';
                               content += '</div>';
                               content += '<br>';
                             content += '</div>';
                             content += '</div>';
                           content += '</div>';
                        }
                        content += '</div>';
                        content += '<p style="text-align: left; font-family: Roboto; font-size: 36px; font-weight: bold; color: #002242; margin-top: 5px;"><u>Customer Claim</u></p>';
                        content += '<div class="row" id="DivCustomerClaim">';

                          content += '<div class="col-sm-6">';
                            content += '<div class="row justify-content-md-center">';
                            content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                            content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index].device_name + '</div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index].mode_of_defect + '</div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index].customer + '</div>';
                            content += '</div>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                              content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index].date_detected + '</div>';
                            content += '</div>';
                            content += '<br>';
                            content += '<div class="row">';
                              content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                              content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                              content += '<img style="border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/storage/app/public/images/customer_claim/' + JsonObject['dispcontentcustclaim'][index].imagefilename +'">';
                             content += '</div>';
                           content += '</div>';
                           content += '<br>';
                         content += '</div>';
                         content += '</div>';
                         content += '</div>';

                          if (index >= countercc - 1) {
                              if (countercc % 2 != 0) {

                                content += '<div class="col-sm-6">';
                                  content += '<div class="row justify-content-md-center">';
                                  content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                                  content += '<div class="row">';
                                      content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                  content += '</div>';
                                  content += '<div class="row">';
                                    content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                  content += '</div>';
                                  content += '<div class="row">';
                                    content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                  content += '</div>';
                                  content += '<div class="row">';
                                    content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                                  content += '</div>';
                                  content += '<br>';
                                  content += '<div class="row">';
                                    content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                    content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                    content += '<img style="border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/public/images/Defect.png">';
                                   content += '</div>';
                                 content += '</div>';
                                 content += '<br>';
                               content += '</div>';
                               content += '</div>';
                               content += '</div>';
                              }

                          }else{
                            content += '<div class="col-sm-6">';
                              content += '<div class="row justify-content-md-center">';
                              content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                              content += '<div class="row">';
                                  content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index + 1].device_name + '</div>';
                              content += '</div>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index + 1].mode_of_defect + '</div>';
                              content += '</div>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index + 1].customer + '</div>';
                              content += '</div>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;">' + JsonObject['dispcontentcustclaim'][index + 1].date_detected + '</div>';
                              content += '</div>';
                              content += '<br>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                content += '<img style="border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/storage/app/public/images/customer_claim/' + JsonObject['dispcontentcustclaim'][index + 1].imagefilename +'">';
                               content += '</div>';
                             content += '</div>';
                             content += '<br>';
                           content += '</div>';
                           content += '</div>';
                           content += '</div>';
                          }

                            content += '<div class="col-sm-6">';
                              content += '<div class="row justify-content-md-center">';
                              content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                              content += '<div class="row">';
                                  content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                              content += '</div>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                              content += '</div>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                              content += '</div>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                              content += '</div>';
                              content += '<br>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                content += '<img style="border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/public/images/Defect.png">';
                               content += '</div>';
                             content += '</div>';
                             content += '<br>';
                           content += '</div>';
                           content += '</div>';
                           content += '</div>';

                            content += '<div class="col-sm-6">';
                              content += '<div class="row justify-content-md-center">';
                              content += '<div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">';
                              content += '<div class="row">';
                                  content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                              content += '</div>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                              content += '</div>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                              content += '</div>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>';
                                content += '<div class="col-sm-5" style="text-align: center; border-bottom: 2px solid black; font-size: 26px; color: black;"></div>';
                              content += '</div>';
                              content += '<br>';
                              content += '<div class="row">';
                                content += '<div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>';
                                content += '<div class="col-sm-5" style="text-align: center; margin-left: 70px">';
                                content += '<img style="border: 2px solid black; border-color: #050A30; width: 225px; max-height: 200px; min-height: 80px" src="http://192.168.3.188/StatusBoard/public/images/Defect.png">';
                               content += '</div>';
                             content += '</div>';
                             content += '<br>';
                           content += '</div>';
                           content += '</div>';
                           content += '</div>';

                        content += '</div>';
                      content += '</div>';
                    content += '</div>';
                }
                else{

                }

              }
            }

            $(content).appendTo('.carousel-inner');

        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

        }
    });
}

// function DisplayQCContentCustomerClaim(){
//   // console.log(selectedUsers);
//     toastr.options = {
//       "closeButton": false,
//       "debug": false,
//       "newestOnTop": true,
//       "progressBar": true,
//       "positionClass": "toast-top-right",
//       "preventDuplicates": false,
//       "onclick": null,
//       "showDuration": "300",
//       "hideDuration": "3000",
//       "timeOut": "3000",
//       "extendedTimeOut": "3000",
//       "showEasing": "swing",
//       "hideEasing": "linear",
//       "showMethod": "fadeIn",
//       "hideMethod": "fadeOut",
//     };

//     $.ajax({
//         url: "display_qc_content_customerclaim",
//         method: "get",
//         data: {
//         },
//         dataType: "json",
//         async: false,
//         beforeSend: function(){

//         },
//         success: function(JsonObject){
//             let content = "";
//             if(JsonObject['dispcontentcustclaim'].length > 0){
//                 for(let index = 0; index < JsonObject['dispcontentcustclaim'].length; index++) {

//                   content += '<div class="col-sm-6" style="text-align: left;">';
//                      content += '<div class="row">';
//                        content += '<div class="col-sm-4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">Device Name</div>';
//                        content += '<div class="col-sm-8" style="text-align: center; border-bottom: 2px solid black; font-size: 20px; color: black;">' + JsonObject['dispcontentcustclaim'][index].device_name + '</div>';
//                      content += '</div>';
//                      content += '<div class="row">';
//                        content += '<div class="col-sm-4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">Mode of Defect</div>';
//                        content += '<div class="col-sm-8" style="text-align: center; border-bottom: 2px solid black; font-size: 20px; color: black;">' + JsonObject['dispcontentcustclaim'][index].mode_of_defect + '</div>';
//                      content += '</div>';
//                      content += '<div class="row">';
//                        content += '<div class="col-sm-4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">Customer</div>';
//                        content += '<div class="col-sm-8" style="text-align: center; border-bottom: 2px solid black; font-size: 20px; color: black;">' + JsonObject['dispcontentcustclaim'][index].customer + '</div>';
//                      content += '</div>';
//                      content += '<div class="row">';
//                        content += '<div class="col-sm-4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">Date Detected</div>';
//                        content += '<div class="col-sm-8" style="text-align: center; border-bottom: 2px solid black; font-size: 20px; color: black;">' + JsonObject['dispcontentcustclaim'][index].date_detected + '</div>';
//                      content += '</div>';
//                      content += '<br>';
//                      content += '<div class="row">';
//                        content += '<div class="col-sm-12" style="text-align: center;">'
//                          content += '<img style="width: 300px; max-height: 300px; min-height: 80px" src="http://192.168.3.188/StatusBoard/storage/app/public/images/customer_claim/' + JsonObject['dispcontentcustclaim'][index].imagefilename +'">'
//                        content += '</div>';
//                      content += '</div>';
//                    content += '</div>';
//                 }
//             }
//             else{
//                 // toastr.error('Failed!');
//             }


//         },
//         error: function(data, xhr, status){
//             toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

//         }
//     });
// }

function DisplayQCContentListOfDocumentsWI(){
  // console.log(selectedUsers);
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
        url: "display_qc_content_listofdocuments",
        method: "get",
        data: {
        },
        dataType: "json",
        async: false,
        beforeSend: function(){

        },
        success: function(JsonObject){
            let content = "";
            let contentWI = "";
            let contentPP = "";
            let contentPQS = "";
            let listofdocsinterval = 5000;

            let counter = JsonObject['dispcontentlistofdocswi'].length;

            if(JsonObject['listofdocsinterval'].length > 0)
            {
               listofdocsinterval = JsonObject['listofdocsinterval'][0].data_interval * 1000;
            }

            for(let index = 0; index < counter; index += 12) {
              if(JsonObject['dispcontentlistofdocswi'].length > 0){

            content += '<div class="carousel-item" data-interval="' + listofdocsinterval +'">';
              content += '<img class="d-block w-55" src="public/images/plain_white_bg.jpg" alt="Third slide">';
                content += '<div class="carousel-caption" style="top: 0%; transform: translateY(-1%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%">';
                content += '<div style="background-color: #59981A; width: 100%;">';
                  content += '<p style="font-size: 40px; font-family: Roboto; text-align: left; font-weight: bold; ">&nbsp;<img src="public/images/Box.png" width="30" height="30" alt="Warning!" style="margin-bottom: 10px">&nbsp;&nbsp;QC Status Board</p>';
                content += '</div>';
                content += '<div style="background-color: #59981A; width: 100%; height: 15px; margin-top: 15px;"></div>';
                  content += '<p style="text-align: left; font-family: Roboto; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>List of New and Revised Documents</u></p>';
                  content += '<p style="text-align: left; font-family: Roboto; font-size: 36px; font-weight: bold; color: #BA0F30; margin-top: 20px;">Work Instruction</p>';
                 content += '<table class="left" style="width:100%;" id="ListofDocsWI">';
                   content += '<thead>';
                     content += '<tr>';
                      content += '<th scope="col" style="border: 1px solid black; color: black; font-size: 42px; background-color: #B2D2A4">Document Number</th>';
                      content += '<th scope="col" style="border: 1px solid black; color: black; font-size: 42px; background-color: #B2D2A4">Document Title</th>';
                      content += '<th scope="col" style="border: 1px solid black; color: black; font-size: 42px; background-color: #B2D2A4">Revision Details</th>';
                    content += '</tr>';
                  content += '</thead>';
                  content += '<tbody>';

                    content += '<tr>';
                      content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index].document_no + '</td>';
                      content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index].revision_details + '</td>';
                      }
                    content += '</tr>';

                      if (index >= counter - 1) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 1].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 1].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index + 1].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 1].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 2) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 2].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 2].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index + 2].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 2].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }


                      if (index >= counter - 4) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 3].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 3].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index+ 3].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index+ 3].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 4) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 4].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 4].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index + 4].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 4].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 5) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 5].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 5].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index + 5].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 5].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 6) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 6].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 6].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index + 6].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 6].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 7) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 7].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 7].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index + 7].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 7].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 8) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 8].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 8].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index + 8].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 8].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                      if (index >= counter - 9) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 9].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 9].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index + 9].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 9].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                      if (index >= counter - 10) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 10].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 10].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index + 10].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 10].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                      if (index >= counter - 11) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 11].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 11].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocswi'][index + 11].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocswi'][index + 11].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                  content += '</tbody>';
                  content += '</table>';

                  content += '</tbody>';
                content += '</table>';
              content += '</div>';
            content += '</div>';
              }

              else{
                  // toastr.error('Failed!');
              }
            }
            $(content).appendTo('.carousel-inner');


        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

        }
    });
}


function DisplayQCContentListOfDocumentsPP(){
  // console.log(selectedUsers);
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
        url: "display_qc_content_listofdocuments",
        method: "get",
        data: {
        },
        dataType: "json",
        async: false,
        beforeSend: function(){

        },
        success: function(JsonObject){
            let content = "";
            let contentWI = "";
            let contentPP = "";
            let contentPQS = "";
            let listofdocsinterval = 5000;

            let counter = JsonObject['dispcontentlistofdocspp'].length;

            if(JsonObject['listofdocsinterval'].length > 0)
            {
               listofdocsinterval = JsonObject['listofdocsinterval'][0].data_interval * 1000;
            }

            for(let index = 0; index < counter; index += 12) {
              if(JsonObject['dispcontentlistofdocspp'].length > 0){

            content += '<div class="carousel-item" data-interval="' + listofdocsinterval +'">';
              content += '<img class="d-block w-55" src="public/images/plain_white_bg.jpg" alt="Third slide">';
                content += '<div class="carousel-caption" style="top: 0%; transform: translateY(-1%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%">';
                content += '<div style="background-color: #59981A; width: 100%;">';
                  content += '<p style="font-size: 40px; font-family: Roboto; text-align: left; font-weight: bold; ">&nbsp;<img src="public/images/Box.png" width="30" height="30" alt="Warning!" style="margin-bottom: 10px">&nbsp;&nbsp;QC Status Board</p>';
                content += '</div>';
                content += '<div style="background-color: #59981A; width: 100%; height: 15px; margin-top: 15px;"></div>';
                  content += '<p style="text-align: left; font-family: Roboto; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>List of New and Revised Documents</u></p>';
                  content += '<p style="text-align: left; font-family: Roboto; font-size: 36px; font-weight: bold; color: #BA0F30; margin-top: 20px;">Point Panel</p>';
                 content += '<table class="left" style="width:100%;" id="ListofDocsWI">';
                   content += '<thead>';
                     content += '<tr>';
                      content += '<th scope="col" style="border: 1px solid black; color: black; font-size: 42px; background-color: #B2D2A4">Document Number</th>';
                      content += '<th scope="col" style="border: 1px solid black; color: black; font-size: 42px; background-color: #B2D2A4">Document Title</th>';
                      content += '<th scope="col" style="border: 1px solid black; color: black; font-size: 42px; background-color: #B2D2A4">Revision Details</th>';
                    content += '</tr>';
                  content += '</thead>';
                  content += '<tbody>';

                    content += '<tr>';
                      content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index].document_no + '</td>';
                      content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index].revision_details + '</td>';
                      }
                    content += '</tr>';

                      if (index >= counter - 1) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 1].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 1].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index + 1].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 1].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 2) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 2].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 2].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index + 2].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 2].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }


                      if (index >= counter - 4) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 3].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 3].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index + 3].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 3].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 4) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 4].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 4].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index + 4].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 4].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 5) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 5].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 5].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index + 5].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 5].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 6) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 6].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 6].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index + 6].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 6].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 7) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 7].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 7].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index + 7].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 7].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 8) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 8].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 8].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index + 8].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 8].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                      if (index >= counter - 9) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 9].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 9].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index + 9].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 9].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                      if (index >= counter - 10) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 10].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 10].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index + 10].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 10].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                      if (index >= counter - 11) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 11].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 11].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspp'][index + 11].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspp'][index + 11].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                  content += '</tbody>';
                  content += '</table>';

                  content += '</tbody>';
                content += '</table>';
              content += '</div>';
            content += '</div>';
              }

              else{
                  // toastr.error('Failed!');
              }
            }
            $(content).appendTo('.carousel-inner');


        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

        }
    });
}


function DisplayQCContentListOfDocumentsPQS(){
  // console.log(selectedUsers);
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
        url: "display_qc_content_listofdocuments",
        method: "get",
        data: {
        },
        dataType: "json",
        async: false,
        beforeSend: function(){

        },
        success: function(JsonObject){
            let content = "";
            let contentWI = "";
            let contentPP = "";
            let contentPQS = "";
            let listofdocsinterval = 5000;

            let counter = JsonObject['dispcontentlistofdocspqs'].length;

            if(JsonObject['listofdocsinterval'].length > 0)
            {
               listofdocsinterval = JsonObject['listofdocsinterval'][0].data_interval * 1000;
            }

            for(let index = 0; index < counter; index += 12) {
              if(JsonObject['dispcontentlistofdocspqs'].length > 0){

            content += '<div class="carousel-item" data-interval="' + listofdocsinterval +'">';
              content += '<img class="d-block w-55" src="public/images/plain_white_bg.jpg" alt="Third slide">';
                content += '<div class="carousel-caption" style="top: 0%; transform: translateY(-1%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%">';
                content += '<div style="background-color: #59981A; width: 100%;">';
                  content += '<p style="font-size: 40px; font-family: Roboto; text-align: left; font-weight: bold; ">&nbsp;<img src="public/images/Box.png" width="30" height="30" alt="Warning!" style="margin-bottom: 10px">&nbsp;&nbsp;QC Status Board</p>';
                content += '</div>';
                content += '<div style="background-color: #59981A; width: 100%; height: 15px; margin-top: 15px;"></div>';
                  content += '<p style="text-align: left; font-family: Roboto; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>List of New and Revised Documents</u></p>';
                  content += '<p style="text-align: left; font-family: Roboto; font-size: 36px; font-weight: bold; color: #BA0F30; margin-top: 20px;">PQS Documents</p>';
                 content += '<table class="left" style="width:100%;" id="ListofDocsWI">';
                   content += '<thead>';
                     content += '<tr>';
                      content += '<th scope="col" style="border: 1px solid black; color: black; font-size: 42px; background-color: #B2D2A4">Document Number</th>';
                      content += '<th scope="col" style="border: 1px solid black; color: black; font-size: 42px; background-color: #B2D2A4">Document Title</th>';
                      content += '<th scope="col" style="border: 1px solid black; color: black; font-size: 42px; background-color: #B2D2A4">Revision Details</th>';
                    content += '</tr>';
                  content += '</thead>';
                  content += '<tbody>';

                    content += '<tr>';
                      content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index].document_no + '</td>';
                      content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index].revision_details + '</td>';
                      }
                    content += '</tr>';

                      if (index >= counter - 1) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 1].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 1].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index + 1].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 1].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 2) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 2].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 2].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index + 2].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 2].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }


                      if (index >= counter - 4) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 3].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 3].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index + 3].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 3].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 4) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 4].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 4].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index + 4].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 4].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 5) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 5].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 5].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index + 5].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 5].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 6) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 6].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 6].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index + 6].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 6].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 7) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 7].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 7].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index + 7].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 7].revision_details + '</td>';
                      }
                      content += '</tr>';
                      }

                      if (index >= counter - 8) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 8].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 8].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index = 8].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index = 8].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                      if (index >= counter - 9) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 9].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 9].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index + 9].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 9].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                      if (index >= counter - 10) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 10].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 10].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index + 10].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 10].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                      if (index >= counter - 11) {
                        if (counter % 12 != 0) {
                          content += '<tr>';

                          content += '</tr>';
                        }
                      }else{
                      content += '<tr>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 11].document_no + '</td>';
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 11].document_title + '</td>';
                      if (JsonObject['dispcontentlistofdocspqs'][index + 11].revision_details == null) {
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;"> </td>';
                      }else{
                        content += '<td scope="col" style=" font-size: 36px; border: 2px solid black; color: black;">' + JsonObject['dispcontentlistofdocspqs'][index + 11].revision_details + '</td>';
                      }
                      content +='</tr>';
                      }

                  content += '</tbody>';
                  content += '</table>';

                  content += '</tbody>';
                content += '</table>';
              content += '</div>';
            content += '</div>';
              }

              else{
                  // toastr.error('Failed!');
              }
            }
            $(content).appendTo('.carousel-inner');


        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

        }
    });
}

function DisplayProdContentMthlyBestPerformer(){
  console.log('1');
  // console.log(selectedUsers);
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
        url: "display_prodcontent_monthlybestperformers",
        method: "get",
        data: {
            result: "1"
        },
        dataType: "json",
        async: false,
        beforeSend: function(){

        },
        success: function(JsonObject){
            let content = "";
            let mthlybestperfsinterval = 5000;

            if(JsonObject['mthlybestperfsinterval'].length > 0)
            {
               mthlybestperfsinterval = JsonObject['mthlybestperfsinterval'][0].data_interval * 1000;
            }

            content += '<div class="carousel-item" data-interval="' + mthlybestperfsinterval + '">';
              content += '<img class="d-block w-55" src="public/images/plain_white_bg.jpg" alt="Sixth slide">';
              content += '<div class="carousel-caption" style="top: 0%; transform: translateY(-1%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%">';
                content += '<div style="background-color: #003060; width: 100%;">';
                  content += '<p style="font-size: 40px; font-family: Roboto; text-align: left; font-weight: bold; ">&nbsp;<img src="public/images/Box.png" width="30" height="30" alt="Warning!" style="margin-bottom: 10px">&nbsp;&nbsp;Production Status Board</p>';
                content += '</div>';
                content += '<div style="background-color: #003060; width: 100%; height: 15px; margin-top: 15px;"></div>';
                if(JsonObject['mthlybestperfsmonth'].length > 0){
                    for(let index = 0; index < JsonObject['mthlybestperfsmonth'].length; index++) {
                      content += '<div class="row">';
                        content += '<div class="col-sm-6" style="float: left; text-align: left; width: 50%;">';
                        content += '<span style="font-family: Roboto; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>Monthly Best Performers</u></span> </div>';
                        content += '<div class="col-sm-6" style="float: right; text-align: right; width: 50%;">';
                        content += '<span style="font-family: Roboto; font-size: 40px; font-weight: bold; color: #000C66; margin-top: 20px;">Month : <u>' + JsonObject['mthlybestperfsmonth'][index].content_month + '</u></span>';
                        content += '</div>';
                      content += '</div>';
                      content += '<div style="margin-left:-5px; margin-right:-5px; margin-top: 15px;">';
                      content += '<div style="float:left; width:50%; padding: 5px">';
                        content += '<table style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="MthlyBestPerfs3">';
                          content += '<thead>';
                            content += '<tr>';
                              content += '<th style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Category</th>';
                              content += '<th colspan="2" style="border: 2px solid black; color: black; font-size: 28px; font-weight: bold;">Name / Photo</th>';
                            content += '</tr>';
                          content += '</thead>';
                    }
                }else{
                    // toastr.error('Failed!');
                }

                  content += '<tbody>';
                  if(JsonObject['dispcontentmthlybestperfs3'].length > 0){
                      for(let index = 0; index < JsonObject['dispcontentmthlybestperfs3'].length; index++) {

                         let award_category8 = "";

                         if (JsonObject['dispcontentmthlybestperfs3'][index].category == 1) {
                            award_category8 = "Best Operator"
                         }else if (JsonObject['dispcontentmthlybestperfs3'][index].category == 2) {
                            award_category8 = "Best Machine Operator"
                         }else if (JsonObject['dispcontentmthlybestperfs3'][index].category == 3) {
                            award_category8 = "Best Material Handler"
                         }

                         content += '<tr>';
                          content += '<td style="border: 2px solid black; width: 35%; color: black; font-size: 30px; font-weight: bold;">';
                            content += award_category8;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-right-style: none; width: 25%; color: black; font-size: 30px; margin-left: 100px;">';
                            content += JsonObject['dispcontentmthlybestperfs3'][index].employee_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-left-style: none; width: 25%; margin-left: 100px; padding: 5px;">';
                            content += '<img style="width: 300px; max-height: 250px; min-height: 250px; border: 3px solid black; border-color: #145DA0;" src="http://192.168.3.188/StatusBoard/storage/app/public/images/monthly_best_performers/' + JsonObject['dispcontentmthlybestperfs3'][index].imagefilename +'">';
                          content += '</td>';
                        content += '</tr>';
                      }
                  }
                  else{
                      // toastr.error('Failed!');
                  }

                let isHidden = "";
                if(JsonObject['dispcontentmthlybestperfs10'].length == 0){
                    isHidden = 'hidden';
                }

                  content += '</tbody>';
                content += '</table>';
                content += '</div>';
                content += '<div style="margin-left:-5px; margin-right:-5px;">';
                content += '<div style="float:left; width:50%; padding: 5px">';
                  content += '<table style="border-collapse: collapse; border-spacing: 0; width: 100%;" '+isHidden+' id="MthlyBestPerfs10">';
                    content += '<thead>';
                      content += '<tr>';
                        content += '<th style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Category</th>';
                        content += '<th colspan="2" style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Name / Photo</th>';
                      content += '</tr>';
                    content += '</thead>';
                  content += '<tbody>';
                  console.log('count bestperformer10 ',JsonObject['dispcontentmthlybestperfs10'].length);

                  if(JsonObject['dispcontentmthlybestperfs10'].length > 0){
                    for(let index = 0; index < JsonObject['dispcontentmthlybestperfs10'].length; index++) {

                        let award_category16 = "";

                        if (JsonObject['dispcontentmthlybestperfs10'][index].category == 10) {
                        award_category16 = "Best Technician"
                        }else if (JsonObject['dispcontentmthlybestperfs10'][index].category == 11) {
                        award_category16 = "Best Engineer"
                        }else if (JsonObject['dispcontentmthlybestperfs10'][index].category == 12) {
                        award_category16 = "Best Kaizen (Staff)"
                        }

                        content += '<tr>';
                        content += '<td style="border: 2px solid black; width: 35%; color: black; font-size: 30px; font-weight: bold;">';
                        content += award_category16;
                        content += '</td>';
                        content += '<td style="border: 2px solid black; border-right-style: none; width: 25%; color: black; font-size: 30px;">';
                        content += JsonObject['dispcontentmthlybestperfs10'][index].employee_name;
                        content += '</td>';
                        content += '<td style="border: 2px solid black; border-left-style: none; width: 25%; margin-left: 100px; padding: 5px;">';
                        content += '<img style="width: 300px; max-height: 250px; min-height: 250px; border: 3px solid black; border-color: #145DA0;" src="http://192.168.3.188/StatusBoard/storage/app/public/images/monthly_best_performers/' + JsonObject['dispcontentmthlybestperfs10'][index].imagefilename +'">';
                        content += '</td>';
                    content += '</tr>';
                    }
                  }else{

                  }
                  content += '</tbody>';
                content += '</table>';
              content += '</div>';
            content += '</div>';

            $(content).appendTo('.carousel-inner');

        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

        }
    });
}

function DisplayProdContentMthlyBestPerformer6(){
  console.log('2');
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
        url: "display_prodcontent_monthlybestperformers",
        method: "get",
        data: {
            result: "2"
        },
        dataType: "json",
        async: false,
        beforeSend: function(){

        },
        success: function(JsonObject){
            let content = "";
            let mthlybestperfsinterval = 5000;

            if(JsonObject['mthlybestperfsinterval'].length > 0)
            {
               mthlybestperfsinterval = JsonObject['mthlybestperfsinterval'][0].data_interval * 1000;
            }

            content += '<div class="carousel-item" data-interval="' + mthlybestperfsinterval + '">';
              content += '<img class="d-block w-55" src="public/images/plain_white_bg.jpg" alt="Sixth slide">';
              content += '<div class="carousel-caption" style="top: 0%; transform: translateY(-1%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%">';
                content += '<div style="background-color: #003060; width: 100%;">';
                  content += '<p style="font-size: 40px; font-family: Roboto; text-align: left; font-weight: bold; ">&nbsp;<img src="public/images/Box.png" width="30" height="30" alt="Warning!" style="margin-bottom: 10px">&nbsp;&nbsp;Production Status Board</p>';
                content += '</div>';
                content += '<div style="background-color: #003060; width: 100%; height: 15px; margin-top: 15px;"></div>';
                if(JsonObject['mthlybestperfsmonth'].length > 0){
                    for(let index = 0; index < JsonObject['mthlybestperfsmonth'].length; index++) {
                      content += '<div class="row">';
                        content += '<div class="col-sm-6" style="float: left; text-align: left; width: 50%;">';
                        content += '<span style="font-family: Roboto; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>Monthly Best Performers</u></span> </div>';
                        content += '<div class="col-sm-6" style="float: right; text-align: right; width: 50%;">';
                        content += '<span style="font-family: Roboto; font-size: 40px; font-weight: bold; color: #000C66; margin-top: 20px;">Month : <u>' + JsonObject['mthlybestperfsmonth'][index].content_month + '</u></span>';
                        content += '</div>';
                      content += '</div>';
                      content += '<div style="margin-left:-5px; margin-right:-5px; margin-top: 15px;">';
                      content += '<div style="float:left; width:50%; padding: 5px">';
                        content += '<table style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="MthlyBestPerfs3">';
                          content += '<thead>';
                            content += '<tr>';
                              content += '<th style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Category</th>';
                              content += '<th colspan="2" style="border: 2px solid black; color: black; font-size: 28px; font-weight: bold;">Name / Photo</th>';
                            content += '</tr>';
                          content += '</thead>';
                    }
                }
                else{
                    // toastr.error('Failed!');
                }

                  content += '<tbody>';
                  if(JsonObject['dispcontentmthlybestperfs6'].length > 0){
                      for(let index = 0; index < JsonObject['dispcontentmthlybestperfs6'].length; index++) {

                         let award_category8 = "";

                         if (JsonObject['dispcontentmthlybestperfs6'][index].category == 4) {
                            award_category8 = "Best Supervisor"
                         }else if (JsonObject['dispcontentmthlybestperfs6'][index].category == 5) {
                            award_category8 = "Best Clerk"
                         }else if (JsonObject['dispcontentmthlybestperfs6'][index].category == 6) {
                            award_category8 = "Best Warehouse MH"
                         }

                         content += '<tr>';
                          content += '<td style="border: 2px solid black; width: 35%; color: black; font-size: 30px; font-weight: bold;">';
                            content += award_category8;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-right-style: none; width: 25%; color: black; font-size: 30px; margin-left: 100px;">';
                            content += JsonObject['dispcontentmthlybestperfs6'][index].employee_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-left-style: none; width: 25%; margin-left: 100px; padding: 5px;">';
                            content += '<img style="width: 300px; max-height: 250px; min-height: 250px; border: 3px solid black; border-color: #145DA0;" src="http://192.168.3.188/StatusBoard/storage/app/public/images/monthly_best_performers/' + JsonObject['dispcontentmthlybestperfs6'][index].imagefilename +'">';
                          content += '</td>';
                        content += '</tr>';
                      }
                  }
                  else{
                      // toastr.error('Failed!');
                  }

                let isHidden = "";
                if(JsonObject['dispcontentmthlybestperfs12'].length == 0){
                    isHidden = 'hidden';
                }

                  content += '</tbody>';
                content += '</table>';
                content += '</div>';
                content += '<div style="margin-left:-5px; margin-right:-5px;">';
                content += '<div style="float:left; width:50%; padding: 5px">';
                  content += '<table style="border-collapse: collapse; border-spacing: 0; width: 100%;" '+isHidden+' id="MthlyBestPerfs10">';
                    content += '<thead>';
                      content += '<tr>';
                        content += '<th style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Category</th>';
                        content += '<th colspan="2" style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Name / Photo</th>';
                      content += '</tr>';
                    content += '</thead>';
                  content += '<tbody>';

                  if(JsonObject['dispcontentmthlybestperfs12'].length > 0){
                      for(let index = 0; index < JsonObject['dispcontentmthlybestperfs12'].length; index++) {

                         let award_category16 = "";

                         if (JsonObject['dispcontentmthlybestperfs12'][index].category == 13) {
                            award_category16 = "Best Kaizen (Non-Staff)"
                         }else if (JsonObject['dispcontentmthlybestperfs12'][index].category == 14) {
                            award_category16 = "Best in Productivity"
                         }else if (JsonObject['dispcontentmthlybestperfs12'][index].category == 15) {
                            award_category16 = "Most # of Defect Escalate"
                         }

                         content += '<tr>';
                          content += '<td style="border: 2px solid black; width: 35%; color: black; font-size: 30px; font-weight: bold;">';
                            content += award_category16;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-right-style: none; width: 25%; color: black; font-size: 30px;">';
                            content += JsonObject['dispcontentmthlybestperfs12'][index].employee_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-left-style: none; width: 25%; margin-left: 100px; padding: 5px;">';
                            content += '<img style="width: 300px; max-height: 250px; min-height: 250px; border: 3px solid black; border-color: #145DA0;" src="http://192.168.3.188/StatusBoard/storage/app/public/images/monthly_best_performers/' + JsonObject['dispcontentmthlybestperfs12'][index].imagefilename +'">';
                          content += '</td>';
                        content += '</tr>';
                      }
                  }
                  else{
                      // toastr.error('Failed!');
                  }
                  content += '</tbody>';
                content += '</table>';
              content += '</div>';
            content += '</div>';

            $(content).appendTo('.carousel-inner');

        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

        }
    });
}

function DisplayProdContentMthlyBestPerformer9(){
  console.log('3');
  // console.log(selectedUsers);
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
        url: "display_prodcontent_monthlybestperformers",
        method: "get",
        data: {
            result: "3"
        },
        dataType: "json",
        async: false,
        beforeSend: function(){

        },
        success: function(JsonObject){
            let content = "";
            let mthlybestperfsinterval = 5000;

            if(JsonObject['mthlybestperfsinterval'].length > 0)
            {
               mthlybestperfsinterval = JsonObject['mthlybestperfsinterval'][0].data_interval * 1000;
            }

            content += '<div class="carousel-item" data-interval="' + mthlybestperfsinterval + '">';
              content += '<img class="d-block w-55" src="public/images/plain_white_bg.jpg" alt="Sixth slide">';
              content += '<div class="carousel-caption" style="top: 0%; transform: translateY(-1%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%">';
                content += '<div style="background-color: #003060; width: 100%;">';
                  content += '<p style="font-size: 40px; font-family: Roboto; text-align: left; font-weight: bold; ">&nbsp;<img src="public/images/Box.png" width="30" height="30" alt="Warning!" style="margin-bottom: 10px">&nbsp;&nbsp;Production Status Board</p>';
                content += '</div>';
                content += '<div style="background-color: #003060; width: 100%; height: 15px; margin-top: 15px;"></div>';
                if(JsonObject['mthlybestperfsmonth'].length > 0){
                    for(let index = 0; index < JsonObject['mthlybestperfsmonth'].length; index++) {
                      content += '<div class="row">';
                        content += '<div class="col-sm-6" style="float: left; text-align: left; width: 50%;">';
                        content += '<span style="font-family: Roboto; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>Monthly Best Performers</u></span> </div>';
                        content += '<div class="col-sm-6" style="float: right; text-align: right; width: 50%;">';
                        content += '<span style="font-family: Roboto; font-size: 40px; font-weight: bold; color: #000C66; margin-top: 20px;">Month : <u>' + JsonObject['mthlybestperfsmonth'][index].content_month + '</u></span>';
                        content += '</div>';
                      content += '</div>';
                      content += '<div style="margin-left:-5px; margin-right:-5px; margin-top: 15px;">';
                      content += '<div style="float:left; width:50%; padding: 5px">';
                        content += '<table style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="MthlyBestPerfs3">';
                          content += '<thead>';
                            content += '<tr>';
                              content += '<th style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Category</th>';
                              content += '<th colspan="2" style="border: 2px solid black; color: black; font-size: 28px; font-weight: bold;">Name / Photo</th>';
                            content += '</tr>';
                          content += '</thead>';
                    }
                }else{
                    // toastr.error('Failed!');
                }

                  content += '<tbody>';
                  if(JsonObject['dispcontentmthlybestperfs9'].length > 0){
                      for(let index = 0; index < JsonObject['dispcontentmthlybestperfs9'].length; index++) {

                         let award_category8 = "";

                         if (JsonObject['dispcontentmthlybestperfs9'][index].category == 7) {
                            award_category8 = "Best Inspector"
                         }else if (JsonObject['dispcontentmthlybestperfs9'][index].category == 8){
                            award_category8 = "Best QC Supervisor"
                         }else if (JsonObject['dispcontentmthlybestperfs9'][index].category == 9){
                            award_category8 = "Best Planner"
                         }

                         content += '<tr>';
                          content += '<td style="border: 2px solid black; width: 35%; color: black; font-size: 30px; font-weight: bold;">';
                            content += award_category8;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-right-style: none; width: 25%; color: black; font-size: 30px; margin-left: 100px;">';
                            content += JsonObject['dispcontentmthlybestperfs9'][index].employee_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-left-style: none; width: 25%; margin-left: 100px; padding: 5px;">';
                            content += '<img style="width: 300px; max-height: 250px; min-height: 250px; border: 3px solid black; border-color: #145DA0;" src="http://192.168.3.188/StatusBoard/storage/app/public/images/monthly_best_performers/' + JsonObject['dispcontentmthlybestperfs9'][index].imagefilename +'">';
                          content += '</td>';
                        content += '</tr>';
                      }
                  }
                  else{
                      // toastr.error('Failed!');
                  }

                let isHidden = "";
                if(JsonObject['dispcontentmthlybestperfs16'].length == 0){
                    isHidden = 'hidden';
                }

                  content += '</tbody>';
                content += '</table>';
                content += '</div>';
                content += '<div style="margin-left:-5px; margin-right:-5px;">';
                content += '<div style="float:left; width:50%; padding: 5px">';
                  content += '<table style="border-collapse: collapse; border-spacing: 0; width: 100%;" '+isHidden+' id="MthlyBestPerfs10">';
                    content += '<thead>';
                      content += '<tr>';
                        content += '<th style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Category</th>';
                        content += '<th colspan="2" style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Name / Photo</th>';
                      content += '</tr>';
                    content += '</thead>';
                  content += '<tbody>';

                  if(JsonObject['dispcontentmthlybestperfs16'].length > 0){
                      for(let index = 0; index < JsonObject['dispcontentmthlybestperfs16'].length; index++) {

                         let award_category16 = "";

                         if (JsonObject['dispcontentmthlybestperfs16'][index].category == 16) {
                            award_category16 = "Best 5S"
                         }else if (JsonObject['dispcontentmthlybestperfs16'][index].category == 17) {
                            award_category16 = "Best Poka-Yoke"
                         }else if(JsonObject['dispcontentmthlybestperfs16'][index].category == 18){//this else if is for custom placement of the award category zero(0)
                            award_category16 = "" //manually set the Category here
                         }

                         content += '<tr>';
                          content += '<td style="border: 2px solid black; width: 35%; color: black; font-size: 30px; font-weight: bold;">';
                            content += award_category16;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-right-style: none; width: 25%; color: black; font-size: 30px;">';
                            content += JsonObject['dispcontentmthlybestperfs16'][index].employee_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-left-style: none; width: 25%; margin-left: 100px; padding: 5px;">';
                            content += '<img style="width: 300px; max-height: 250px; min-height: 250px; border: 3px solid black; border-color: #145DA0;" src="http://192.168.3.188/StatusBoard/storage/app/public/images/monthly_best_performers/' + JsonObject['dispcontentmthlybestperfs16'][index].imagefilename +'">';
                          content += '</td>';
                        content += '</tr>';
                      }
                  }
                  else{
                      // toastr.error('Failed!');
                  }
                  content += '</tbody>';
                content += '</table>';
              content += '</div>';
            content += '</div>';

            $(content).appendTo('.carousel-inner');

        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

        }
    });
}

function DisplayProdContentMthlyBestPerformerNew(){
  console.log('new');
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
        url: "display_prodcontent_monthlybestperformers",
        method: "get",
        data: {
            result: "new"
        },
        dataType: "json",
        async: false,
        beforeSend: function(){

        },
        success: function(JsonObject){
            let content = "";
            let mthlybestperfsinterval = 5000;

            if(JsonObject['mthlybestperfsinterval'].length > 0){
               mthlybestperfsinterval = JsonObject['mthlybestperfsinterval'][0].data_interval * 1000;
            }

            content += '<div class="carousel-item" data-interval="' + mthlybestperfsinterval + '">';
              content += '<img class="d-block w-55" src="public/images/plain_white_bg.jpg" alt="Sixth slide">';
              content += '<div class="carousel-caption" style="top: 0%; transform: translateY(-1%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%">';
                content += '<div style="background-color: #003060; width: 100%;">';
                  content += '<p style="font-size: 40px; font-family: Roboto; text-align: left; font-weight: bold; ">&nbsp;<img src="public/images/Box.png" width="30" height="30" alt="Warning!" style="margin-bottom: 10px">&nbsp;&nbsp;Production Status Board</p>';
                content += '</div>';
                content += '<div style="background-color: #003060; width: 100%; height: 15px; margin-top: 15px;"></div>';
                if(JsonObject['mthlybestperfsmonth'].length > 0){
                    for(let index = 0; index < JsonObject['mthlybestperfsmonth'].length; index++) {
                      content += '<div class="row">';
                        content += '<div class="col-sm-6" style="float: left; text-align: left; width: 50%;">';
                        content += '<span style="font-family: Roboto; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>Monthly Best Performers</u></span> </div>';
                        content += '<div class="col-sm-6" style="float: right; text-align: right; width: 50%;">';
                        content += '<span style="font-family: Roboto; font-size: 40px; font-weight: bold; color: #000C66; margin-top: 20px;">Month : <u>' + JsonObject['mthlybestperfsmonth'][index].content_month + '</u></span>';
                        content += '</div>';
                      content += '</div>';
                      content += '<div style="margin-left:-5px; margin-right:-5px; margin-top: 15px;">';
                      content += '<div style="float:left; width:50%; padding: 5px">';
                        content += '<table style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="MthlyBestPerfs3">';
                          content += '<thead>';
                            content += '<tr>';
                              content += '<th style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Category</th>';
                              content += '<th colspan="2" style="border: 2px solid black; color: black; font-size: 28px; font-weight: bold;">Name / Photo</th>';
                            content += '</tr>';
                          content += '</thead>';
                    }
                }else{
                    // toastr.error('Failed!');
                }

                  content += '<tbody>';
                  if(JsonObject['dispcontentmthlybestperfs19'].length > 0){
                      for(let index = 0; index < JsonObject['dispcontentmthlybestperfs19'].length; index++) {

                         let award_category19 = "";

                         if (JsonObject['dispcontentmthlybestperfs19'][index].category == 19) { //this else if is for custom placement of the award category zero(0)
                            award_category19 = "Best in Productivity" //manually set the Category here
                         }else if (JsonObject['dispcontentmthlybestperfs19'][index].category == 20){ //this else if is for custom placement of the award category zero(0)
                            award_category19 = "Best Clerk" //manually set the Category here
                         }else if (JsonObject['dispcontentmthlybestperfs19'][index].category == 21){ //this else if is for custom placement of the award category zero(0)
                            award_category19 = "Best Supervisor" //manually set the Category here
                         }

                         content += '<tr>';
                          content += '<td style="border: 2px solid black; width: 35%; color: black; font-size: 30px; font-weight: bold;">';
                            content += award_category19;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-right-style: none; width: 25%; color: black; font-size: 30px; margin-left: 100px;">';
                            content += JsonObject['dispcontentmthlybestperfs19'][index].employee_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-left-style: none; width: 25%; margin-left: 100px; padding: 5px;">';
                            content += '<img style="width: 300px; max-height: 250px; min-height: 250px; border: 3px solid black; border-color: #145DA0;" src="http://192.168.3.188/StatusBoard/storage/app/public/images/monthly_best_performers/' + JsonObject['dispcontentmthlybestperfs19'][index].imagefilename +'">';
                          content += '</td>';
                        content += '</tr>';
                      }
                  }
                  else{
                      // toastr.error('Failed!');
                  }

                let isHidden = "";
                if(JsonObject['dispcontentmthlybestperfs22'].length == 0){
                    isHidden = 'hidden';
                }

                  content += '</tbody>';
                content += '</table>';
                content += '</div>';
                content += '<div style="margin-left:-5px; margin-right:-5px;">';
                content += '<div style="float:left; width:50%; padding: 5px">';
                  content += '<table style="border-collapse: collapse; border-spacing: 0; width: 100%;" '+isHidden+' id="MthlyBestPerfs10">';
                    content += '<thead>';
                      content += '<tr>';
                        content += '<th style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Category</th>';
                        content += '<th colspan="2" style="border: 2px solid black; color: black; font-size: 30px; font-weight: bold;">Name / Photo</th>';
                      content += '</tr>';
                    content += '</thead>';
                  content += '<tbody>';

                  if(JsonObject['dispcontentmthlybestperfs22'].length > 0){
                      for(let index = 0; index < JsonObject['dispcontentmthlybestperfs22'].length; index++) {

                         let award_category22 = "";
                         if (JsonObject['dispcontentmthlybestperfs22'][index].category == 22) { //this else if is for custom placement of the award category zero(0)
                            award_category22 = "" //manually set the Category here
                         }else if (JsonObject['dispcontentmthlybestperfs22'][index].category == 23) {
                            award_category22 = "" //manually set the Category here
                         }else if(JsonObject['dispcontentmthlybestperfs22'][index].category == 24){//this else if is for custom placement of the award category zero(0)
                            award_category22 = "" //manually set the Category here
                         }

                         content += '<tr>';
                          content += '<td style="border: 2px solid black; width: 35%; color: black; font-size: 30px; font-weight: bold;">';
                            content += award_category22;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-right-style: none; width: 25%; color: black; font-size: 30px;">';
                            content += JsonObject['dispcontentmthlybestperfs22'][index].employee_name;
                          content += '</td>';
                          content += '<td style="border: 2px solid black; border-left-style: none; width: 25%; margin-left: 100px; padding: 5px;">';
                            content += '<img style="width: 300px; max-height: 250px; min-height: 250px; border: 3px solid black; border-color: #145DA0;" src="http://192.168.3.188/StatusBoard/storage/app/public/images/monthly_best_performers/' + JsonObject['dispcontentmthlybestperfs22'][index].imagefilename +'">';
                          content += '</td>';
                        content += '</tr>';
                      }
                  }
                  else{
                      // toastr.error('Failed!');
                  }
                  content += '</tbody>';
                content += '</table>';
              content += '</div>';
            content += '</div>';

            $(content).appendTo('.carousel-inner');

        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

        }
    });
}

function DisplayProdContentProdLineEffMon(){
  // console.log(selectedUsers);
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
        url: "display_prodcontent_prodlineeffmonitoring",
        method: "get",
        data: {
        },
        dataType: "json",
        async: false,
        beforeSend: function(){

        },
        success: function(JsonObject){
            let content = "";
            let contentheader = "";
            let prodlineeffmoninterval = 5000;
            console.log(JsonObject);

            if(JsonObject['prodlineeffmoninterval'].length > 0){
               prodlineeffmoninterval = JsonObject['prodlineeffmoninterval'][0].data_interval * 1000;
            }

            // console.log('assd',JsonObject['prodlineeffmontarget']);

              content += '<div class="carousel-item" data-interval="' + prodlineeffmoninterval + '">';
                content += '<img class="d-block w-55" src="public/images/plain_white_bg.jpg" alt="Seventh Slide">';
                  content += '<div class="carousel-caption" style="top: 0%; transform: translateY(-1%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%">';
                    content += '<div style="background-color: #003060; width: 100%;">';
                      content += '<p style="font-size: 40px; font-family: Roboto; text-align: left; font-weight: bold; ">&nbsp;<img src="public/images/Box.png" width="30" height="30" alt="Warning!" style="margin-bottom: 10px">&nbsp;&nbsp;Production Status Board</p>';
                    content += '</div>';
                    content += '<div style="background-color: #000C66; width: 100%; height: 15px; margin-top: 15px;"></div>';
                      content += '<span style="font-family: Roboto; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>Product Line Efficiency Monitoring</u></span>';
                        if(JsonObject['prodlineeffmontarget'].length > 0){
                          for(let index = 0; index < JsonObject['prodlineeffmontarget'].length; index++) {
                            content += '<div class="row">';
                              content += '<div class="col-sm-6" style="float: left; text-align: left; width: 50%;">';
                                content += '<span style="font-family: Roboto; font-size: 40px; font-weight: bold; color: black; margin-top: 20px;">Month : <u style="color: #000C66;">' + JsonObject['prodlineeffmonmonth'][index].content_month + '</u></span>';
                              content += '</div>';
                              content += '<div class="col-sm-6" style="float: right; text-align: right; width: 50%;">';
                                content += '<span style="font-family: Roboto; font-size: 40px; font-weight: bold; color: black; margin-top: 20px;">Target Efficiency : <u style="color: #0000FF;">' + JsonObject['prodlineeffmontarget'][index].target + '%</u></span>';
                              content += '</div>';
                            content += '</div>';
                          }
                        }else{
                          // toastr.error('Failed!');
                        }
                      content += '<table style="width:100%; margin-left: auto; margin-right: auto;" id="ProdLineEffMon">';
                      content += '<thead>';
                      content += '<tr>';
                        content += '<th>&nbsp;</th>';
                      content += '</tr>';
                      content += '<tr>';
                        content += '<th scope="col" style="border: 2px solid black; font-size: 44px; font-weight: bold; color: black; background-color: #EEB5EB;">Line</th>';
                        content += '<th scope="col" style="border: 2px solid black; font-size: 44px; font-weight: bold; color: black; background-color: #EEB5EB;">Actual Efficiency</th>';
                        content += '<th scope="col" style="border: 2px solid black; font-size: 44px; font-weight: bold; color: black; background-color: #EEB5EB;">Result</th>';
                      content += '</tr>';
                    content += '</thead>';
                    content += '<tbody>';

                    if(JsonObject['dispprodlineeffmon'].length > 0){
                        for(let index = 0; index < JsonObject['dispprodlineeffmon'].length; index++) {

                           let line_category = "";

                           if (JsonObject['dispprodlineeffmon'][index].line == 1) {
                              line_category = "BGA-FP"
                           }else if (JsonObject['dispprodlineeffmon'][index].line == 2) {
                              line_category = "BGA / LGA"
                           }else if (JsonObject['dispprodlineeffmon'][index].line == 3) {
                              line_category = "QFP TSOP"
                           }else if (JsonObject['dispprodlineeffmon'][index].line == 4) {
                              line_category = "SMPO"
                           }else{
                              line_category = "Probe"
                           }

                           content += '<tr>';
                            content += '<td style="width:15%; border: 2px solid black; font-size: 44px; color: black; text-align: left;">';
                              content += '&nbsp;' + line_category;
                            content += '</td>';
                            for(let x = 0; x < JsonObject['prodlineeffmontarget'].length; x++) {
                              if (JsonObject['dispprodlineeffmon'][index].actual_efficiency < JsonObject['prodlineeffmontarget'][x].target) {
                                content += '<td style="width:15%; border: 2px solid black; font-size: 44px; color: #F51720;">';
                                  content += JsonObject['dispprodlineeffmon'][index].actual_efficiency + '%';
                                content += '</td>';
                              }else{
                                content += '<td style="width:15%; border: 2px solid black; font-size: 44px; color: black;">';
                                  content += JsonObject['dispprodlineeffmon'][index].actual_efficiency + '%';
                                content += '</td>';
                              }
                            }
                            if (JsonObject['dispprodlineeffmon'][index].result == "Off-Target") {
                              content += '<td style="width:15%; border: 2px solid black; font-size: 44px; color: #F51720;">';
                                content += JsonObject['dispprodlineeffmon'][index].result + '<img src="public/images/off-target.png" width="180px" height="130px">';
                              content += '</td>';
                            }else{
                              content += '<td style="width:15%; border: 2px solid black; font-size: 44px; color: #0000FF;">';
                                content += JsonObject['dispprodlineeffmon'][index].result + '<img src="public/images/on-target.png">';
                              content += '</td>';
                            }
                          content += '</tr>';
                        }
                    }
                    else{
                        // toastr.error('Failed!');
                    }
                    content += '</tbody>';
                  content += '</table>';
                content += '</div>';
              content += '</div>';
            content += '</div>';

            $(content).appendTo('.carousel-inner');

        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

        }
    });
}
