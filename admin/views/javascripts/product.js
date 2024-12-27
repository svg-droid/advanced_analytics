function adddata(){

	var flag = 0;
	var img=$("#txt_addphoto").val();

	if(requiredValidate('AddType',AddTypeMsg)){
       	 flag++;
  		 }
	if(requiredValidate('brand_name',brandMsg)){
		flag++;
	}
	if(requiredValidate('AddCat',categoryMsg)){
		flag++;
	}
	if(requiredValidate('productname',productMsg)){
		flag++;
	}




	if(flag>0){
		return false;
	}else{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+'controllers/ajax_controller/product-ajax-controller.php',
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

		var ArrNames = data.split("_");


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
			document.getElementById('err').innerHTML='Please Enter  price value';
		}else if(data == 4){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML='Please Enter  price value .';
		}
		else if(ArrNames[0]=='empty')
		{
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);
			document.getElementById('succ').innerHTML='Record added successfully.';
			newdata();
			//alert('Please fill quqntity in row '+ArrNames[1]);
		}
		$('#form_cmsadd').unbind('submit').bind('submit',function() {
		});
	}
}



function updatedata(){
	var flag = 0;
	var img=$("#txt_addphoto").val();
	if(requiredValidate('AddType',AddTypeMsg)){
       	 flag++;
  		 }
	if(requiredValidate('brand_name',brandMsg)){
		flag++;
	}
	if(requiredValidate('AddCat',categoryMsg)){
		flag++;
	}
	if(requiredValidate('productname',productMsg)){
		flag++;
	}
	if(flag>0){
		return false;
	}
	else{
		var options = {
			beforeSubmit: showRequest_update,
			success: showResponse_update,
			url: site_url + 'controllers/ajax_controller/product-ajax-controller.php',
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
		alert(data);
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

	function imageDelete(id,cid){
	$.ajax({
		url : site_url+'controllers/ajax_controller/product-ajax-controller.php',
		type : 'post',
		data: 'image_deleted=1&id='+id+'&fk_productid='+cid,
		success : function(result){
			if(result == 1){
				$("#img"+id).fadeOut(2000);
				return false;
			}
		}
	});
}


function getBrandListByType(id){


	$.ajax({
		url : site_url+'controllers/ajax_controller/product-ajax-controller.php',
		type : 'post',
		data: 'getDropDowns=1&id='+id,
		success : function(data){

			$('#brand_name').html($.trim(data));
			$('#AddCat').val('');
		}
	});

 }
 function getCollectionListByBrand(id){


	$.ajax({
		url : site_url+'controllers/ajax_controller/shopnow-ajax-controller.php',
		type : 'post',
		data: 'getCollectionlist=1&id='+id,
		success : function(data){

			$('#AddCat').html($.trim(data));

		}
	});

 }





function getLeftValues(id){


	if($("#power_box_"+id+"").is(":checked")){

		$('#txt_right_product_quantity_'+id+'').val($('#txt_left_product_quantity_'+id+'').val());

		$('#txt_right_price_kuwait_'+id+'').val($('#txt_left_price_kuwait_'+id+'').val());
		$('#txt_right_new_price_kuwait_'+id+'').val($('#txt_left_new_price_kuwait_'+id+'').val());

		$('#txt_right_price_uae_'+id+'').val($('#txt_left_price_uae_'+id+'').val());
		$('#txt_right_new_price_uae_'+id+'').val($('#txt_left_new_price_uae_'+id+'').val());

		$('#txt_right_price_qatar_'+id+'').val($('#txt_left_price_qatar_'+id+'').val());
		$('#txt_right_new_price_qatar_'+id+'').val($('#txt_left_new_price_qatar_'+id+'').val());

		$('#txt_right_price_sa_'+id+'').val($('#txt_left_price_sa_'+id+'').val());
		$('#txt_right_new_price_sa_'+id+'').val($('#txt_left_new_price_sa_'+id+'').val());

		$('#txt_right_price_bahrain_'+id+'').val($('#txt_left_price_bahrain_'+id+'').val());
		$('#txt_right_new_price_bahrain_'+id+'').val($('#txt_left_new_price_bahrain_'+id+'').val());



	}else{

		$('#txt_right_product_quantity_'+id+'').val('');

		$('#txt_right_price_kuwait_'+id+'').val('');
		$('#txt_right_new_price_kuwait_'+id+'').val('');

		$('#txt_right_price_uae_'+id+'').val('');
		$('#txt_right_new_price_uae_'+id+'').val('');

		$('#txt_right_price_qatar_'+id+'').val('');
		$('#txt_right_new_price_qatar_'+id+'').val('');

		$('#txt_right_price_sa_'+id+'').val('');
		$('#txt_right_new_price_sa_'+id+'').val('');

		$('#txt_right_price_bahrain_'+id+'').val('');
		$('#txt_right_new_price_bahrain_'+id+'').val('');

	}
}


function addNewRow(){


	var rowCount = $('#table_row_count').val();
	var new_row_count = parseInt(rowCount) + 1;

	var checkEmpty = $('#power_attributes_'+rowCount).val();

	if(checkEmpty==""){
		alert("please enter values in above row.");
	}else{

		$.ajax( {
			url : site_url+'controllers/ajax_controller/product-ajax-controller.php',
			type : 'post',
			data: 'get_new_row=1&rowCount='+rowCount,
			success : function(result)
			{

				$('#power_attributes_table').append(result);
				$('#add_row_btn').remove();
				if(rowCount==4){
					$('#remove_btn_4').remove();
				}
				$('#remove_btn_'+rowCount).show();
				$('#table_row_count').val(new_row_count);

			}
		});

	}


}

function removeRow(tr_id){
	$('#row_'+tr_id).remove();
}


function deleteRow(tr_id, left_id, right_id){


	var r = confirm("Are you sure to want to delete this row?");

	if (r == true) {

	   	$.ajax( {
			url : site_url+'controllers/ajax_controller/product-ajax-controller.php',
			type : 'post',
			data: 'delete_attributes_row=1&left_id='+left_id+'&right_id='+right_id,
			success : function(result)
			{
				$('#row_'+tr_id).remove();
			}
		});

	} else {

	}

}
