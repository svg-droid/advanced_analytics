<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/country-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	include('../country-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."country/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."country/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."country/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM tbl_country where id=".$id;
    $result=$modelObj->fetchRow($qry);

     $query="SELECT * FROM tbl_language where id=".$result['fk_language_id'];
    $results=$modelObj->fetchRow($query)
    
?>
<div class="col-md-12">
    <div class="widget-content padded">
		<dl><b>Country Name : </b> <?php echo  urldecode($result['countryname']); ?></dl> 
		<dl><b>Country Short Name : </b> <?php echo  urldecode($result['short_name']); ?></dl> 
		<dl><b>Currency : </b> <?php echo  urldecode($result['currencyname']); ?></dl> 
		<dl><b>Symbol : </b> <?php echo  $result['symbol']; ?></dl>
		<!--start--><?php if($result['county_image']!=''){
				
			
			if($controller_class->isAws()){ 
				$url = $_SESSION['S3_BUCKET_URL']."upload/country/".$result['county_image'];
				}else{
				$url = $_SESSION['FRNT_DOMAIN_NAME'].'upload/country/'.$result['county_image'];
			}
		?>
			<dl><b> Country Image : </b> <img width="50" height="50" src="<?php echo $controller_class->displayImage($url); ?>" alt="No Image Found"/></dl>
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
			$sortfield = 'countryname';
			}
		elseif($iSortCol_0=='2'){
			$sortfield = 'short_name';
		}
		elseif($iSortCol_0=='3'){
			$sortfield = 'currencyname';
		}
		else{
				$sortfield = 'id';
			}
		$TotalCountqry = $modelObj->numRows("select * FROM tbl_country where status!=2");
		
		if($sSearch!=''){
			
			$user = $modelObj->fetchRows("SELECT id FROM tbl_language WHERE status!=2 and languagename LIKE '%".$sSearch."%'");
			
			foreach($user as $k => $data){
				$user_id[]="'".$data['id']."'";
				
			}			
			$userids = implode(",",$user_id);	
			
			if($userids!=''){
				$query1= "OR fk_language_id IN ($userids)";
			}
		}
		
		if($sSearch!=''){
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_country where status!=2 AND (countryname LIKE '%".$sSearch."%' OR currencyname LIKE '%".$sSearch."%' OR short_name LIKE '%".$sSearch."%' OR  symbol LIKE '%".$sSearch."%'  )");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_country where status!=2 AND (countryname LIKE '%".$sSearch."%' OR currencyname LIKE '%".$sSearch."%' OR short_name LIKE '%".$sSearch."%' OR  symbol LIKE '%".$sSearch."%'  ) ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_country where countryparentid=0 AND status!=2 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_country where countryparentid=0 AND status!=2 ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
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

			$countryname = urldecode($result['countryname']);
			$currencyname = urldecode($result['currencyname']);
			$short_name = urldecode($result['short_name']);
			$symbol = $result['symbol'];
			

		

	
			$status = $result['status'];
			
			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
			
			$name='<td>'.$countryname.'</td>';
			
			
				
		if($status==1)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
			}
			elseif($status==0)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
			}
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 8 ORDER BY id ASC";
		$moduleresult=$modelObj->fetchRow($selectmodule); 
		if($moduleresult['p_field3'] == 1 && $moduleresult['p_field4'] == 1){

			$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'country\')" title="Edit">
            <i class="icon-pencil"></i>
            </a>' ;
			/* foreach ($results as $value) {
			$option .='<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'country\','.$value['id'].')" title="Edit in '.$value['languagename'].'">
			<img src="'.$_SESSION['FRNT_DOMAIN_NAME'].'upload/language/'.$value['image'].'" width="30px">
			</a>';
			} */
			
			'</div>
			</td>';
		 } else if($moduleresult['p_field3'] == 1){

		 	$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'country\')" title="Edit">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'country\')" title="Edit">
		 <i class="icon-pencil"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'country\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'country\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'country\')" title="Edit">
		 <i class="icon-pencil"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'country\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'country\')" title="Edit">
		 <i class="icon-pencil"></i>
			</a>
			</div>
			</td>';	
			}	
			
			$Arr['aaData'][] = array($checkbox,$countryname,$short_name,$currencyname,$symbol,$status_new,$option);
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
			$qry="UPDATE tbl_country SET status=1 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);

			$qry = "UPDATE tbl_state SET status=1 WHERE fk_country_id=".($val);
			$result =$modelObj->runQuery($qry);
			$qry = "UPDATE tbl_city SET status=1 WHERE fk_country_id=".($val);
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
			$qry="UPDATE tbl_country SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);

		    $qry = "UPDATE tbl_state SET status=0 WHERE fk_country_id=".($val);
		 	$result =$modelObj->runQuery($qry);
		 	$qry = "UPDATE tbl_city SET status=0 WHERE fk_country_id=".($val);
			$result =$modelObj->runQuery($qry);

			
			
		}
	}	
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_country SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);

			$qry = "UPDATE tbl_state SET status=2 WHERE fk_country_id=".($val);
			$result =$modelObj->runQuery($qry);
			$qry = "UPDATE tbl_city SET status=2 WHERE fk_country_id=".($val);
			$result =$modelObj->runQuery($qry);

			
		}
	}
