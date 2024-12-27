<?php 

    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/category-model.php');
    include('../common-controller.php');
	include('../category-controller.php');
    include('../../models/ajax-model.php');
    $modelObj 			= new AjaxModel();
	$controller_class 	= new CommonController();
	$upload_dir1 		= $_SESSION['SITE_IMG_PATH']."category/";
    $upload_dir 		= $_SESSION['SITE_IMG_PATH']."category/";
    $upload_dirthumb 	= $_SESSION['SITE_IMG_PATH']."category/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    
    $qry="SELECT * FROM tbl_category where id=".$id;
    
    $result=$modelObj->fetchRow($qry);
    $qury="SELECT * FROM tbl_language where id=".$result['fk_language_id'];
    $resul=$modelObj->fetchRow($qury);
   
    
?>
<div class="col-md-12">
    <div class="widget-content padded">
      <dl><b>Language Name </b> <?php echo  urldecode($resul['languagename']); ?></dl>
    <!--<dl><b>Parent Category Name : </b> <?php echo  $result['categoryname']; ?></dl>-->
    	<?php $getBrandTypeById=$controller_class->getBrandTypeById($result['brandtype_id']); ?>
		<dl><b>Type : </b> <?php echo  urldecode($getBrandTypeById['name']); ?></dl> 
		<?php $getBrandById=$controller_class->getBrandById($result['brand_id']); ?>
		<dl><b>Brand Name:  </b> <?php echo  urldecode($getBrandById['brand_name']); ?></dl>
		<dl><b>Collection Name: </b> <?php echo  urldecode($result['categoryname']); ?></dl> 
		<!--start--><?php if($result['image']!=''){
				
			
			if($controller_class->isAws()){ 
				$url = $_SESSION['S3_BUCKET_URL']."upload/category/".$result['image'];
			}else{
				$url = $_SESSION['FRNT_DOMAIN_NAME'].'upload/category/'.$result['image'];
			}
		?>
			<dl><b> Image : </b> <img width="50" height="50" src="<?php echo $controller_class->displayImage($url); ?>" alt="No Image Found"/></dl>
		<?php } ?><!--End-->
		<!--<dl><b>Details : </b> <?php //echo urldecode($result['description']); ?></dl> -->
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
			$sortfield = 'c.categoryname';
			}
		elseif($iSortCol_0=='2'){
			$sortfield = 't.name';
		}
		elseif($iSortCol_0=='3'){
			$sortfield = 'b.brand_name';
		}
		else{
				$sortfield = 'c.id';
			}
		$TotalCountqry = $modelObj->numRows("select * FROM tbl_category where status!=2 and categoryparentid=0");
		
		
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
			
			$user = $modelObj->fetchRows("SELECT b.id FROM tbl_brand WHERE b.status!=2 and b.brand_name LIKE '%".$sSearch."%'");
			
			foreach($user as $k => $data){
				$user_id[]="'".$data['id']."'";
				
			}			
			$userids = implode(",",$user_id);	
			
			if($userids!=''){
				$query2= "OR c.brand_id IN ($userids)";
			}
		}

		if($sSearch!=''){
			$Filteredqry = $modelObj->numRows("SELECT c.*,t.name,b.brand_name FROM tbl_category as c Left Join tbl_brand_type as t on t.id=c.brandtype_id LEFT JOIN tbl_brand as b ON b.id=c.brand_id where c.status!=2 AND c.categoryparentid=0 AND (c.categoryname LIKE '%".$sSearch."%' OR t.name LIKE '%".$sSearch."%' OR b.brand_name LIKE '%".$sSearch."%' $query1 $query2) ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
			
			/*$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_category where status!=2 AND (categoryname LIKE '%".$sSearch."%' $query1) ORDER BY createdatetime ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
			}*/ 
			$list_activity_log = $modelObj->fetchRows("SELECT c.*,t.name,b.brand_name FROM tbl_category as c Left Join tbl_brand_type as t on t.id=c.brandtype_id LEFT JOIN tbl_brand as b ON b.id=c.brand_id where c.status!=2 AND c.categoryparentid=0 AND (c.categoryname LIKE '%".$sSearch."%' OR t.name LIKE '%".$sSearch."%' OR b.brand_name LIKE '%".$sSearch."%' $query1 $query2) ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_category where categoryparentid=0 AND status!=2 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT c.*,t.name,b.brand_name FROM tbl_category as c Left Join tbl_brand_type as t on t.id=c.brandtype_id LEFT JOIN tbl_brand as b ON b.id=c.brand_id where c.status!=2 AND c.categoryparentid=0 AND (c.categoryname LIKE '%".$sSearch."%' OR t.name LIKE '%".$sSearch."%' OR b.brand_name LIKE '%".$sSearch."%' $query1 $query2) ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
		   }
		
		$stateMsg = '';  
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){


			 $qury="SELECT * FROM tbl_language where status=1";
			$resul=$modelObj->fetchRows($qury);
           
           
			$cms_id = $result['id'];
            
			$cms_name = urldecode($result['categoryname']);
				
			$cms_page_ptype = urldecode($result['name']);
			
			$cms_page_brand = urldecode($result['brand_name']);
			
		
		    

	
			$status = $result['status'];
			
			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
			
			$name='<td>'.$cms_name.'</td>';
			$ptype='<td>'.$cms_page_ptype.'</td>';
			$brand='<td>'.$cms_page_brand.'</td>';
			$description='<td>'.$cms_description.'</td>';
			$parent='<td>'.$cms_parent.'</td>';
		
			if($status==1)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
			}
			elseif($status==0)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
			}
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 17 ORDER BY id ASC";
		$moduleresult=$modelObj->fetchRow($selectmodule); 
		if($moduleresult['p_field3'] == 1 && $moduleresult['p_field4'] == 1){

			$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>';
			foreach ($resul as $value) {
			$option .='<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'category\','.$value['id'].')" title="Edit in '.$value['languagename'].'">
<span>  '.$value['shortcode'].' </span>
			</a>';
			}
			
			$option .='<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'Collection?\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'category\')" title="Edit">
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
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'category\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'category\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'category\')" title="Delete">
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
			
			$Arr['aaData'][] = array($checkbox,$name,$ptype,$brand,$status_new,$option);
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
			/*$qry="UPDATE tbl_category SET status=1 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);*/

		$qry="UPDATE tbl_category
			
			LEFT JOIN  tbl_product ON  tbl_product.categoryid = tbl_category.id
			
			SET tbl_category.status=1,tbl_product.status=1,
			
			
			tbl_category.updatedatetime = '".date("Y-m-d H:i:s", time())."',
			tbl_product.updatedatetime = '".date("Y-m-d H:i:s", time())."'
			
			WHERE  tbl_category.id='".$val."' 
			
			and (tbl_product.id IS NULL OR tbl_product.id IS NOT NULL)
			"; 
			$result=$modelObj->runQuery($qry);
			
		}
	}	
