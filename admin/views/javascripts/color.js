function adddata(){
	var flag = 0;
	var img=$("#image").val();     

	if(requiredValidate('title',colorMsg)){
			flag++;
		}
		
		 	        
		if(flag>0){
			return false;
		}
		else{
			var options = {
				beforeSubmit:  showRequest,
				success:       showResponse,
				url:       site_url+'controllers/ajax_controller/color-ajax-controller.php', 
				type: "POST"
			};
			
			$('#form_cmsadd').submit(function() {
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
		$('#form_cmsadd').unbind('submit').bind('submit',function() {
		});
}
function updatedata(){
	var flag = 0;
	var img=$("#image").val();      

	if(requiredValidate('name',colorMsg)){
			flag++;
		} 
		
		if(flag>0){
			return false;
		}
		else{
			var options = {
				beforeSubmit: showRequest_update,
				success: showResponse_update,
				url: site_url + 'controllers/ajax_controller/color-ajax-controller.php',
				type: "POST"
			};
			$('#form_cmsadd').submit(function() {
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
    $('#form_cmsadd').unbind('submit').bind('submit', function() {});
}

function check_default(banner_id){
	//alert(banner_id);
	$.ajax({
		url : site_url+'controllers/ajax_controller/marketing-ajax-controller.php',
		type : 'post',
		data: 'check_default=1&banner_id='+banner_id,
		success : function(result)
		{
			// alert(result); 
			window.location.reload();
		}
	});
	
}