?>

<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){		
		
        $checkexists="SELECT id FROM tbl_country where status!=2 and countryname=".$_POST['countryname'];
		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0){
			$flag=0;
			echo "0";
			}else {
			$flag=1;
		}
		if($flag==1){


			if(!dir($upload_dir)){
				mkdir($upload_dir);
			}

			if(isset($_FILES["txt_addlogo"]["tmp_name"])){

				$tmpfile = $_FILES["txt_addlogo"]["tmp_name"];
				$newname = $_FILES["txt_addlogo"]["name"];			

				if($_FILES["txt_addlogo"]["tmp_name"]!=''){


					$insertimage 	= 'country_'.time().".jpg";	
	  				
					move_uploaded_file($tmpfile, $upload_dir.$insertimage);
					
				}

				$file =  $upload_dir.$insertimage;

	   			$im  = imagecreatefromjpeg($file); 
				
				imagewebp($im, str_replace('jpg', 'webp', $file) );
	    		imagedestroy($im);
				//unlink($file);
			
				
			}	
		
		
			$post['countryname']=urlencode($_POST['countryname']);
			$post['currencyname']=urlencode($_POST['c_name']);	
			$post['symbol']=strip_tags($_POST['symbol']);
			$post['short_name']=urlencode($_POST['short_name']);
			$post['county_image']=$insertimage;
			$post['fixdefault']=strip_tags($_POST['txt_default']);
			/* $post['fk_language_id']=strip_tags($_POST['AddLang']); */
			$post['status']='1';
			$post['createdatetime']=date("Y-m-d H:i:s", time());
			$post['updatedatetime']=date("Y-m-d H:i:s", time());
			$post['createdby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
		    

		
			$addfaq=$controller_class->addData('tbl_country',$post);
			echo '1';
		}
	}
	