?>
<?php
	if(isset($_POST['statusinactive']) && $_POST['statusinactive'] != '')
	{
		$id = explode("," ,$_POST['inactive']);
		foreach($id as $k => $val)
		{
			/*$qry="UPDATE tbl_category SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);*/
			$qry="UPDATE tbl_category
			
			LEFT JOIN  tbl_product ON  tbl_product.categoryid = tbl_category.id
			
			SET tbl_category.status=0,tbl_product.status=0,
			
			
			tbl_category.updatedatetime = '".date("Y-m-d H:i:s", time())."',
			tbl_product.updatedatetime = '".date("Y-m-d H:i:s", time())."'
			
			WHERE  tbl_category.id='".$val."' 
			
			and (tbl_product.id IS NULL OR tbl_product.id IS NOT NULL)
			"; 
			$result=$modelObj->runQuery($qry);

          
			
		}
	}	
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val)
		{
			/*$qry="UPDATE tbl_category SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);*/

			$qry="UPDATE tbl_category
			
			LEFT JOIN  tbl_product ON  tbl_product.categoryid = tbl_category.id
			
			SET tbl_category.status=2,tbl_product.status=2,
			
			
			tbl_category.updatedatetime = '".date("Y-m-d H:i:s", time())."',
			tbl_product.updatedatetime = '".date("Y-m-d H:i:s", time())."'
			
			WHERE  tbl_category.id='".$val."' 
			
			and (tbl_product.id IS NULL OR tbl_product.id IS NOT NULL)
			"; 
			$result=$modelObj->runQuery($qry);
			
		}
	}
