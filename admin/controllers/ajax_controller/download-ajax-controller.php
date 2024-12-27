<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/download-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	include('../download-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new DownloadController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."download/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."download/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."download/thumb/";
	

if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM tbl_download where status!=2 and id='".$id."'";
    $result=$modelObj->fetchRow($qry);
   $getchapter=$controller_class->getChapterById($result['fk_chapter_id']);
   $getuser=$controller_class->getUserById($result['fk_user_id']);
	  
   $str1="SELECT * FROM tbl_chapter where id=".$result['fk_chapter_id'];
   $row_chapter=$modelObj->fetchRow($str1);

   $getclass=$controller_class->getClassStudentById($row_chapter['fk_class_id']);
   $getsub=$controller_class->getSubjectById($row_chapter['fk_subject_id']);
?>
<div class="col-md-12">
    <div class="widget-content padded">
		<dl><b>Class Name : </b> <?php echo urldecode($getclass['class_name']); ?></dl> 
		<dl><b>Subject Name : </b> <?php echo urldecode($getsub['subject_name']); ?></dl> 
		<dl><b>Chapter Name : </b> <?php echo urldecode($getchapter['chapter_name']); ?></dl> 
		<dl><b>User Name : </b> <?php echo urldecode($getuser['name']); ?></dl> 
		<dl><b>Download Status: </b>  <?php echo $result['download_status']; ?></dl> 
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
  $TotalCountqry = $modelObj->numRows("select * FROM tbl_download WHERE status!=2");
	
  if($sSearch!=''){
	  
  $user = $modelObj->fetchRows("SELECT id FROM tbl_class WHERE status!=2 and class_name LIKE '%".$sSearch."%'");
  
		foreach($user as $k => $data){
			$user_id[]="'".$data['id']."'";
			
			}			
		$userids = implode(",",$user_id);	
		
	if($userids!=''){
		$query1= "OR fk_chapter_id IN ($userids)";
	}
  }
	
  if($sSearch!=''){
	  
  $user = $modelObj->fetchRows("SELECT id FROM tbl_subject WHERE status!=2 and subject_name LIKE '%".$sSearch."%'");
  
		foreach($user as $k => $data){
			$user_id[]="'".$data['id']."'";
			
			}			
		$userids = implode(",",$user_id);	
		
	if($userids!=''){
		$query2= "OR fk_chapter_id IN ($userids)";
	}
  }
	
  if($sSearch!=''){
	  
  $user = $modelObj->fetchRows("SELECT id FROM tbl_user WHERE status!=2 and name LIKE '%".$sSearch."%'");
  
		foreach($user as $k => $data){
			$user_id[]="'".$data['id']."'";
			
			}			
		$userids = implode(",",$user_id);	
		
	if($userids!=''){
		$query3= "OR fk_user_id IN ($userids)";
	}
  }
  if($sSearch!=''){
	  
  $user = $modelObj->fetchRows("SELECT id FROM tbl_chapter WHERE status!=2 and chapter_name LIKE '%".$sSearch."%'");
  
		foreach($user as $k => $data){
			$user_id[]="'".$data['id']."'";
			
			}			
		$userids = implode(",",$user_id);	
		
	if($userids!=''){
		$query4= "OR fk_chapter_id IN ($userids)";
	}
  }
  
  
 
	if($sSearch!=''){
		$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_download WHERE status!=2 AND (cr_date LIKE '%".$sSearch."%' $query1 $query2 $query3 $query4)");
		
		$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_download WHERE status!=2 AND (cr_date LIKE '%".$sSearch."%' $query1 $query2 $query3 $query4) ORDER BY cr_date ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
	} else {
		$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_download WHERE status!=2");
		
		$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_download WHERE status!=2 ORDER BY cr_date ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
	}
  
  $countryMsg = '';  
  $Arr['sEcho'] = $_REQUEST['sEcho'];
  $Arr['iTotalRecords'] = $TotalCountqry;
  $Arr['iTotalDisplayRecords'] = $Filteredqry;
  $Arr['aaData'] = array();
  foreach($list_activity_log as $result){
	  
   $str1="SELECT * FROM tbl_chapter where id=".$result['fk_chapter_id'];
   $row_chapter=$modelObj->fetchRow($str1);
   
   $getclass=$controller_class->getClassStudentById($row_chapter['fk_class_id']);
   $getsub=$controller_class->getSubjectById($row_chapter['fk_subject_id']);
   $getchapter=$controller_class->getChapterById($result['fk_chapter_id']);
   $getuser=$controller_class->getUserById($result['fk_user_id']);
   $cms_id = $result['id'];
   $class_name = urldecode($getclass['class_name']);
   $subject_name = urldecode($getsub['subject_name']);
   $chapter_name = urldecode($getchapter['chapter_name']);
   $user_name = urldecode($getuser['name']);
   $cr_date = $result['cr_date'];
   $cms_status = $result['status'];
 
		$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
	  
		$class_na='<td>'.$class_name.'</td>';
		$subject_na='<td>'.$subject_name.'</td>';
		$chapter_na='<td>'.$chapter_name.'</td>';
		$user_name_na='<td>'.$user_name.'</td>';
		$cr_date_na='<td>'.$cr_date.'</td>';			
        
		$option='<td class="actions">
					<div class="action-buttons">
						<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
						  <i class="icon-eye-open"></i>
						</a>
							
					<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'download?\')" title="Delete">
							   <i class="icon-trash"></i>
					</a>
					</div>
				</td>';
   
   $Arr['aaData'][] = array($checkbox,$class_na,$subject_na,$chapter_na,$user_name_na,$cr_date_na,$option);
  } 

  echo json_encode($Arr); 
 } 
