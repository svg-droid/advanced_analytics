<?php

    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	  include('../../models/user-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
  	include('../user-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
  	$controller_class = new CommonController();
	  $upload_dir1 =$_SESSION['SITE_IMG_PATH']."user/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."user/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."user/thumb/";


if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM tbl_users where status!=2 and id='".$id."'";
    $result=$modelObj->fetchRow($qry);

    // $getclass=$controller_class->getClassStudentById($result['fk_class_id']);
//echo $controller_class->displayImage($_SESSION['FRNT_DOMAIN_NAME'].'upload/user/'.$result['image']);
?>
<div class="col-md-12">
    <div class="widget-content padded">
		<dl><b>Name : </b> <?php echo urldecode($result['name']); ?></dl>
        <dl><b>Email : </b> <?php echo urldecode($result['email']); ?></dl>
	</div>
  </div>
<?php endif; ?>
<?php

if(isset($_REQUEST['action']) && $_REQUEST['action'] == "displaydata"){

  $iDisplayStart = $_REQUEST['iDisplayStart'];
  $iDisplayLength = $_REQUEST['iDisplayLength'];
  $sSearch = urlencode($_REQUEST['sSearch']);
  $sSortDir_0 = $_REQUEST['sSortDir_0'];
  $iSortCol_0 = $_REQUEST['iSortCol_0'];
  if($sSortDir_0=='asc'){
   $SortBy = 'asc';
  }else{
   $SortBy = 'desc';
  }
  if($iSortCol_0=='1'){
			$sortfield = 'name';
			}
		elseif($iSortCol_0=='2'){
			$sortfield = 'email';
		}
		else{
				$sortfield = 'id';
			}
  $TotalCountqry = $modelObj->numRows("select * FROM tbl_users WHERE status!=2");
  if(strtolower($sSearch) == 'active')
  {
    $sSearchactive = 1;
  }
else  if(strtolower($sSearch) == 'inactive')
  {
    $sSearchactive = 0;
  }
  else {
    $sSearchactive = $sSearch;
  }

   if($sSearch!=''){
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_users where status!=2 AND (name LIKE '%".$sSearch."%' OR email LIKE '%".$sSearch."%' || status LIKE '%$sSearchactive%') ");

			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_users where status!=2 AND (name LIKE '%".$sSearch."%' OR email LIKE '%".$sSearch."%' || status LIKE '%$sSearchactive%') ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
			} else {

			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_users where status!=2 ");

			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_users where status!=2 ORDER BY ".$sortfield." ".$SortBy."  LIMIT ".$iDisplayStart.",".$iDisplayLength."");
		}


  $countryMsg = '';
  $Arr['sEcho'] = $_REQUEST['sEcho'];
  $Arr['iTotalRecords'] = $TotalCountqry;
  $Arr['iTotalDisplayRecords'] = $Filteredqry;
  $Arr['aaData'] = array();
  foreach($list_activity_log as $result){
   // $getclass=$controller_class->getClassStudentById($result['fk_class_id']);
   $cms_id = $result['id'];
   $cms_name = urldecode($result['name']);
   $cms_email = urldecode($result['email']);
   $cms_status = $result['status'];
	 $checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
	 $u_name='<td>'.$cms_name.'</td>';
   $u_email='<td>'.$cms_email.'</td>';

		if($cms_status==1){
		 $status='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
		} else {
		$status='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
		}

		$option='<td class="actions">
					<div class="action-buttons">
						<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
						  <i class="icon-eye-open"></i>
						</a>
					<a class="table-actions" href="index.php?pid=userassessment&user='.encode($cms_id).'"  title="Assessment Results">
						<i class="glyphicon glyphicon-list-alt"></i>
						</a>
					<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'user?\')" title="Delete">
							   <i class="icon-trash"></i>
					</a>
					</div>
				</td>';

   $Arr['aaData'][] = array($checkbox,$u_name,$u_email,$status,$option);
  }

  echo json_encode($Arr);
 }
?>
<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){

		$result_checkexists = $modelObj->numRows("SELECT id FROM tbl_users WHERE (email='".trim($_POST['email'])."'  and status!=2 and id!='".$_POST['hid_userid']."'");

		if($result_checkexists>0){
			echo '0'; exit;
		}else{

			if(!dir($upload_dir)){
				mkdir($upload_dir);
			}



			if(isset($_FILES["txt_addphoto"]["tmp_name"])){

				$tmpfile = $_FILES["txt_addphoto"]["tmp_name"];
				$newname = $_FILES["txt_addphoto"]["name"];


				if($_FILES["txt_addphoto"]["tmp_name"] != ''){


					$insertimage 	= 'user'.time().'.jpg';


				 	$resultImage = $modelObj->fetchRow("SELECT image FROM tbl_users WHERE id=".$_POST['hid_userid']);


					 unlink($upload_dir.$resultImage['image']);

					move_uploaded_file($tmpfile, $upload_dir.$insertimage);

					$file =  $upload_dir.$insertimage;

	       			$im  = imagecreatefromjpeg($file);

					imagewebp($im, str_replace('jpg', 'webp', $file) );
		    		imagedestroy($im);
					//unlink($file);

					chmod($upload_dir.$insertimage, 0777);

					 $res_img= $modelObj->runQuery("UPDATE tbl_users SET image='".str_replace('.jpg' , '.webp', $insertimage)."' where id=".$_POST['hid_userid']);

				}
			}


			/*if(isset($_FILES["txt_addphoto"]["tmp_name"])){

				$tmpfile = $_FILES["txt_addphoto"]["tmp_name"];
				$newname = $_FILES["txt_addphoto"]["name"];


				if($_FILES["txt_addphoto"]["tmp_name"] != ''){

					$ext = substr($newname, strrpos($newname, '.') + 1);

					$insertimage 	= 'user'.time().'.'.$ext;

					$resultImage=$modelObj->fetchRow("SELECT image FROM tbl_users WHERE id=".$_POST['hid_userid']);
					unlink($upload_dir.$resultImage['image']);

					move_uploaded_file($tmpfile, $upload_dir.$insertimage);

					$file =  $upload_dir.$insertimage;

					if($ext=='jpeg' || $ext=='jpg'){

						$im  = imagecreatefromjpeg($file);
						imagewebp($im, str_replace('jpeg', 'webp', $file) );
				    	imagedestroy($im);
				    	//unlink($file);

					}else if($ext=='png'){

						$im1 = imagecreatefrompng($file);
						imagewebp($im1, str_replace('png', 'webp', $file) );
				        imagedestroy($im1);
						//unlink($file);

					}

					chmod($upload_dir.$insertimage, 0777);
					$qry_img="UPDATE tbl_users SET image='".str_replace('.'.$ext , '.webp', $insertimage)."' where id='".$_POST['hid_userid']."'";
					$res_img= $modelObj->runQuery($qry_img);


				}
			}*/



			if(isset($_POST['txt_addpassword']) && $_POST['txt_addpassword']!==''){
				$pass=md5($_POST['txt_addpassword']);
				$qry="UPDATE tbl_users SET password='".$pass."' WHERE id='".$_POST['hid_userid']."'";
				$result=$modelObj->runQuery($qry);
			}

			$pst['name']			= urlencode($_POST['name']);
			$pst['countryid']		= urlencode($_POST['AddCat']);

			$pst['gender']		= urlencode($_POST['txt_addgender']);
			$pst['email']			= urlencode($_POST['email']);
			$pst['mobile']			= strip_tags($_POST['txt_addphone']);

			$pst['updatedatetime']	= date("Y-m-d H:i:s", time());

			$editMyData=$controller_class->editData('tbl_users',$pst,"id='".$_POST['hid_userid']."'");

			echo "1";


		}
	}

?>


<?php
	if(isset($_POST['statusactive']) && $_POST['statusactive'] != '')
	{
		$id = explode("," ,$_POST['active']);
		foreach($id as $k => $val)
		{
			$qry="UPDATE tbl_users SET status=1 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);


		}
	}
?>

<?php
	if(isset($_POST['statusinactive']) && $_POST['statusinactive'] != '')
	{
		$id = explode("," ,$_POST['inactive']);
		foreach($id as $k => $val)
		{
			$qry="UPDATE tbl_users SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);


		}
	}
?>
<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_users SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);


		}
	}
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
    $start = $_POST['prevnext'];
    $end = $_POST['row'];
    $orderby = $_POST['orderby'];
    $qry = "SELECT * FROM tbl_users where status!=2 order by createdatetime desc";
    $result =$modelObj->fetchRows($qry);
    $totalrecords = $modelObj->numRows($qry);
    $noofrows_k = $end;
    $noofpages = ceil($totalrecords / $noofrows_k);
    if ($_POST['first'] != 0) {
        $curr_page = ceil($start / $noofrows_k);
    } else if ($_POST['last'] != 0) {
        $curr_page = 0;
    } else {
        $curr_page = $_POST['curr_page'];
    }
