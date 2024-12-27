<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/newsletter-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	include('../newsletter-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."newsletter/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."newsletter/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."newsletter/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    
    $qry="SELECT * FROM tbl_newletter where id=".$id;
    $result=$modelObj->fetchRow($qry);

    $query="SELECT * FROM tbl_posttype where id=".$result['posttype'];
    $results=$modelObj->fetchRow($query);

    $qury="SELECT * FROM tbl_language where id=".$result['fk_language_id'];
    $resul=$modelObj->fetchRow($qury);
    
?>
<div class="col-md-12">
    <div class="widget-content padded">
        <dl><b>Language Name </b> <?php echo  urldecode($resul['languagename']); ?></dl> 
		<dl><b>News letter Name : </b> <?php echo  urldecode($result['name']); ?></dl> 
		<dl><b>News letter Email : </b> <?php echo  urldecode($result['email']); ?></dl> 
		<dl><b>Post Type Name: </b> <?php echo  urldecode($results['posttypename']); ?></dl> 
		
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
		$TotalCountqry = $modelObj->numRows("select * FROM tbl_newletter where status!=2");

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
			
			$user = $modelObj->fetchRows("SELECT id FROM tbl_posttype WHERE status!=2 and posttypename LIKE '%".$sSearch."%'");
			
			foreach($user as $k => $data){
				$user_id[]="'".$data['id']."'";
				
			}			
			$userids = implode(",",$user_id);	
			
			if($userids!=''){
				$query2= "OR posttype IN ($userids)";
			}
		}
		
		
		//(area LIKE '%".$sSearch."%' OR zipcode LIKE '%".$sSearch."%') ");
		if($sSearch!=''){
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_newletter where status!=2 AND (name LIKE '%".$sSearch."%' OR email LIKE '%".$sSearch."%'$query1 $query2)");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_newletter where status!=2 AND (name LIKE '%".$sSearch."%'  OR email LIKE '%".$sSearch."%' $query1 $query2) ORDER BY createdatetime ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_newletter where newsparentid=0 AND status!=2 ");
			
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_newletter where newsparentid=0 AND status!=2  LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
		}
		
		$stateMsg = '';  
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){

			  $qury="SELECT * FROM tbl_language where status=1";
			$resul=$modelObj->fetchRows($qury);
           
            $query="SELECT * FROM tbl_posttype where id=".$result['posttype'];
            $results=$modelObj->fetchRow($query);
        			
			$cms_id = $result['id'];

			$cms_name = urldecode($result['name']);
			$cms_email = urldecode($result['email']);
			$cms_post = urldecode($results['posttypename']);
			
			$status = $result['status'];
			
			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
			
			$name='<td>'.$cms_name.'</td>';
			$email='<td>'.$cms_email.'</td>';
			$post='<td>'.$cms_post.'</td>';
		   
			
				
			if($status==1)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
			}
			elseif($status==0)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
			}
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 13 ORDER BY id ASC";
		$moduleresult=$modelObj->fetchRow($selectmodule); 
		if($moduleresult['p_field3'] == 1 && $moduleresult['p_field4'] == 1){

			$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>';
			foreach ($resul as $value) {
			$option .='<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'newsletter\','.$value['id'].')" title="Edit in '.$value['languagename'].'">
			<img src="'.$_SESSION['FRNT_DOMAIN_NAME'].'upload/language/'.$value['image'].'">
			</a>';
			}
			
			$option .='<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'newsletter\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'newsletter\')" title="Edit">
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
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'newsletter\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'newsletter\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'newsletter\')" title="Delete">
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
			
			$Arr['aaData'][] = array($checkbox,$post,$name,$email,$status_new,$option);
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
			$qry="UPDATE tbl_newletter SET status=1 WHERE id=".($val);
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
			$qry="UPDATE tbl_newletter SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);
			
		}
	}	
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_newletter SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);
			
			
		}
	}
?>

<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){		
	$checkexists="SELECT id FROM tbl_newletter where status!=2 and name='".($_POST['name'])."'";
	

		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0){
			$flag=0;
			echo "0";
			}else {
			$flag=1;
		}
		
		if($flag==1)
		{
			$post['posttype']=urlencode($_POST['AddPosttype']);
			$post['fk_language_id']=urlencode($_POST['AddLang']);
			 $post['name']=urlencode($_POST['name']);
		    $post['email']=urlencode($_POST['email']);
            $post['status']='1';
			$post['createdatetime']=date("Y-m-d H:i:s", time());
			$post['updatedatetime']=date("Y-m-d H:i:s", time());
			$post['createdby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
		
			$addfaq=$controller_class->addData('tbl_newletter',$post);
			
			echo '1';
		}
	}
	
