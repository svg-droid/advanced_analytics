function checkpassword(password){	
	var flag = 0;
	$("#h_password").val('0');
	/* if(password == ''){
		$("#h_password").val('0'); */
		if(password == '' && requiredValidate('txt_oldpassword',oldpasswordMsg)){
			flag++;
		}
			/* $("#fcbox_content_tag").html('oldpasswordMsg');
			$("#fancybox-example").fancybox().trigger('click'); */
	/* } */
	if(flag>0){
		return false;
	}else{
		
	$.ajax({
	url : site_url+'controllers/ajax_controller/changepassword-ajax-controller.php', 
	type : 'post',
	data : 'getpassword=1&password='+password,		
	success : function( resp ) {
		if(resp==0){
			$("#h_password").val('0');
			$("#error_txt_oldpassword").html('Enter correct old password.');
			/* $("#fancybox-example").fancybox().trigger('click'); */
			return false;
		
		}else {
			$("#h_password").val('1');
			$("#txt_newpassword").focus();
		}
	}
	});
	}
}
function adddata(){
	var alphanum = /^[a-zA-Z0-9]+$/;
	var chkpassword = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/;
	
	if($("#txt_oldpassword").val()==''){
		$("#fcbox_content_tag").html('Please enter old password.');
		$("#fancybox-example").fancybox().trigger('click');
			return false;
	}else if($("#h_password").val()=='0'){
		$("#fcbox_content_tag").html('Please enter correct password.');
		$("#fancybox-example").fancybox().trigger('click');
			return false;
	}else if($("#txt_newpassword").val()==''){
		$("#fcbox_content_tag").html('Pease enter new password.');
		$("#fancybox-example").fancybox().trigger('click');
			return false;
	}else if(chkpassword.test($("#txt_newpassword").val())==false){
		$("#fcbox_content_tag").html('Password is invalid, it must contain 1 capital letter , 1 special character and be a minimum of 6 chars!');
		$("#fancybox-example").fancybox().trigger('click');
			return false;
	}else if($("#txt_addcnfrmpassword").val()==''){
		$("#fcbox_content_tag").html('Please enter confirm password.');
		$("#fancybox-example").fancybox().trigger('click');
			return false;
	}else if($("#txt_addcnfrmpassword").val()!==$("#txt_newpassword").val()){
		$("#fcbox_content_tag").html('Confirm password does not match with new password.');
		$("#fancybox-example").fancybox().trigger('click');
			return false;
	}else{	  
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+'controllers/ajax_controller/changepassword-ajax-controller.php', 
			type: "POST"
		};

		$('#form_changepassword').submit(function(){
			$(this).ajaxSubmit(options);
			return false;
		});    
	}	   
}
function showRequest(formData, jqForm, options) {
	return true;
} 
function showResponse(data, statusText){
	if (statusText == 'success') {
		if(data == 1){
			$("#message-green").show().fadeOut(5000);
			$("#message-red").hide();
			document.getElementById('succ').innerHTML = 'Password changed successfully.';
			newdata();		   
		}else if(data==2){
			$("#message-green").hide();
			$("#message-red").show().fadeOut(7000);
			document.getElementById('err').innerHTML = 'Some error occurred while updating password.';
		}
	}
	$('#form_changepassword').unbind('submit').bind('submit',function() {
	});
}

function newdata(){
   showviewdiv();
}

function showviewdiv(){
	$.scrollTo(0,500);
	$.ajax({ 
		url : site_url+'controllers/ajax_controller/changepassword-ajax-controller.php', 
		type : 'post',
		data : 'viewdiv='+ 1,
		success : function( resp ) {
			document.getElementById('changepassword').style.display='block';
			$("#changepassword").html(resp);
		}
	});
}