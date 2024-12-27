<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/lenscare-model.php');
    include('../common-controller.php');
	include('../lenscare-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."lenscare/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."lenscare/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."lenscare/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM tbl_lenscare where id=".$id;
    $result=$modelObj->fetchRow($qry);
    
    $query="SELECT * FROM tbl_language where id=".$result['fk_language_id'];
    $results=$modelObj->fetchRow($query)
   
?>
<div class="col-md-12">
    <div class="widget-content padded">
    <dl><b>Language Name </b> <?php echo  urldecode($results['languagename']); ?></dl> 
    <dl><b>LensCare Title : </b> <?php echo  urldecode($result['lenscare_title']); ?></dl> 
		<?php if($result['type']==1) 
		{ 
			$type="Image";
		}
		else
		{
			$type = "Video";
		}
		?>

		<dl><b>Type : </b> <?php echo  urldecode($type); ?></dl> 
		<?php if($result['type']==1) { ?>		
		<!--start--><?php if($result['image']!=''){
				
			
			if($controller_class->isAws()){ 
				$url = $_SESSION['S3_BUCKET_URL']."upload/lenscare/".$result['image'];
				}else{
				$url = $_SESSION['FRNT_DOMAIN_NAME'].'upload/lenscare/'.$result['image'];
			}
		?>
			<dl><b> Image : </b> <img width="50" height="50" src="<?php echo $controller_class->displayImage($url); ?>" alt="No Image Found"/></dl>
		<?php } ?><!--End-->
		<?php } else { ?>

		<dl><b>video Url : </b> <video width="300" height="170" controls><source src='<?php echo  $result['video_url']; ?>'></video></dl> 
		<?php } ?>
		<dl><b>Short Description : </b> <?php echo  urldecode($result['short_description']); ?></dl> 
		<dl><b>Description : </b> <?php echo  urldecode($result['description']); ?></dl> 
		
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
	
		
		$TotalCountqry = $modelObj->numRows("select * FROM tbl_lenscare where status!=2 and lenparentid=0");
		
		
		
		if($sSearch!=''){
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_lenscare where status!=2 AND lenparentid=0 and (short_description LIKE '%".$sSearch."%' OR lenscare_title LIKE '%".$sSearch."%')");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_lenscare where status!=2 AND lenparentid=0 and (short_description LIKE '%".$sSearch."%' OR lenscare_title LIKE '%".$sSearch."%') ORDER BY id  ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
			
	
	
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_lenscare where status!=2 and lenparentid=0 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_lenscare where status!=2 AND lenparentid=0 ORDER BY lenscare_title ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
		}
		
		$countryMsg = '';  
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){

			$query="SELECT * FROM tbl_language where status=1";
			$results=$modelObj->fetchRows($query);
			
			$cms_id = $result['id'];

			$cms_page_name = urldecode($result['lenscare_title']);
			$cms_page_name1 = urldecode($result['short_description']);
			
		

		
			$status = $result['status'];
			
			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
			
			$title='<td>'.$cms_page_name.'</td>';
			$desc='<td>'.$cms_page_name1.'</td>';
			$link='<td>'.$link.'</td>';
			
			
					
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
			</a>';
			foreach ($results as $value) {
			/*$option .='<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'lenscare\','.$value['id'].')" title="Edit in '.$value['languagename'].'">
			<img src="'.$_SESSION['FRNT_DOMAIN_NAME'].'upload/language/'.$value['image'].'" width="30px">
			</a>';*/

			$option .='<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'lenscare\','.$value['id'].')" title="Edit in '.$value['languagename'].'">'.$value['shortcode'].'</a>';
			}
			
			$option .='<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'lenscare?\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'lenscare\')" title="Edit">
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
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'lenscare\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'lenscare\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'lenscare\')" title="Delete">
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
			
			$Arr['aaData'][] = array($checkbox,$title,$desc,$status_new,$option);
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
			$qry="UPDATE tbl_lenscare SET status=1 WHERE id=".($val);
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
			$qry="UPDATE tbl_lenscare SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);
			
		}
	}	
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_lenscare SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);
			
			
		}
	}
?>

