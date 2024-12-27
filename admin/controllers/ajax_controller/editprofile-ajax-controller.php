<?php
    @session_start();
    include('../../models/db.php');
    include('../../models/common-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
    $database = new Connection();
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
    $controller_class = new CommonController();
    $upload_dir =$_SESSION['SITE_IMG_PATH']."admin_profile/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."admin_profile/thumb/";

if(isset($_POST['view']) && $_POST['view']!=''):
    $id=$_POST['id'];
    $qry="SELECT * FROM admin where adminid='".$id."' And user_type!='3'";
    $result=$modelObj->fetchRow($qry);
	if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==1){ $IMARFLAG=1; }
?>
<div class="col-md-12">
    <div class="widget-content padded">
		<!-- <dl><b>Admin Type : </b> <?php echo $result['user_type']==1 ? 'SUPER ADMIN' : 'SUB ADMIN'; ?> </dl> -->
		<dl><b>First Name : </b> <?php echo urldecode($result['firstname']); ?> </dl>
		<dl><b>Last Name : </b> <?php echo urldecode($result['lastname']); ?> </dl>
		<dl><b>User Name : </b> <?php echo urldecode($result['username']); ?> </dl>
		<dl><b>Email : </b> <?php echo urldecode($result['email']); ?> </dl>
	<?php if($_SESSION['TERRATROVE_ID']['ADMIN_ID']!=1){ ?>
		<dl><b>Phone Number : </b> <?php echo $result['phone']; ?> </dl>
		<dl><b>Address : </b> <?php echo urldecode($result['address']); ?> </dl>
	<?php } ?>
		<?php if($result['image']!=''){ ?>
		<dl><b>Profile Picture : </b> <img width="50" height="50" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>/upload/admin_profile/<?php echo $result['image'];?>" alt="No Image Found"/></dl>
		<?php } ?>
		<?php if($IMARFLAG==1){ ?>
		<dl><b>Login Date : </b> <?php echo $result['logindate']; ?> </dl>
		<dl><b>Created Date : </b> <?php echo $result['Created_date']; ?> </dl>
		<dl><b>Modified Date : </b> <?php echo $result['Modify_date']; ?> </dl>
		<?php } ?>
	</div>
  </div>
<?php endif; ?>


<?php

if(isset($_REQUEST['action']) && $_REQUEST['action'] == "displaydata"){

  $iDisplayStart = $_REQUEST['iDisplayStart'];
  $iDisplayLength = $_REQUEST['iDisplayLength'];
  $sSearch = urlencode($_REQUEST['sSearch']);
  $sSortDir_0 = $_REQUEST['sSortDir_0'];
  if($sSortDir_0=='asc'){
   $SortBy = 'asc';
  }else{
   $SortBy = 'desc';
  }
  $TotalCountqry = $modelObj->numRows("SELECT * FROM admin WHERE status!=2 AND user_type=2");

  $Filteredqry = $modelObj->numRows("SELECT * FROM admin WHERE user_type=2 and status!=2 and (email LIKE '%".$sSearch."%' OR firstname LIKE '%".$sSearch."%' OR lastname LIKE '%".$sSearch."%' OR username LIKE '%".$sSearch."%' OR email LIKE '%".$sSearch."%')");


	if($sSearch!=''){

		$list_activity_log = $modelObj->fetchRows("SELECT * FROM admin WHERE status!=2 AND user_type=2 AND (email LIKE '%".$sSearch."%' OR firstname LIKE '%".$sSearch."%' OR lastname LIKE '%".$sSearch."%' OR username LIKE '%".$sSearch."%' OR email LIKE '%".$sSearch."%') ORDER BY adminid ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");

	} else {

		$list_activity_log = $modelObj->fetchRows("SELECT * FROM admin WHERE user_type=2 AND status!=2 ORDER BY adminid ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
	}


  $dataMsg = '';
  $Arr['sEcho'] = $_REQUEST['sEcho'];
  $Arr['iTotalRecords'] = $TotalCountqry;
  $Arr['iTotalDisplayRecords'] = $Filteredqry;
  $Arr['aaData'] = array();
  foreach($list_activity_log as $result){
	$user_type = $result['user_type'];
   $manager_id = $result['adminid'];
   $first_name = urldecode($result['firstname']);
   $last_name = urldecode($result['lastname']);
   $username = urldecode($result['username']);
   $email = urldecode($result['email']);
   $user_status = $result['status'];

		$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$manager_id.'"><span></span></label></td>';

		/* if($user_type==1){
		 $utype='<td>Super Admin</td>';
		} else {
		$utype='<td>Sub Admin</td>';
		} */


		$fname='<td>'.$first_name.'</td>';
		$lname='<td>'.$last_name.'</td>';
		$uname='<td>'.$username.'</td>';
		$uemail='<td>'.$email.'</td>';

		if($user_status==1){
		 $status='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
		} else {
		$status='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
		}


		$option='<td class="actions">
					<div class="action-buttons">
						<a class="table-actions" href="javascript:void(0)" onclick="view('.$manager_id.')" title="View">
						  <i class="icon-eye-open"></i>
						</a>

				<a class="table-actions" href="javascript:void(0)" onclick="edit('.$manager_id.',\'editprofile\')">
						 <i class="icon-pencil"></i>
						</a>

				<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$manager_id.')" title="Delete">
                           <i class="icon-trash"></i>
						</a>

			</div>
				</td>';






   $Arr['aaData'][] = array($checkbox,$fname,$lname,$uname,$uemail,$status,$option);
  }

  echo json_encode($Arr);
 }

 ?>


<?php
	if(isset($_POST['statusactive']) && $_POST['statusactive'] != ''){
		$id=explode("," ,$_POST['active']);
		foreach($id as $k => $val){
			$qry="UPDATE admin SET status=1 WHERE adminid=".$val;
			$result=$modelObj->runQuery($qry);
		}
	}
?>
<?php
	if(isset($_POST['statusinactive']) && $_POST['statusinactive'] != ''){
		$id=explode("," ,$_POST['inactive']);
		foreach($id as $k => $val){
			$qry="UPDATE admin SET status=0 WHERE adminid=".$val;
			$result=$modelObj->runQuery($qry);
		}
	}
?>
<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE admin SET status=2 WHERE adminid='".$val."'";
			$result=$modelObj->runQuery($qry);
		}
	}
