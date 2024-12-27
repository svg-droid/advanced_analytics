function adddata(){
	var flag = 0; 
	
	
		/*if(requiredValidate('couponname',couponnameMsg)){
			flag++;
		} */
		// if(requiredValidate('fromdate',fromdateMsg)){
		// 	flag++;
		// } 
		// if(requiredValidate('todate',todateMsg)){
		// 	flag++;
		// } 
		if(requiredValidate('discount_code',discountcodeMsg)){
			flag++;
		}
		if(requiredValidate('discount_percentage',discountpercentageMsg)){
			flag++;
		} 

		/*var rupees =$('#discount_rupees').val();
		var percentage =$('#discount_percentage').val();

        if(rupees !="" && percentage!="" )
        {
        	alert("Please Enter Only One Discount Value for Discount Percentage");
           flag++;
        }
         if(rupees !="")
        {
        	if(regexValidate('discount_rupees',discountrupeesMsg,discountnumMsg,'numpoint'))
        	{
			flag++;
		     }
		
        }
          if(percentage !="")
        {
        	if(regexValidate('discount_percentage',discountpercentageMsg,discountnumMsg,'numpoint'))
        	{
			flag++;
		     }
        }*/
        
       
		     
		if(flag>0){
			return false;
		}
		else{
			var options = {
				beforeSubmit:  showRequest,
				success:       showResponse,
				url:       site_url+'controllers/ajax_controller/discount-ajax-controller.php', 
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
		/*if(requiredValidate('couponname',couponnameMsg)){
			flag++;
		} */
		// if(requiredValidate('fromdate',fromdateMsg)){
		// 	flag++;
		// } 
		// if(requiredValidate('todate',todateMsg)){
		// 	flag++;
		// } 
		if(requiredValidate('discount_code',discountcodeMsg)){
			flag++;
		} 
		
		if(requiredValidate('discount_percentage',discountpercentageMsg)){
			flag++;
		} 
		/*var rupees =$('#discount_rupees').val();
		var percentage =$('#discount_percentage').val();
       if(rupees !="" && percentage!="" )
        {
        	alert("Please Enter Only One Discount Value for Discount Percentage");
           flag++;
        }
         if(rupees !="")
        {
        	if(requiredValidate('discount_rupees',discountrupeesMsg))
          {
			flag++;
		  }
		
        }
          if(percentage !="")
        {
        	if(requiredValidate('discount_percentage',discountpercentageMsg))
        	{
			flag++;

		
          }
     }*/
		if(flag>0){
			return false;
		}
		else{
			var options = {
				beforeSubmit: showRequest_update,
				success: showResponse_update,
				url: site_url + 'controllers/ajax_controller/discount-ajax-controller.php',
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