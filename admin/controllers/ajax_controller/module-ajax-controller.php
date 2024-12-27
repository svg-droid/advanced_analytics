<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/testimonial-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	include('../testimonial-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."testimonial/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."testimonial/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."testimonial/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM testimonial where testimonial_id=".$id;
    $result=$modelObj->fetchRow($qry);
    
?>
<div class="col-md-12">
    <div class="widget-content padded">
		<dl><b>Username : </b> <?php echo  urldecode($result['username']); ?></dl> 
		<dl><b>Testimonial Msg : </b> <?php echo  urldecode($result['testimonial_msg']); ?></dl> 
		
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
		$TotalCountqry = $modelObj->numRows("select * FROM testimonial where status!=2");
		
		
		
		if($sSearch!=''){
			$Filteredqry = $modelObj->numRows("SELECT * FROM testimonial where status!=2 AND (username LIKE '%".$sSearch."%' OR testimonial_msg LIKE '%".$sSearch."%') ");
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM testimonial where status!=2 AND (username LIKE '%".$sSearch."%' OR testimonial_msg LIKE '%".$sSearch."%') ORDER BY created_date ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM testimonial where status!=2 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM testimonial where status!=2  LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
		}
		
		$countryMsg = '';  
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){
			
			$cms_id = $result['testimonial_id'];

			$cms_page_name = urldecode($result['username']);
			$cms_page_names = urldecode($result['testimonial_msg']);

		

	
			$status = $result['status'];
			
			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
			
			$name='<td>'.$cms_page_name.'</td>';
			$names='<td>'.$cms_page_names.'</td>';
		    
			
				
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'testimonial\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'testimonial\')" title="Delete">
			<i class="icon-trash"></i>
			</a>
			</div>
			</td>';
			
			$Arr['aaData'][] = array($checkbox,$name,$names,$status_new,$option);
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
			$qry="UPDATE testimonial SET status=1 WHERE testimonial_id=".($val);
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
			$qry="UPDATE testimonial SET status=0 WHERE testimonial_id=".($val);
			$result =$modelObj->runQuery($qry);
			
		}
	}	
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE testimonial SET status=2 WHERE testimonial_id='".$val."'";
			$result=$modelObj->runQuery($qry);
			
			
		}
	}
?>

<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){		
		$checkexists="SELECT testimonial_id FROM testimonial where username=".$_POST['username'];

		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0){
			$flag=0;
			echo "0";
			}else {
			$flag=1;
		}
		
		
			$post['username']=urlencode($_POST['username']);
			$post['testimonial_msg']=urlencode($_POST['testimonial_msg']);
		
			$addfaq=$controller_class->addData('testimonial',$post);
			echo '1';
		}
	
?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){	
		$checkexists="SELECT testimonial_id FROM testimonial WHERE username='".(trim($_POST['username']))."' and status!=2 and id!='".$_POST['testimonial_id']."' and fk_class_id='".($_POST['classstudentAdd'])."'";
		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0){
			$flag=0;
			echo "0";
			}else{
			$flag=1;
		    $post['testimonial_id']=$_POST['hid_userid'];
			$post['username']=urlencode($_POST['username']);
			$post['testimonial_msg']=urlencode($_POST['testimonial_msg']);
		    
		
			
			
			
			$editcms=$controller_class->editData('testimonial',$post,"testimonial_id='".$post['testimonial_id']."'");
			echo '1';
		}
	}	
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM testimonial ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> Testimonial List
				<a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('<?php echo $_SESSION['pid']; ?>')"><i class="icon-plus"></i>Add New</a>
				<?php if($result !='' ): ?>
				<div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
					<button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown"> <i class="icon-check-sign"></i> Action <span class="caret"></span> </button>
					<ul class="dropdown-menu">
						<li>
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','testimonial')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','testimonial')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','testimonial')"><i class="icon-remove"></i>Delete</a>
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
                        <th class="hidden-xs" style="color: #007aff;">Username</th>
                        <th class="hidden-xs" style="color: #007aff;">Testimonial_Msg</th>

                        
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
				"sAjaxSource": site_url + 'controllers/ajax_controller/testimonial-ajax-controller.php?action=displaydata'
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
		
		$qry="UPDATE testimonial SET status=2 WHERE testimonial_id='".$_POST['id']."'";
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
		$qry="SELECT * FROM testimonial WHERE testimonial_id=".$_POST['id'];
		$data=$modelObj->fetchRow($qry);

	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update Testimonial
					<?php } else { ?> Add Testimonial
				<?php } ?>
			</div>
			<div class="widget-content padded">
				<form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
					
					<div class="form-group">
						<label class="control-label col-md-2">Username <font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="username" maxlength="40" id="username" value="<?php echo urldecode($data['username']); ?>" /> <span id="error_username" style="color:red" class="error_label"></span> </div>
					

				
							
					</div>

					<div class="form-group">
				<label class="control-label col-md-2">Testimonial Msg<font class="required_mark" color="red">*</font>
				</label>
				<div class="col-md-7">
					<textarea class="form-control" name="testimonial_msg" id="testimonial_msg" rows="3">
						<?php echo urldecode($data['testimonial_msg']); ?>
					</textarea>
					<script>
						CKEDITOR.replace('testimonial_msg', {
							on: {
								focus: onFocus,
								blur: onBlur,
								pluginsLoaded: function(evt) {
									var doc = CKEDITOR.document,
										ed = evt.editor;
									if (!ed.getCommand('bold')) doc.getById('exec-bold').hide();
									if (!ed.getCommand('link')) doc.getById('exec-link').hide();
								}
							}
						});
					</script> <span id="error_testimonial_msg" style="color:red" class="error_label"></span>
			</div>

				
							
					</div>

					<?php if($_POST['id'] !=0):?>
					<div class="form-group">
						<label class="control-label col-md-2"></label>
						<div class="col-md-7">
							<input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data['testimonial_id']; ?>" />
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