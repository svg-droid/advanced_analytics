function adddata(){
	var flag = 0;
	if(requiredValidate('category',categoryMsg)){
            flag++;
        }
	if(requiredValidate('questions',questionsMsg)){
            flag++;
        }
    if(requiredValidate('option1',option1Msg)){
            flag++;
        }
	 if(requiredValidate('option2',option2Msg)){
            flag++;
        }
	 if(requiredValidate('option3',option3Msg)){
            flag++;
        }
	 if(requiredValidate('option4',option4Msg)){
            flag++;
        }
	var radio = $('input[name="option"]:checked').val();

	if(radio == undefined)
	{
	if(requiredValidate('option',optionMsg)){
           flag++;
       }
	}
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
				url:       site_url+'controllers/ajax_controller/assessment-ajax-controller.php',
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
			document.getElementById('err').innerHTML='Question is already exists, Please try another question.';
		}
	}
		$('#form_testadd').unbind('submit').bind('submit',function() {
		});
}
function updatedata(){
	var flag = 0;
	if(requiredValidate('category',categoryMsg)){
						flag++;
				}
	if(requiredValidate('questions',questionsMsg)){
						flag++;
				}
		if(requiredValidate('option1',option1Msg)){
						flag++;
				}
	 if(requiredValidate('option2',option2Msg)){
						flag++;
				}
	 if(requiredValidate('option3',option3Msg)){
						flag++;
				}
	 if(requiredValidate('option4',option4Msg)){
						flag++;
				}
	var radio = $('input[name="option"]:checked').val();

	if(radio == undefined)
	{
	if(requiredValidate('option',optionMsg)){
					 flag++;
			 }
	}
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
				url: site_url + 'controllers/ajax_controller/assessment-ajax-controller.php',
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