?>
<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){

		$checkexists="SELECT adminid FROM admin WHERE email='".trim($_POST['txt_addemail'])."' and status!=2";
		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists!=0){
				$flag=0;
				echo '0';
			}else{
				/* $checkexists1="SELECT id FROM tbl_users_account where status!=2 and email='".$_POST['txt_addemail']."'";
				$result_checkexists1=$modelObj->numRows($checkexists1);
				if($result_checkexists1!=0){
					$flag=0;
					echo '0';
				}else{ */
					$flag=1;

				/* } */
			}




		if($flag==1){
			if(!dir($upload_dir)){
				mkdir($upload_dir);
			}
			if(!dir($upload_dirthumb)){
				mkdir($upload_dirthumb);
			}

			if(isset($_FILES["txt_addlogo"]["tmp_name"])){
				$tmpfile=$_FILES["txt_addlogo"]["tmp_name"];
				$newname=$_FILES["txt_addlogo"]["name"];
				$insertimage='';
				if($_FILES["txt_addlogo"]["tmp_name"] != ''){
					/* $insertimage=time().$newname;
					$insertimage=str_replace(" ", "_" , $insertimage); */
					$type=substr($newname,strrpos($newname,'.')+0);
					$insertimage='VEN'.time().$type;
					/* list($width, $height, $type, $attr) = getimagesize($tmpfile); */
					if(move_uploaded_file($tmpfile, $upload_dir.$insertimage)){
						if($width >= 50 || $height >= 50){
							$resizeObj_50 = new resize($upload_dir.$insertimage);
							$resizeObj_50 -> resizeImage(50, 50, 'exact');
							$resizeObj_50 -> saveImage($upload_dirthumb.$insertimage,$upload_dir.$insertimage, 100);
						}else{
							$resizeObj_50 = new resize($upload_dir.$insertimage);
							$resizeObj_50 -> resizeImage($width, $height, 'exact');
							$resizeObj_50 -> saveImage($upload_dirthumb.$insertimage,$upload_dir.$insertimage, 100);
						}
					}
				}
			}

			$post['firstname']=urlencode($_POST['txt_addfirstname']);
			$post['lastname']=urlencode($_POST['txt_addlastname']);
			$post['username']=urlencode($_POST['txt_addusername']);
			$post['password']=md5($_POST['txt_addpassword']);
			$post['email']=urlencode($_POST['txt_addemail']);
			$post['phone']=$_POST['txt_addphone'];
			$post['address']=urlencode($_POST['txt_addaddress']);
			$post['image']=$insertimage;
			$post['user_type']='2';
			$post['status']='1';
			$post['Created_date']=date("Y-m-d H:i:s", time());
			$post['Modify_date']=date("Y-m-d H:i:s", time());
			$post['ip_address']=$_SERVER['REMOTE_ADDR'];
			$addMyData=$controller_class->addData('admin',$post);
			echo "1";
		}
	}
?>
<?php
	if(isset($_POST['statusid']) && $_POST['statusid'] != ''){
		$qry="UPDATE admin SET status=".$_POST['status']." WHERE adminid=".$_POST['statusid'];
		$result=$modelObj->runQuery($qry);
	}
