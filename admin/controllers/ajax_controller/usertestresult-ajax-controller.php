	<?php
  @session_start();
  include('../../models/db.php');
  include('../../models/common-model.php');
	include('../../models/usertestresult-model.php');
  include('../../includes/thumb_new.php');
  include('../../includes/resize-class.php');
  include('../common-controller.php');
	include('../usertestresult-controller.php');
  include('../../models/ajax-model.php');
  $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."city/";
  $upload_dir =$_SESSION['SITE_IMG_PATH']."evm_img/";
  $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."city/thumb/";
  // $upload_dir3 =$_SESSION['SITE_IMG_PATH']."fragnets_img/";

	if(isset($_POST['view']) && $_POST['view'] != ''):
  $id = $_POST['id'];

   $qry="SELECT tbl_users.name,tbl_assessments_category.categoryname,tbl_userresults.* FROM tbl_userresults left join tbl_assessments_category on tbl_assessments_category.categoryid = tbl_userresults.fk_category_id left join  tbl_users on tbl_users.email= tbl_userresults.useremail where  tbl_userresults.userresultid=".$id;
   $result=$modelObj->fetchRow($qry);
   ?>
<div class="col-md-12">
    <div class="widget-content padded">
	<!--	<dl><b>Name : </b> <?php echo $result['name']; ?></dl>
    <dl><b>Email : </b> <?php echo $result['useremail']; ?></dl> -->
    <dl><b>Category : </b> <?php echo urldecode($result['categoryname']); ?></dl>
    <dl><b>Total questions : </b> <?php echo $result['totalnoquestions']; ?></dl>
    <dl><b>Total Right Answer : </b> <?php echo $result['totalrightanswer']; ?></dl>
    <?php
     $i = 1;
     $qry="SELECT tbl_assessments_tests.questions,tbl_assessments_tests.option1,tbl_assessments_tests.option2,tbl_assessments_tests.option3,tbl_assessments_tests.option4,tbl_assessments_tests.rightanswer,tbl_userassessment.useranswer FROM `tbl_userassessment` left join tbl_assessments_tests on tbl_assessments_tests.assessmentsid = tbl_userassessment.fk_assessmentsid where tbl_userassessment.fk_userresultid=".$result['userresultid'];
     $resultdata=$modelObj->fetchRows($qry);
     foreach($resultdata as $tests)
     {
     ?>
     <dl><b>Que  <?php echo $i++; ?> : </b> <?php echo urldecode($tests['questions']); ?></dl>
      <dl><b>Right Answer : </b> <?php
      if($tests['rightanswer'] == 1)
      {
      echo  $tests['option1'];
      }
     else if($tests['rightanswer'] == 2)
      {
      echo  $tests['option2'];
      }
      else if($tests['rightanswer'] == 3)
      {
      echo  $tests['option3'];
      }
      else if($tests['rightanswer'] == 4)
      {
      echo  $tests['option4'];
    }else{}
      ?></dl>
      <dl><b>User Answer : </b>
        <?php
       if($tests['useranswer'] == 1)
       {
       echo  $tests['option1'];
       }
     else if($tests['useranswer'] == 2)
       {
       echo  $tests['option2'];
       }
       else if($tests['useranswer'] == 3)
       {
       echo  $tests['option3'];
       }
       else if($tests['useranswer'] == 4)
       {
       echo  $tests['option4'];
     }else{}
       ?>
      </dl>
     <?php } ?>
	</div>
