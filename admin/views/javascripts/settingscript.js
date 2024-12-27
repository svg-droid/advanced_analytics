function updatedata(){
	var flag = 0;
	var fburl=$("#txt_addfacebook").val();
	var twurl=$("#txt_addtwitter").val();
	var qpurl=$("#txt_addgplus").val();
	var img=$("#txt_banner").val(); 
	var rates = document.getElementById('rates').value;
	var rate_value;
	if (document.getElementById('txt_mail_type1').checked) {
	  rate_value = document.getElementById('txt_mail_type1').value;
	}else if (document.getElementById('txt_mail_type2').checked) {
	  rate_value = document.getElementById('txt_mail_type2').value;
	}

		if(regexValidate('txt_email',emailMsg,emailValidMsg,'email')){
		   flag++;
		}
		if(regexValidate('txt_websitename',WebsiteMsg,PageTitleValidMsg,'chkSpace')){
			flag++;
		}
		/*if(fburl!='' && regexValidate('txt_addfacebook',facebooklinkMsg,facebookValidmsg,'website')){
			flag++;
		}
		if(twurl!='' && regexValidate('txt_addtwitter',twitterlinkMsg,twitterValidmsg,'website')){
			flag++;
		}
		if(qpurl!='' && regexValidate('txt_addgplus',googlelinkMsg,googleValidmsg,'website')){
			flag++;
		}*/
		if(rate_value=='1' && requiredValidate('txt_smtpport',smtpportMsg)){
			flag++;
		}
		if(rate_value=='1' && requiredValidate('txt_smtphost',smtphostMsg)){
			flag++;
		}
		if(rate_value=='1' && requiredValidate('txt_smtpusername',smtpusernsmeMsg)){
			flag++;
		}
		if(rate_value=='1' && requiredValidate('txt_smtppassword',smtppasswordMsg)){
			flag++;
		}
		/*if(regexValidate('txt_banner',photoMsg,photoValidMsg,'img')){
		   flag++;
		}*/
		
		
		if(flag>0){
			return false;
		}
		else{
	   var options = {
			beforeSubmit:  showRequest_update,
			success:       showResponse_update,
			url:       site_url+'controllers/ajax_controller/setting-ajax-controller.php', 
			type: "POST"
		};
		$('#form_SettingAdd').submit(function() { 
			$(this).ajaxSubmit(options);
			return false;
		});
	}  
}
function showRequest_update(formData, jqForm, options) {
	return true;
} 
function showResponse_update(data, statusText)  
{
	if (statusText == 'success') 
	{	
		if(data == 0){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Record already exist. Please try another.';
		}else if(data == 1){
			$.scrollTo(0,500);
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);				
			document.getElementById('succ').innerHTML = 'Record updated successfully.';
			newdata();
			window.location.href='index.php?pid=setting';
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Some error occurred while updating Record.';
		}
	}
	$('#form_SettingAdd').unbind('submit').bind('submit',function() {
	});
}