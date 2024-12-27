<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/currency-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	include('../currency-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."currency/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."currency/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."currency/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM tbl_currencys
 where id=".$id;
    $result=$modelObj->fetchRow($qry);

    $que="SELECT * FROM tbl_country where id=".$result['fk_country_id'];
    $res=$modelObj->fetchRow($que);
    
?>
<div class="col-md-12">
    <div class="widget-content padded">
        <dl><b>Country Name : </b> <?php echo  urldecode($res['countryname']); ?></dl> 
		<dl><b>Currency Name : </b> <?php echo  urldecode($result['currencyname']); ?></dl>
		<dl><b>Symbol : </b> <?php echo  $result['symbol']; ?></dl>  
		<dl><b>Currency : </b> <?php echo  $result['fixdefault']; ?></dl> 
	
		<?php if($result['image']!=''){ ?>
			<dl><b> Upload Image : </b> <img width="50" height="50" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>upload/currency/<?php echo $result['image'];?>" alt="No Image Found"/></dl>
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
		$TotalCountqry = $modelObj->numRows("select * FROM tbl_currencys
 where status!=2");
		 
		 if($sSearch!=''){
			
			$user = $modelObj->fetchRows("SELECT id FROM tbl_country WHERE status!=2 and countryname LIKE '%".$sSearch."%'");
			
			foreach($user as $k => $data){
				$user_id[]="'".$data['id']."'";
				
			}			
			$userids = implode(",",$user_id);	
			
			if($userids!=''){
				$query2= "OR fk_country_id IN ($userids)";
			}
		}
		
		
		if($sSearch!=''){
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_currencys
 where status!=2 AND (currencyname LIKE '%".$sSearch."%' OR symbol LIKE '%".$sSearch."%' $query1) ");
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_currencys
 where status!=2 AND (currencyname LIKE '%".$sSearch."%' OR symbol LIKE '%".$sSearch."%' $query1 ) ORDER BY createdatetime ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_currencys
 where status!=2 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_currencys
 where status!=2  LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
		}
		
		$countryMsg = '';  
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){

			  $que="SELECT * FROM tbl_country where id=".$result['fk_country_id'];
            $res=$modelObj->fetchRow($que);
			
			$cms_id = $result['id'];
            $cms_page = urldecode($res['countryname']);
			$cms_name = urldecode($result['currencyname']);
			$cms_shortcode = $result['symbol'];
		

		
			$status = $result['status'];
			
			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
			$names='<td>'.$cms_page.'</td>';
			$name='<td>'.$cms_name.'</td>';

			$shortcode='<td>'.$cms_shortcode.'</td>';
			
					
			if($status==1)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
			}
			elseif($status==0)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
			}
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 20 ORDER BY id ASC";
		$moduleresult=$modelObj->fetchRow($selectmodule); 
		if($moduleresult['p_field3'] == 1 && $moduleresult['p_field4'] == 1){

			$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'currency\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'currency\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'currency\')" title="Edit">
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
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'currency\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'currency\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'currency\')" title="Delete">
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
			
			$Arr['aaData'][] = array($checkbox,$names,$name,$shortcode,$status_new,$option);
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
			$qry="UPDATE tbl_currencys
 SET status=1 WHERE id=".($val);
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
			$qry="UPDATE tbl_currencys
 SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);
			
		}
	}	
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_currencys
 SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);
			
			
		}
	}
?>