?>

<?php
	if(isset($_POST['statusactive']) && $_POST['statusactive'] != '')
	{
		$id = explode("," ,$_POST['active']);
		foreach($id as $k => $val)
		{
			$qry="UPDATE tbl_download SET status=1 WHERE id=".($val);
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
			$qry="UPDATE tbl_download SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);
		}
	}
?>
<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_download SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);
		}
	}
?>
	
<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){		
		$checkexists="SELECT id FROM tbl_download where status!=2 and chapter_name='".($_POST['txt_chapter_name'])."'";
		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0){
				$flag=0;
				echo "0";
		}else {
			$flag=1;
		}

		if($flag==1){
			$post['fk_class_id']=urlencode($_POST['classstudentAdd']);
			$post['fk_subject_id']=urlencode($_POST['subjectAdd']);
			$post['chapter_name']=urlencode($_POST['txt_chapter_name']);
			$post['edition_number']=strip_tags($_POST['txt_edition_number']);
			$post['chapter_image']=$insertimage;
			$post['pdf_file']=$insertfile;
			$post['status']='1';
			$post['cr_date']=date("Y-m-d H:i:s", time());
			$post['modified_date']=date("Y-m-d H:i:s", time());
			$post['Created_Id']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$post['Modify_Id']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$post['ip_address']=$_SERVER['REMOTE_ADDR'];
			$addfaq=$controller_class->addData('tbl_chapter',$post);
			echo '1';
		}
	}