?>

<div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i style="cursor:default;" class="icon-table"></i> User List
        
                <a class="btn btn-sm btn-primary pull-right ajesh_margin_right_10" href="javascript:void(0)" onclick="exportdataMember()"><i class="icon-circle-arrow-down"></i>Export</a>
            <?php if($result !='' ): ?>
            <div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
                <button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown"> <i class="icon-check-sign"></i> Action <span class="caret"></span> </button>
                <ul class="dropdown-menu">
                    <li>
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','user?')"><i class="icon-ok-sign"></i>Active</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','user?')"><i class="icon-ok-circle"></i>Inactive</a>
                        </li>
					  <li>
						<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','user?')"><i class="icon-remove"></i>Delete</a>
					  </li>
                </ul>
            </div>
            <?php endif;?> </div>
        <div class="widget-content padded clearfix">
            <table class="table table-bordered table-striped" id="tbl_data_display">
                <thead>
                    <th class="check-header hidden-xs">
                        <label>
                            <input id="checkAll" name="checkAll" type="checkbox"><span></span> </label>
                    </th>
                        <th class="hidden-xs" style="color: #007aff;">Name </th>
                        <th class="hidden-xs" style="color: #007aff;">E-mail</th>
                        <th class="hidden-xs" style="color: #007aff;">Status</th>
                        <th class="hidden-xs" style="color: #007aff;">Options</th>
                </thead>
                <tbody>
                    <tr> </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tbl_data_display').dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0, 3, 4]
            }],
            "aaSorting": [
                [0, "desc"]
            ],
            "sAjaxSource": site_url + 'controllers/ajax_controller/user-ajax-controller.php?action=displaydata'
        });
    });