</div>
<?php endif; ?>
<?php

	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "displaydata"){

    $getuserid=decode($_GET['userviewid']);
    $_SESSION['getuserid']=$_GET['userviewid'];
  //  $query2="SELECT id,email  from tbl_users  where id =".$getuserid;
  //  $results2=$modelObj->fetchRow($query2);
  //  $emailviewid = $getuserid;

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
	  /*if($iSortCol_0=='1'){
      	$sortfield = 'categoryname';
      	}
    else  if($iSortCol_0=='2'){
        $sortfield = 'totalnoquestions';
          }
    else  if($iSortCol_0=='3'){
        $sortfield = 'totalrightanswer';
            }
		else{
				$sortfield = 'userresultid';
			}*/
    //echo  "select * FROM tbl_userresults where useremail ='$emailviewid'";
    //echo "select * FROM tbl_userresults where fk_userid ='$getuserid'";
  //  exit;
	$qry="SELECT tbl_users.name,tbl_assessments_category.categoryname,tbl_userresults.* FROM tbl_userresults left join tbl_assessments_category on tbl_assessments_category.categoryid = tbl_userresults.fk_category_id left join  tbl_users on tbl_users.email= tbl_userresults.useremail where  tbl_userresults.userresultid=".$getuserid;
   $result=$modelObj->fetchRow($qry);
   $rid = $result['userresultid'];

		$TotalCountqry = $modelObj->numRows("select * FROM tbl_userassessments where fk_userresultid =".$rid);

//echo "SELECT tbl_users.name,tbl_assessments_category.categoryname,tbl_userresults.* FROM tbl_userresults left join tbl_assessments_category on tbl_assessments_category.categoryid = tbl_userresults.fk_category_id left join  tbl_users on tbl_users.id= tbl_userresults.fk_userid  where id ='$getuserid' and statuscheck !=2 and (categoryname LIKE '%".$sSearch."%' || totalnoquestions LIKE '%".$sSearch."%' || totalrightanswer LIKE '%".$sSearch."%')";
//exit;
    if($sSearch!=''){


			$Filteredqry = $modelObj->numRows("SELECT tbl_assessments_tests.questions,tbl_assessments_tests.option1,tbl_assessments_tests.option2,tbl_assessments_tests.option3,tbl_assessments_tests.option4,tbl_assessments_tests.rightanswer,tbl_userassessment.useranswer FROM `tbl_userassessment` left join tbl_assessments_tests on tbl_assessments_tests.assessmentsid = tbl_userassessment.fk_assessmentsid where tbl_userassessment.fk_userresultid='$rid' and tbl_userassessment.statuscheck !=2 (tbl_assessments_tests.questions LIKE '%".urlencode($sSearch)."%')");
			//echo "SELECT * FROM tbl_assessments_tests  where (questions LIKE '%".$sSearch."%') ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."";
			
			$list_activity_log = $modelObj->fetchRows("SELECT tbl_assessments_tests.questions as question,tbl_assessments_tests.option1 as opt1,tbl_assessments_tests.option2 as opt2,tbl_assessments_tests.option3 as opt3,tbl_assessments_tests.option4 as opt4,tbl_assessments_tests.rightanswer as rightan,tbl_userassessment.useranswer as uanswer FROM `tbl_userassessment` left join tbl_assessments_tests on tbl_assessments_tests.assessmentsid = tbl_userassessment.fk_assessmentsid where tbl_userassessment.fk_userresultid='$rid' and tbl_userassessment.statuscheck !=2 (tbl_assessments_tests.questions LIKE '%".urlencode($sSearch)."%') ORDER BY ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");
			} else {

			$Filteredqry = $modelObj->numRows("SELECT tbl_assessments_tests.questions as question,tbl_assessments_tests.option1 as opt1,tbl_assessments_tests.option2 as opt2,tbl_assessments_tests.option3 as opt3,tbl_assessments_tests.option4 as opt4,tbl_assessments_tests.rightanswer as rightan,tbl_userassessment.useranswer as uanswer FROM `tbl_userassessment` left join tbl_assessments_tests on tbl_assessments_tests.assessmentsid = tbl_userassessment.fk_assessmentsid where tbl_userassessment.fk_userresultid='$rid' and tbl_userassessment.statuscheck !=2");
			
			$list_activity_log = $modelObj->fetchRows("SELECT tbl_assessments_tests.questions as question,tbl_assessments_tests.option1 as opt1,tbl_assessments_tests.option2 as opt2,tbl_assessments_tests.option3 as opt3,tbl_assessments_tests.option4 as opt4,tbl_assessments_tests.rightanswer as rightan,tbl_userassessment.useranswer as uanswer FROM `tbl_userassessment` left join tbl_assessments_tests on tbl_assessments_tests.assessmentsid = tbl_userassessment.fk_assessmentsid where tbl_userassessment.fk_userresultid='$rid' and tbl_userassessment.statuscheck !=2 LIMIT ".$iDisplayStart.",".$iDisplayLength."");
			
		}

		$countryMsg = '';
		$Arr['sEcho'] = $_REQUEST['sEcho'];
		$Arr['iTotalRecords'] = $TotalCountqry;
		$Arr['iTotalDisplayRecords'] = $Filteredqry;
		$Arr['aaData'] = array();
		foreach($list_activity_log as $result){
			
			$query="SELECT tbl_users.name,tbl_assessments_category.categoryname,tbl_userresults.* FROM tbl_userresults left join tbl_assessments_category on tbl_assessments_category.categoryid = tbl_userresults.fk_category_id left join  tbl_users on tbl_users.id= tbl_userresults.fk_userid where id ='$rid' and statuscheck !=2";
			$results=$modelObj->fetchRows($query);

			$cms_id = $result['userassessmentid'];
			$title = urldecode($result['question']);
		    if($result['uanswer'] == 1)
		    {
		       $uans = $result['opt1'];
		    }
		     else if($result['uanswer'] == 2)
		    {
		       $uans = $result['opt2'];
		    }
		       else if($result['uanswer'] == 3)
		    {
		       $uans = $result['opt3'];
		    }
		       else if($result['uanswer'] == 4)
		    {
		       $uans = $result['opt4'];
		    }
		    $totalquestions = $uans;
			if($result['rightan'] == 1)
		    {
		      	$Rans = $result['opt1'];
		    }
		     else if($result['rightan'] == 2)
		    {
		      	$Rans =  $result['opt2'];
		    }
		      else if($result['rightan'] == 3)
		    {
		     	$Rans = $result['opt3'];
		    }
		      else if($result['rightan'] == 4)
		    {
		      	$Rans =  $result['opt4'];
		    }
		    $totalrightanswer = $Rans;
		    $username = $result['name'];

		    if($uans == $Rans){
		    	$resans = 'True';
		    }else{
		    	$resans = 'False';
		    }
/*	  $image = $result['image'];
      if($image == '')
      {
      $imagesrc ='http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';
      }
      else {
        $imagesrc = COFIG_SITE_URL_IMG.'evm_img/'.$image;
      } */
			$status = $result['statuscheck'];

			$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';

			//$cms='<td>'.$username.'</td>';
      //$cms1='<td>'.$email.'</td>';
      $cms2='<td>'.$title.'</td>';
      $cms3='<td>'.$totalquestions.'</td>';
      $cms4='<td>'.$totalrightanswer.'</td>';


		//	$cmsemail='<td><img height="100" width="100" src='.$imagesrc.'></td>';


			if($status==1)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
			}
			elseif($status==0)
			{
			$status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
			}
			 $selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 17   ORDER BY id ASC";

			$moduleresult=$modelObj->fetchRow($selectmodule);
			if($moduleresult['p_field3'] == 1 && $moduleresult['p_field4'] == 1){

			$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="index.php?pid=usertestresult&user='.encode($cms_id).'"  title="Assessment Results">
				<i class="glyphicon glyphicon-list-alt"></i>
				</a>';


			$option .='<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'userassessment\')" title="edit">
				<i class="icon-edit"></i>
			</a>';
			$option .='<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'userassessment?\')" title="Delete">
			<i class="icon-trash"></i>
			</a>
			</div>
			</td>';
		 } else if($moduleresult['p_field3'] == 1){

		 	$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="index.php?pid=usertestresult&user='.encode($cms_id).'"  title="Assessment Results">
				<i class="glyphicon glyphicon-list-alt"></i>
				</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'userassessment\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>

			</div>
				</td>';
	} else if($moduleresult['p_field4'] == 1){
		$option='<td class="actions">
			<div class="action-buttons">
			
			<a class="table-actions" href="index.php?pid=usertestresult&user='.encode($cms_id).'"  title="Assessment Results">
				<i class="glyphicon glyphicon-list-alt"></i>
				</a>
			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'userassessment\')" title="Delete">
			<i class="icon-trash"></i>
			</a>
			</div>
			</td>';
	}  else if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==1){

		$option='<td class="actions">
			<div class="action-buttons">
			<a class="table-actions" href="index.php?pid=usertestresult&user='.encode($cms_id).'"  title="Assessment Results">
				<i class="glyphicon glyphicon-list-alt"></i>
				</a>
			<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'userassessment\')" title="Edit">
			<i class="icon-pencil"></i>
			</a>

			<a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'userassessment\')" title="Delete">
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

			$Arr['aaData'][] = array($cms2,$cms3,$cms4,$resans);
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
			$qry="UPDATE tbl_evm SET statuscheck=1 WHERE  evmid=".($val);
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
			$qry="UPDATE tbl_evm SET  statuscheck=0 WHERE  evmid=".($val);

			$result =$modelObj->runQuery($qry);

		}
	}
