function GetUserClassification(cboElement){
    let result = '<option value="0" selected disabled> -- Select User Classification -- </option>';
    $.ajax({
        url: 'get_user_classifications',
        method: 'get',
        dataType: 'json',
        beforeSend: function(){
            result = '<option value="0" selected disabled> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(JsonObject){
            result = '';
            if(JsonObject['user_classifications'].length > 0){
                result = '<option value="0" selected disabled> -- Select User Classification -- </option>';
                for(let index = 0; index < 3; index++){
                    result += '<option value="' + JsonObject['user_classifications'][index].id + '">' + JsonObject['user_classifications'][index].classification + '</option>';
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