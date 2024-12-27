<?php
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	  include('../../models/city-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
  	include('../test-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."city/";
  $upload_dir =$_SESSION['SITE_IMG_PATH']."analytics_img/";
  $upload_dir2 =$_SESSION['SITE_IMG_PATH']."analytics_img/thumb/";
  // $upload_dir3 =$_SESSION['SITE_IMG_PATH']."fragnets_img/";

	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];

    $qry="SELECT * FROM tbl_analytics left join tbl_analytics_image on tbl_analytics_image.fk_analyticsid = tbl_analytics.analyticsid where  tbl_analytics.analyticsid=".$id;
    $result=$modelObj->fetchRow($qry);

?>
<div class="col-md-12">
    <div class="widget-content padded">
		<dl><b>Title : </b> <?php echo urldecode($result['analyticstitle']); ?></dl>
    <?php
  if($result['image'] == '')
  {
  $imageviewthumb = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
  }
  else {
  $imageviewthumb =  COFIG_SITE_URL_IMG."analytics_img/thumb/".$result['thumbimage'];
  }
     ?>
    <!-- <dl><b>Thumb Image : </b><br/> <img src="<?php echo  $imageviewthumb; ?>"  height="100" width="100"/></dl> -->
     <?php
if($result['image'] == '')
{
$imageview = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
}
else {
$imageview =  COFIG_SITE_URL_IMG."analytics_img/".$result['image'];
}
      ?>
     <dl><b>Image : </b><br/> <img src="<?php echo  $imageview; ?>"  height="100" width="100"/></dl>
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
			$sortfield = 'analyticstitle';
			}
		else{
				$sortfield = 'analyticsid';
			}
		$TotalCountqry = $modelObj->numRows("select * FROM tbl_analytics");



		if($sSearch!=''){
      if(strtolower($sSearch) == 'active')
      {
        $sSearchactive = 1;
      }

    else  if(strtolower($sSearch) == 'inactive')
      {
        $sSearchactive = 0;
      }
      else {
        $sSearchactive = $sSearch;
      }
				$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_analytics  where statuscheck !=2 and (analyticstitle LIKE '%".$sSearch."%' || statuscheck LIKE '%$sSearchactive%')");
			//echo "SELECT * FROM tbl_assessments_tests  where (questions LIKE '%".$sSearch."%') ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."";
			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_analytics  where statuscheck !=2 and (analyticstitle LIKE '%".$sSearch."%' || statuscheck LIKE '%$sSearchactive%') ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
			} else {
			$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_analytics left join tbl_analytics_image on tbl_analytics_image.fk_analyticsid = tbl_analytics.analyticsid where statuscheck !=2");

			$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_analytics left join tbl_analytics_image on tbl_analytics_image.fk_analyticsid = tbl_analytics.analyticsid  where statuscheck !=2 ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
		}

		$countryMsg = '';
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){

			$query="SELECT  FROM tbl_analytics left join tbl_analytics_image on tbl_analytics_image.fk_analyticsid = tbl_analytics.analyticsid";
			$results=$modelObj->fetchRows($query);

			$cms_id = $result['analyticsid'];
			$title = urldecode($result['analyticstitle']);


			$status = $result['statuscheck'];

			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';

			$cms='<td>'.$title.'</td>';


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
			<a class="table-actions" href="javascript:void(0)"   onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>';


			$option .='<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'analytics\')" title="edit">
			<i class="icon-edit"></i>
			</a>
			</div>
			</td>';
		 } else if($moduleresult['p_field3'] == 1){

		 	$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'analytics\')" title="Edit">
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
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'analytics\')" title="Delete">
			<i class="icon-trash"></i>
			</a>statuscheck
			</div>
			</td>';

	}  else if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==1){

		$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
			<i class="icon-eye-open"></i>
			</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'analytics\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>

			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'analytics\')" title="Delete">
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
	/*';


			$option .='<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'analytics?\')" title="Delete">
			<i class="icon-trash"></i>
			</a>*/
?>
<?php
	if(isset($_POST['statusactive']) && $_POST['statusactive'] != '')
	{
		$id = explode("," ,$_POST['active']);
		foreach($id as $k => $val)
		{
			$qry="UPDATE tbl_analytics SET statuscheck=1 WHERE  analyticsid=".($val);
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
			$qry="UPDATE tbl_analytics SET  statuscheck=0 WHERE  analyticsid=".($val);

			$result =$modelObj->runQuery($qry);

		}
	}
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_analytics SET  statuscheck=2 WHERE analyticsid='".($val)."'";

			$result=$modelObj->runQuery($qry);


		}
	}
