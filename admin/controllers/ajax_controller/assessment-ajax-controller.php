<?php
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	  include('../../models/city-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	  include('../test-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
  	$controller_class = new CommonController();
	  $upload_dir1 =$_SESSION['SITE_IMG_PATH']."city/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."assessment_img/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."city/thumb/";

	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];

    $qry="SELECT * FROM tbl_assessments_tests inner join tbl_assessments_category on tbl_assessments_category.categoryid = tbl_assessments_tests.fk_category_id  where assessmentsid=".$id;
    $result=$modelObj->fetchRow($qry);

?>
<div class="col-md-12">
    <div class="widget-content padded">
		<dl><b>Category : </b> <?php echo  $result['categoryname']; ?></dl>
		<dl><b>Question : </b> <?php echo  urldecode($result['questions']); ?></dl>
		<dl><b>Option 1 : </b> <?php echo  urldecode($result['option1']); ?></dl>
		<dl><b>Option 2 : </b> <?php echo  urldecode($result['option2']); ?></dl>
		<dl><b>Option 3 : </b> <?php echo  urldecode($result['option3']); ?></dl>
		<dl><b>Option 4 : </b> <?php echo  urldecode($result['option4']); ?></dl>
		<dl><b>Right Answer : </b>
 <?php
if($result['rightanswer'] == '1')
{
  echo  urldecode($result['option1']);
}
else if($result['rightanswer'] == '2')
{
  echo  urldecode($result['option2']);
}
else if($result['rightanswer'] == '3')
{
  echo  urldecode($result['option3']);
}
else if($result['rightanswer'] == '4')
{
  echo  urldecode($result['option4']);
}
else {
}
  ?>

    </dl>
     <?php
if($result['image'] == '')
{
$imageview = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
}
else {
$imageview =  COFIG_SITE_URL_IMG."assessment_img/".$result['image'];
}
      ?>
     <dl><b>Image : </b><br/> <img src="<?php echo  $imageview; ?>"  height="200" width="200"/></dl>
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
		if($sSortDir_0 == 'asc'){
			$SortBy = 'asc';
			}else{
			$SortBy = 'desc';
		}
		if($iSortCol_0 == '1'){
			$sortfield = 'categoryname';
			}
    else  if($iSortCol_0 == '2'){
        $sortfield = 'questions';
        }
    else  if($iSortCol_0 == '3'){
            $sortfield = 'rightanswertext';
            }
		else{
				$sortfield = 'assessmentsid';
			}
		$TotalCountqry = $modelObj->numRows("select * FROM tbl_assessments_tests where statuscheck !=2");

		if($sSearch!=''){
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
    //  echo "SELECT * FROM tbl_assessments_tests inner join tbl_assessments_category on tbl_assessments_category.categoryid = tbl_assessments_tests.fk_category_id  where statuscheck !=2 and  (questions LIKE '%".$sSearch."%' || categoryname LIKE '%".$sSearch."%' || statuscheck LIKE '%$sSearchactive%') ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."";
				$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_assessments_tests  where status !=2 and statuscheck !=2 and (questions LIKE '%".$sSearch."%' || statuscheck LIKE '%$sSearchactive%' || rightanswertext LIKE '%".$sSearch."%')");
			//echo "SELECT * FROM tbl_assessments_tests  where (questions LIKE '%".$sSearch."%') ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."";
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_assessments_tests inner join tbl_assessments_category on tbl_assessments_category.categoryid = tbl_assessments_tests.fk_category_id  where status !=2 and statuscheck !=2 and  (questions LIKE '%".$sSearch."%' || categoryname LIKE '%".$sSearch."%' || statuscheck LIKE '%$sSearchactive%' || rightanswertext LIKE '%".$sSearch."%') ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_assessments_tests inner join tbl_assessments_category on tbl_assessments_category.categoryid = tbl_assessments_tests.fk_category_id where status !=2 and statuscheck !=2");

			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_assessments_tests inner join tbl_assessments_category on tbl_assessments_category.categoryid = tbl_assessments_tests.fk_category_id where status !=2 and statuscheck !=2 ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
		}

		$countryMsg = '';
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){

			$query="SELECT * FROM tbl_assessments_tests";
			$results=$modelObj->fetchRows($query);

			$cms_id = $result['assessmentsid'];
			$categoryname = $result['categoryname'];
		  $cmsemail = urldecode($result['questions']);
      $rightanswer = '';
     if($result['rightanswer'] == '1')
     {
      $rightanswer = urldecode($result['option1']);
     }
     else if($result['rightanswer'] == '2')
     {
      $rightanswer = urldecode($result['option2']);
     }
     else if($result['rightanswer'] == '3')
     {
      $rightanswer = urldecode($result['option3']);
     }
     else if($result['rightanswer'] == '4')
     {
      $rightanswer = urldecode($result['option4']);
     }
     else {
     }

			$status = $result['statuscheck'];

			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';

			$cms='<td>'.$categoryname.'</td>';
			$cmsemail='<td>'.$cmsemail.'</td>';




			if($status==1)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
			}
			elseif($status==0)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
			}
			 $selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 41 ORDER BY id ASC";

			$moduleresult=$modelObj->fetchRow($selectmodule);
			if($moduleresult['p_field3'] == 1 && $moduleresult['p_field4'] == 1){

			$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>';


			$option .='<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'assessment\')" title="edit">
				<i class="icon-edit"></i>
			</a>';


			$option .='<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'assessment?\')" title="Delete">
			<i class="icon-trash"></i>
			</a>
			</div>
			</td>';
		 } else if($moduleresult['p_field3'] == 1){

		 	$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'cms\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>

			</div>
				</td>';
	} else if($moduleresult['p_field4'] == 1){
		$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" tbl_assessments_tests="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" tbl_assessments_tests="deleteuser('.$cms_id.', \'delete\', \'assessment\')" title="Delete">
			<i class="icon-trash"></i>
			</a>statuscheck
			</div>
			</td>';
	}  else if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==1){

		$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'assessment\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>

			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'assessment\')" title="Delete">
			<i class="icon-trash"></i>
			</a>
			</div>
			</td>';
	}   else{
		$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			</div>
			</td>';
			}

			$Arr['aaData'][] = array($checkbox,$cms,$cmsemail,$rightanswer,$status_new,$option);
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
			$qry="UPDATE tbl_assessments_tests SET statuscheck=1 WHERE  	assessmentsid=".($val);
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
			$qry="UPDATE tbl_assessments_tests SET  statuscheck=0 WHERE  assessmentsid=".($val);

			$result =$modelObj->runQuery($qry);

		}
	}
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_assessments_tests SET  statuscheck=2 WHERE assessmentsid='".($val)."'";

			$result=$modelObj->runQuery($qry);


		}
	}
