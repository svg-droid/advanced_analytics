<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/changepasswordscripts.js?<?php echo time(); ?>"></script>
<div id="<?php echo $_GET['pid']; ?>" >
<div class="col-lg-12">
<div class="widget-container fluid-height clearfix">
	<div class="heading"><i class="icon-reorder"></i>Change Password</div>
	<div class="widget-content padded">
	<form name="form_changepassword" id="form_changepassword" method="post" enctype="multipart/form-data" action="" class="form-horizontal" >
		<div class="form-group">
			<label class="control-label col-md-2">Old Password <font class="required_mark" color="red">*</font></label>
			<div class="col-md-5">
			<input type="password" class="form-control" name="txt_oldpassword" id="txt_oldpassword" onblur="checkpassword(this.value);" />
			<span id="error_txt_oldpassword" style="color:red" class="error_label"></span>
			</div>
		</div>  
		<div class="form-group">
			<label class="control-label col-md-2">New Password <font class="required_mark" color="red">*</font></label>
			<div class="col-md-5">
			<input type="password" class="form-control"  name="txt_newpassword" id="txt_newpassword"/>
			<span id="error_txt_newpassword" style="color:red" class="error_label"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Confirm Password <font class="required_mark" color="red">*</font></label>
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
</div>