?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){	
		
        $checkexists="SELECT id FROM tbl_newletter WHERE name='".(trim($_POST['name']))."' and status!=2 and id!='".$_POST['hid_userid']."' ";
		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0)
		{
			
			$flag=0;
			echo "0";
			}else{
			$flag=1;	
            $query4="SELECT * FROM tbl_newletter WHERE id='".$_POST['hid_userid']."' and status!=2 and fk_language_id='".$_POST['AddLang']."'";
            $result_checkexists=$modelObj->numRows($query4);
            if($result_checkexists==0)
		    {

			$post['newsparentid']=urlencode($_POST['hid_userid']);
			$post['posttype']=urlencode($_POST['AddPosttype']);
			$post['fk_language_id']=urlencode($_POST['AddLang']);
		    $post['name']=urlencode($_POST['name']);
		    $post['email']=urlencode($_POST['email']);
			$post['status']='1';
			$post['createdby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$post['createdatetime']=date("Y-m-d H:i:s", time());
			$post['updatedatetime']=date("Y-m-d H:i:s", time());
		    $post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
            $addfaq=$controller_class->addData('tbl_newletter',$post);		    
		      }
		     else
		     {
		    $post['id']=$_POST['hid_userid'];
		    $post['posttype']=urlencode($_POST['AddPosttype']);
			$post['fk_language_id']=urlencode($_POST['AddLang']);
		    $post['name']=urlencode($_POST['name']);
		    $post['email']=urlencode($_POST['email']);
			$post['updatedatetime']=date("Y-m-d H:i:s", time());
			$post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
		
			}
			$editcms=$controller_class->editData('tbl_newletter',$post,"id='".$post['id']."'");
			echo '1';
		}
	}	
?>
<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_newletter ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> News Letter List
			<?php
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 13 ORDER BY id ASC";
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
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','newsletter')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','newsletter')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						 <?php if($moduleresult['p_field4'] == 1){ ?>
						<li>
							<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','newsletter')"><i class="icon-remove"></i>Delete</a>
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
						
						<th lass="hidden-xs" style="color: #007aff;">Post Type Name</th>

                        <th lass="hidden-xs" style="color: #007aff;">News Letter Name</th>
                         <th lass="hidden-xs" style="color: #007aff;">News Letter Email</th>
                        
                        

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
					'aTargets': [0,4, 5]
				}],
				"aaSorting": [
                [0, "desc"]
				],
				"sAjaxSource": site_url + 'controllers/ajax_controller/newsletter-ajax-controller.php?action=displaydata'
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
		
		$qry="UPDATE tbl_newletter SET status=2 WHERE id='".$_POST['id']."'";
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
		$qry="SELECT * FROM tbl_newletter WHERE fk_language_id='".$_POST['lan_id']."' AND id=".$_POST['id'];
		$result_checkexists=$modelObj->numRows($qry);
		if($result_checkexists==0) {
			$qry="SELECT * FROM tbl_newletter WHERE fk_language_id='".$_POST['lan_id']."' AND newsparentid=".$_POST['id'];
			$data=$modelObj->fetchRow($qry);
		} else {
			$data=$modelObj->fetchRow($qry);
		}

	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update News Letter
					<?php } else { ?> Add News Letter
				<?php } ?>
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

					<div class="form-group">
						<label class="control-label col-md-2"> Post Type <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
							<select id="AddPosttype" name="AddPosttype" class="form-control" >
								<option value="">Select Post Type</option>
								<?php 
									$getPosttype=$controller_class->getPosttype();
									foreach($getPosttype as $k => $data1){ ?>
									
									<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['posttype']){ echo "selected"; } ?>><?php echo urldecode($data1['posttypename']);?></option>
								<?php } ?>
							</select>
							<span id="error_AddPosttype" style="color:red" class="error_label"></span>
							
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">News Letter Name <font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="name" maxlength="40" id="name" value="<?php echo urldecode($data['name']); ?>" /> <span id="error_name" style="color:red" class="error_label"></span>
						 </div>
							
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">News Letter Email <font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="email" name="email" maxlength="40" id="email" value="<?php echo urldecode($data['email']); ?>" /> <span id="error_email" style="color:red" class="error_label"></span>
						 </div>
							
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