?>
<?php
	/*if(isset($_POST['getBrand']) && $_POST['getBrand'] != ''){
		$id = $_POST['id'];
		$data = '<option value="">Select Brand</option>';
		 $sql = "SELECT * FROM tbl_brand WHERE status=1 AND brandtype_id=".$id;
		$result=$modelObj->fetchRows($sql);
		foreach ($result as $value) {
			$data .= '<option value='.$value['id'].'>'.urldecode($value['brand_name']).'</option>';
		}
		
		 echo $data;
	}*/
?>

<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){		



		$result_checkexists=$modelObj->numRows("SELECT id FROM tbl_category where status!=2 and categoryname='".$_POST['categoryname']."'");

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
	

					$insertimage 	= 'category'.time().'.jpg';	
      				
					move_uploaded_file($tmpfile, $upload_dir.$insertimage);

					$file =  $upload_dir.$insertimage;

	       			$im  = imagecreatefromjpeg($file); 
					
				    imagewebp($im, str_replace('jpg', 'webp', $file) );
		    		imagedestroy($im);
					//unlink($file);
					
				}

				

				
			}
			
			//$post['parentcategoryid']=strip_tags($_POST['AddCat']);
			$post['fk_language_id']	= urlencode($_POST['AddLang']);
			$post['categoryname']	= urlencode($_POST['categoryname']);
			$post['brandtype_id']	= urlencode($_POST['addbrandtype']);
			$post['brand_id']		= urlencode($_POST['brand_name']);
			$post['image']			= str_replace('.jpg' , '.webp', $insertimage);
			$post['description']	= urlencode($_POST['description']);
		    $post['status']			= '1';
			$post['createdatetime']	= date("Y-m-d H:i:s", time());
			$post['updatedatetime']	= date("Y-m-d H:i:s", time());
			$post['createdby']		= $_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$post['updatedby']		= $_SESSION['TERRATROVE_ID']['ADMIN_ID'];
		

		
			$addfaq=$controller_class->addData('tbl_category',$post);
		
			echo '1';
		}
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

					
					$insertimage 	= 'category'.time().'.jpg';	

					$resultImage = $modelObj->fetchRow("SELECT image FROM tbl_category WHERE id=".$_POST['hid_userid']);
					unlink($upload_dir.$resultImage['image']);
					
					move_uploaded_file($tmpfile, $upload_dir.$insertimage);

					$file =  $upload_dir.$insertimage;

	       			$im  = imagecreatefromjpeg($file); 
					

		   			imagewebp($im, str_replace('jpg', 'webp', $file) );
		    		imagedestroy($im);
					//unlink($file);
						
						
					chmod($upload_dir.$insertimage, 0777);
					
					$res_img= $modelObj->runQuery("UPDATE tbl_category SET image='".str_replace('.jpg' , '.webp', $insertimage)."' where id=".$_POST['hid_userid']);


				}
			}

			
			$flag=1;
			$query4="SELECT * FROM tbl_category WHERE id='".$_POST['hid_userid']."' and status!=2 and fk_language_id='".$_POST['AddLang']."'";
            $result_checkexists=$modelObj->numRows($query4);
            if($result_checkexists==0)
		    {
		  
		    $post['categoryparentid']=$_POST['hid_userid'];
			//$post['parentcategoryid']=strip_tags($_POST['AddCat']);
			$post['fk_language_id']=urlencode($_POST['AddLang']);
			$post['categoryname']=urlencode($_POST['categoryname']);
			$post['brandtype_id']=urlencode($_POST['addbrandtype']);
			$post['brand_id']=urlencode($_POST['brand_name']);
			$post['description']=urlencode($_POST['description']);
			$post['status']='1';
			$post['createdatetime']=date("Y-m-d H:i:s", time());
			$post['updatedatetime']=date("Y-m-d H:i:s", time());
			$post['updatedatetime']=date("Y-m-d H:i:s", time());
		    $post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
		    $addfaq=$controller_class->addData('tbl_category',$post);
		    
             }
		     else
		     {	
		     			$checkexists=$modelObj->numRows("SELECT id FROM tbl_category WHERE categoryname='".urlencode($_POST['categoryname'])."' and status!=2 and id!='".$_POST['hid_userid']."'");
		//$result_checkexists=$modelObj->fetchRow($checkexists);
		
		if($checkexists){
			$flag=0;
			echo "0";
		}else{
			$flag=1;

				$post['id']=$_POST['hid_userid'];
				 $post['fk_language_id']=urlencode($_POST['AddLang']);
			 //$post['parentcategoryid']=strip_tags($_POST['AddCat']);
			$post['categoryname']=urlencode($_POST['categoryname']);
			$post['brandtype_id']=urlencode($_POST['addbrandtype']);
			$post['brand_id']=urlencode($_POST['brand_name']);
			$post['description']=urlencode($_POST['description']);
			$post['updatedatetime']=date("Y-m-d H:i:s", time());
		    $post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$editcms=$controller_class->editData('tbl_category',$post,"id='".$post['id']."'");
			echo '1';
		}
	}	
}
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM category ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> Category List
			<?php
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 17 ORDER BY id ASC";
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
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','Collection?')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','Collection?')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
							 <?php if($moduleresult['p_field4'] == 1){ ?>
						<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','Collection?')"><i class="icon-remove"></i>Delete</a>
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
                        <th lass="hidden-xs" style="color: #007aff;">Collection Name</th>
                        <th class="hidden-xs" style="color: #007aff;">Type</th>
                        <th class="hidden-xs" style="color: #007aff;">Brand Name</th>


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
				"sAjaxSource": site_url + 'controllers/ajax_controller/category-ajax-controller.php?action=displaydata'
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
		
		$qry="UPDATE tbl_category SET status=2 WHERE id='".$_POST['id']."'";
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

			$qry="SELECT * FROM tbl_category WHERE fk_language_id='".$_POST['lan_id']."' AND id=".$_POST['id'];
			$result_checkexists=$modelObj->numRows($qry);

			if($result_checkexists==0) {
				$qry="SELECT * FROM tbl_category WHERE fk_language_id='".$_POST['lan_id']."' AND categoryparentid=".$_POST['id'];
				$data=$modelObj->fetchRow($qry);
				$flag = 0;
			} else {
				$data=$modelObj->fetchRow($qry);
				$flag = 1;
			}

		}

		if($_POST['id']==0){ $flag = 1; }
		

		$qry="SELECT * FROM tbl_category WHERE  id=".$_POST['id'];
		$res=$modelObj->fetchRow($qry);

	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update Collection
					<?php } else { ?> Add Collection
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
							<select id="AddLang" name="AddLang" class="form-control" >
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
					

                    
					<!-- <div class="form-group">
						<label class="control-label col-md-2">Parent Category <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
							<select id="AddCat" name="AddCat" class="form-control" >
								<option value="">Select Parent Category</option>
								<?php 
									$getCat=$controller_class->getCat();
									foreach($getCat as $k => $data1){ ?>
									
									<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['id']){ echo "selected"; } ?>><?php echo $data1['categoryname'];?></option>
								<?php } ?>
							</select>
							<span id="error_AddCat" style="color:red" class="error_label"></span>
							
						</div>
					</div> -->
					
					<div class="form-group">
						<label class="control-label col-md-2">Type <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
						<select name="addbrandtype" class="form-control"  id="addbrandtype" onchange="getBrandListByType(this.value)" <?php if($_POST['lan_id']==2){echo 'disabled="true"';} ?>>
							
								<option value="">Select Brand Type</option>
								<?php 
									$getBrandTypeList=$controller_class->getBrandTypeList();
									foreach($getBrandTypeList as $k => $data1){ ?>
									
									<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$res['brandtype_id']){ echo "selected"; } ?>><?php echo urldecode($data1['name']);?></option>
								<?php } ?>
							</select>
							<?php if($_POST['lan_id']==2){ ?>
								<input type="hidden" name="addbrandtype" value="<?php echo $res['brandtype_id']; ?>">
							<?php } ?>
							<span id="error_addbrandtype" style="color:red" class="error_label"></span>
							
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2"> Brand Name<font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
						<select name="brand_name" class="form-control"  id="brand_name" onchange="" <?php if($_POST['lan_id']==2){echo 'disabled="true"';} ?>>
							
								<option value="">Select Brand Name</option>
								<?php 
									

									$getBrandList=$controller_class->getBrandList();
									foreach($getBrandList as $k => $data1){ ?>
									
									<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$res['brand_id']){ echo "selected"; } ?>><?php echo urldecode($data1['brand_name']);?></option>
								<?php } ?>
							</select>
							<?php if($_POST['lan_id']==2){ ?>
								<input type="hidden" name="brand_name" value="<?php echo $res['brand_id']; ?>">
							<?php } ?>
							<span id="error_brand_name" style="color:red" class="error_label"></span>
							
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Collection Name<font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="categoryname" maxlength="40" id="categoryname" value="<?php if($_POST['lan_id']==$_POST['hid_userid']){ echo urldecode($data['']);} else { echo urldecode($data['categoryname']);} ?>" /> <span id="error_categoryname" style="color:red" class="error_label"></span> </div>
				
						
					</div>


					<?php if($flag==1){ ?>

						<div class="form-group">
							<label class="control-label col-md-2">Image <font class="required_mark" color = "red">*</font></label>
							<div class="col-md-4">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
										<?php if($res['image']=='' ){?>
											<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
											<?php } else { 
											if($controller_class->isAws()){ 
												$url2 = $_SESSION['S3_BUCKET_URL'].'upload/category/'.$res['image'];
												}else{
												
												$url2 = $_SESSION['FRNT_DOMAIN_NAME']."upload/category/".$res['image'];
											}?>
									<img src="<?php echo $controller_class->displayImage($url2); ?>" width="200px" hieght="150px">
										<?php  } ?>
										<input type="hidden" id="txt_image" name="txt_image" value='<?php echo $res['image'];?>'>
									</div>
									<?php/* if($_POST['lan_id']==0 || $_POST['lan_id']==1){*/ ?>
									<div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
									<div>
										<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" id ="image" name="image" accept="image/*" value='<?php echo $res['image'];?>'></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="javascript:void(0);">Remove</a>
									</div><?php /* }*/ ?>
								</div>
								<input type="hidden" name="image" id="image" value="<?php echo $res['image']; ?>">
								
								<span id="error_image" style="color:red" class="error_label"></span><br>
								<span><b>Recommended size 600(Width) x 600(Height)</b></span>
								
							</div>
						</div>

					<?php } ?>



					
				<!--<div class="form-group">
				<label class="control-label col-md-2">Details<font class="required_mark" color="red">*</font>
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
			</div></div>-->

					
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

<?php
	if(isset($_POST['getDropDowns']) && $_POST['getDropDowns'] != ''){
		
				
				echo '<option value="" hidden>Select Brand Name</option>';
				$getBannerList=$controller_class->getBrandListById($_POST['id']);

				foreach($getBannerList as $k => $data1){  
					echo "<option value='".$data1['id']."''>".urldecode($data1['brand_name'])."</option>";
				}

	}
?>