<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){		
			
	

			if(!dir($upload_dir)){
				mkdir($upload_dir);
			}

			if(isset($_FILES["image"]["tmp_name"])){

				$tmpfile = $_FILES["image"]["tmp_name"];
						

				if($_FILES["image"]["tmp_name"]!=''){
	

					$insertimage 	= 'lenscare'.time().".jpg";	
      				
					move_uploaded_file($tmpfile, $upload_dir.$insertimage);

					$file =  $upload_dir.$insertimage;

	       			$im  = imagecreatefromjpeg($file); 
					
					imagewebp($im, str_replace('jpg', 'webp', $file) );
		    		imagedestroy($im);
					//unlink($file);
				
				}

			}
			$post['lenscare_title']=urlencode($_POST['titles']);
			$post['fk_language_id']	= urlencode($_POST['AddLang']);
			$post['type']=strip_tags($_POST['type_name']);
			$post['video_url']=strip_tags($_POST['link']);			
			
			$post['description']=urlencode($_POST['description']);
			$post['short_description']=urlencode($_POST['short_description']);

			$post['image']=str_replace('.jpg' , '.webp', $insertimage);
			$post['status']='1';
			$post['created_date']=date("Y-m-d H:i:s", time());
			$post['updated_date']=date("Y-m-d H:i:s", time());
			
			
			$addfaq=$controller_class->addData('tbl_lenscare',$post);
			
			echo '1';
		
	}
?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){	
		
			if(!dir($upload_dir)){
				mkdir($upload_dir);
			}
		
			if(isset($_FILES["image"]["tmp_name"])){

				$tmpfile = $_FILES["image"]["tmp_name"];
				$newname = $_FILES["image"]["name"];


				if($_FILES["image"]["tmp_name"] != ''){

					
					$insertimage 	= 'lenscare'.time().".jpg";	
					$getLastImg="SELECT image FROM tbl_lenscare WHERE id=".$_POST['hid_userid'];
					$resultImage=$modelObj->fetchRow($getLastImg);
					unlink($upload_dir.$resultImage['image']);
					
					move_uploaded_file($tmpfile, $upload_dir.$insertimage);

					$file =  $upload_dir.$insertimage;

	       			$im  = imagecreatefromjpeg($file); 
					
					imagewebp($im, str_replace('jpg', 'webp', $file) );
		    		imagedestroy($im);
					//unlink($file);
					
					chmod($upload_dir.$insertimage, 0777);
					
					$qry_img="UPDATE tbl_lenscare SET image='".str_replace('.jpg' , '.webp', $insertimage)."' where id='".$_POST['hid_userid']."'";
					$res_img= $modelObj->runQuery($qry_img);


				}
			}

			
		//}
			$query4="SELECT * FROM tbl_lenscare WHERE id='".$_POST['hid_userid']."' and status!=2 and fk_language_id='".$_POST['AddLang']."'";
			
            $result_checkexists=$modelObj->numRows($query4);

            if($result_checkexists==0){

			    //$post['country_id'] = implode(',',$_POST['txtcountry']);
			$post['lenparentid']=$_POST['hid_userid'];
			$post['lenscare_title']=urlencode($_POST['titles']);			
			$post['fk_language_id']	= urlencode($_POST['AddLang']);
					
			
			$post['description']=urlencode($_POST['description']);
			$post['short_description']=urlencode($_POST['short_description']);

			//$post['image']=str_replace('.jpg' , '.webp', $insertimage);
			$post['status']='1';
			$post['created_date']=date("Y-m-d H:i:s", time());
			$post['updated_date']=date("Y-m-d H:i:s", time());
			
			
			$addfaq=$controller_class->addData('tbl_lenscare',$post);
			
			
			}else{

			$flag=1;
			$post['id']				= $_POST['hid_userid'];
			$post['lenscare_title']=urlencode($_POST['titles']);
			$post['fk_language_id']	= $_POST['AddLang'];
			$post['type']=strip_tags($_POST['type_name']);
		    $post['video_url']=strip_tags($_POST['link']);			
			
			$post['description']=urlencode($_POST['description']);
			$post['short_description']=urlencode($_POST['short_description']);
			//$post['image']=$insertimage;
			$post['status']='1';
			
			$post['updated_date']=date("Y-m-d H:i:s", time());
			$post['id']=$_POST['hid_userid'];
			$editcms=$controller_class->editData('tbl_lenscare',$post,"id='".$post['id']."'");
			
		}
	echo '1';
	}	