?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){
		
			$flag=1;

			if(!dir($upload_dir)){
				mkdir($upload_dir);
			}
		
			if(isset($_FILES["txt_addlogo"]["tmp_name"])){

				$tmpfile = $_FILES["txt_addlogo"]["tmp_name"];
				$newname = $_FILES["txt_addlogo"]["name"];


				if($_FILES["txt_addlogo"]["tmp_name"] != ''){

					
					$insertimage 	= 'country_'.time().".jpg";	

					$getResult = $modelObj->fetchRow("SELECT county_image FROM tbl_country WHERE id='".$_POST['hid_userid']."'");
					unlink($upload_dir.$getResult['county_image']);
					
					move_uploaded_file($tmpfile, $upload_dir.$insertimage);

					$file =  $upload_dir.$insertimage;

	       			$im  = imagecreatefromjpeg($file); 
					
					imagewebp($im, str_replace('jpg', 'webp', $file) );
		    		imagedestroy($im);
					//unlink($file);
					
					chmod($upload_dir.$insertimage, 0777);
				

					$modelObj->runQuery("UPDATE tbl_country SET county_image='".str_replace('.jpg' , '.webp', $insertimage)."' WHERE id='".$_POST['hid_userid']."' ");

				}
			}
            
			    $post['id']=$_POST['hid_userid'];
				//$post['fk_language_id']=urlencode($_POST['AddLang']);
				$post['countryname']=urlencode($_POST['countryname']);
				$post['currencyname']=urlencode($_POST['c_name']);	
				$post['symbol']=strip_tags($_POST['symbol']);
				$post['fixdefault']=strip_tags($_POST['txt_default']);
				$post['updatedatetime']=date("Y-m-d H:i:s", time());
				$post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			
			$editcms=$controller_class->editData('tbl_country',$post,"id='".$post['id']."'");

			echo '1';
		
	}	
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_country ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> Country List
				<?php
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 8 ORDER BY id ASC";
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
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','country?')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','country?')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						 <?php if($moduleresult['p_field4'] == 1){ ?>
						<!--<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','country?')"><i class="icon-remove"></i>Delete</a>
						</li>-->
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
                        <th class="hidden-xs" style="color: #007aff;">Country Name</th>
                        <th class="hidden-xs" style="color: #007aff;">Country Short Name</th>
                        <th class="hidden-xs" style="color: #007aff;">Currency </th>
                        <th class="hidden-xs" style="color: #007aff;">Symbol </th>
                      
                        
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
					'aTargets': [0, 5,6]
				}],
				"aaSorting": [
                [0, "desc"]
				],
				"sAjaxSource": site_url + 'controllers/ajax_controller/country-ajax-controller.php?action=displaydata'
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
		
		$qry="UPDATE tbl_country SET status=2 WHERE id='".$_POST['id']."'";
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
		
		$qry="SELECT * FROM tbl_country WHERE   id=".$_POST['id'];
		$result_checkexists=$modelObj->fetchRow($qry);
		 
			$data=$modelObj->fetchRow($qry);
		

	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update Country
					<?php } else { ?> Add Country
				<?php } ?>
			</div>
			<div class="widget-content padded">
				<form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
				
              <!--  <div class="form-group">
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
					</div>-->


					<div class="form-group">
						<label class="control-label col-md-2">Country Name <font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="countryname" maxlength="40" id="countryname" value="<?php echo urldecode($data['countryname']); ?>" /> <span id="error_countryname" style="color:red" class="error_label"></span> </div>
					

				
							
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Country Short Name <font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="short_name" maxlength="40" id="short_name" value="<?php echo urldecode($data['short_name']); ?>" /> <span id="error_short_name" style="color:red" class="error_label"></span> </div>
							
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Currency  <font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="c_name" maxlength="40" id="c_name" value="<?php echo urldecode($data['currencyname']); ?>" /> <span id="error_c_name" style="color:red" class="error_label"></span> </div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Symbol <font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="symbol" maxlength="40" id="symbol" value="<?php echo stripslashes($data['symbol']); ?>" /> <span id="error_symbol" style="color:red" class="error_label"></span> </div>
					</div>
                      
					
				
					<div class="form-group">
						<label class="control-label col-md-2">Country Image <font class="required_mark" color = "red">*</font></label>
						<div class="col-md-4">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
									<?php if($data['county_image']== '' ){?>
										<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
										<?php } else { 
										if($controller_class->isAws()){ 
											$url2 = $_SESSION['S3_BUCKET_URL'].'upload/country/'.$data['county_image'];
											}else{
											
											$url2 = $_SESSION['FRNT_DOMAIN_NAME']."upload/country/".$data['county_image'];
										}?>
											<img src="<?php echo $controller_class->displayImage($url2); ?>" width="200px" hieght="150px">
									<?php  } ?>

									<input type="hidden" id="countryImage" name="countryImage" value='<?php echo $data['county_image'];?>'>
								</div>

						

								<!-- <div style="width=500px;"><?php echo $res['county_image'] ?></div> -->
								<div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
								
								<div style="width:300px">
									<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
									<span class="fileupload-exists">Change</span><input type="file" name="txt_addlogo" id="txt_addlogo"></span>
									<a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>
								</div>

								<span id="error_txt_addlogo" style="color:red" class="error_label"></span>

							

							</div>
							</div>
							</div>
							<input type="hidden" value="1" name="txt_default" id="txt_default">
											
							<!--<div class="form-group">
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
							</div>-->

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