function validatelogin(){
	$("#sessionlogin").hide();
		if($("#txt_username").val() == ''){	
			$("#aj_error_content").show();
			$("#aj_error_content").html('Please enter username.');	
			$("#txt_username").focus();	
				return false;  
		}else if($("#txt_password").val() == ''){
			$("#aj_error_content").show(); 
			$("#aj_error_content").html('Please enter password.');
			$("#txt_password").focus();
				return false;  
		}else{	
			$("#aj_error_content").hide();
			$("#aj_error_content").html(''); 
			document.Form_login.submit();	
				return true;  
		}
}