<?php 
    @session_start();
	include('../../models/db.php');
	include('../../models/common-model.php');
	include('../../includes/thumb_new.php');
	include('../common-controller.php');
	$database = new Connection();
	include('../../models/ajax-model.php');
	$modelObj = new AjaxModel();
?>
<?php 

if(isset($_POST['getpassword']) && $_POST['getpassword'] != '')
{
	$password=md5($_POST['password']);
	$qry = "SELECT * FROM admin where adminid='".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."'";
	$result = $modelObj -> fetchRow($qry);
	$oldpassword=$result['password'];
	if($password == $oldpassword)
	{
		echo "1";
	}
	else
	{
		echo '0';
	}
}
if(isset($_POST['hid_add']) && $_POST['hid_add'] != '')
{
	$update_admin="update admin set password='".md5($_POST['txt_newpassword'])."' where adminid='".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."'";
	$qry=$modelObj->runQuery($update_admin);
	if($qry)
	{ 
		echo "1";
	}
	else
	{
		echo "2";
	}
}
?>

<?php

	if(isset($_POST['viewdiv']) && $_POST['viewdiv'] != '')
	{
?>

	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
		  <div class="heading">
			<i class="icon-reorder"></i>Change Password
		  </div>
		  <div class="widget-content padded">
			<form name="form_changepassword" id="form_changepassword" method="post" enctype="multipart/form-data" action="#" class="form-horizontal" >
			  
			<div class="form-group">
			 <label class="control-label col-md-2">Old Password</label>
			  <div class="col-md-5">
				<input type="password" class="form-control"  name="txt_oldpassword" id="txt_oldpassword"  onblur="checkpassword(this.value);" />
				<span id="error_txt_oldpassword" style="color:red" class="error_label"></span>
			 </div>
		   </div>  
			
			<div class="form-group">
			 <label class="control-label col-md-2">New Password</label>
			  <div class="col-md-5">
				<input type="password" class="form-control"  name="txt_newpassword" id="txt_newpassword" value=""/>
				<span id="error_txt_newpassword" style="color:red" class="error_label"></span>
			</div>
		   </div>
			<div class="form-group">
			 <label class="control-label col-md-2">Confirm Password</label>
			  <div class="col-md-5">
				<input type="password" class="form-control"  name="txt_addcnfrmpassword" id="txt_addcnfrmpassword" />
				<span id="error_txt_addcnfrmpassword" style="color:red" class="error_label"></span>
			 </div>
		   </div>
		   <div class="form-group">
				<label class="control-label col-md-2"></label>
				<div class="col-md-7">
					<input type="hidden" name="hid_add" id="hid_add" value="add" />
					<input type="hidden" name="h_password" id="h_password" value="" />	
					<button type="submit" class="btn btn-primary" value="Submit" name="btn_save" onclick="return adddata()">Submit</button>
					<button type="reset" value="Reset" class="btn btn-default-outline" >Reset</button>
				</div>
			  </div>
			  
			</form>
		  </div>
		</div>
	</div>
<?php  
	} 
?>