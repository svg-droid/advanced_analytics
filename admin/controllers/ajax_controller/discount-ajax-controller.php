<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/discount-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	include('../discount-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."discount/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."discount/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."discount/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM tbl_discount where id=".$id;
    $result=$modelObj->fetchRow($qry);
  // echo  $_SESSION['FRNT_DOMAIN_NAME'];
?>
<div class="col-md-12">
    <div class="widget-content padded">
		<!-- <dl><b>Coupon Name : </b> <?php echo  urldecode($result['couponname']); ?></dl> 
		<dl><b>From Date : </b> <?php echo  $result['fromdate']; ?></dl> 
		<dl><b>To Date : </b> <?php echo  $result['todate']; ?></dl> -->
		<dl><b>Discount Code : </b> <?php echo  $result['discount_code']; ?></dl> 
		<!-- <dl><b>Discount values : </b> <?php echo  $result['discount_rupees']; ?></dl> -->
		<dl><b>Discount Percentage(%) : </b> <?php echo  $result['discount_percentage']; ?></dl>

		

		
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
		 
		  
		   if($iSortCol_0==1)
			 $sortfield = 'discount_code';
		 
		  elseif($iSortCol_0==2)
			 $sortfield = 'discount_percentage';
		  else
			  $sortfield = 'id';
		 
		 
		if($sSortDir_0=='asc'){
			$SortBy = 'asc';
			}else{
			$SortBy = 'desc';
		}
		$TotalCountqry = $modelObj->numRows("select * FROM tbl_discount where status!=2");
		
		
		
		if($sSearch!=''){
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_discount where status!=2 AND (discount_code LIKE '%".$sSearch."%' OR discount_percentage LIKE '%".$sSearch."%') ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_discount where status!=2 AND (discount_code LIKE '%".$sSearch."%' OR discount_percentage LIKE '%".$sSearch."%') ORDER BY createdatetime ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_discount where status!=2 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_discount where status!=2 ORDER BY $sortfield ".$SortBy."  LIMIT ".$iDisplayStart.",".$iDisplayLength." ");	
		}
		
		$countryMsg = '';  
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){
			
			$cms_id = $result['id'];

			$cms_couponname = urldecode($result['discount_code']);
			$cms_per = urldecode($result['discount_percentage']);
			

			
		
            
	
			$status = $result['status'];
			
			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
			
			$coupon='<td>'.$cms_couponname.'</td>';
			$dper='<td>'.$cms_per.'</td>';
			
	

				
			if($status==1)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
			}
			elseif($status==0)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
			}
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 5 ORDER BY id ASC";
		$moduleresult=$modelObj->fetchRow($selectmodule); 
		if($moduleresult['p_field3'] == 1 && $moduleresult['p_field4'] == 1){

			$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'discount\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'discount?\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'discount\')" title="Edit">
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
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'discount\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'discount\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'discount\')" title="Delete">
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
			$Arr['aaData'][] = array($checkbox,$coupon,$dper,$status_new,$option);
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
			$qry="UPDATE tbl_discount SET status=1 WHERE id=".($val);
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
			$qry="UPDATE tbl_discount SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);
			
			
		}
	}
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_discount SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);
			
			
		}
	}
?>

<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){		
		
        /*$checkexists="SELECT id FROM tbl_discount where status!=2 and couponname='".($_POST['couponname'])."'";
		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0){
			$flag=0;
			echo "0";
			}else {
			$flag=1;
		}
		if($flag==1){*/
		
		
			/*$post['couponname']	= urlencode($_POST['couponname']);
			$post['fromdate']=strip_tags(date('Y-m-d',strtotime($_POST['fromdate'])));
			$post['todate']=strip_tags(date('Y-m-d',strtotime($_POST['fromdate'])));*/
			

			$post['discount_code'] 			= strip_tags($_POST['discount_code']);
			$post['discount_percentage']	= strip_tags($_POST['discount_percentage']);
			$post['status']='1';
			$post['createdatetime']			= date("Y-m-d H:i:s", time());
			$post['updatedatetime']			= date("Y-m-d H:i:s", time());
			$post['createdby']				= $_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$post['updatedby']				= $_SESSION['TERRATROVE_ID']['ADMIN_ID'];
		    

		
			$addfaq=$controller_class->addData('tbl_discount',$post);
			echo '1';
		/*}*/
	}
	
?>