?>

<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE tbl_userresults SET  statuscheck=2 WHERE 	userresultid='".($val)."'";

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

		  $post['fk_language_id']=1;
			$post['evmttitle']=urlencode($_POST['evmtitle']);
		  $post['statuscheck']=1;
      $post1['image'] = $insertimage;

	   	   $addfaq=$controller_class->addData('tbl_evm',$post);
         $last_id 	= $GLOBALS['pdo']->lastInsertId();
         $post1['fk_evmid'] = $last_id;
         $addfaq1=$controller_class->addData('tbl_evm_image',$post1);
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

        $post['fk_language_id']=1;
        $post['evmttitle']=urlencode($_POST['evmtitle']);

    $post1['image'] = $insertimage;
    if($insertimage == '')
    {
     $post1['image'] = $_POST['old_photo'];
    }
		//$post['evmid']=$_POST['hid_userid'];

			$editcms=$controller_class->editData('tbl_evm',$post,"evmid='".$_POST['hid_userid']."'");
      $editcms2=$controller_class->editData('tbl_evm_image',$post1,"fk_evmid='".$_POST['hid_userid']."'");
  		echo '1';

	}
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {

		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby = $_POST['orderby'];
		$qry = "SELECT tbl_users.name,tbl_assessments_category.categoryname,tbl_userresults.* FROM tbl_userresults left join tbl_assessments_category on tbl_assessments_category.categoryid = tbl_userresults.fk_category_id left join  tbl_users on tbl_users.email= tbl_userresults.useremail where  statuscheck !=2";
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
			<div class="heading"> <i style="cursor:default;" class="icon-table"></i> Assessment Results List
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
				
			<?php endif;?> </div>
			 <?php if($moduleresult['p_field4'] == 1){ ?>
			<div class="widget-content padded clearfix">
				<table class="table table-bordered table-striped" id="tbl_data_display">
					<thead>
						
                        <th lass="hidden-xs" style="color: #007aff;">Attempted Questions</th>
                        <th lass="hidden-xs" style="color: #007aff;">User Answers</th>
                        <th lass="hidden-xs" style="color: #007aff;">Right Answers</th>
                        <th lass="hidden-xs" style="color: #007aff;">Result</th>
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
					'aTargets': [0,1,2,3]
				}],
				"aaSorting": [
                [0, "desc"]
				],
				"sAjaxSource": site_url + 'controllers/ajax_controller/usertestresult-ajax-controller.php?action=displaydata&userviewid=<?php echo $_SESSION['getuserid']; ?>'
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

		$qry="UPDATE tbl_userresults SET statuscheck=2 WHERE 	userresultid='".$_POST['id']."'";
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
	 	$qry="SELECT * FROM tbl_evm left join tbl_evm_image on tbl_evm_image.fk_evmid = tbl_evm.evmid where tbl_evm.evmid=".$_POST['id'];
		$result_checkexists=$modelObj->numRows($qry);
		$data=$modelObj->fetchRow($qry);






	?>
	<div class="col-lg-12">
		<div class="widget-container fluid-height clearfix">
			<div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
				<?php if($_POST[ 'id']!=0){ ?> Update EVM
					<?php } else { ?> Add EVM
				<?php } ?>
			</div>
			<div class="widget-content padded">
				<form name="form_testadd" id="form_testadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
					<?php if($data['fk_language_id']!=1){ ?>
					<a class="table-actions" href="javascript:void(0)" onclick="view(<?php echo $_POST['id']; ?>)" title="View">
					<i class="icon-eye-open"></i>
					</a>
					<?php } ?>


					<div class="form-group">
						<label class="control-label col-md-2"> Title <font class="required_mark" color="red">*</font></label>
						<div class="col-md-7">
						<input class="form-control" type="text" name="evmtitle" maxlength="40" id="evmtitle" value="<?php echo urldecode($data['evmttitle']); ?>" />
						<span id="error_evmtitle" style="color:red" class="error_label"></span> </div>
					</div>


					<div class="form-group">
							<label class="control-label col-md-2">Image<font class="required_mark" color="red">*</font></label>
							<div class="col-md-4">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
										<?php if($data['image'] == '' ){ ?>
											<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" >
											<?php } else {
												if($controller_class->isAws()){
													$url = COFIG_SITE_URL_IMG.'evm_img/'.$data['image'];
													}else{

													$url = COFIG_SITE_URL_IMG."evm_img/".$data['image'];
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
										<a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>
									</div>
									<span><b>Recommended size 600(Width) x 900(Height)</b></span>
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
