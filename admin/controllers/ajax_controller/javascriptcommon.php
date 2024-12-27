<?php
$ourFileName2 = $_SESSION['APP_PATH']."views/javascripts/".strtolower($_POST['txt_pageid'])."scripts.js";
if(!file_exists($ourFileName2))
{
	$ourFileHandle2 = fopen($ourFileName2, 'w');
	$stringData = 'function searching(){
	var alpha = /^[a-zA-Z]+$/;
	var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	$("#searchmsg").html(\'\');
	var flag = 0;
	var regflag = 0;';
	$j=0;
	foreach($myarray as $k => $tablefields)
	{
		$j++;
		if(preg_match("/country/i", $tablefields['Field']) || preg_match("/state/i", $tablefields['Field']) || preg_match("/city/i", $tablefields['Field']) || preg_match("/zip/i", $tablefields['Field']) || preg_match("/image/i", $tablefields['Field']) || preg_match("/description/i", $tablefields['Field']) || preg_match("/date/i", $tablefields['Field']))
		{
			$stringData .='';
			$j=$j-1;
		}
		else
		{
			if($j==1)
			{
				$stringData .='if($("#txt_src'.$tablefields['Field'].'").val() == \'\'';
			}
			else
			{
				$stringData .=' && $("#txt_src'.$tablefields['Field'].'").val() == \'\'';
			}
		}
	}
	$stringData .=')';
	$stringData .='{
		flag = 1;
	}
	if(flag == 1){
		parent.$.fancybox.close();
		$("#search").val(\'0\');
		newdata();
	}
	else
	{
		if(regflag == 0)
		{
			$("#searchmsg").html(\'\');
			var options = {
				beforeSubmit:  showRequest,
				success:       showResponse_search,
				url:       site_url+\'controllers/ajax_controller/'.strtolower($_POST['txt_pageid']).'-ajax-controller.php\', 
				type: "POST"
			};
			$(\'#form_search\').submit(function()
			{
				$(this).ajaxSubmit(options);				
				return false;
			});
		}
	 }
	}
	function showResponse_search(data, statusText)  {
		if (statusText == \'success\') {
			parent.$.fancybox.close();
			$("#'.strtolower($_POST['txt_pageid']).'").html(data);
		} 
	}
	function adddata(){
	var alpha = /^[a-zA-Z]+$/;
	var alphanum = /^[a-zA-Z0-9]+$/;
	var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	var mobnum=/^[0-9]{10,12}$/;
	var phonum=/^[0-9]{10,14}$/;
	var num=/^[0-9]$/;
	var decnum=/^[0-9.]$/;
	var domain=/[^,\s]+\.{1,}[^,\s]{2,}/;
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;';
	
	
	$j=0;
	foreach($myarray as $k => $tablefields)
	{
		$j++;
		if($j==1)
		{
			if(preg_match("/email/i", $tablefields['Field']))
			{
				$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(emailchk.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Invalid email id\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else if($tablefields['Field']=='password')
			{
				$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(alphanum.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Invalid password\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val().length < 6){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Minimum 6 character required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if($("#txt_addc'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_addc'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_addc'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_addc'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if($("#txt_addc'.$tablefields['Field'].'").val() != $("#txt_add'.$tablefields['Field'].'").val()){
				  $("#error-innertxt_addc'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_addc'.$tablefields['Field'].'").html(\'Confirm password not match\');
				  $("#txt_addc'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else if(preg_match("/int/i", $tablefields['Type']))
			{
				if(preg_match("/country/i", $tablefields['Field']) || preg_match("/state/i", $tablefields['Field']) || preg_match("/city/i", $tablefields['Field']) || preg_match("/zipcode/i", $tablefields['Field']))
				{
					$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
				}
				else
				{
					$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
					$stringData .= 'else if(mobnum.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Enter correct number\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
				}
			}
			else if(preg_match("/decimal/i", $tablefields['Type']))
			{
				$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(decnum.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Enter correct number\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else if(preg_match("/description/i", $tablefields['Field']) || preg_match("/ref_id/i", $tablefields['Field']))
			{
				$stringData .= '';
				$j=$j-1;
			}
			else if(preg_match("/website/i", $tablefields['Field']))
			{
				$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(url.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Invalid website\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else
			{
				$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
		}
		else
		{
			if(preg_match("/email/i", $tablefields['Field']))
			{
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(emailchk.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Invalid email id\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else if($tablefields['Field']=='password')
			{
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(alphanum.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Invalid password\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val().length < 6){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Minimum 6 character required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if($("#txt_addc'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_addc'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_addc'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_addc'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if($("#txt_addc'.$tablefields['Field'].'").val() != $("#txt_add'.$tablefields['Field'].'").val()){
				  $("#error-innertxt_addc'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_addc'.$tablefields['Field'].'").html(\'Confirm password not match\');
				  $("#txt_addc'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else if(preg_match("/int/i", $tablefields['Type']))
			{
				if(preg_match("/country/i", $tablefields['Field']) || preg_match("/state/i", $tablefields['Field']) || preg_match("/city/i", $tablefields['Field']) || preg_match("/zipcode/i", $tablefields['Field']))
				{
					$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
				}
				else
				{
					$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
					$stringData .= 'else if(mobnum.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Enter correct number\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
				}
			}
			else if(preg_match("/decimal/i", $tablefields['Type']))
			{
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(decnum.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Enter correct number\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else if(preg_match("/description/i", $tablefields['Field']) || preg_match("/ref_id/i", $tablefields['Field']))
			{
				$stringData .= '';
				$j=$j-1;
			}
			else if(preg_match("/website/i", $tablefields['Field']))
			{
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(url.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Invalid website\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else
			{
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
		}		
	}
	
	$stringData .= 'else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+\'controllers/ajax_controller/'.strtolower($_POST['txt_pageid']).'-ajax-controller.php\', 
			type: "POST"
		};
		$(\'#form_'.strtolower($_POST['txt_pageid']).'add\').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});
	}
	}
	function showRequest(formData, jqForm, options) {
		return true;
	}
	function showResponse(data, statusText)  {
	if(statusText == \'success\')
	{
		if(data == 0)
		{
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById(\'err\').innerHTML = \''.ucfirst(strtolower($_POST['txt_pageid'])).' already exist. Please try another.\';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);		   
			document.getElementById(\'succ\').innerHTML = \''.ucfirst(strtolower($_POST['txt_pageid'])).' added successfully.\';
			newdata();				 
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById(\'err\').innerHTML = \'Some error occurred while adding '.strtolower($_POST['txt_pageid']).'.\';
		}
		$(\'#form_'.strtolower($_POST['txt_pageid']).'add\').unbind(\'submit\').bind(\'submit\',function() {
		});
	}
	}
	function updatedata(){
	var alpha = /^[a-zA-Z]+$/;
	var alphanum = /^[a-zA-Z0-9]+$/;
	var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	var mobnum=/^[0-9]{10,12}$/;
	var phonum=/^[0-9]{10,14}$/;
	var num=/^[0-9]$/;
	var decnum=/^[0-9.]$/;
	var domain=/[^,\s]+\.{1,}[^,\s]{2,}/;
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;';
	
	$j=0;
	foreach($myarray as $k => $tablefields)
	{
		$j++;
		if($j==1)
		{
			if(preg_match("/email/i", $tablefields['Field']))
			{
				$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(emailchk.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Invalid email id\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else if(preg_match("/int/i", $tablefields['Type']))
			{
				if(preg_match("/country/i", $tablefields['Field']) || preg_match("/state/i", $tablefields['Field']) || preg_match("/city/i", $tablefields['Field']) || preg_match("/zipcode/i", $tablefields['Field']))
				{
					$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
				}
				else
				{
					$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
					$stringData .= 'else if(mobnum.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Enter correct number\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
				}
			}
			else if(preg_match("/decimal/i", $tablefields['Type']))
			{
				$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(decnum.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Enter correct number\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else if(preg_match("/description/i", $tablefields['Field']) || preg_match("/ref_id/i", $tablefields['Field']))
			{
				$stringData .= '';
				$j=$j-1;
			}
			else if(preg_match("/website/i", $tablefields['Field']))
			{
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(url.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Invalid website\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else
			{
				$stringData .= 'if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
		}
		else
		{
			if(preg_match("/email/i", $tablefields['Field']))
			{
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(emailchk.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Invalid email id\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else if(preg_match("/int/i", $tablefields['Type']))
			{
				if(preg_match("/country/i", $tablefields['Field']) || preg_match("/state/i", $tablefields['Field']) || preg_match("/city/i", $tablefields['Field']) || preg_match("/zipcode/i", $tablefields['Field']))
				{
					$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
				}
				else
				{
					$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
					$stringData .= 'else if(mobnum.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
					  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
					  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Enter correct number\');
					  $("#txt_add'.$tablefields['Field'].'").focus();
					  return false;
					}';
				}
			}
			else if(preg_match("/decimal/i", $tablefields['Type']))
			{
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(decnum.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Enter correct number\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else if(preg_match("/description/i", $tablefields['Field']) || preg_match("/ref_id/i", $tablefields['Field']))
			{
				$stringData .= '';
				$j=$j-1;
			}
			else if(preg_match("/website/i", $tablefields['Field']))
			{
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
				$stringData .= 'else if(url.test($("#txt_add'.$tablefields['Field'].'").val()) == false){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'Invalid website\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
			else
			{
				$stringData .= 'else if($("#txt_add'.$tablefields['Field'].'").val() == \'\'){
				  $("#error-innertxt_add'.$tablefields['Field'].'").show().fadeOut(5000);
				  $("#error-innertxt_add'.$tablefields['Field'].'").html(\'This field is required\');
				  $("#txt_add'.$tablefields['Field'].'").focus();
				  return false;
				}';
			}
		}		
	}
	$stringData .= 'else
	{
	   var options = {
			beforeSubmit:  showRequest_update,
			success:       showResponse_update,
			url:       site_url+\'controllers/ajax_controller/'.strtolower($_POST['txt_pageid']).'-ajax-controller.php\', 
			type: "POST"
		};
		$(\'#form_'.strtolower($_POST['txt_pageid']).'add\').submit(function() {
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
		if (statusText == \'success\') 
		{
			if(data == 0){
				$.scrollTo(0,500);
				$("#message-red").show().fadeOut(7000);
				$("#message-green").hide();
				document.getElementById(\'err\').innerHTML = \''.ucfirst(strtolower($_POST['txt_pageid'])).' already exist. Please try another.\';
			}else if(data == 1){
				$("#message-red").hide();
				$("#message-green").show().fadeOut(5000);				
				document.getElementById(\'succ\').innerHTML = \''.ucfirst(strtolower($_POST['txt_pageid'])).' updated successfully.\';
				newdata();
			}else if(data == 2){
				$.scrollTo(0,500);
				$("#message-red").show().fadeOut(7000);
				$("#message-green").hide();
				document.getElementById(\'err\').innerHTML = \'Some error occurred while updating '.strtolower($_POST['txt_pageid']).'.\';
			}
		}
		$(\'#form_'.strtolower($_POST['txt_pageid']).'add\').unbind(\'submit\').bind(\'submit\',function() {
		});
	}';
	if($states=="yes")
	{
		$stringData .='function getStates(){ 
			$("#message-red").hide();	
			$("#message-green").hide(); 
			$("#'.$cityy_name.'").html("<option value=\'\'>Select City</option>");
			$("#'.$zipp_name.'").html("<option value=\'\'>Select Zipcode</option>");
			var abc=$("#'.$countryy_name.'").val();
			$.ajax( {
				url : site_url+\'controllers/ajax_controller/'.strtolower($_POST['txt_pageid']).'-ajax-controller.php\', 
				type : \'post\',
				data: \'getstateid=\'+abc,				
				success : function( resp ) {
					$("#stateajax").html(resp);
				}
			});
		}';
	}
	if($cityy=="yes")
	{	
		$stringData .='function getCities(){ 
			$("#message-red").hide();	
			$("#message-green").hide();      
			$("#'.$zipp_name.'").html("<option value=\'\'>Select Zipcode</option>");
			var abc=$("#'.$states_name.'").val();
			$.ajax( {
				url : site_url+\'controllers/ajax_controller/'.strtolower($_POST['txt_pageid']).'-ajax-controller.php\', 
				type : \'post\',
				data: \'getcityid=\'+abc,				
				success : function( resp ) {
					$("#cityajax").html(resp);
				}
			});
		}';
	}
	if($zipp=="yes")
	{
		$stringData .='function getZipCode(){ 
			$("#message-red").hide();	
			$("#message-green").hide();      
			var abc=$("#'.$cityy_name.'").val();
			$.ajax( {
				url : site_url+\'controllers/ajax_controller/'.strtolower($_POST['txt_pageid']).'-ajax-controller.php\', 
				type : \'post\',
				data: \'getzcodeid=\'+abc,				
				success : function( resp ) {
					$("#zcodeajax").html(resp);
				}
			});
		}';
	}
	fwrite($ourFileHandle2, $stringData);
	fclose($ourFileHandle2);
}
?>