?>
<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){

		$checkexists="SELECT adminid FROM admin WHERE email='".trim($_POST['txt_addemail'])."' and status!=2 and adminid!=".$_POST['hid_userid']."";
		$result_checkexists=$modelObj->numRows($checkexists);
    $result_checkexists = 0;
		if($result_checkexists!=0){
				$flag=0;
				echo '0';
			}else{
				/* $checkexists1="SELECT id FROM tbl_users_account where status!=2 and email='".$_POST['txt_addemail']."'";
				$result_checkexists1=$modelObj->numRows($checkexists1);
				if($result_checkexists1!=0){
					$flag=0;
					echo '0';
				}else{ */
					$flag=1;

				/* } */
			}


		if($flag==1){
			$flag=1;
			if(!dir($upload_dir)){
				mkdir($upload_dir);
			}
			if(!dir($upload_dirthumb)){
				mkdir($upload_dirthumb);
			}
			if(isset($_FILES["txt_addlogo"]["tmp_name"])){
				$tmpfile=$_FILES["txt_addlogo"]["tmp_name"];
				$newname=$_FILES["txt_addlogo"]["name"];
				$insertimage='';
				if($_FILES["txt_addlogo"]["tmp_name"] != ''){
					/* $insertimage=time().$newname;
					$insertimage=str_replace(" ", "_" , $insertimage); */
					$type=substr($newname,strrpos($newname,'.')+0);
					$insertimage='VEN'.time().$type;
					/* list($width, $height, $type, $attr) = getimagesize($tmpfile); */
						$DeleteOldImage="SELECT image FROM admin WHERE adminid='".$_POST['hid_userid']."'";
						$getResult = $modelObj->fetchRow($DeleteOldImage);
						unlink($upload_dir.$getResult['image']);
						unlink($upload_dirthumb.$getResult['image']);
					if(move_uploaded_file($tmpfile, $upload_dir.$insertimage)){
						if($width >= 50 || $height >= 50){
							$resizeObj_50 = new resize($upload_dir.$insertimage);
							$resizeObj_50 -> resizeImage(50, 50, 'exact');
							$resizeObj_50 -> saveImage($upload_dirthumb.$insertimage,$upload_dir.$insertimage, 100);
						}else{
							$resizeObj_50 = new resize($upload_dir.$insertimage);
							$resizeObj_50 -> resizeImage($width, $height, 'exact');
							$resizeObj_50 -> saveImage($upload_dirthumb.$insertimage,$upload_dir.$insertimage, 100);
						}
					}
					$qry_img="UPDATE admin SET image='".$insertimage."' WHERE adminid='".$_POST['hid_userid']."' ";
					$res_img= $modelObj->runQuery($qry_img);
				}
			}

			if(isset($_POST['txt_addpassword']) && $_POST['txt_addpassword']!==''){
				$pass=md5($_POST['txt_addpassword']);
				$qry="UPDATE admin SET password='".$pass."' WHERE adminid='".$_POST['hid_userid']."'";
				$result=$modelObj->runQuery($qry);
			}

			$pst['firstname']=urlencode($_POST['txt_addfirstname']);
			$pst['lastname']=urlencode($_POST['txt_addlastname']);
			$pst['username']=urlencode($_POST['txt_addusername']);
			$pst['email']=urlencode($_POST['txt_addemail']);
			$pst['phone']=strip_tags($_POST['txt_addphone']);
			$pst['address']=urlencode($_POST['txt_addaddress']);
			$pst['Modify_date']=date("Y-m-d H:i:s", time());
			$pst['ip_address']=$_SERVER['REMOTE_ADDR'];
			//$pst['adminid']=$_POST['hid_userid'];
			$editMyData=$controller_class->editData('admin',$pst,"adminid='".$_POST['hid_userid']."'");
			echo "1";
		}
	}
?>
<?php
	if(isset($_POST['viewdiv']) && $_POST['viewdiv'] != ''){
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby=$_POST['orderby'];

		if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==1){ $IMARFLAG=1; }

		$qry="SELECT * FROM admin where status!=2 And user_type=2 order by adminid asc LIMIT 0,500";
		$result=$modelObj->fetchRows($qry);
		$totalrecords = mysql_num_rows($qry);
		$noofrows_k = $end;
		$noofpages = ceil($totalrecords/$noofrows_k);
		if($_POST['first'] != 0)
		{
			$curr_page = ceil($start/$noofrows_k);
		}
		else if($_POST['last'] != 0)
		{
			$curr_page = 0;
		}
		else
		{
			$curr_page=$_POST['curr_page'];
		}
