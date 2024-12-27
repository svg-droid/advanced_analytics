<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/marketing-model.php');
    include('../common-controller.php');
	include('../marketing-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."marketing/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."marketing/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."marketing/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM tbl_marketing_offer where id=".$id;
    $result=$modelObj->fetchRow($qry);
    
   
?>
<div class="col-md-12">
    <div class="widget-content padded">
		<dl><b> Name : </b> <?php echo  urldecode($result['name']); ?></dl> 
		<?php $getCountryById=$controller_class->getCountryById($result['country_id']); ?>
		<dl><b> Country: </b> <?php echo  urldecode($getCountryById['countryname']); ?></dl> 
		<!-- <dl><b> Image Link : </b> <?php echo  urldecode($result['link']); ?></dl>  -->

		<!--start--><?php if($result['image']!=''){
				
			
			if($controller_class->isAws()){ 
				$url = $_SESSION['S3_BUCKET_URL']."upload/marketing/".$result['image'];
				}else{
				$url = $_SESSION['FRNT_DOMAIN_NAME'].'upload/marketing/'.$result['image'];
			}
		?>
			<dl><b> Image : </b> <img width="50" height="50" src="<?php echo $controller_class->displayImage($url); ?>" alt="No Image Found"/></dl>
		<?php } ?><!--End-->
		
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
			$sortfield = 'mf.name';
			}else{
			$sortfield = 'c.countryname';
		}

		$TotalCountqry = $modelObj->numRows("select * FROM tbl_marketing_offer where status!=2");
		
		
		
		
		if($sSearch!=''){
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_marketing_offer as mf LEFT JOIN tbl_country as c ON c.id=mf.country_id where mf.status!=2 AND (mf.name LIKE '%".$sSearch."%' OR c.countryname LIKE '%".$sSearch."%'  ) $query1 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT mf.* FROM tbl_marketing_offer as mf LEFT JOIN tbl_country as c ON c.id=mf.country_id where mf.status!=2 AND (mf.name LIKE '%".$sSearch."%' OR c.countryname LIKE '%".$sSearch."%'  ) ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength." ");	
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_marketing_offer where status!=2 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT mf.* FROM tbl_marketing_offer as mf LEFT JOIN tbl_country as c ON c.id=mf.country_id where mf.status!=2 AND (mf.name LIKE '%".$sSearch."%' OR c.countryname LIKE '%".$sSearch."%'  ) ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
		}
		
		$countryMsg = '';  
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){
			
			$cms_id = $result['id'];

			$cms_page_name = urldecode($result['name']);
			$getCountryById=$controller_class->getCountryById($result['country_id']);
			$cms_page_country = urldecode($getCountryById['countryname']);
			$link = $result['link'];
		

		
			$status = $result['status'];
			
			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
			
			$name='<td>'.$cms_page_name.'</td>';
			$country='<td>'.$cms_page_country.'</td>';
			$link='<td>'.$link.'</td>';
			
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'marketing\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'marketing?\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'marketing offer\')" title="Edit">
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
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'marketing\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'marketing\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'marketing\')" title="Delete">
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
			
			$Arr['aaData'][] = array($checkbox,$name,$country,$status_new,$check_box,$option);
		} 
		
		echo json_encode($Arr); 
	} 
?>
<?php
	if(isset($_POST['check_default']) && $_POST['check_default'] != '')
	{
		 
			
			$qry_set_default="UPDATE `tbl_marketing_offer` SET `is_default` = '0' WHERE `id` !='".$_POST['banner_id']."'";
			$result =$modelObj->runQuery($qry_set_default);
			
			 $qry="UPDATE `tbl_marketing_offer` SET `is_default` = '1' WHERE `id` ='".$_POST['banner_id']."'";
			$result =$modelObj->runQuery($qry);
			
				echo "1";
	}
		
	
	
?>
<?php
	if(isset($_POST['statusactive']) && $_POST['statusactive'] != '')
	{
		$id = explode("," ,$_POST['active']);
		foreach($id as $k => $val)
		{
			$qry="UPDATE tbl_marketing_offer SET status=1 WHERE id=".($val);
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
			$qry="UPDATE tbl_marketing_offer SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);
			
		}
	}	
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_marketing_offer SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);
			
			
		}
	}
?>

<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){	


		$result_checkexists = $modelObj->numRows("SELECT id FROM tbl_marketing_offer where status!=2 and name='".$_POST['name']."'");
		
		if($result_checkexists>0){
			$flag=0;
			echo "0";
		}else {
			$flag=1;
		}
		
		if($flag==1)
		{
			
			if(!dir($upload_dir)){
				mkdir($upload_dir);
			}

			if(isset($_FILES["image"]["tmp_name"])){

				$tmpfile = $_FILES["image"]["tmp_name"];
				$newname = $_FILES["image"]["name"];			

				if($_FILES["image"]["tmp_name"]!=''){
	

					$insertimage 	= 'marketing_'.time().".jpg";	
      				
					move_uploaded_file($tmpfile, $upload_dir.$insertimage);
					
				}

				$file =  $upload_dir.$insertimage;

       			$im  = imagecreatefromjpeg($file); 
				
				imagewebp($im, str_replace('jpg', 'webp', $file) );
	    		imagedestroy($im);
				//unlink($file);
			
				
			}

			
			$post['name']			= urlencode($_POST['name']);			
			$post['country_id']		= urlencode($_POST['addcountry']);			
			$post['link']			= strip_tags($_POST['link']);			
			$post['image']			= str_replace('.jpg' , '.webp', $insertimage);
			$post['status']			= '1';
			$post['created_date']	= date("Y-m-d H:i:s", time());
			$post['updated_date']	= date("Y-m-d H:i:s", time());
			
			$post['ip_address']=$_SERVER['REMOTE_ADDR'];

			$addfaq = $controller_class->addData('tbl_marketing_offer',$post);
			
			echo '1';
		}
	}
