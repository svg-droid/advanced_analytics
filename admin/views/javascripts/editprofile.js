function adddata(){
	var flag = 0;
	var img=$("#txt_addlogo").val();
		if(regexValidate('txt_addfirstname',firstnameMsg,PageTitleValidMsg,'chkSpace')){
			flag++;
		}
		if(regexValidate('txt_addlastname',lastnameMsg,PageTitleValidMsg,'chkSpace')){
			flag++;
		}
		if(regexValidate('txt_addusername',usernameMsg,usernameValidMsg,'alphanum')){
		   flag++;
		}
		if(regexValidate('txt_addemail',emailMsg,emailValidMsg,'email')){
		   flag++;
		}
		if(regexValidate('txt_addpassword',passwordMsg,passwordValidMsg,'password')){
			flag++;
		}
		if(regexValidate('txt_addcnfrmpassword',cnfmpaswordMsg,cnfmpaswordValidMsg,'password')){
			flag++;
		}
		/* if(requiredValidate('txt_addphone',phoneMsg)){
			flag++;
		}
		if(requiredValidate('txt_addaddress',addressMsg)){
			flag++;
		} */
		if(img!='' && regexValidate('txt_addlogo',photoMsg,photoValidMsg,'img')){
			flag++;
		}
		if(flag>0){
			return false;
		}
		else{
			var options = {
				beforeSubmit : showRequestAdmin,
				success : showResponseAdmin,
				url : site_url+'controllers/ajax_controller/editprofile-ajax-controller.php', 
				type : "POST"
			};
			$('#form_adminadd').submit(function() {
				$(this).ajaxSubmit(options);
				return false;
			});
		}
	}
	function showRequestAdmin(formData, jqForm, options) {
		return true;
	}
function showResponseAdmin(data, statusText)  {
	if(statusText == 'success'){
		if(data == 0){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Email is already exists.';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);		   
			document.getElementById('succ').innerHTML = 'Record added successfully.';
			newdata();
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Some error occurred while Record.';
		}
		$('#form_adminadd').unbind('submit').bind('submit',function() {
		});
	}
}
function updatedata(){
	var flag = 0;
	var img=$("#txt_addlogo").val();
	var password11=$("#txt_addpassword").val();
		if(regexValidate('txt_addfirstname',firstnameMsg,PageTitleValidMsg,'chkSpace')){
			flag++;
		}
		if(regexValidate('txt_addlastname',lastnameMsg,PageTitleValidMsg,'chkSpace')){
			flag++;
		}
		if(regexValidate('txt_addusername',usernameMsg,usernameValidMsg,'alphanum')){
		   flag++;
		}
		if(regexValidate('txt_addemail',emailMsg,emailValidMsg,'email')){
		   flag++;
		}
		if(password11!='' && regexValidate('txt_addpassword',passwordMsg,passwordValidMsg,'password')){
			flag++;
		}
		if(password11!='' && regexValidate('txt_addcnfrmpassword',cnfmpaswordMsg,cnfmpaswordValidMsg,'password')){
			flag++;
		}
		/* if(requiredValidate('txt_addphone',phoneMsg)){
			flag++;
		}
		if(requiredValidate('txt_addaddress',addressMsg)){
			flag++;
		} */
		if(img!='' && regexValidate('txt_addlogo',photoMsg,photoValidMsg,'img')){
			flag++;
		}
		if(flag>0){
			return false;
		}else{
			var options = {
				beforeSubmit : showRequest_update,
				success : showResponse_update,
				url : site_url+'controllers/ajax_controller/editprofile-ajax-controller.php', 
				type : "POST"
			};
			$('#form_adminadd').submit(function() {
				$(this).ajaxSubmit(options);
				return false;
			});
		}
	}
function showRequest_update(formData, jqForm, options) {
	return true;
}
function showResponse_update(data, statusText) {
	if (statusText == 'success'){
		if(data == 0){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Email is already exists.';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);
			document.getElementById('succ').innerHTML = 'Record updated successfully.';
			newdata();
			window.location.href='index.php?pid=dashboard';
			/* newdata();
			setInterval(function (){location.reload();},700); */
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML='Some error occurred while Record.';
		}
		
		$('#form_adminadd').unbind('submit').bind('submit',function() {
		});
	}
}