?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_lenscare ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> Lens Care List
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
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','lenscare?')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','lenscare?')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						   <?php if($moduleresult['p_field4'] == 1){ ?>
						<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','lenscare?')"><i class="icon-remove"></i>Delete</a>
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
                        
                         <th class="hidden-xs" style="color: #007aff;">Lenscare Title</th>
						 <th class="hidden-xs" style="color: #007aff;">Sort Description</th>
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
					'aTargets': [0, 3,4]
				}],
				"aaSorting": [
                [0, "desc"]
				],
				"sAjaxSource": site_url + 'controllers/ajax_controller/lenscare-ajax-controller.php?action=displaydata'
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
		
		$qry="UPDATE tbl_lenscare SET status=2 WHERE id='".$_POST['id']."'";
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
		if($_POST['id']!=0){

		$qry="SELECT * FROM tbl_lenscare WHERE fk_language_id='".$_POST['lan_id']."' AND id=".$_POST['id'];
		$result_checkexists=$modelObj->numRows($qry);
		if($result_checkexists==0) {
				$qry="SELECT * FROM tbl_lenscare WHERE fk_language_id='".$_POST['lan_id']."' AND lenparentid=".$_POST['id'];
				$data=$modelObj->fetchRow($qry);
				
			} else {
				$data=$modelObj->fetchRow($qry);
				
			} 
		}
		$qry="SELECT * FROM tbl_lenscare WHERE  id=".$_POST['id'];
		$res=$modelObj->fetchRow($qry);

	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update Lens Care 
					<?php } else { ?> Add Lens Care
				<?php } ?>
				<div class="col-lg-12" align="right">
					<?php if($_POST['lan_id']!=0 && $_POST['lan_id']!=1){ ?>  View Details :
					<a class="table-actions" href="javascript:void(0)" onclick="view(<?php echo $_POST['id']; ?>)" title="View" >
					<i class="icon-eye-open"></i>
					</a>
					<?php } ?>
				</div>
			</div>
			<div class="widget-content padded">
				<form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">

					<div class="form-group">
						<label class="control-label col-md-2"> Language Name <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
							<select id="AddLang" name="AddLang" class="form-control" <?php echo $class_read; ?>>
								<?php
								if($_POST['id']!=0) {
									$getLangByID=$controller_class->getLangByID($_POST['lan_id']);
								} else {
									$getLangByID=$controller_class->getLang();
								}
									foreach($getLangByID as $k => $data1){ ?>
									
									<option value='<?php echo $data1['id'];?>'selected ><?php echo urldecode($data1['languagename']);?></option>
								<?php } ?>
							</select>
							<span id="error_AddLang" style="color:red" class="error_label"></span>
							
						</div>
					</div>

	                <div class="form-group">
	                    <label class="control-label col-md-2">Lenscare Title <font class="required_mark" color="red">*</font>
	                    </label>
	                    <div class="col-md-7">
	                        <input class="form-control" type="text" name="titles"  id="titles" value="<?php if($_POST['lan_id']==$_POST['hid_userid']){ echo urldecode($data['']);} else { echo urldecode($data['lenscare_title']);} ?>" /> <span id="error_titles" style="color:red" class="error_label"></span> </div>
	                </div>
				
	            <?php if($_POST['lan_id']==0 || $_POST['lan_id']==1){ ?>
					<div class="form-group">
					
						<label class="control-label col-md-2"> Type <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
						<select name="type_name" class="form-control"  id="type_name" onchange="ShowHideDiv(this.value)" >
							
								<option value="">Select Type</option>
								<option value="1" <?php if($res['type']==1 ){ echo "selected"; } ?>>Image</option>
								<option value="2" <?php if($res['type']==2){ echo "selected"; } ?>>Video</option>
							</select>
							<?php if($_POST['lan_id']==2){ ?>
								<input type="hidden" name="type_name" value="<?php echo $res['type']; ?>">
							<?php } ?>
							<span id="error_type_name" style="color:red" class="error_label"></span>
							
						</div>
						
					</div>
					
					<div id = "divtype" style="display: none">
					<div class="form-group">
						<label class="control-label col-md-2"> Video Url <!-- <font class="required_mark" color="red">*</font> -->
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="link"  id="link"  value="<?php echo stripslashes($res['video_url']); ?>" /> <span id="error_link" style="color:red" class="error_label"></span> </div>
						<?php if($_POST['lan_id']==2){ ?>
								<input type="hidden" name="link" value="<?php echo $res['video_url']; ?>">
							<?php } ?>
					</div>
					</div>


					 <script type="text/javascript">
					 <?php if($_POST[ 'id'] !=0){?>
					 	$( document ).ready(function() {
							    ShowHideDiv(<?php echo $data['type']; ?>)
							});
					 <?php } ?>
					function ShowHideDiv(type_name) {
					if(type_name==1)
					{
						$("#divtype").hide();
						$("#txt_dvtype").show();
					}
					else
					{
						$("#divtype").show();
						$("#txt_dvtype").hide();						
					}
					}

					

				</script>
			
			
					<div id="txt_dvtype" style="display: none">	
					
					<div class="form-group">
						<label class="control-label col-md-2">Image <!-- <font class="required_mark" color = "red">*</font> --></label>
						<div class="col-md-4">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
									<?php if($res['image']=='' ){?>
										<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
										<?php } else { 
										if($controller_class->isAws()){ 
											$url2 = $_SESSION['S3_BUCKET_URL'].'upload/lenscare/'.$res['image'];
											}else{
											
											$url2 = $_SESSION['FRNT_DOMAIN_NAME']."upload/lenscare/".$res['image'];
										}?>
								<img src="<?php echo $controller_class->displayImage($url2); ?>" width="200px" hieght="150px">
									<?php  } ?>

									<input type="hidden" id="userimage" name="userimage" value='<?php echo $res['image'];?>'>
								</div>
								<!-- <div style="width=500px;"><?php echo $res['image'] ?></div> -->
								<div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>

								<div style="width:300px">
									<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
									<span class="fileupload-exists">Change</span><input type="file" id ="image" name="image" accept="image/*" value='<?php echo $res['image'];?>'></span>
									<a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="javascript:void(0);">Remove</a>
								</div>
							</div>
							<input type="hidden" name="image" id="image" value="<?php echo $res['image']; ?>">
							<!-- <input type="hidden" name="image" id="image" value="<?php echo $data['image']; ?>"> -->
							<span id="error_image" style="color:red" class="error_label"></span>
							
						</div>
					</div>
				</div>
			<?php } ?>
					<!-- <div class="form-group">
						<label class="control-label col-md-2"> Language Name <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
							<select id="AddLang" name="AddLang" class="form-control" >
								<?php
								if($_POST['id']!=0) {
									$getLangByID=$controller_class->getLangByID($_POST['lan_id']);
								} else {
									$getLangByID=$controller_class->getLang();
								}
									foreach($getLangByID as $k => $data1){ ?>
									
									<option value='<?php echo $data1['id'];?>'selected ><?php echo $data1['languagename'];?></option>
								<?php } ?>
							</select>
							<span id="error_AddLang" style="color:red" class="error_label"></span>
							
						</div>
					</div> -->
					<div class="form-group">
				<label class="control-label col-md-2">Short Description<font class="required_mark" color="red">*</font>
				</label>
				 <div class="col-md-7">
					<textarea class="form-control" name="short_description" id="short_description" rows="3"><?php echo urldecode($data['short_description']); ?></textarea>
					<span id="error_short_description" style="color:red" class="error_label"></span>
			     </div>
			     </div>

					
				<div class="form-group">
				<label class="control-label col-md-2">Description<!-- <font class="required_mark" color="red">*</font> -->
				</label>
				<div class="col-md-7">
					<textarea class="form-control" name="description" id="description" rows="3">
						<?php echo urldecode($data['description']); ?>
					</textarea>
					<script>
						CKEDITOR.replace('description', {
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
					</script> <span id="error_description" style="color:red" class="error_label"></span>
			</div>

				
							
					</div>

					<?php if($_POST[ 'id'] !=0):?>
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