<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){	
		
		   
		  /*  $post['couponname']		= urlencpde($_POST['couponname']);
			$post['fromdate']		= strip_tags($_POST['fromdate']);
			$post['todate']			= strip_tags($_POST['todate']);
			$post['discount_rupees'] = strip_tags($_POST['discount_rupees']);*/

			$post['discount_code']		= strip_tags($_POST['discount_code']);
			
			$post['discount_percentage']= strip_tags($_POST['discount_percentage']);
			$post['updatedatetime']		= date("Y-m-d H:i:s", time());
		    $post['updatedby']			= $_SESSION['TERRATROVE_ID']['ADMIN_ID'];
		    
            
			$editcms=$controller_class->editData('tbl_discount',$post,"id='".$_POST['hid_userid']."'");
		
			echo '1';
		
	
	}	
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_discount ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> Discount List
			<?php
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 5 ORDER BY id ASC";
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
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','discount?')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','discount?')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						 <?php if($moduleresult['p_field4'] == 1){ ?>
						<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','discount?')"><i class="icon-remove"></i>Delete</a>
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
                        <th class="hidden-xs" style="color: #007aff;">Discount Code</th>
                        <th class="hidden-xs" style="color: #007aff;">Discount Percentages (%)</th>
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
				"sAjaxSource": site_url + 'controllers/ajax_controller/discount-ajax-controller.php?action=displaydata'
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

		$('#discount_percentage').keyup(function(){
  if ($(this).val() < 100){
    alert("No numbers above 100");
    $(this).val('100');
  }
});

	</script>
<?php } ?>
<?php } ?>
<?php
	if(isset($_POST['delete']) && $_POST['delete'] != ''){
		
		$qry="UPDATE tbl_discount SET status=2 WHERE id='".$_POST['id']."'";
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
		$qry="SELECT * FROM tbl_discount WHERE id=".$_POST['id'];
		$data=$modelObj->fetchRow($qry);

	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update Discount
					<?php } else { ?> Add Discount
				<?php } ?>
			</div>
			<div class="widget-content padded">
				<form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
					
					<!-- <div class="form-group">
						<label class="control-label col-md-2">Coupon Name<font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="couponname" maxlength="40" id="couponname" value="<?php echo urldecode($data['couponname']); ?>" /> <span id="error_couponname" style="color:red" class="error_label"></span>
						 </div>
					</div>
					<div class="form-group">
						  <label class="control-label col-md-2">From Date<font class="required_mark" color="red">*</font></label>
						  <div class="col-md-3">
							 <div class="input-group bootstrap-timepicker">
							<input onfocus="validateMsgHide('fromdate');" class="form-control" id="fromdate" name="fromdate" value="<?php if($_POST['id']==0)
							{ echo date("D:m"); }else{ echo date('m/d/Y',strtotime($data['fromdate'])); } ?>" type="text"><span class="input-group-addon"><i class="icon-time"></i></span></input>
					</div>
					<span id="error_fromdate" style="color:red" class="error_label"></span>
					</div>
                    </div> 
					<script>
					$('#fromdate').datepicker({showMeridian:false});
					</script>
					<div class="form-group">
						<label class="control-label col-md-2">From Date <font class="required_mark" color="red"></font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="date" name="fromdate" maxlength="40" id="fromdate" value="<?php echo stripslashes($data['fromdate']); ?>" /> <span id="error_fromdate" style="color:red" class="error_label"></span> </div>
					</div>
					<div class="form-group">
						  <label class="control-label col-md-2">To Date<font class="required_mark" color="red">*</font></label>
						  <div class="col-md-3">
							 <div class="input-group bootstrap-timepicker">
							<input onfocus="validateMsgHide('todate');" class="form-control" id="todate" name="todate" value="<?php if($_POST['id']==0)
							{ echo date("D:m"); }else{ echo date('m/d/Y',strtotime($data['todate'])); } ?>" type="text"><span class="input-group-addon"><i class="icon-time"></i></span></input>
					</div>
					<span id="error_todate" style="color:red" class="error_label"></span>
					</div>
                    </div> 
					<script>
					$('#todate').datepicker({showMeridian:false});
					</script> -->
					<!-- <div class="form-group">
						<label class="control-label col-md-2"> To Date<font class="required_mark" color="red"></font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="date" name="todate" maxlength="40" id="todate" value="<?php echo stripslashes($data['todate']); ?>" /> <span id="error_todate" style="color:red" class="error_label"></span> </div>
					</div> -->
                    	<div class="form-group">
						<label class="control-label col-md-2">Discount Code<font class="required_mark" color="red"></font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="discount_code" maxlength="40" id="discount_code" value="<?php echo stripslashes($data['discount_code']); ?>" /> <span id="error_discount_code" style="color:red" class="error_label"></span>
						 </div>
					</div> 

					<!-- <div class="form-group">
						<label class="control-label col-md-2">Discount Values<font class="required_mark" color="red"></font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="discount_rupees" maxlength="40" id="discount_rupees" value="<?php echo stripslashes($data['discount_rupees']); ?>" /> <span id="error_discount_rupees" style="color:red" class="error_label"></span>
						 </div>
					</div>  -->

					<div class="form-group">
						<label class="control-label col-md-2">Discount Percentage (%)<font class="required_mark" color="red"></font>
						</label>
						<div class="col-md-7">
						<input class="form-control" name="discount_percentage" type='number' max='100' id="discount_percentage" value="<?php echo stripslashes($data['discount_percentage']); ?>" /> <span id="error_discount_percentage" style="color:red" class="error_label"></span>
						 </div>
					</div> 


					
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