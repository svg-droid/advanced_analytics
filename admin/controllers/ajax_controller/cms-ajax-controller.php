<?php
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/cms-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	include('../cms-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."cms/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."cms/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."cms/thumb/";

	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];

    $qry="SELECT * FROM tbl_cms where id=".$id;

    $result=$modelObj->fetchRow($qry);
    $query="SELECT * FROM tbl_language where id=".$result['fk_language_id'];
    $results=$modelObj->fetchRow($query);

?>
<div class="col-md-12">
    <div class="widget-content padded">


		<dl><b>CMS Page Name : </b> <?php echo  urldecode($result['cms_page_name']); ?></dl>
		<dl><b>CMS Page Content : </b> <?php echo  urldecode($result['cms_page_content']); ?></dl>
		<!-- <dl><b>Meta Title : </b> <?php echo  urldecode($result['meta_title']); ?></dl>
		<dl><b>Meta Description : </b> <?php echo  urldecode($result['meta_description']); ?></dl>
		<dl><b>Meta Keyword : </b> <?php echo  urldecode($result['meta_keyword']); ?></dl>
	<dl><b>Language Name </b> <?php echo  urldecode($results['languagename']); ?></dl>
   -->


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
			$sortfield = 'cms_page_name';
			}
		else{
				$sortfield = 'id';
			}
		$TotalCountqry = $modelObj->numRows("select * FROM tbl_cms where status!=2");

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
				$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_cms where cmsparentid=0 AND status!=2 AND (cms_page_name LIKE '%".urlencode($sSearch)."%' $query1 ) ");

			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_cms where cmsparentid=0 AND  status!=2 AND (cms_page_name LIKE '%".urlencode($sSearch)."%' $query1) ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_cms where cmsparentid=0 AND status!=2 ");

			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_cms where  cmsparentid=0 AND status!=2 ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
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


			$cmsname = urldecode($result['cms_page_name']);


			$status = $result['status'];

			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';

			$cms='<td>'.$cmsname.'</td>';



			if($status==1)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
			}
			elseif($status==0)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
			}
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 15 ORDER BY id ASC";
			$moduleresult=$modelObj->fetchRow($selectmodule);
			if($moduleresult['p_field3'] == 1 && $moduleresult['p_field4'] == 1){

			$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>';

			$option .='<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'cms\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>
			</div>
			</td>';
		 } else if($moduleresult['p_field3'] == 1){

		 	$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'cms\')" title="Edit">
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
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'cms\')" title="Delete">
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
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'cms\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>

			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'cms\')" title="Delete">
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

			$Arr['aaData'][] = array($checkbox,$cms,$status_new,$option);
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
			$qry="UPDATE tbl_cms SET status=1 WHERE id=".($val);
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
			$qry="UPDATE tbl_cms SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);

		}
	}
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_cms SET status=2 WHERE id='".$val."'";
			$result=$modelObj->runQuery($qry);


		}
	}
?>

<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){
	$checkexists="SELECT id FROM tbl_cms where status!=2 and cms_page_name='".($_POST['cms_page_name'])."'";


		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0){
			$flag=0;
			echo "0";
			}else {
			$flag=1;
		}

		if($flag==1)
		{

			$post['fk_language_id']=urlencode($_POST['AddLang']);
			$post['cms_page_name']=urlencode($_POST['cms_page_name']);
			$post['cms_page_content']=urlencode($_POST['cms_page_content']);
			$post['meta_title']=urlencode($_POST['meta_title']);
			$post['meta_description']=urlencode($_POST['meta_description']);
			$post['meta_keyword']=urlencode($_POST['meta_keyword']);
            $post['status']='1';
			$post['createdatetime']=date("Y-m-d H:i:s", time());
			$post['updatedatetime']=date("Y-m-d H:i:s", time());
			$post['createdby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];

			$addfaq=$controller_class->addData('tbl_cms',$post);

			echo '1';
		}
	}