</script>
<script type="text/javascript">
    $("#dataTable1").dataTable({
        "sPaginationType": "full_numbers",
        aoColumnDefs: [{
            bSortable: false,
            aTargets: [0, -1]
        }]
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
<?php } ?>
<?php
	if(isset($_POST['delete']) && $_POST['delete'] != ''){

		$qry="UPDATE tbl_users SET status=2 WHERE id='".$_POST['id']."'";
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
	$qry="SELECT * FROM tbl_users WHERE id=".$_POST['id'];
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
        <div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
            <?php if($_POST[ 'id']!=0){ ?> Update User
            <?php } else { ?> Add User
            <?php } ?>
        </div>
        <div class="widget-content padded">
            <form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-2">Name <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="name" maxlength="40" id="name" value="<?php echo urldecode($data['name']); ?>" /> <span id="error_name" style="color:red" class="error_label"></span> </div>
                </div>
				<!-- <div class="form-group">
						<label class="control-label col-md-2">Country Name <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
							<select id="AddCat" name="AddCat" class="form-control" >
								<option value="">Select Country</option>
								<?php
									$getCat=$controller_class->getCountry();
									foreach($getCat as $k => $data1){ ?>

									<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['countryid']){ echo "selected"; } ?>><?php echo urldecode($data1['countryname']);?></option>
								<?php } ?>
							</select>
							<span id="error_AddCat" style="color:red" class="error_label"></span>

						</div>
					</div> -->
				 <div class="form-group">
					<label class="control-label col-md-2">Email <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="email" maxlength="40" id="email" value="<?php echo urldecode($data['email']); ?>" /> <span id="error_email" style="color:red" class="error_label"></span> </div>
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
									<input type="password" class="form-control" onblur="validateMsgHide('txt_addpassword')" maxlength="20" name="txt_addpassword" id="txt_addpassword" value="" />
									<span id="error_txt_addpassword" style="color:red" class="error_label"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">Confirm Password <font class="required_mark" color = "red">*</font></label>
								<div class="col-md-7">
									<input type="password" class="form-control" maxlength="20" onblur="validateMsgHide('txt_addcnfrmpassword')" name="txt_addcnfrmpassword" id="txt_addcnfrmpassword" value="" />
									<span id="error_txt_addcnfrmpassword" style="color:red" class="error_label"></span>
								</div>
							</div>
							<input type="hidden" name="hid_userpid" id="hid_userpid" value="<?php echo $data['id']; ?>" />
						</div>
						<?php } else { ?>
						<div class="form-group">
							<label class="control-label col-md-2">Password <font class="required_mark" color = "red">*</font></label>
							<div class="col-md-7">
								<input type="password" class="form-control" onblur="validateMsgHide('txt_addpassword')" maxlength="20" name="txt_addpassword" id="txt_addpassword" />
								<span id="error_txt_addpassword" style="color:red" class="error_label"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Confirm Password <font class="required_mark" color = "red">*</font></label>
							<div class="col-md-7">
								<input type="password" class="form-control" maxlength="20" onblur="validateMsgHide('txt_addcnfrmpassword')" name="txt_addcnfrmpassword" id="txt_addcnfrmpassword" />
								<span id="error_txt_addcnfrmpassword" style="color:red" class="error_label"></span>
							</div>
						</div>
					<?php } ?>
					<div class="form-group">
						<label class="control-label col-md-2">Mobile Number <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
							<input class="form-control" type="text" onblur="validateMsgHide('txt_addphone')" onkeypress="return isNumberKey(event)"  name="txt_addphone" id="txt_addphone"  value="<?php echo $data['mobile']; ?>"/>
							<span id="error_txt_addphone" style="color:red" class="error_label"></span>
						</div>
					</div>



			<div class="form-group">
					<label class="control-label col-md-2">Profile image</label>
					<div class="col-md-4">
						<div class="fileupload fileupload-new" data-provides="fileupload">


							<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
								<?php if($data['image'] == '' ){ ?>
									<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" >
									<?php } else {
										if($controller_class->isAws()){
											$url = $_SESSION['S3_BUCKET_URL'].'upload/user/'.$data['image'];
											}else{

											$url = $_SESSION['FRNT_DOMAIN_NAME']."upload/user/".$data['image'];
										}
									?>

									<img src="<?php echo $controller_class->displayImage($url); ?>" width="200px" hieght="150px">

								<?php } ?>
								<input type="hidden" name="old_photo" id="old_photo" value="<?php echo $data['image']; ?>">
							</div>

							<div class="form-group">
				<label class="control-label col-md-2">Gender <font class="required_mark" color="red">*</font></label>
				<div class="col-md-7" >
					<label class="radio-inline">
						<input name="txt_addgender" id="txt_addgender" type="radio" <?php if(isset($data['gender']) && $data['gender']==1) echo "checked";?> value="1">
						<span>Male</span>
					</label>
					<label class="radio-inline">
						<input name="txt_addgender" id="txt_addgender" type="radio" <?php if(isset($data['gender']) && $data['gender']==2) echo "checked";?> value="2">
						<span>Female</span>
					</label>
				</div>
			</div>
								<!-- <div style="width=500px;"><?php echo $data['image'] ?></div> -->
								<div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>

								<div style="width:300px">
									<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
									<span class="fileupload-exists">Change</span><input type="file" name="txt_addphoto" id="txt_addphoto"></span>
									<a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>
								</div>

								<span id="error_txt_addphoto" style="color:red" class="error_label"></span>



						</div>
					</div>
				</div>


                <?php if($_POST[ 'id'] !=0):?>
                <div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-7">
                        <input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data['id']; ?>" />
                        <input type="hidden" name="hid_update" id="hid_update" value="update" />
                        <button type="submit" class="btn btn-primary" onclick="return updatedata()">Submit</button>
                        <button class="btn btn-default-outline" onclick="newdata();">Cancel</button>
                    </div>
                </div>
                <?php else:?>
                <div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-7">
                        <input type="hidden" name="hid_add" id="hid_add" value="add" />
                        <button type="submit" class="btn btn-primary" onclick="return adddata()">Submit</button>
                        <button class="btn btn-default-outline" onclick="newdata();">Cancel</button>
                    </div>
                </div>
                <?php endif;?> </form>
        </div>
    </div>
</div>
<?php } ?>
