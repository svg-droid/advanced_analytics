<?php
							/* $id=$_SESSION['UNIVERSITY_ID']['ADMIN_ID'];
							$qry1=mysql_query("SELECT * FROM admin where adminid='".mysql_real_escape_string($id)."'");
							$result=mysql_fetch_array($qry1);
							$keywordata=explode(",",$result['module']);
							foreach($keywordata as $k => $data){
							$selectkeyword=mysql_query("SELECT id,module FROM tbl_module WHERE status=1 AND id='".$data."'");
							$data1=mysql_fetch_array($selectkeyword);
							$my_Module[] = $data1['module'];
							}
if(($_SESSION['UNIVERSITY_USERTYPE']['USER_TYPE']==1 || $_SESSION['UNIVERSITY_USERTYPE']['USER_TYPE']==2) && in_array("employeemanagement",$my_Module)){ */ ?>


<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/editprofile.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/js/jquery.form.js"></script>
<script type="application/javascript">
	function showhidepassword(){
		$("#pwdLink").toggle();
	}
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	   	return true;
	}
</script>
<div class="page-title"><h1>Edit Profile Management</h1></div>
<?php $qry="SELECT * FROM admin WHERE adminid='".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' And user_type!=3";
	$data=$model_class->fetchRow($qry);	?>
<?php $_SESSION['pid'] =$_GET['pid']; ?>
<div class="row" id="<?php echo $_GET['pid']; ?>" >
<div class="col-lg-12">
	<div class="widget-container fluid-height clearfix">
		<div class="heading">
		<i style="cursor:default;" class="icon-reorder"></i><?php if($_SESSION['TERRATROVE_ID']['ADMIN_ID']!=0){ ?> Update Edit Profile <?php } else { ?> Add Edit Profile <?php } ?></div>
		<div class="widget-content padded">
		<form name="form_adminadd" id="form_adminadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal" >

           <div class="form-group">
            <label class="control-label col-md-2">First Name <font class="required_mark" color="red">*</font></label>
            <div class="col-md-7">
              <input class="form-control" type="text" name="txt_addfirstname" id="txt_addfirstname" value="<?php echo urldecode($data['firstname']); ?>"/>
			  <span id="error_txt_addfirstname" style="color:red" class="error_label"></span>
            </div>
          </div>

		 <div class="form-group">
            <label class="control-label col-md-2">Last Name <font class="required_mark" color="red">*</font></label>
            <div class="col-md-7">
              <input class="form-control" type="text" name="txt_addlastname" id="txt_addlastname" value="<?php echo urldecode($data['lastname']);?>"/>
			  <span id="error_txt_addlastname" style="color:red" class="error_label"></span>
            </div>
          </div>

		  <div class="form-group">
            <label class="control-label col-md-2">Username <font class="required_mark" color="red">*</font></label>
            <div class="col-md-7">
              <input class="form-control" type="text" name="txt_addusername" id="txt_addusername" value="<?php echo $data['username']; ?>"/>
			  <span id="error_txt_addusername" style="color:red" class="error_label"></span>
            </div>
          </div>

		  <div class="form-group">
            <label class="control-label col-md-2">Email Address <font class="required_mark" color="red">*</font></label>
            <div class="col-md-7">
              <input class="form-control" type="text" name="txt_addemail" id="txt_addemail" value="<?php echo urldecode($data['email']); ?>"/>
			  <span id="error_txt_addemail" style="color:red" class="error_label"></span>
            </div>

          </div>
		<?php if($_SESSION['TERRATROVE_ID']['ADMIN_ID'] !=0) { ?>
			<div class="form-group">
				<label class="control-label col-md-2"></label>
				<div class="col-md-7">
					<a href="javascript:void()" onclick="showhidepassword();">Change Password</a>
				</div>
			</div>
			<div style="display:none;" id="pwdLink">
			<div class="form-group">
			 <label class="control-label col-md-2">New Password <font class="required_mark" color = "red">*</font></label>
			  <div class="col-md-7">
				<input type="password" class="form-control" maxlength="20" name="txt_addpassword" id="txt_addpassword" value="" />
				<span id="error_txt_addpassword" style="color:red" class="error_label"></span>
			</div>
			</div>
		    <div class="form-group">
				<label class="control-label col-md-2">Confirm Password <font class="required_mark" color = "red">*</font></label>
			  <div class="col-md-7">
				<input type="password" class="form-control" maxlength="20" name="txt_addcnfrmpassword" id="txt_addcnfrmpassword" value="" />
				<span id="error_txt_addcnfrmpassword" style="color:red" class="error_label"></span>
			 </div>
			</div>
			<input type="hidden" name="hid_userpid" id="hid_userpid" value="<?php echo $data['adminid']; ?>" />
			</div>
	   <?php } else { ?>
			<div class="form-group">
			 <label class="control-label col-md-2">Password <font class="required_mark" color = "red">*</font></label>
			  <div class="col-md-7">
				<input type="password" class="form-control" maxlength="20" name="txt_addpassword" id="txt_addpassword" />
				<span id="error_txt_addpassword" style="color:red" class="error_label"></span>
			</div>
			</div>
		    <div class="form-group">
			<label class="control-label col-md-2">Confirm Password <font class="required_mark" color = "red">*</font></label>
			  <div class="col-md-7">
				<input type="password" class="form-control" maxlength="20" name="txt_addcnfrmpassword" id="txt_addcnfrmpassword" />
				<span id="error_txt_addcnfrmpassword" style="color:red" class="error_label"></span>
			 </div>
		   </div>
		<?php } ?>
			<div class="form-group">
            <label class="control-label col-md-2">Profile Picture </label>
            <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
					<?php if($data['image']== '' ){?>
					<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
					<?php } else { ?>
					<img width="200px" height="150px" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>upload/admin_profile/<?php echo $data['image'];?>">
					<?php } ?>
					<input type="hidden" id="userPicture" name="userPicture" value='<?php echo $data['image'];?>'>
				</div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px;"></div>
                <div>
					<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
					<input type="file" id="txt_addlogo" name="txt_addlogo" accept="image/*">
					</span>
				</div>
			</div>
			<span id="error_txt_addlogo" style="color:red" class="error_label"></span>
            </div>
          </div>

		<?php if($_SESSION['TERRATROVE_ID']['ADMIN_ID'] !=0): ?>
		<div class="form-group">
			<label class="control-label col-md-2"></label>
			<div class="col-md-7">
				<input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $_SESSION['TERRATROVE_ID']['ADMIN_ID']; ?>" />
				<input type="hidden" name="hid_update" id="hid_update" value="update" />
				<button type="submit" class="btn btn-primary" onclick="return updatedata()">Submit</button>
			<!--	<button type="button" class="btn btn-default-outline" onclick="newdata();">Cancel</button> -->
			<a href="index.php?pid=viewprofile">	<button type="button" class="btn btn-default-outline">Cancel</button></a>
			</div>
		</div>
		<?php else: ?>
		<div class="form-group">
			<label class="control-label col-md-2"></label>
			<div class="col-md-7">
				<input type="hidden" name="hid_add" id="hid_add" value="add" />
				<button type="submit" class="btn btn-primary" onclick="return adddata()">Submit</button>
				<button type="button" class="btn btn-default-outline" onclick="newdata();">Cancel</button>
			</div>
		</div>
		<?php endif; ?>
		</form>
	  </div>
	</div>
</div>
</div>
