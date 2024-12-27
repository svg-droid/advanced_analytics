<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/permissionmodule-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	include('../permissionmodule-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."permissionmodule/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."permissionmodule/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."permissionmodule/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];   

    $qry="SELECT * FROM tbl_modules_permission where id=".$id;
    $result=$modelObj->fetchRow($qry);

    $que="SELECT * FROM admin where adminid=".$result['fk_admin_id'];
    $res=$modelObj->fetchRow($que);

    $query="SELECT * FROM tbl_permission where id=".$result['fk_permission_id'];
    $results=$modelObj->fetchRow($query);
    
?>
<div class="col-md-12">
    <div class="widget-content padded">
		<dl><b>Admin Name : </b> <?php echo  $res['firstname']; ?>
            <?php echo  $res['lastname']; ?></dl>
		<dl><b>Permission Module Name </b> <?php echo  $results['modulename']; ?></dl> 

		<dl><b>Module For : </b>  <?php if($result['p_field1']==1){echo "View";} ?>
		                          <?php if($result['p_field2']==1){echo "Add";}?>
                                  <?php if($result['p_field3']==1){echo "Edit";}?>
                                  <?php if($result['p_field4']==1){echo "Delete";}?>
		                         </dl> 

                                <label class="radio-inline"><input type="checkbox" value="1" <?php if($result['p_field1']==1){echo "checked";}?>  name="txt_add<?php echo $i; ?>" id="txt_permission<?php echo $i; ?>"><span>View</span></label>
								<label class="radio-inline"><input type="checkbox" value="1" <?php if($result['p_field2']==1){echo "checked";}?>  name="txt_view<?php echo $i; ?>" id="txt_permission<?php echo $i; ?>"><span>Add</span></label>
								<label class="radio-inline"><input type="checkbox" value="1" <?php if($result['p_field3']==1){echo "checked";}?>  name="txt_edit<?php echo $i; ?>" id="txt_permission<?php echo $i; ?>"><span>Edit</span></label>
								<label class="radio-inline"><input type="checkbox" value="1" <?php if($result['p_field4']==1){echo "checked";}?>  name="txt_delete<?php echo $i; ?>" id="txt_permission<?php echo $i; ?>"><span>Delete</span></label>
	</div>	
	</div>
</div>
<?php endif; ?>
<?php
	
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "displaydata"){
		
		$iDisplayStart = $_REQUEST['iDisplayStart'];
		$iDisplayLength = $_REQUEST['iDisplayLength'];
		$sSearch = $_REQUEST['sSearch'];
		$sSortDir_0 = $_REQUEST['sSortDir_0'];
		if($sSortDir_0=='asc'){
			$SortBy = 'asc';
			}else{
			$SortBy = 'desc';
		}
		$TotalCountqry = $modelObj->numRows("select * FROM tbl_modules_permission where status!=2");


		if($sSearch!=''){
			
			$user = $modelObj->fetchRows("SELECT adminid FROM admin WHERE status!=2 and firstname LIKE '%".$sSearch."%'");
			
			foreach($user as $k => $data){
				$user_id[]="'".$data['id']."'";
				
			}			
			$userids = implode(",",$user_id);	
			
			if($userids!=''){
				$query1= "OR fk_admin_id IN ($userids)";
			}
		}
		
      
		if($sSearch!=''){
			 
			$user = $modelObj->fetchRows("SELECT id FROM tbl_permission WHERE status!=2 and modulename LIKE '%".$sSearch."%'");
			
			foreach($user as $k => $data){
				$user_id[]="'".$data['id']."'";
				
			}			
			$userids = implode(",",$user_id);	
			
			if($userids!=''){
				$query2= "OR fk_permission_id IN ($userids)";
			}
		}
		
		
		if($sSearch!=''){
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_modules_permission where status!=2  $query1 $query2 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_modules_permission where status!=2 $query1 $query2 ORDER BY createdatetime ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_modules_permission where status!=2 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_modules_permission where status!=2  LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
		}
		
		$stateMsg = '';  
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){
           
            $que="SELECT * FROM admin where adminid=".$result['fk_admin_id'];
            $res=$modelObj->fetchRow($que);
            $query="SELECT * FROM tbl_permission where id=".$result['fk_permission_id'];
			$results=$modelObj->fetchRow($query);
        			
			$cms_id = $result['id'];

			$cms_admin_name = $res['firstname'] .$res['lastname'];
			$cms_permission = $results['modulename'];


		    

	
			$status = $result['status'];
			
			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
			
			$admin_name='<td>'.$cms_admin_name.'</td>';
			$permission='<td>'.$cms_permission.'</td>';
		
			
				
			if($status==1)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
			}
			elseif($status==0)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
			}
			$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'permissionmodule\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'permissionmodule\')" title="Delete">
			<i class="icon-trash"></i>
			</a>
			</div>
			</td>';
			
			$Arr['aaData'][] = array($checkbox,$admin_name,$permission,$status_new,$option);
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
			$qry="UPDATE tbl_modules_permission SET status=1 WHERE id=".($val);
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
			$qry="UPDATE tbl_modules_permission SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);
			
		}
	}	
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_modules_permission SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);
			
			
		}
	}