?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){	

		
		$result_checkexists=$modelObj->numRows("SELECT id FROM tbl_marketing_offer WHERE name='".trim($_POST['name'])."' and status!=2 and banner_id!='".$_POST['hid_userid']."'");

		if($result_checkexists>0){

			$flag=0;
			echo "0";
		}else{


			if(!dir($upload_dir)){
				mkdir($upload_dir);
			}
		
			if(isset($_FILES["image"]["tmp_name"])){

				$tmpfile = $_FILES["image"]["tmp_name"];
				$newname = $_FILES["image"]["name"];


				if($_FILES["image"]["tmp_name"] != ''){

					
					$insertimage 	= 'banner_'.time().".jpg";	

					$resultImage=$modelObj->fetchRow("SELECT image FROM tbl_marketing_offer WHERE id=".$_POST['hid_userid']);
					unlink($upload_dir.$resultImage['image']);
					
					move_uploaded_file($tmpfile, $upload_dir.$insertimage);

					$file =  $upload_dir.$insertimage;

	       			$im  = imagecreatefromjpeg($file); 
					
					imagewebp($im, str_replace('jpg', 'webp', $file) );
		    		imagedestroy($im);
					//unlink($file);
					
					chmod($upload_dir.$insertimage, 0777);
					
					$qry_img="UPDATE tbl_marketing_offer SET image='".str_replace('.jpg' , '.webp', $insertimage)."' where id='".($_POST['hid_userid'])."'";
					$res_img= $modelObj->runQuery($qry_img);


				}
			}


			$flag=1;
		    $post['id']=$_POST['hid_userid'];
		   
			$post['name']=urlencode($_POST['name']);
			$post['country_id']=urlencode($_POST['addcountry']);
			$post['link']=strip_tags($_POST['link']);
			$post['updated_date']=date("Y-m-d H:i:s", time());
			
			
			$editcms=$controller_class->editData('tbl_marketing_offer',$post,"id='".$post['id']."'");
			echo '1';
		}
	}	
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_marketing_offer ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> Marketing List
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
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','marketing?')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','marketing?')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						   <?php if($moduleresult['p_field4'] == 1){ ?>
						<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','marketing?')"><i class="icon-remove"></i>Delete</a>
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
                        <th class="hidden-xs" style="color: #007aff;">Name</th>
                        <th class="hidden-xs" style="color: #007aff;">Country</th>
						<!--  <th class="hidden-xs" style="color: #007aff;">Image Link</th> -->
                            <th class="hidden-xs" style="color: #007aff;">Status</th>
							 <th class="hidden-xs" style="color: #007aff;">Is Default?</th>
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
					'aTargets': [0, 3,4,5]
				}],
				"aaSorting": [
                [0, "desc"]
				],
				"sAjaxSource": site_url + 'controllers/ajax_controller/marketing-ajax-controller.php?action=displaydata'
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
		
		$qry="UPDATE tbl_marketing_offer SET status=2 WHERE id='".$_POST['id']."'";
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
		$qry="SELECT * FROM tbl_marketing_offer WHERE id=".$_POST['id'];
		$data=$modelObj->fetchRow($qry);
		

	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update Marketing Banner
					<?php } else { ?> Add Marketing Banner
				<?php } ?>
			</div>
			<div class="widget-content padded">
				<form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
					
					<div class="form-group">
						<label class="control-label col-md-2"> Name <font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="name" maxlength="40" id="name" value="<?php echo urldecode($data['name']); ?>" /> <span id="error_name" style="color:red" class="error_label"></span> </div>
					</div>
					
					 <div class="form-group">
						<label class="control-label col-md-2"> Country <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
							<select id="addcountry" name="addcountry" class="form-control" >
								<option value="">Select Country</option>
								<?php 
									$getCountryList=$controller_class->getCountryList();
									foreach($getCountryList as $k => $data1){ ?>
									
									<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['country_id']){ echo "selected"; } ?>><?php echo urldecode($data1['countryname']);?></option>
								<?php } ?>
							</select>
							<span id="error_addcountry" style="color:red" class="error_label"></span>
							
						</div>
					</div>

					<!-- <div class="form-group">
						<label class="control-label col-md-2"> Image link <font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="link"  id="link" value="<?php echo stripslashes($data['link']); ?>" /> <span id="error_link" style="color:red" class="error_label"></span> </div>
					</div> -->
					
			
							
					<div class="form-group">
						<label class="control-label col-md-2">Image <font class="required_mark" color = "red">*</font></label>
						<div class="col-md-4">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
									<?php if($data['image']=='' ){?>
										<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">

										<?php } else { 
										if($controller_class->isAws()){ 
											$url2 = $_SESSION['S3_BUCKET_URL'].'upload/marketing/'.$data['image'];
											}else{
											
											$url2 = $_SESSION['FRNT_DOMAIN_NAME']."upload/marketing/".$data['image'];
										}?>
								<img src="<?php echo $controller_class->displayImage($url2); ?>" width="200px" hieght="150px">
									<?php  } ?>
									<input type="hidden" id="userimage" name="userimage" value='<?php echo $data['image'];?>'>
								</div>
								<div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" id ="image" name="image" accept="image/*" value='<?php echo $data['image'];?>'></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="javascript:void(0);">Remove</a>
								</div>
							</div>
							<input type="hidden" name="image" id="image" value="<?php echo $data['image']; ?>">
							<span><b>Recommended size 1080(Width) x 1920(Height)</b></span>
							<span id="error_image" style="color:red" class="error_label"></span>
							
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
