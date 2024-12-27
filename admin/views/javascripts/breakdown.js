function adddata(){
	var flag = 0;
	if(requiredValidate('breakdowntitle',breakdowntitleMsg)){
            flag++;
}
/*if(regexValidate('txt_addphoto2',SubjectthumbImg,photoValidMsg,'img')){
	flag++;
 }*/
if(regexValidate('txt_addphoto',SubjectImg,photoValidMsg,'img')){
	 flag++;
 }
	if(flag>0){
			return false;
		}
		else{
			var options = {
				beforeSubmit:  showRequest,
				success:       showResponse,
				url:       site_url+'controllers/ajax_controller/breakdown-ajax-controller.php',
				type: "POST"
			};

			$('#form_testadd').submit(function() {
				$(this).ajaxSubmit(options);
				return false;
			});
		}

}
function showRequest(formData, jqForm, options) {
	return true;
}
function showResponse(data, statusText)  {
	if(statusText == 'success'){
		if(data == 0){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML='Record already exist. Please try another.';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);
			document.getElementById('succ').innerHTML='Record added successfully.';
			newdata();
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML='URL already exist.';
		}
	}
		$('#form_testadd').unbind('submit').bind('submit',function() {
		});
}
function updatedata(){
	var flag = 0;
	if(requiredValidate('breakdowntitle',breakdowntitleMsg)){
            flag++;
}
/*var imgbrowse =	$("#txt_addphoto2").val();
if(imgbrowse != '')
{
if(regexValidate('txt_addphoto2',SubjectthumbImg,photoValidMsg,'img')){
	 flag++;
 }
}*/

var imgbrowse =	$("#txt_addphoto").val();
if(imgbrowse != '')
{
if(regexValidate('txt_addphoto',SubjectImg,photoValidMsg,'img')){
	 flag++;
 }
}
		if(flag>0){
			return false;
		}
		else{
			var options = {
				beforeSubmit: showRequest_update,
				success: showResponse_update,
				url: site_url + 'controllers/ajax_controller/breakdown-ajax-controller.php',
				type: "POST"
			};
			$('#form_testadd').submit(function() {
				$(this).ajaxSubmit(options);
				return false;
			});
		}
}

function showRequest_update(formData, jqForm, options) {
    return true;
}

function showResponse_update(data, statusText) {
    if (statusText == 'success') {
        if (data == 0) {
            $.scrollTo(0, 500);
            $("#message-red").show().fadeOut(7000);
            $("#message-green").hide();
            document.getElementById('err').innerHTML = 'Record already exist. Please try another.';
        } else if (data == 1) {
            $("#message-red").hide();
            $("#message-green").show().fadeOut(5000);
            document.getElementById('succ').innerHTML = 'Record updated successfully.';
            newdata();
        } else if (data == 2) {
            $.scrollTo(0, 500);
            $("#message-red").show().fadeOut(7000);
            $("#message-green").hide();
            document.getElementById('err').innerHTML = 'Some error occurred while Record.';
        } else if (data == 3) {
            $.scrollTo(0, 500);
            $("#message-red").show().fadeOut(7000);
            $("#message-green").hide();
            document.getElementById('err').innerHTML = 'Confirm password not match.';
        }
    }
    $('#form_testadd').unbind('submit').bind('submit', function() {});
}