?>
<div class="col-lg-12">
	<div class="widget-container fluid-height clearfix">
		<div class="heading">
		<i style="cursor:default;" class="icon-table"></i>Vendor Lists
		<?php if($IMARFLAG==1){ ?>
		<!--<a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('<?php echo $_SESSION['pid']; ?>')"><i class="icon-plus"></i>Add New</a>-->
		<?php if($result != ''):?>
			<div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
			<!--<button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown">
				<i class="icon-check-sign"></i>
				Action
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
			  <li>
				<a href="javascript:void(0)" onclick="statusactive()"><i class="icon-ok-sign"></i>Active</a>
			  </li>
			  <li>
				<a href="javascript:void(0)" onclick="statusinactive()"><i class="icon-ok-circle"></i>Inactive</a>
			  </li>
			  <li>
				<a href="javascript:void(0)" onclick="deleteselected()"><i class="icon-remove"></i>Delete</a>
			  </li>
			</ul>-->
			</div>
			<?php endif;?>
		  <?php } ?>
		</div>
		<div class="widget-content padded clearfix">
			<table class="table table-bordered table-striped" id="tbl_data_display">
			<thead>
			<th class="check-header hidden-xs">
				<label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
			</th>
			<th class="hidden-xs"> First Name </th>
			<th class="hidden-xs"> Last Name </th>
			<th class="hidden-xs"> User Name </th>
			<th class="hidden-xs"> Email </th>
			<th class="hidden-xs"> Status </th>
			<th style="color:#007aff;"> Options</th>
			</thead>
			<tbody>

						<tr>

						</tr>

			</tbody>
			</table>
		</div>
	  </div>
	</div>
<script>
	  $(document).ready(function(){
			$('#tbl_data_display').dataTable( {
				"bProcessing": true,
				"bServerSide": true,
				"aoColumnDefs": [
					{ 'bSortable': false, 'aTargets': [ 0, 6 ] }
				],
				"aaSorting": [[ 0, "asc" ]],
				"sAjaxSource": site_url+'controllers/ajax_controller/editprofile-ajax-controller.php?action=displaydata'
			} );
		});
</script>
<script type="text/javascript">
    $("#dataTable1").dataTable({
      "sPaginationType": "full_numbers",
      aoColumnDefs: [
        {
          bSortable: false,
          aTargets: [0, -1]
        }
      ]
    });

    $('.table').each(function() {
      return $(".table #checkAll").click(function() {
        if ($(".table #checkAll").is(":checked")) {
          return $(".table input[type=checkbox]").each(function() {
            return $(this).prop("checked", true);
          });
        } else {
          return $(".table input[type=checkbox]").each(function() {
            return $(this).prop("checked", false);
          });
        }
      });
    });
</script>
<?php } ?>
<?php
	if(isset($_POST['delete']) && $_POST['delete'] != ''){

		$qry="UPDATE admin SET status=2 WHERE adminid='".$_POST['id']."'";
		$result=$modelObj->runQuery($qry);

		if($result){
			echo $successmsg='1';
		}else{
			echo $errmsg='0';
		}
	}
?>
<?php
if(isset($_POST['edit']) && $_POST['edit'] != ''){

	$qry="SELECT * FROM admin WHERE adminid='".$_POST['id']."' And user_type!=3";
	$data=$modelObj->fetchRow($qry);

?>
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
<div class="col-lg-12">
	<div class="widget-container fluid-height clearfix">
		<div class="heading">
		<i style="cursor:default;" class="icon-reorder"></i><?php if($_POST['id']!=0){ ?> Update Admin <?php } else { ?> Add Admin <?php } ?></div>
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
            <label class="control-label col-md-2">Username<font class="required_mark" color="red">*</font></label>
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
		<?php if($_POST['id'] !=0) { ?>
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
		<?php if($_SESSION['TERRATROVE_ID']['ADMIN_ID']!=1){ ?>
			<div class="form-group">
				<label class="control-label col-md-2">Phone Number </label>
				<div class="col-md-7">
				  <input class="form-control" type="text" name="txt_addphone" id="txt_addphone" onkeypress="return isNumberKey(event)" value="<?php echo $data['phone']; ?>"/>
				  <span id="error_txt_addphone" style="color:red" class="error_label"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Address </label>
				<div class="col-md-6">
				 <textarea class="form-control"  type="text" name="txt_addaddress" id="txt_addaddress"><?php echo $data['address']; ?></textarea>
				  <span id="error_txt_addaddress" style="color:red" class="error_label"></span>
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

		<?php if($_POST['id'] !=0): ?>
		<div class="form-group">
			<label class="control-label col-md-2"></label>
			<div class="col-md-7">
				<input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data['adminid']; ?>" />
				<input type="hidden" name="hid_update" id="hid_update" value="update" />
				<button type="submit" class="btn btn-primary" onclick="return updatedata()">Submit</button>
				<button type="button" class="btn btn-default-outline" onclick="newdata();">Cancel</button>
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
<?php } ?>