?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){

        $checkexists="SELECT id FROM tbl_cms WHERE cms_page_name='".(trim($_POST['cms_page_name']))."' and status!=2 and id!='".$_POST['hid_userid']."'";
		$result_checkexists=$modelObj->numRows($checkexists);
		if($result_checkexists>0)
		{

			$flag=0;
			echo "0";
			}else{
			$flag=1;
            
			    $pst['id']=$_POST['hid_userid'];
			    $pst['cms_page_name']=urlencode($_POST['cms_page_name']);
				$pst['cms_page_content']=urlencode($_POST['cms_page_content']);
				$pst['meta_title']=urlencode($_POST['meta_title']);
				$pst['meta_description']=urlencode($_POST['meta_description']);
				$pst['meta_keyword']=urlencode($_POST['meta_keyword']);
	            $pst['updatedatetime']=date("Y-m-d H:i:s", time());
			    $pst['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
				$editcms=$controller_class->editData('tbl_cms',$pst,"id='".$_POST['hid_userid']."'");
		     
			echo '1';
		}
	}
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_cms ";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> CMS List
			<?php
			$selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 15 ORDER BY id ASC";
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
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','cms?')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','cms?')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						 <?php if($moduleresult['p_field4'] == 1){ ?>
						<li>
							<!-- <a href="javascript:void(0)" onclick="deleteselected('Delete','delete','cms?')"><i class="icon-remove"></i>Delete</a> -->
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

                        <th class="hidden-xs" style="color: #007aff;">CMS Page Name</th>



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
					'aTargets': [0, 2, 3]
				}],
				"aaSorting": [
                [0, "desc"]
				],
				"sAjaxSource": site_url + 'controllers/ajax_controller/cms-ajax-controller.php?action=displaydata'
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

		$qry="UPDATE tbl_cms SET status=2 WHERE id='".$_POST['id']."'";
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
		$qry="SELECT * FROM tbl_cms WHERE fk_language_id='".$_POST['lan_id']."' AND id=".$_POST['id'];
		$result_checkexists=$modelObj->numRows($qry);
		if($result_checkexists==0) {
			$qry="SELECT * FROM tbl_cms WHERE fk_language_id='".$_POST['lan_id']."' AND cmsparentid=".$_POST['id'];
			$data=$modelObj->fetchRow($qry);
		} else {
			$data=$modelObj->fetchRow($qry);
		}

	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update CMS
					<?php } else { ?> Add CMS
				<?php } ?>
				<!-- <div class="col-lg-12" align="right">
					<?php if($data['fk_language_id']!=1){ ?>  View Details :
					<a class="table-actions" href="javascript:void(0)" onclick="view(<?php echo $_POST['id']; ?>)" title="View" >
					<i class="icon-eye-open"></i>
					</a>
					<?php } ?>
				</div> -->
			</div>
			<div class="widget-content padded">
				<form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">

					<div class="form-group" style="display:none;">
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
                   <input type="hidden" name="cmsparentid" value="<?php echo $id;?>" />
					<div class="form-group">
						<label class="control-label col-md-2">CMS Page Name<font class="required_mark" color="red">*</font>
						</label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="cms_page_name" maxlength="40" id="cms_page_name" value="<?php echo urldecode($data['cms_page_name']); ?>" /> <span id="error_cms_page_name" style="color:red" class="error_label"></span>
						 </div>
					</div>


					<div class="form-group">
				<label class="control-label col-md-2">CMS Page Content<font class="required_mark" color="red">*</font>
				</label>
				<div class="col-md-7">
					<textarea class="form-control" name="cms_page_content" id="cms_page_content" rows="3">
						<?php echo urldecode($data['cms_page_content']); ?>
					</textarea>
					<script>
						CKEDITOR.replace('cms_page_content', {
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
					</script> <span id="error_cms_page_content" style="color:red" class="error_label"></span> </div>
			</div>
			<!-- <div class="form-group">
				<label class="control-label col-md-2">Meta Title<font class="required_mark" color="red">*</font>
				</label>
				 <div class="col-md-7">
					<textarea class="form-control" name="meta_title" id="meta_title" rows="3"><?php echo urldecode($data['meta_title']); ?></textarea>
					 <span id="error_meta_title" style="color:red" class="error_label"></span> </div>

			     </div>
			     <div class="form-group">
				<label class="control-label col-md-2">Meta Description<font class="required_mark" color="red">*</font>
				</label>
				 <div class="col-md-7">
					<textarea class="form-control" name="meta_description" id="meta_description" rows="3"><?php echo urldecode($data['meta_description']); ?></textarea>
					<span id="error_meta_description" style="color:red" class="error_label"></span>
			     </div>
			     </div>
			     <div class="form-group">
				<label class="control-label col-md-2">Meta Keyword<font class="required_mark" color="red">*</font>
				</label>
				 <div class="col-md-7">
					<textarea class="form-control" name="meta_keyword" id="meta_keyword" rows="3"><?php echo urldecode($data['meta_keyword']); ?></textarea>
					<span id="error_meta_keyword" style="color:red" class="error_label"></span>
			     </div>
			     </div> -->

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