<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){		
		$checkexists="SELECT id FROM tbl_currencys
 where status!=2 and currencyname='".($_POST['currencyname'])."' ";
		$result_checkexists=$modelObj->numRows($checkexists);

		

		if($result_checkexists>0){
			$flag=0;
			echo "0";
			}else {
			$flag=1;
		}
		
		if($flag==1){
         
        if($_POST['$txt_default']!=0)
        {


           $query= "SELECT * FROM tbl_currencys
 where fixdefault=1";
           $results=$modelObj->fetchRow($query);
           $que="UPDATE tbl_currencys
 SET fixdefault =0  WHERE id=".$results['id'];
           $res= $modelObj->runQuery($que);
           


	     }
			if(!dir($upload_dir)){ 
				mkdir($upload_dir);
			}
			if(!dir($upload_dirthumb)){
				mkdir($upload_dirthumb);
			}
			if(isset($_FILES["image"]["tmp_name"])){
				$tmpfile = $_FILES["image"]["tmp_name"];
				$newname = $_FILES["image"]["name"];				
				if($_FILES["image"]["tmp_name"]!=''){
					$type=substr($newname,strrpos($newname,'.')+0);
					$insertimage='SUB'.time().$type;
					
					list($width, $height, $type, $attr)=getimagesize($tmpfile);
					if(move_uploaded_file($tmpfile, $upload_dir.$insertimage)){
						if($width >= 50 || $height >= 50){
							$resizeObj_50 = new resize($upload_dir.$insertimage); 
							$resizeObj_50 -> resizeImage(50, 50, 'exact');
							$resizeObj_50 -> saveImage($upload_dirthumb.$insertimage,$upload_dir.$insertimage, 100);
							}else{
							$resizeObj_50 = new resize($upload_dir.$insertimage); 
							$resizeObj_50 -> resizeImage($width, $height, 'exact');
							$resizeObj_50 -> saveImage($upload_dir.$insertimage, 100);
						}
					}
				}
			}

			
			$post['currencyname']=urlencode($_POST['currencyname']);	
			$post['fk_country_id']=urlencode($_POST['AddCountry']);
			$post['symbol']=strip_tags($_POST['symbol']);
			$post['fixdefault']=strip_tags($_POST['txt_default']);
			
			$post['status']='1';
			$post['createdatetime']=date("Y-m-d H:i:s", time());
			$post['updatedatetime']=date("Y-m-d H:i:s", time());
			$post['createdby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$addfaq=$controller_class->addData('tbl_currencys',$post);
			
			if(strip_tags($_POST['txt_default']) ){
				$post['fixdefault'] = '1';				
			}else{
				$post['fixdefault'] = '0';				
			}
			echo '1';
		}
	}
?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){	
		$checkexists="SELECT id FROM tbl_currencys
 WHERE currencyname='".(trim($_POST['currencyname']))."' and status!=2 and id!='".$_POST['hid_userid']."'";
		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0){
			$flag=0;
			echo "0";
			}else{
			if(!dir($upload_dir)){
				mkdir($upload_dir);
				}if(!dir($upload_dirthumb)){
				mkdir($upload_dirthumb);
			}
			if(isset($_FILES["image"]["tmp_name"])){
				$tmpfile = $_FILES["image"]["tmp_name"];
				$newname = $_FILES["image"]["name"];
				if($_FILES["image"]["tmp_name"] != ''){

					$type=substr($newname,strrpos($newname,'.')+0);
					$insertimage='SUB'.time().$type;
					
					$getLastImg="SELECT image FROM tbl_currencys
 WHERE id=".($_POST['hid_userid']);
					$resultImage=$modelObj->fetchRow($getLastImg);
					unlink($upload_dir.$resultImage['image']);
					unlink($upload_dirthumb.$resultImage['image']);
					list($width, $height, $type, $attr)=getimagesize($tmpfile);
					if(move_uploaded_file($tmpfile, $upload_dir.$insertimage)){
						if($width >= 50 || $height >= 50){
							$resizeObj_50 = new resize($upload_dir.$insertimage); 
							$resizeObj_50 -> resizeImage(50, 50, 'exact');
							$resizeObj_50 -> saveImage($upload_dirthumb.$insertimage,$upload_dir.$insertimage, 100);
							}else{
							$resizeObj_50 = new resize($upload_dir.$insertimage); 
							$resizeObj_50 -> resizeImage($width, $height, 'exact');
							$resizeObj_50 -> saveImage($upload_dir.$insertimage, 100);
						}
					}
					$qry_img="UPDATE tbl_currencys
 SET image='".($insertimage)."' where id='".($_POST['hid_userid'])."'";
					$res_img= $modelObj->runQuery($qry_img);
				}
			}
			$flag=1;
		    $post['id']=$_POST['hid_userid'];
			$post['currencyname']=urlencode($_POST['currencyname']);
			 $post['fk_country_id']=urlencode($_POST['AddCountry']);
			$post['symbol']=strip_tags($_POST['symbol']);
			$post['fixdefault']=strip_tags($_POST['txt_default']);
			
			$editcms=$controller_class->editData('tbl_currencys
',$post,"id='".$post['id']."'");
			echo '1';
		}
	}	
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_currencys
 ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> Language List
			<?php
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 20 ORDER BY id ASC";
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
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','currency')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','currency')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						 <?php if($moduleresult['p_field4'] == 1){ ?>
						<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','currency')"><i class="icon-remove"></i>Delete</a>
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
						 <th class="hidden-xs" style="color: #007aff;">Country Name</th>
                        <th class="hidden-xs" style="color: #007aff;">Currency Name</th>
                         <th class="hidden-xs" style="color: #007aff;">Symbol</th>
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
					'aTargets': [0, 4, 5]
				}],
				"aaSorting": [
                [0, "desc"]
				],
				"sAjaxSource": site_url + 'controllers/ajax_controller/currency-ajax-controller.php?action=displaydata'
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
		
		$qry="UPDATE tbl_currencys
 SET status=2 WHERE id='".$_POST['id']."'";
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
		$qry="SELECT * FROM tbl_currencys
 WHERE id=".$_POST['id'];
		$data=$modelObj->fetchRow($qry);id

	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update Currency
					<?php } else { ?> Add Currency
				<?php } ?>
			</div>
			<div class="widget-content padded">
				<form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/f1orm-data" action="" class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-md-2"> Country <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
							<select id="AddCountry" name="AddCountry" class="form-control" >
								<option value="">Select Country</option>
								<?php 
									$getCountry=$controller_class->getCountry();
									foreach($getCountry as $k => $data1){ ?>
									
									<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['fk_country_id']){ echo "selected"; } ?>><?php echo urldecode($data1['countryname']);?></option>
								<?php } ?>
							</select>
							<span id="error_AddCountry" style="color:red" class="error_label"></span>
							
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Currency Name <font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="currencyname" maxlength="40" id="currencyname" value="<?php echo urldecode($data['currencyname']); ?>" /> <span id="error_currencyname" style="color:red" class="error_label"></span> </div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Symbol <font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="symbol" maxlength="40" id="symbol" value="<?php echo stripslashes($data['symbol']); ?>" /> <span id="error_symbol" style="color:red" class="error_label"></span> </div>
					</div>
                      
					
					<div class="form-group">
						<label class="control-label col-md-2">Symbol For</label>
						
						<div class="col-md-7">
							<div id="rates">								
								<label class="radio-inline"><input type="checkbox" value="1" 
									<?php if($data['fixdefault']==1)
									{ echo 'checked'; } 
									?> name="txt_default" id="txt_default"><span>Default</span></label>
								
								<span id="error_default" style="color:red" class="error_label"></span>
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