?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){	
		$checkexists="SELECT id FROM tbl_chapter WHERE chapter_name='".(trim($_POST['txt_chapter_name']))."' and status!=2 and id!='".$_POST['hid_userid']."'";
		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0){
			$flag=0;
			echo "0";
		}else{
			$flag=1;
			$pst['fk_class_id']=urlencode($_POST['classstudentAdd']);
			$pst['fk_subject_id']=urlencode($_POST['subjectAdd']);
			$pst['chapter_name']=urlencode($_POST['txt_chapter_name']);
			$pst['edition_number']=strip_tags($_POST['txt_edition_number']);
			$pst['chapter_image']=$insertimage;
			$pst['modified_date']=date("Y-m-d H:i:s", time());
			$pst['Modify_Id']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$pst['ip_address']=$_SERVER['REMOTE_ADDR'];
			$pst['id']=$_POST['hid_userid'];
			$editcms=$controller_class->editData('tbl_chapter',$pst,"id='".$pst['id']."'");
			echo '1';
		}
	}	
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
    $start = $_POST['prevnext'];
    $end = $_POST['row'];
    $orderby = $_POST['orderby'];
    $qry = "SELECT * FROM tbl_download where status!=2 order by cr_date desc";
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
        <div class="heading"> <i style="cursor:default;" class="icon-table"></i> Download List
            <?php if($result !='' ): ?>
            <div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
                <button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown"> <i class="icon-check-sign"></i> Action <span class="caret"></span> </button>
                <ul class="dropdown-menu">
						<li>
						<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','download?')"><i class="icon-remove"></i>Delete</a>
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
                    <th class="hidden-xs" style="color: #007aff;">Class Name</th>
                    <th class="hidden-xs" style="color: #007aff;">Subject Name</th>
                    <th class="hidden-xs" style="color: #007aff;">Chapter Name</th>
                    <th class="hidden-xs" style="color: #007aff;">User Name</th>
                    <th class="hidden-xs" style="color: #007aff;"> Download Date </th>
                    <th class="hidden-xs" style="color: #007aff;"> Options </th>
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
                'aTargets': [0, 6]
            }],
            "aaSorting": [
                [0, "desc"]
            ],
            "sAjaxSource": site_url + 'controllers/ajax_controller/download-ajax-controller.php?action=displaydata'
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
</script>
<?php } ?>
<?php
	if(isset($_POST['delete']) && $_POST['delete'] != ''){
		
		$qry="UPDATE tbl_download SET status=2 WHERE id='".$_POST['id']."'";
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
	$qry="SELECT * FROM tbl_download WHERE id=".$_POST['id'];
	$data=$modelObj->fetchRow($qry);
?>
<div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
            <?php if($_POST[ 'id']!=0){ ?> Update Chapter
            <?php } else { ?> Add Chapter
            <?php } ?>
        </div>
        <div class="widget-content padded">
            <form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
		   	<div class="form-group">
				<label class="control-label col-md-2"> Class <font class="required_mark" color="red">*</font></label>
				<div class="col-md-7">
					<select id="classstudentAdd" name="classstudentAdd" class="form-control" >
						<option value="">Select Class</option>
						<?php 
                     $getClassStudentList=$controller_class->getClassStudentList();
							foreach($getClassStudentList as $k => $data1){ ?>
							
							<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['fk_class_id']){ echo "selected"; } ?>><?php echo urldecode($data1['class_name']);?></option>
						<?php } ?>
					</select>
					<span id="error_classstudentAdd" style="color:red" class="error_label"></span>
					
				</div>
				</div>
		   	<div class="form-group">
				<label class="control-label col-md-2"> Subject <font class="required_mark" color="red">*</font></label>
				<div class="col-md-7">
					<select id="subjectAdd" name="subjectAdd" class="form-control" >
						<option value="">Select Subject</option>
						<?php 
                     $getSubjectList=$controller_class->getSubjectList();
							foreach($getSubjectList as $k => $data1){ ?>
							
							<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['fk_subject_id']){ echo "selected"; } ?>><?php echo urldecode($data1['subject_name']);?></option>
						<?php } ?>
					</select>
					<span id="error_subjectAdd" style="color:red" class="error_label"></span>
					
				</div>
				</div>
                <div class="form-group">
                    <label class="control-label col-md-2">Chapter Name <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="txt_chapter_name" maxlength="40" id="txt_chapter_name" value="<?php echo urldecode($data['chapter_name']); ?>" /> <span id="error_txt_chapter_name" style="color:red" class="error_label"></span> 	
					</div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Edition Number <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="txt_edition_number" maxlength="40" id="txt_edition_number" value="<?php echo stripslashes($data['edition_number']); ?>" /> <span id="error_txt_edition_number" style="color:red" class="error_label"></span> </div>
                </div>
			
			
			<div class="form-group">
				<label class="control-label col-md-2">Chapter Image <font class="required_mark" color = "red">*</font></label>
				<div class="col-md-4">
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
					<?php if($data['chapter_image']=='' ){?>
							<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
						<?php }else{?>
						<img src="<?=$_SESSION['FRNT_DOMAIN_NAME']?>upload/chapter/<?php echo $data['chapter_image'];?>">
						<?php } ?>
						<input type="hidden" id="userPicture" name="userPicture" value='<?php echo $data['chapter_image'];?>'>
				</div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                <div>
					<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" id ="txt_addphoto" name="txt_addphoto" accept="image/*"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="javascript:void(0);">Remove</a>
                </div>
				</div>
					<input type="hidden" name="userImage" id="userImage" value="<?php echo $data['chapter_image']; ?>">
					 <span id="error_txt_addphoto" style="color:red" class="error_label"></span>

				</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-md-2">Chapter PDF File <font class="required_mark" color = "red">*</font></label>
				<div class="col-md-4">
				<div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                <div>
					<span class="btn btn-default btn-file"><span class="fileupload-new">Select File</span><span class="fileupload-exists">Change</span><input type="file" id ="txt_addfile" name="txt_addfile" accept="pdf/*"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="javascript:void(0);">Remove</a>
                </div>
				</div>
					<input type="hidden" name="userImage" id="userImage" value="<?php echo $data['pdf_file']; ?>">
					 <span id="error_txt_addfile" style="color:red" class="error_label"></span>

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