?>

<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){		
		$checkexists="SELECT id FROM tbl_modules_permission where status!=2  and fk_admin_id='".$_POST['AddAdmin']."' ";		
	
		
		$result_checkexists=$modelObj->numRows($checkexists);
		
		if($result_checkexists>0){
			$flag=0;
			echo "0";
			}else {
			$flag=1;
		}
		
		if($flag==1)
		{
			$j=strip_tags($_POST['total_value']);

			for($h=1; $h<$j;$h++) {

			$post['p_field1']=$_POST['txt_add'.$h];
			$post['p_field2']=$_POST['txt_view'.$h];
			$post['p_field3']=$_POST['txt_edit'.$h];
			$post['p_field4']=$_POST['txt_delete'.$h];

			$post['fk_admin_id']=strip_tags($_POST['AddAdmin']);
			$post['fk_permission_id']=$_POST['module'].$h;
			$post['status']='1';
			$post['createdatetime']=date("Y-m-d H:i:s", time());
			$post['updatedatetime']=date("Y-m-d H:i:s", time());
			$post['createdby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];

          

		
			$addfaq=$controller_class->addData('tbl_modules_permission',$post);
			
		   }
			echo '1';
		}
	}
	
?>

<?php
		if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){	
		$checkexists="SELECT id FROM tbl_modules_permission  and status!=2 and id!='".$_POST['hid_userid']."'";
		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0){
			$flag=0;
			echo "0";
			}else{
			$j=strip_tags($_POST['total_value']);

			
            $flag=1;
		    $post['p_field1']=$_POST['txt_add'];
			$post['p_field2']=$_POST['txt_view'];
			$post['p_field3']=$_POST['txt_edit'];
			$post['p_field4']=$_POST['txt_delete'];

			$post['fk_admin_id']=strip_tags($_POST['AddAdmin']);
		    $post['fk_permission_id']=$_POST['module'];
		    $post['id']=$_POST['hid_userid'];
			$post['updatedatetime']=date("Y-m-d H:i:s", time());
		    $post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];		    
			
			
			$editcms=$controller_class->editData('tbl_modules_permission',$post,"id='".$post['id']."'");
		
		

			echo '1';
		}
	}	
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_modules_permission ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i>Permission Module List
				<a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('<?php echo $_SESSION['pid']; ?>')"><i class="icon-plus"></i>Add New</a>
				<?php if($result !='' ): ?>
				<div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
					<button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown"> <i class="icon-check-sign"></i> Action <span class="caret"></span> </button>
					<ul class="dropdown-menu">
						<li>
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','permissionmodule')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','permissionmodule')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','permissionmodule')"><i class="icon-remove"></i>Delete</a>
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
                        <th class="hidden-xs" style="color: #007aff;">Admin Name</th>       
                        <th class="hidden-xs" style="color: #007aff;">Permission Module Name</th> 
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
				"sAjaxSource": site_url + 'controllers/ajax_controller/permissionmodule-ajax-controller.php?action=displaydata'
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
		
		$qry="UPDATE tbl_modules_permission SET status=2 WHERE id='".$_POST['id']."'";
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
		$qry="SELECT * FROM tbl_modules_permission WHERE id=".$_POST['id'];
		$data=$modelObj->fetchRow($qry);

	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update Permission Module
					<?php } else { ?> Add Permission Module
				<?php } ?>
			</div>
			<div class="widget-content padded">
				<form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
					
					
					<div class="form-group">
						<label class="control-label col-md-2"> Admin Name <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
							<select id="AddAdmin" name="AddAdmin" class="form-control" >
								<option value="">Select Admin Name</option>
								<?php 
									$getAdmin=$controller_class->getAdmin();
									foreach($getAdmin as $k => $data1){ ?>
									
									<option value='<?php echo $data1['adminid'];?>' <?php if($data1['adminid']==$data['fk_admin_id']){ echo "selected"; } ?>><?php echo $data1['firstname'];?>
										   <?php echo  $data1['lastname']; ?>
									</option>
								<?php } ?>
							</select>
							<span id="error_AddAdmin" style="color:red" class="error_label"></span>
							
						</div>
					</div>
                	<?php if($_POST['id'] !=0):?>
				
					<div class="form-group">
							<label class="control-label col-md-2">
							
							<?php 

									$getPermission=$controller_class->getPermission($data['fk_permission_id']);
								
							?>
									<?php echo $getPermission['modulename'] ;?>
										  
			 
							</label>
							<input type="hidden" name="module" id="module" value="<?php echo $data['fk_permission_id']; ?>" >
                        
						<div class="col-md-7">
							<div id="rates">
								 <label class="radio-inline"><input type="checkbox" value="1" <?php if($data['p_field1']==1){echo "checked";}?>  name="txt_add" id="txt_permission"><span>View</span></label>
								<label class="radio-inline"><input type="checkbox" value="1" <?php if($data['p_field2']==1){echo "checked";}?>  name="txt_view" id="txt_permission"><span>Add</span></label>
								<label class="radio-inline"><input type="checkbox" value="1" <?php if($data['p_field3']==1){echo "checked";}?>  name="txt_edit" id="txt_permission"><span>Edit</span></label>
								<label class="radio-inline"><input type="checkbox" value="1" <?php if($data['p_field4']==1){echo "checked";}?>  name="txt_delete" id="txt_permission"><span>Delete</span></label>

							</div>
						</div>
					</div>


					
                    <input type="hidden" name="total_value" value="<?php echo $i; ?>">
					<?php else:?>
						 <?php
					$i=1; 
					$query="SELECT * FROM tbl_permission";
                    $results=$modelObj->fetchRows($query);
                    foreach ($results as $key)
					{
					?>
					<div class="form-group">
							<label class="control-label col-md-2"><?php echo $key['modulename']; ?></label>
							<input type="hidden" name="module<?php echo $i; ?>" id="module<?php echo $i; ?>" value="<?php echo $results['id']; ?>" >

						<div class="col-md-7">
							<div id="rates">
								 <label class="radio-inline"><input type="checkbox" value="1" <?php if($results['p_field1']==1){echo "checked";}?>  name="txt_add<?php echo $i; ?>" id="txt_permission<?php echo $i; ?>"><span>View</span></label>
								<label class="radio-inline"><input type="checkbox" value="1" <?php if($results['p_field2']==1){echo "checked";}?>  name="txt_view<?php echo $i; ?>" id="txt_permission<?php echo $i; ?>"><span>Add</span></label>
								<label class="radio-inline"><input type="checkbox" value="1" <?php if($results['p_field3']==1){echo "checked";}?>  name="txt_edit<?php echo $i; ?>" id="txt_permission<?php echo $i; ?>"><span>Edit</span></label>
								<label class="radio-inline"><input type="checkbox" value="1" <?php if($results['p_field4']==1){echo "checked";}?>  name="txt_delete<?php echo $i; ?>" id="txt_permission<?php echo $i; ?>"><span>Delete</span></label>

							</div>
						</div>
					</div>


					<?php
					$i++;
					}
					?>
                    <input type="hidden" name="total_value" value="<?php echo $i; ?>">
					
                    <?php endif;?> 

					
					<?php if($_POST['id'] !=0):?>
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