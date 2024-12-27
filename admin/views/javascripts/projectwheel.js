function adddata(){
	var flag = 0;
	if(requiredValidate('wheeltype',wheeltypeMsg)){
            flag++;
}
if(requiredValidate('wheeltitle',wheeltitleMsg)){
					flag++;
}
if(requiredValidate('description',wheeldescriptionMsg)){
					flag++;
}

	if(flag>0){
			return false;
		}
		else{
			var options = {
				beforeSubmit:  showRequest,
				success:       showResponse,
				url:       site_url+'controllers/ajax_controller/projectwheel-ajax-controller.php',
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
			document.getElementById('err').innerHTML='Title already exist, Please Try another Title.';
		}
	}
		$('#form_testadd').unbind('submit').bind('submit',function() {
		});
}
function updatedata(){
	var flag = 0;
	if(requiredValidate('wheeltype',wheeltypeMsg)){
						flag++;
}
if(requiredValidate('wheeltitle',wheeltitleMsg)){
					flag++;
}
if(requiredValidate('description',wheeldescriptionMsg)){
					flag++;
}

		if(flag>0){
			return false;
		}
		else{
			var options = {
				beforeSubmit: showRequest_update,
				success: showResponse_update,
				url: site_url + 'controllers/ajax_controller/projectwheel-ajax-controller.php',
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
            document.getElementById('err').innerHTML = 'Title already exist, Please Try another Title.';
        } else if (data == 3) {
            $.scrollTo(0, 500);
            $("#message-red").show().fadeOut(7000);
            $("#message-green").hide();
            document.getElementById('err').innerHTML = 'Confirm password not match.';
        }
    }
    $('#form_testadd').unbind('submit').bind('submit', function() {});
}

function onlyNumbersandSpecialChar(evt) {

	var e = window.event || evt;
	var charCode = e.which || e.keyCode;

	if (charCode > 31 && (charCode < 48 || charCode > 57 || charCode > 107 || charCode > 219 || charCode > 221) && charCode != 40 && charCode != 32 && charCode != 41 && (charCode < 43 || charCode > 46) && charCode != 37 && charCode != 39) {

		if (window.event) //IE
			window.event.returnValue = false;
		else //Firefox
			e.preventDefault();
		}

	return true;
}
