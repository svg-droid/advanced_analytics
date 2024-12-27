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
  $upload_dir =$_SESSION['SITE_IMG_PATH']."evm_img/";
  $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."city/thumb/";
  // $upload_dir3 =$_SESSION['SITE_IMG_PATH']."fragnets_img/";

	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];

   $qry="SELECT * FROM tbl_assessments_category  where  categoryid=".$id;
    $result=$modelObj->fetchRow($qry);

?>
<div class="col-md-12">
    <div class="widget-content padded">
		<dl><b>Category  : </b> <?php echo urldecode($result['categoryname']); ?></dl>
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
			$sortfield = 'categoryname';
			}
		else{
				$sortfield = 'categoryid';
			}
		$TotalCountqry = $modelObj->numRows("select * FROM tbl_assessments_category");



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
				$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_assessments_category  where status !=2 and (categoryname LIKE '%".$sSearch."%' || status LIKE '%$sSearchactive%')");
			//echo "SELECT * FROM tbl_assessments_tests  where (questions LIKE '%".$sSearch."%') ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."";
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_assessments_category  where status !=2 and (categoryname LIKE '%".$sSearch."%' || status LIKE '%$sSearchactive%') ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_assessments_category  where status !=2");

			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_assessments_category  where status !=2 ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
		}

		$countryMsg = '';
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){

			$query="SELECT  FROM tbl_assessments_category";
			$results=$modelObj->fetchRows($query);

			$cms_id = $result['categoryid'];
			$title = urldecode($result['categoryname']);

/*	  $image = $result['image'];
      if($image == '')
      {
      $imagesrc ='http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';
      }
      else {
        $imagesrc = COFIG_SITE_URL_IMG.'evm_img/'.$image;
      } */
			$status = $result['status'];

			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';

			$cms='<td>'.$title.'</td>';

		//	$cmsemail='<td><img height="100" width="100" src='.$imagesrc.'></td>';


			if($status==1)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
			}
			elseif($status==0)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
			}
			 $selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 11 ORDER BY id ASC";

			$moduleresult=$modelObj->fetchRow($selectmodule);
			if($moduleresult['p_field3'] == 1 && $moduleresult['p_field4'] == 1){

			$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)"   onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>';


			$option .='<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'testcategory\')" title="edit">
				<i class="icon-edit"></i>
			</a>
			</div>
			</td>';

			/*';

			-----For Delete Button----------

			$option .='<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'Assessment Category?\')" title="Delete">
			<i class="icon-trash"></i>
			</a>
			
			---------------------------------

			*/


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
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'testcategory\')" title="Delete">
			<i class="icon-trash"></i>
			</a>status
			</div>
			</td>';
	}  else if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==1){

		$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'testcategory\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>

			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'testcategory\')" title="Delete">
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

			$Arr['aaData'][] = array($checkbox,$cms,$status_new,$option);
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
			$qry="UPDATE tbl_assessments_category SET status=1 WHERE  categoryid=".($val);
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
			$qry="UPDATE tbl_assessments_category SET  status=0 WHERE  categoryid=".($val);

			$result =$modelObj->runQuery($qry);

		}
	}
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_assessments_category SET  status=2 WHERE categoryid='".($val)."'";

			$result=$modelObj->runQuery($qry);


		}
	}
?>


<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){

		$qry="SELECT categoryid FROM tbl_assessments_category WHERE (categoryname = '".urlencode($_POST['categoryname'])."') AND status!=2";
				$resultCheck=$modelObj->numRows($qry);
				
				if($resultCheck > 0){
					echo "2"; exit;
				} else {


					$post['categoryname']=urlencode($_POST['categoryname']);
				  	$post['status']=1;

			   	  	 $addfaq=$controller_class->addData('tbl_assessments_category',$post);

						echo '1';
					}
	}
?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){

$qry="SELECT id FROM tbl_assessments_category WHERE (categoryname = '".urlencode($_POST['categoryname'])."') AND status!=2";
				$resultCheck=$modelObj->numRows($qry);
				
				if($resultCheck > 0){
					echo "2"; exit;
				} else {


    $post['categoryname']=urlencode($_POST['categoryname']);
     $post['status']=1;
		//$post['categoryid']=$_POST['hid_userid'];

			$editcms=$controller_class->editData('tbl_assessments_category',$post,"categoryid='".$_POST['hid_userid']."'");

  		echo '1';

  		}
	}
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {

		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_assessments_category  where status !=2";
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
			<?php
			 $selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 11 ORDER BY id ASC";

			$moduleresult=$modelObj->fetchRow($selectmodule);

			if($moduleresult['p_field2'] == 1)
			{

			?>
				<!-- <a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('<?php echo $_SESSION['pid']; ?>')"><i class="icon-plus"></i>Add New</a> -->
				<?php } ?>
				<?php if($result !='' ): ?>
				<div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
					<!-- <button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown"> <i class="icon-check-sign"></i> Action <span class="caret"></span> </button> -->
					<ul class="dropdown-menu">
						<li>
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','Assessment Category?')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','Assessment Category?')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						 <?php if($moduleresult['p_field4'] == 1){ ?>
						<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','Assessment Category?')"><i class="icon-remove"></i>Delete</a>
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
					'aTargets': [0,2,3]
				}],
				"aaSorting": [
                [0, "desc"]
				],
				"sAjaxSource": site_url + 'controllers/ajax_controller/testcategory-ajax-controller.php?action=displaydata'
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

		$qry="UPDATE tbl_assessments_category SET status=2 WHERE 	categoryid='".$_POST['id']."'";
		//$qry="delete from tbl_test  WHERE testid='".$_POST['id']."'";
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
	 	$qry="SELECT * FROM tbl_assessments_category  where categoryid=".$_POST['id'];
		$result_checkexists=$modelObj->numRows($qry);
		$data=$modelObj->fetchRow($qry);






	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update Assessment Category
					<?php } else { ?> Add Assessment Category
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
						<label class="control-label col-md-2"> Title <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="categoryname" maxlength="40" id="categoryname" value="<?php echo urldecode($data['categoryname']); ?>" />
						<span id="error_categoryname" style="color:red" class="error_label"></span> </div>
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