?>


<?php
	if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){

    if(isset($_FILES["txt_addphoto"]["tmp_name"])){

  				$tmpfile = $_FILES["txt_addphoto"]["tmp_name"];


  				if($_FILES["txt_addphoto"]["tmp_name"]!=''){

  					$insertimage 	= 'product1'.time().".jpg";

  					move_uploaded_file($tmpfile, $upload_dir.$insertimage);
  					$file =  $upload_dir.$insertimage;

  	       		//	$im  = imagecreatefromjpeg($file);

  				//	imagewebp($im, str_replace('jpg', 'webp', $file) );
  		    	//	imagedestroy($im);
  					//unlink($file);
  				}
  			}

        if(isset($_FILES["txt_addphoto2"]["tmp_name"])){

              $tmpfile = $_FILES["txt_addphoto2"]["tmp_name"];


              if($_FILES["txt_addphoto2"]["tmp_name"]!=''){

                $insertimagethumb 	= 'productthumb'.time().".jpg";

                move_uploaded_file($tmpfile, $upload_dir2.$insertimagethumb);
                $file =  $upload_dir2.$insertimagethumb;
              }
            }

		  $post['fk_language_id']=1;
			$post['analyticstitle']=urlencode($_POST['analyticstitle']);
		  $post['statuscheck']=1;
      $post1['image'] = $insertimage;
        $post1['thumbimage'] = $insertimagethumb;

	   	   $addfaq=$controller_class->addData('tbl_analytics',$post);
         $last_id 	= $GLOBALS['pdo']->lastInsertId();

         $post1['fk_analyticsid'] = $last_id;

         $addfaq1=$controller_class->addData('tbl_analytics_image',$post1);
			echo '1';

	}
?>