?>


<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){

	$qry="SELECT assessmentsid FROM tbl_assessments_tests WHERE (questions = '".urlencode($_POST['questions'])."') AND statuscheck!=2";
				$resultCheck=$modelObj->numRows($qry);
				
				if($resultCheck > 0){
					echo "2"; exit;
				} else {

	if(isset($_FILES["txt_addphoto"]["tmp_name"])){

				$tmpfile = $_FILES["txt_addphoto"]["tmp_name"];


				if($_FILES["txt_addphoto"]["tmp_name"]!=''){

					$insertimage 	= 'product1'.time().".jpg";

					move_uploaded_file($tmpfile, $upload_dir.$insertimage);
					$file =  $upload_dir.$insertimage;

	       		//	$im  = imagecreatefromjpeg($file);

				//	imagewebp($im, str_replace('jpg', 'webp', $file) );
		    	//	imagedestroy($im);
					//unlink($file);
				}
			}

			$post['fk_category_id']=urlencode($_POST['category']);
		  $post['fk_language_id']=1;

			$post['questions']=urlencode($_POST['questions']);
		 	$post['option1']=urlencode($_POST['option1']);
			$post['option2']=urlencode($_POST['option2']);
			$post['option3']=urlencode($_POST['option3']);
			$post['option4']=urlencode($_POST['option4']);
			$post['rightanswer']=$_POST['option'];
			$post['statuscheck']=1;
      		$post['image'] = $insertimage;

      if($_POST['option'] == '1')
      {
      $post['rightanswertext']  = urlencode($_POST['option1']);
      }
      else if($_POST['option'] == '2')
      {
      $post['rightanswertext']  = urlencode($_POST['option2']);
      }
      else if($_POST['option'] == '3')
      {
      $post['rightanswertext']  = urlencode($_POST['option3']);
      }
      else if($_POST['option'] == '4')
      {
      $post['rightanswertext']  = urlencode($_POST['option4']);
      }
      else {
        $post['rightanswertext'] = '';
      }

	   	   $addfaq=$controller_class->addData('tbl_assessments_tests',$post);

			echo '1';

		}
	}
