<div class="page-title"><h1>View Profile Management</h1></div>
<?php
	$qry="SELECT * FROM admin WHERE adminid='".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' and user_type!=3";
	$data=$model_class->fetchRow($qry);	?>
<div class="row" id="<?php echo $_GET['pid']; ?>" >
<div class="col-lg-12">
	<div class="widget-container fluid-height clearfix">
		<div class="heading">
		<i style="cursor:default;" class="icon-reorder"></i><?php if($_SESSION['TERRATROVE_ID']['ADMIN_ID']!=0){ ?>View Profile <?php } else { ?>View Profile <?php } ?></div>
		<div class="widget-content padded">
			<form name="form_adminadd" id="form_adminadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal" >
           <div class="form-group">
            <label class="control-label col-md-2">First Name : </label>
            <div class="col-md-7">
				<label class="control-label col-md-2"><?php echo urldecode($data['firstname']); ?> </label>
            </div>
          </div>


		 <div class="form-group">
            <label class="control-label col-md-2">Last Name : </label>
            <div class="col-md-7">
				<label class="control-label col-md-2"><?php echo urldecode($data['lastname']); ?> </label>
            </div>
          </div>

		  <div class="form-group">
            <label class="control-label col-md-2">Username : </label>
            <div class="col-md-7">
				<label class="control-label col-md-2"><?php echo $data['username']; ?> </label>
            </div>
          </div>

		  <div class="form-group">
            <label class="control-label col-md-2">Email Address : </label>
            <div class="col-md-7">
				<label class="control-label col-md-2"><?php echo urldecode($data['email']); ?> </label>
            </div>
          </div>

			<div class="form-group">
            <label class="control-label col-md-2">Profile Picture : </label>
            <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
					<?php if($data['image']== '' ){?>
					<img src="<?php echo $_SESSION['ADMIN_DOMAIN_NAME'];?>images/default.png">
					<?php } else { ?>
					<img width="200px" height="150px" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>upload/admin_profile/<?php echo $data['image'];?>">
					<?php } ?>
					<input type="hidden" id="userPicture" name="userPicture" value='<?php echo $data['image'];?>'>
				</div>
			</div>
            </div>
          </div>
		  </form>
	  </div>
	</div>
</div>
</div>