<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){




   	if(isset($_FILES["txt_addphoto"]["tmp_name"])){

   				$tmpfile = $_FILES["txt_addphoto"]["tmp_name"];


   				if($_FILES["txt_addphoto"]["tmp_name"]!=''){

   					$insertimage 	= 'product1'.time().".jpg";

   					move_uploaded_file($tmpfile, $upload_dir.$insertimage);
   					$file =  $upload_dir.$insertimage;

   	       		//	$im  = imagecreatefromjpeg($file);

   				//	imagewebp($im, str_replace('jpg', 'webp', $file) );
   		    	//	imagedestroy($im);
   					//unlink($file);
   				}
   			}

        if(isset($_FILES["txt_addphoto2"]["tmp_name"])){

              $tmpfile = $_FILES["txt_addphoto2"]["tmp_name"];


              if($_FILES["txt_addphoto2"]["tmp_name"]!=''){

                $insertimagethumb 	= 'productthumb'.time().".jpg";

                move_uploaded_file($tmpfile, $upload_dir2.$insertimagethumb);
                $file =  $upload_dir2.$insertimagethumb;
              }
            }

        $post['fk_language_id']=1;
        $post['analyticstitle']=urlencode($_POST['analyticstitle']);


    $post1['image'] = $insertimage;
    if($insertimage == '')
    {
     $post1['image'] = $_POST['old_photo'];
    }

    $post1['thumbimage'] = $insertimagethumb;
    if($insertimagethumb == '')
    {
     $post1['thumbimage'] = $_POST['old_photo2'];
    }
		//$post['evmid']=$_POST['hid_userid'];

			$editcms=$controller_class->editData('tbl_analytics',$post,"analyticsid='".$_POST['hid_userid']."'");
      $editcms2=$controller_class->editData('tbl_analytics_image',$post1,"fk_analyticsid='".$_POST['hid_userid']."'");
  		echo '1';
	}
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {

		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT * FROM tbl_analytics left join tbl_analytics_image on tbl_analytics_image.fk_analyticsid = tbl_analytics.analyticsid where statuscheck !=2";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> User List
			<?php
			 $selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 13 ORDER BY id ASC";

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
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','analytics?')"><i class="icon-ok-sign"></i>Active</a>
						</li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','analytics?')"><i class="icon-ok-circle"></i>Inactive</a>
						</li>
						 <?php if($moduleresult['p_field4'] == 1){ ?>
						<li>
							<!-- <a href="javascript:void(0)" onclick="deleteselected('Delete','delete','analytics?')"><i class="icon-remove"></i>Delete</a> -->
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

            <th lass="hidden-xs" style="color: #007aff;">Title</th>

            <th lass="hidden-xs" style="color: #007aff;">Status</th>
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
					'aTargets': [0,3]
				}],
				"aaSorting": [
                [0, "desc"]
				],
				"sAjaxSource": site_url + 'controllers/ajax_controller/analytics-ajax-controller.php?action=displaydata'
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

		$qry="UPDATE tbl_analytics SET statuscheck=2 WHERE 	analyticsid='".$_POST['id']."'";
		//$qry="delete from tbl_test  WHERE testid='".$_POST['id']."'";
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
	 	$qry="SELECT * FROM tbl_analytics left join tbl_analytics_image on tbl_analytics_image.fk_analyticsid = tbl_analytics.analyticsid where tbl_analytics.analyticsid=".$_POST['id'];
		$result_checkexists=$modelObj->numRows($qry);
		$data=$modelObj->fetchRow($qry);






	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update Schedule Analytics
					<?php } else { ?> Add Schedule Analytics
				<?php } ?>
			</div>
			<div class="widget-content padded">
				<form name="form_testadd" id="form_testadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
					<?php if($data['fk_language_id']!=1){ ?>
					<!-- <a class="table-actions" href="javascript:void(0)" onclick="view(<?php echo $_POST['id']; ?>)" title="View">
					<i class="icon-eye-open"></i>
					</a> -->
					<?php } ?>


					<div class="form-group">
						<label class="control-label col-md-2"> Title <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="analyticstitle"  id="analyticstitle" value="<?php echo htmlentities(urldecode($data['analyticstitle'])); ?>" />
						<span id="error_analyticstitle" style="color:red" class="error_label"></span> </div>
					</div>

          <!-- <div class="form-group">
              <label class="control-label col-md-2">Thumb Image<font class="required_mark" color="red">*</font></label>
              <div class="col-md-4">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                    <?php if($data['image'] == '' ){ ?>
                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" >
                      <?php } else {
                        if($controller_class->isAws()){
                          $url = COFIG_SITE_URL_IMG.'analytics_img/thumb/'.$data['thumbimage'];
                          }else{

                          $url = COFIG_SITE_URL_IMG."analytics_img/thumb/".$data['thumbimage'];
                        }
                      ?>

                      <img src="<?php echo $controller_class->displayImage($url); ?>" width="200px" hieght="150px">

                    <?php } ?>
                    <input type="hidden"   name="old_photo2" id="old_photo2" value="<?php echo $data['thumbimage']; ?>">
                  </div>
                  
                  <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>

                  <div style="width:300px">
                    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                    <span class="fileupload-exists">Change</span><input type="file" name="txt_addphoto2" id="txt_addphoto2"></span>
                    
                  </div>
                 
                <br/>	<span id="error_txt_addphoto2" style="color:red" class="error_label"></span>
                </div>
              </div>
            </div> -->

					<div class="form-group">
							<label class="control-label col-md-2">Image<font class="required_mark" color="red">*</font></label>
							<div class="col-md-4">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
										<?php if($data['image'] == '' ){ ?>
											<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" >
											<?php } else {
												if($controller_class->isAws()){
													$url = COFIG_SITE_URL_IMG.'analytics_img/'.$data['image'];
													}else{

													$url = COFIG_SITE_URL_IMG."analytics_img/".$data['image'];
												}
											?>

											<img src="<?php echo $controller_class->displayImage($url); ?>" width="200px" hieght="150px">

										<?php } ?>
										<input type="hidden" name="old_photo" id="old_photo" value="<?php echo $data['image']; ?>">
									</div>
									<!-- <div style="width=500px;"><?php echo $res['image'] ?></div> -->
									<div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>

									<div style="width:300px">
										<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
										<span class="fileupload-exists">Change</span><input type="file" name="txt_addphoto" id="txt_addphoto"></span>
										<!-- <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> -->
									</div>
									<span><b><font class="required_mark" color="red">Note: Upload image in width: 1242 X height: 2208</font></b></span>
								<br/>	<span id="error_txt_addphoto" style="color:red" class="error_label"></span>
								</div>
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