?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){

	$qry="SELECT assessmentsid FROM tbl_assessments_tests WHERE (questions = '".urlencode($_POST['questions'])."') AND status!=2";
				$resultCheck=$modelObj->numRows($qry);
				
				if($resultCheck > 0){
					echo "2"; exit;
				} else {


   	if(isset($_FILES["txt_addphoto"]["tmp_name"])){

   				$tmpfile = $_FILES["txt_addphoto"]["tmp_name"];


   				if($_FILES["txt_addphoto"]["tmp_name"]!=''){

   					$insertimage 	= 'product1'.time().".jpg";

   					move_uploaded_file($tmpfile, $upload_dir.$insertimage);
   					$file =  $upload_dir.$insertimage;

   	       		//	$im  = imagecreatefromjpeg($file);

   				//	imagewebp($im, str_replace('jpg', 'webp', $file) );
   		    	//	imagedestroy($im);
   					//unlink($file);
   				}
   			}

    $post['fk_category_id']=urlencode($_POST['category']);
    $post['fk_language_id']=1;

    $post['questions']=urlencode($_POST['questions']);
    $post['option1']=urlencode($_POST['option1']);
    $post['option2']=urlencode($_POST['option2']);
    $post['option3']=urlencode($_POST['option3']);
    $post['option4']=urlencode($_POST['option4']);
    $post['rightanswer']=$_POST['option'];
    $post['statuscheck']=1;
    if($_POST['option'] == '1')
    {
    $post['rightanswertext']  = urlencode($_POST['option1']);
    }
    else if($_POST['option'] == '2')
    {
    $post['rightanswertext']  = urlencode($_POST['option2']);
    }
    else if($_POST['option'] == '3')
    {
    $post['rightanswertext']  = urlencode($_POST['option3']);
    }
    else if($_POST['option'] == '4')
    {
    $post['rightanswertext']  = urlencode($_POST['option4']);
    }
    else {
      $post['rightanswertext'] = '';
    }

    $post['image'] = $insertimage;
    if($insertimage == '')
    {
      $post['image'] = $_POST['old_photo'];
    }
		$post['assessmentsid']=$_POST['hid_userid'];

			$editcms=$controller_class->editData('tbl_assessments_tests',$post,"assessmentsid='".$_POST['hid_userid']."'");
			echo '1';

	}
}
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {

		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_assessments_tests inner join tbl_assessments_category on tbl_assessments_category.categoryid = tbl_assessments_tests.fk_category_id where statuscheck !=2 ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> Assessment List
			<?php
			 $selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 41 ORDER BY id ASC";

			$moduleresult=$modelObj->fetchRow($selectmodule);

			if($moduleresult['p_field2'] == 1)
			{

			?>
				<!-- <a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('<?php echo $_SESSION['pid']; ?>')"><i class="icon-plus"></i>Add New</a> -->
				<?php } ?>
				<?php if($result !='' ): ?>
				<div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
					<button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown"> <i class="icon-check-sign"></i> Action <span class="caret"></span> </button>
					<ul class="dropdown-menu">
						<li>
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','assessment?')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','assessment?')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						 <?php if($moduleresult['p_field4'] == 1){ ?>
						<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','assessment?')"><i class="icon-remove"></i>Delete</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			<?php endif;?> </div>
			 <?php if($moduleresult['p_field4'] == 1){ ?>
			<div class="widget-content padded clearfix">
				<table class="table table-bordered table-striped" id="tbl_data_display">
					<thead>
						<th class="check-header hidden-xs">
							<label>
							<input id="checkAll" name="checkAll" type="checkbox"><span></span> </label>
						</th>
                       <th lass="hidden-xs" style="color: #007aff;">Category</th>
                        <th lass="hidden-xs" style="color: #007aff;">Question</th>
                        <th lass="hidden-xs" style="color: #007aff;">Right Answer</th>
                        <th lass="hidden-xs" style="color: #007aff;">Status</th>
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
					'aTargets': [0,4,5]
				}],
				"aaSorting": [
                [0, "desc"]
				],
				"sAjaxSource": site_url + 'controllers/ajax_controller/assessment-ajax-controller.php?action=displaydata'
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
<?php } ?>
<?php
	if(isset($_POST['delete']) && $_POST['delete'] != ''){

		$qry="UPDATE tbl_assessments_tests SET statuscheck=2 WHERE assessmentsid='".$_POST['id']."'";
	//	$qry="delete from tbl_test  WHERE testid='".$_POST['id']."'";

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
	 	$qry="SELECT * FROM tbl_assessments_tests WHERE 	assessmentsid=".$_POST['id'];
		$result_checkexists=$modelObj->numRows($qry);
		$data=$modelObj->fetchRow($qry);


			$qry2="SELECT * FROM tbl_assessments_category  where status='1'";
			$data_category=$modelObj->fetchRows($qry2);
		//print_r($data_category);



	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update Assessments
					<?php } else { ?> Add Assessments
				<?php } ?>
			</div>
			<div class="widget-content padded">
				<form name="form_testadd" id="form_testadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
					<?php if($data['fk_language_id']!=1){ ?>
					<!-- <a class="table-actions" href="javascript:void(0)" onclick="view(<?php echo $_POST['id']; ?>)" title="View">
					<i class="icon-eye-open"></i>
					</a> -->
					<?php } ?>

					<div class="form-group">
						<label class="control-label col-md-2"> Category <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
					<select id="category" name="category" class="form-control">
									<option value="">Select Category</option>
									<?php
										foreach($data_category as $category){ ?>

										<option value='<?php echo $category['categoryid'];?>'<?php if($category['categoryid']==$data['fk_category_id']){ echo "selected"; } ?>><?php echo urldecode($category['categoryname']);?></option>
									<?php } ?>
								</select>
								<span id="error_category" style="color:red" class="error_label"></span>
					</div>

					</div>
					<div class="form-group">
						<label class="control-label col-md-2"> Questions <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="questions"  id="questions" value="<?php echo htmlentities(urldecode($data['questions'])); ?>" />
						<span id="error_questions" style="color:red" class="error_label"></span> </div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2"> Option 1 <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="option1"  id="option1" value="<?php echo htmlentities(urldecode($data['option1'])); ?>" />
						<span id="error_option1" style="color:red" class="error_label"></span> </div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2"> Option 2  <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="option2"  id="option2" value="<?php echo htmlentities(urldecode($data['option2'])); ?>" />
						<span id="error_option2" style="color:red" class="error_label"></span> </div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2"> Option 3 <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="option3"  id="option3" value="<?php echo htmlentities(urldecode($data['option3'])); ?>" />
						<span id="error_option3" style="color:red" class="error_label"></span> </div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2"> Option 4 <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="option4"  id="option4" value="<?php echo htmlentities(urldecode($data['option4'])); ?>" />
						<span id="error_option4" style="color:red" class="error_label"></span> </div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2"> Select right Answer <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
              <table>
                <tr>
                <td> <input type="radio" class="option" name="option" value="1" <?php if('1' == $data['rightanswer']){ echo "checked"; } ?>></td>
                  <td> Option 1&nbsp; </td>
                  <td> <input type="radio" class="option" name="option" value="2" <?php if('2' == $data['rightanswer']){ echo "checked"; } ?>> </td>
                    <td>Option 2&nbsp; </td>
                  <td>  <input type="radio" class="option" name="option" value="3" <?php if('3' == $data['rightanswer']){ echo "checked"; } ?>> </td>
                  <td>Option 3&nbsp; </td>
                <td> <input type="radio" class="option" name="option" value="4" <?php if('4' == $data['rightanswer']){ echo "checked"; } ?>></td>
                <td>Option 4&nbsp; </td>
                </tr>
              </table>




						 <input type="hidden" id="option"  />
						<span id="error_option" style="color:red" class="error_label"></span> </div>
					</div>

					<div class="form-group">
							<label class="control-label col-md-2">Image<font class="required_mark" color="red">*</font></label>
							<div class="col-md-4">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
										<?php if($data['image'] == '' ){ ?>
											<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" >
											<?php } else {
												if($controller_class->isAws()){
													$url = COFIG_SITE_URL_IMG.'assessment_img/'.$data['image'];
													}else{

													$url = COFIG_SITE_URL_IMG."assessment_img/".$data['image'];
												}
											?>

											<img src="<?php echo $controller_class->displayImage($url); ?>"   width="200px" hieght="150px">

										<?php } ?>
										<input type="hidden" name="old_photo" id="old_photo" value="<?php echo $data['image']; ?>">
									</div>
									<!-- <div style="width=500px;"><?php echo $res['image'] ?></div> -->
									<div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>

								   	<div style="width:300px">
										<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
										<span class="fileupload-exists">Change</span><input type="file" name="txt_addphoto" id="txt_addphoto"></span>
										<!-- <a class="btn btn-default fileupload-exists"  data-dismiss="fileupload" href="#">Remove</a> -->
									</div>

									<span><b><font class="required_mark" color="red">Recommended size 600(Width) x 900(Height)</font></b></span>
									<span id="error_txt_addphoto" style="color:red" class="error_label"></span>
								</div>
							</div>
						</div>

					<?php if($_POST['id'] !=0):?>
					<div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-7">
                    <?php if($data['id']=='') { ?>
                        <input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $_POST['id']; ?>" />
                    <?php } else { ?>
                        <input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data['id']; ?>" />
                    <?php } ?>
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
