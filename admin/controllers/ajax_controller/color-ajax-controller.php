<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/color-model.php');
    include('../common-controller.php');
	include('../color-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."color/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."color/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."color/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM tbl_color where id=".$id;
    $result=$modelObj->fetchRow($qry);
    
   
?>
<div class="col-md-12">
    <div class="widget-content padded">
		<dl><b> Color : </b> <?php echo  urldecode($result['title']); ?></dl> 
		
		
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
			$sortfield = 'title';
			}else{
			$sortfield = 'id';
		}

		$TotalCountqry = $modelObj->numRows("select * FROM tbl_color where status!=2");
		
		
		
		
		if($sSearch!=''){
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_color where status!=2 AND (title LIKE '%".$sSearch."%' OR ar_title LIKE '%".$sSearch."%') ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_color where status!=2 AND (title LIKE '%".$sSearch."%' OR ar_title LIKE '%".$sSearch."%')  ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength." ");	
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_color where status!=2 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_color where status!=2 ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
		}
		
		$countryMsg = '';  
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){
			
			$cms_id = $result['id'];

			$cms_page_name = urldecode($result['title']);
			$ar_title = urldecode($result['ar_title']);
		

		
			$status = $result['status'];
			
			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
			
			$name='<td>'.$cms_page_name.'</td>';
			$ar_title='<td>'.$ar_title.'</td>';
		
			
			if($result['is_default']==1){
			$check_box='<td class="check hidden-xs"><label><input class="example" name="ck_id_default" id="ck_id_default" checked="checked" type="checkbox" value="'.$cms_id.'" onclick="return check_default('.$cms_id.');"><span></span></label></td>';
			}else
			{
				$check_box='<td class="check hidden-xs"><label><input class="example" name="ck_id_default" id="ck_id_default" type="checkbox" value="'.$cms_id.'" onclick="return check_default('.$cms_id.');"><span></span></label></td>';
		
			}
				
			if($status==1)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
			}
			elseif($status==0)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
			}
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 3 ORDER BY id ASC";
		$moduleresult=$modelObj->fetchRow($selectmodule); 
		if($moduleresult['p_field3'] == 1 && $moduleresult['p_field4'] == 1){

			$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'color\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'color?\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'color offer\')" title="Edit">
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
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'color\')" title="Delete">
			<i class="icon-trash"></i>
			</a>
			</div>
			</td>';
	}  else if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==1){
				
		$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'color\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'color\')" title="Delete">
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
			
			$Arr['aaData'][] = array($checkbox,$name,$ar_title,$status_new,$option);
		} 
		
		echo json_encode($Arr); 
	} 
?>
<?php
	if(isset($_POST['check_default']) && $_POST['check_default'] != '')
	{
		  $qry="UPDATE `tbl_color` SET `is_default` = '1' WHERE `id` ='".$_POST['banner_id']."'";
			$result =$modelObj->runQuery($qry);
			
			$qry_set_default="UPDATE `tbl_color` SET `is_default` = '0' WHERE `id` !='".$_POST['banner_id']."'";
			$result =$modelObj->runQuery($qry_set_default);
				echo "1";
	}
		
	
	
?>
<?php
	if(isset($_POST['statusactive']) && $_POST['statusactive'] != '')
	{
		$id = explode("," ,$_POST['active']);
		foreach($id as $k => $val)
		{
			$qry="UPDATE tbl_color SET status=1 WHERE id=".($val);
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
			$qry="UPDATE tbl_color SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);
			
		}
	}	
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_color SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);
			
			
		}
	}
?>

<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){	


		$result_checkexists = $modelObj->numRows("SELECT id FROM tbl_color where status!=2 and name='".$_POST['name']."'");
		
		if($result_checkexists>0){
			$flag=0;
			echo "0";
		}else {
			$flag=1;
		}
		
		if($flag==1)
		{
			


			
			$post['title']			= urlencode($_POST['title']);			
			$post['ar_title']=urlencode($_POST['ar_title']);
			$post['status']			= '1';
			$post['cr_date']	= date("Y-m-d H:i:s", time());
			$post['modifieddate']	= date("Y-m-d H:i:s", time());
			
			

			$addfaq = $controller_class->addData('tbl_color',$post);
			
			echo '1';
		}
	}
?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){	

		
		$result_checkexists=$modelObj->numRows("SELECT id FROM tbl_color WHERE name='".trim($_POST['name'])."' and status!=2 and banner_id!='".$_POST['hid_userid']."'");

		if($result_checkexists>0){

			$flag=0;
			echo "0";
		}else{


			

			$flag=1;
		    $post['id']=$_POST['hid_userid'];
		   
			$post['title']=urlencode($_POST['title']);
			$post['ar_title']=urlencode($_POST['ar_title']);
			
			$post['modifieddate']=date("Y-m-d H:i:s", time());
			
			
			$editcms=$controller_class->editData('tbl_color',$post,"id='".$post['id']."'");
			echo '1';
		}
	}	
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_color ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> color List
			<?php
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 3 ORDER BY id ASC";
			$moduleresult=$modelObj->fetchRow($selectmodule); 
			if($moduleresult['p_field2'] == 1)
			{
             
			?>
			<a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('<?php echo $_SESSION['pid']; ?>')"><i class="icon-plus"></i>Add New</a> 
            <?php } ?>
				
				<?php if($result !='' ): ?>

				<div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
					<button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown"> <i class="icon-check-sign"></i> Action <span class="caret"></span> </button>
					<ul class="dropdown-menu">
						<li>
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','color?')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','color?')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						   <?php if($moduleresult['p_field4'] == 1){ ?>
						<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','color?')"><i class="icon-remove"></i>Delete</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			<?php endif;?> </div>
						   <?php if($moduleresult['p_field1'] == 1){ ?>

			<div class="widget-content padded clearfix">
				<table class="table table-bordered table-striped" id="tbl_data_display">
					<thead>
						<th class="check-header hidden-xs">
							<label>
							<input id="checkAll" name="checkAll" type="checkbox"><span></span> </label>
						</th>
                       <th class="hidden-xs" style="color: #007aff;">Color(EN)</th>
					   <th class="hidden-xs" style="color: #007aff;">Color(AR)</th>
                       
						
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
					'aTargets': [0,3,4]
				}],
				"aaSorting": [
                [0, "desc"]
				],
				"sAjaxSource": site_url + 'controllers/ajax_controller/color-ajax-controller.php?action=displaydata'
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
		
		$qry="UPDATE tbl_color SET status=2 WHERE id='".$_POST['id']."'";
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
		$qry="SELECT * FROM tbl_color WHERE id=".$_POST['id'];
		$data=$modelObj->fetchRow($qry);
		

	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update color 
					<?php } else { ?> Add color 
				<?php } ?>
			</div>
			<div class="widget-content padded">
				<form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
					
					<div class="form-group">
						<label class="control-label col-md-2"> Color (EN)<font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="title" maxlength="40" id="title" value="<?php echo urldecode($data['title']); ?>" /> <span id="error_title" style="color:red" class="error_label"></span> </div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-2"> Color (AR)
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="ar_title" maxlength="40" id="ar_title" value="<?php echo urldecode($data['ar_title']); ?>" /> </div>
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
