<?php 
    @session_start();
    include('../../models/db.php');
    include('../../models/common-model.php');
    
    include('../common-controller.php');
    //$database = new Connection();
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
    $controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."banner/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."banner/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."banner/thumb/";
	
	if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM tbl_settings where Id='".$id."'";
    $result=$modelObj->fetchRow($qry);
?>
<div class="col-md-12">
    <div class="widget-content padded">
		<dl><b>Email : </b> <?php echo $result['email']; ?></dl> 
		<dl><b>Website Name : </b> <?php echo $result['websiteName']; ?></dl> 
		<dl><b>Fax : </b> <?php echo $result['fax']; ?></dl> 
		<dl><b>Phone : </b> <?php echo $result['phone']; ?></dl> 
		<dl><b>SMTP Port : </b> <?php echo $result['smtpport']; ?></dl> 
		<dl><b>SMTP Host : </b> <?php echo $result['smtphost']; ?></dl> 
		<dl><b>SMTP UserName : </b> <?php echo $result['smtpusername']; ?></dl> 
		<dl><b>Copyright Text : </b> <?php echo stripslashes($result['copyright_text']); ?></dl> 
		<!-- <dl><b>Facebook URL : </b> <?php echo $result['facebook_url']; ?></dl>  -->
		<!-- <dl><b>Twitter URL : </b> <?php echo $result['twitter_url']; ?></dl>  -->
		<!-- <dl><b>Googleplus URL : </b> <?php echo $result['googleplus_url']; ?></dl>  -->
		<!-- <dl><b>Allow Free Chapter: </b> <?php echo $result['allow_free_chapter']; ?></dl> 
		<dl><b>Chapter Payment : </b> <?php echo $result['currency'].' '.$result['chapter_payment']; ?></dl> 
		<dl><b>Banner Text: </b> <?php echo $result['banner_text']; ?></dl> -->
		<!-- <dl><b>Android App Link: </b> <?php echo $result['android_link']; ?></dl>  -->
		<!-- <dl><b>Iphone App Link: </b> <?php echo $result['iphone_link']; ?></dl>  -->
		<!-- <dl><b>Banner: </b> <img src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>upload/banner/<?php echo $result['banner']; ?>" alt="No Image Found" style="width:300px;height:150px"></dl>  -->
	</div>
  </div>
<?php endif; ?>
<?php

if(isset($_REQUEST['action']) && $_REQUEST['action'] == "displaydata"){
	
  $iDisplayStart = $_REQUEST['iDisplayStart'];
  $iDisplayLength = $_REQUEST['iDisplayLength'];
  $sSearch = $_REQUEST['sSearch'];
  $sSortDir_0 = $_REQUEST['sSortDir_0'];
  if($sSortDir_0=='asc'){
   $SortBy = 'asc';
  }else{
   $SortBy = 'desc';
  }
  $TotalCountqry = $modelObj->numRows("select * FROM tbl_settings ");
  
  
 
	if($sSearch!=''){
		$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_settings WHERE (email like '%".$sSearch."%' or websiteName like '%".$sSearch."%')");
		
		$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_settings WHERE (email like '%".$sSearch."%' or websiteName like '%".$sSearch."%') ORDER BY Id ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
	} else {
		$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_settings");
		
		$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_settings ORDER BY Id ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
	}
  
  $countryMsg = '';  
  $Arr['sEcho'] = $_REQUEST['sEcho'];
  $Arr['iTotalRecords'] = $TotalCountqry;
  $Arr['iTotalDisplayRecords'] = $Filteredqry;
  $Arr['aaData'] = array();
  foreach($list_activity_log as $result){
   $id = $result['Id'];
   $email = $result['email'];
   $website = $result['websiteName'];
 
		$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$id.'"><span></span></label></td>';
		
		$emailS='<td>'.$email.'</td>';
		$websiteS='<td>'.$website.'</td>';
				
			
        
		$option='<td class="actions">
					<div class="action-buttons">
						<a class="table-actions" href="javascript:void(0)" onclick="view('.$id.')" title="View">
						  <i class="icon-eye-open"></i>
						</a>
						<a class="table-actions" href="javascript:void(0)" onclick="edit('.$id.',\'setting\')" title="Edit">
						 <i class="icon-pencil"></i>
						</a>
					</div>
				</td>';
   
   $Arr['aaData'][] = array($checkbox,$emailS,$websiteS,$option);
  } 

  echo json_encode($Arr); 
 } 
?>		
	
	<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){
	
			

				/*if(!dir($upload_dir)){
					mkdir($upload_dir);
				}
			
				if(isset($_FILES["txt_banner"]["tmp_name"])){

					$tmpfile = $_FILES["txt_banner"]["tmp_name"];
					$newname = $_FILES["txt_banner"]["name"];


					if($_FILES["txt_banner"]["tmp_name"] != ''){

						
						$insertimage 	= 'banner_'.time().".jpg";	
						
						$resultImage=$modelObj->fetchRow("SELECT banner FROM tbl_settings WHERE Id=".$_POST['hid_userid']);
						unlink($upload_dir.$resultImage['banner']);
						unlink($upload_dirthumb.$resultImage['banner']);
						
						move_uploaded_file($tmpfile, $upload_dir.$insertimage);

						$file =  $upload_dir.$insertimage;

		       			$im  = imagecreatefromjpeg($file); 
						
						imagewebp($im, str_replace('jpg', 'webp', $file) );
			    		imagedestroy($im);
						unlink($file);
						
						$qry_img="UPDATE tbl_settings SET banner='".str_replace('.jpg' , '.webp', $insertimage)."' where Id='".$_POST['hid_userid']."'";
						$res_img= $modelObj->runQuery($qry_img);
					}
				}*/



				
			$pst['email']=strip_tags($_POST['txt_email']);
			$pst['websiteName']=strip_tags($_POST['txt_websitename']);		
			$pst['fax']=strip_tags($_POST['txt_addfax']);
			$pst['mail_type']=strip_tags($_POST['txt_mail_type']);
			$pst['img_store_locate']=$_POST['txt_img'];
			$pst['phone']=strip_tags($_POST['txt_addphone']);
			$pst['smtpport']=strip_tags($_POST['txt_smtpport']);
			$pst['smtphost']=strip_tags($_POST['txt_smtphost']);
			$pst['smtpusername']=strip_tags($_POST['txt_smtpusername']);
			$pst['smtppassword']=strip_tags($_POST['txt_smtppassword']);
			$pst['copyright_text']=strip_tags($_POST['txt_addcopyrighttext']);	
			//$pst['facebook_url']=strip_tags($_POST['txt_addfacebook']);
			//$pst['twitter_url']=strip_tags($_POST['txt_addtwitter']);
			//$pst['googleplus_url']=strip_tags($_POST['txt_addgplus']);
			//$pst['allow_free_chapter']=strip_tags($_POST['txt_allow_free_chapter']);
			//$pst['chapter_payment']=strip_tags($_POST['txt_chapter_payment']);
			//$pst['banner_text']=strip_tags($_POST['txt_banner_text']);
			//$pst['android_link']=strip_tags($_POST['txt_android_link']);
			//$pst['iphone_link']=strip_tags($_POST['txt_iphone_link']);
			//$pst['currency']=strip_tags($_POST['txt_currency']);
			$pst['update_date']=date("Y-m-d H:i:s", time());
			$pst['Modify_Id']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
			$pst['ip_address']=$_SERVER['REMOTE_ADDR'];
			$pst['Id']=$_POST['hid_userid'];
			$editMyData=$controller_class->editData('tbl_settings',$pst,"Id='".$_POST['hid_userid']."'");
			
			echo "1";
	}	
	?>
	<?php
	if(isset($_POST['viewdiv']) && $_POST['viewdiv'] != ''){
		$start = $_POST['prevnext'];
		$end = $_POST['row'];
		$orderby=$_POST['orderby'];
		
		$qry="SELECT * FROM tbl_settings order by Id desc";
		$result=$modelObj->fetchRows($qry);
		
		$totalrecords =$modelObj->numRows($qry);
		$noofrows_k = $end;
		$noofpages = ceil($totalrecords/$noofrows_k);
		if($_POST['first'] != 0)
		{
			$curr_page = ceil($start/$noofrows_k);
		}
		else if($_POST['last'] != 0)
		{
			$curr_page = 0;
		}
		else
		{
			$curr_page = $_POST['curr_page'];
		}
		
	?>
	<div class="col-lg-12">
	  <div class="widget-container fluid-height clearfix">
		<div class="heading">
		  <i style="cursor:default;" class="icon-table"></i>
		  Settings List
		</div>
		<div class="widget-content padded clearfix">
			<table class="table table-bordered table-striped" id="tbl_data_display">
			<thead>
			  <th class="check-header hidden-xs">
				<label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
			  </th>
			  <th>
				Email
			  </th>
			  <th>
				Website Name
			  </th>
			  <th style="color: #007aff;">Options</th>
			</thead>
			<script>
                    $(document).ready(function() {
                        $('#tbl_data_display').dataTable({
                            "bProcessing": true,
                            "bServerSide": true,
                            "aoColumnDefs": [{
                                'bSortable': false,
                                'aTargets': [0, 3]
                            }],
                            "aaSorting": [
                                [0, "desc"]
                            ],
                            "sAjaxSource": site_url + 'controllers/ajax_controller/setting-ajax-controller.php?action=displaydata'
                        });
                    });
                </script>
			</table>
		</div>
	  </div>
	</div>
<script type="text/javascript">
	$("#dataTable1").dataTable({
	  "sPaginationType": "full_numbers",
	  aoColumnDefs: [
		{
		  bSortable: false,
		  aTargets: [0, -1]
		}
	  ]
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
<?php
	if(isset($_POST['edit']) && $_POST['edit'] != ''){
		$qry="SELECT * FROM tbl_settings WHERE Id='".$_POST['id']."'";
		$data=$modelObj->fetchRow($qry);
?>
<script type="application/javascript">
	function isNumberKeyP(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 46 ){
			return true;
		}
		if (charCode > 31 && (charCode < 48 || charCode > 57)){
			return false;
		} 
		return true;
	}
	
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
</script>
<div class="col-lg-12">
<div class="widget-container fluid-height clearfix">
	<div class="heading">
        <i style="cursor:default;" class="icon-reorder"></i>Update Settings</div>
		<div class="widget-content padded">
        <form name="form_SettingAdd" id="form_SettingAdd" method="post" enctype="multipart/form-data" action="" class="form-horizontal" >     
            
		<div class="form-group">
            <label class="control-label col-md-2">Email <font class="required_mark" color="red">*</font></label>
            <div class="col-md-7">
              <input class="form-control" type="text" name="txt_email" id="txt_email" maxlength="150" value="<?php echo $data['email']; ?>"/>
			  <span id="error_txt_email" style="color:red" class="error_label"></span>
            </div>
		</div>
		  
		<!--<div class="form-group">
            <label class="control-label col-md-2">Feedback Email <font class="required_mark" color="red">*</font></label>
            <div class="col-md-7">
				<input class="form-control" type="text" name="txt_femail" id="txt_femail" maxlength="150" value="<?php echo $data['feedback_email']; ?>"/>
            </div>
		</div>-->
		
		<div class="form-group">
            <label class="control-label col-md-2">Website Name <font class="required_mark" color="red">*</font></label>
            <div class="col-md-7">
              <input class="form-control" type="text" name="txt_websitename" id="txt_websitename" maxlength="70" value="<?php echo $data['websiteName']; ?>"/>
			  <span id="error_txt_websitename" style="color:red" class="error_label"></span>
            </div>
		</div>
		
		<!--<div class="form-group">
            <label class="control-label col-md-2">Address </label>
            <div class="col-md-7">
				<textarea class="form-control" id="txt_addaddress" name="txt_addaddress" rows="3"><?php echo $data['address']; ?></textarea>
            </div>
		</div> 
		
		<div class="form-group">
            <label class="control-label col-md-2">Website Info </label>
            <div class="col-md-7">
				<textarea class="form-control" id="txt_addinfo" name="txt_addinfo" rows="3"><?php echo $data['info']; ?></textarea>
            </div>
		</div>-->
		
		
			
		<div class="form-group">
			<label class="control-label col-md-2">Fax </label>
            <div class="col-md-7">
				<input class="form-control" type="text" onkeypress="return isNumberKey(event)" name="txt_addfax" id="txt_addfax" maxlength="12" value="<?php echo $data['fax']; ?>"/>
				<span id="error_txt_addcopyrighttext" style="color:red" class="error_label"></span>
            </div>
		</div>
		
		
		<div class="form-group">
			<label class="control-label col-md-2"> Phone Number </label>
            <div class="col-md-7">
				<input class="form-control" type="text" onkeypress="return isNumberKey(event)" name="txt_addphone" id="txt_addphone" maxlength="15" value="<?php echo $data['phone']; ?>"/>
				<span id="error_txt_addphone" style="color:red" class="error_label"></span>
            </div>
		</div>
		<div class="form-group">
            <label class="control-label col-md-2">Mail Type</label>
            <div class="col-md-7">
			<div id="rates">
              <label class="radio-inline"><input type="radio" value="0" <?php if($data['mail_type']==0){ echo 'checked'; } ?> name="txt_mail_type" id="txt_mail_type1"><span>PHP Mail</span></label>
			  <label class="radio-inline"><input type="radio" value="1" <?php if($data['mail_type']==1){ echo 'checked'; } ?> name="txt_mail_type" id="txt_mail_type2"><span>SMTP Mail</span></label>
			  <input type="hidden" value="<?php echo '1'; ?>"  name="txt_hiddmailtype" id="txt_hiddmailtype">
			  <span id="error_txt_mail_type" style="color:red" class="error_label"></span>
			 </div>
            </div>
          </div>
		
		<div class="form-group">
            <label class="control-label col-md-2">SMTP Port </label>
            <div class="col-md-7">
              <input class="form-control" type="text" name="txt_smtpport" id="txt_smtpport" maxlength="70" value="<?php echo $data['smtpport']; ?>"/>
			  <span id="error_txt_smtpport" style="color:red" class="error_label"></span>
            </div>
		</div>
		<div class="form-group">
            <label class="control-label col-md-2">SMTP Host </label>
            <div class="col-md-7">
              <input class="form-control" type="text" name="txt_smtphost" id="txt_smtphost" maxlength="70" value="<?php echo $data['smtphost']; ?>"/>
			  <span id="error_txt_smtphost" style="color:red" class="error_label"></span>
            </div>
		</div>
		<div class="form-group">
            <label class="control-label col-md-2">SMTP Username </label>
            <div class="col-md-7">
              <input class="form-control" type="text" name="txt_smtpusername" id="txt_smtpusername" maxlength="70" value="<?php echo $data['smtpusername']; ?>"/>
			  <span id="error_txt_smtpusername" style="color:red" class="error_label"></span>
            </div>
		</div>
		<div class="form-group">
            <label class="control-label col-md-2">SMTP Password </label>
            <div class="col-md-7">
              <input class="form-control" type="text" name="txt_smtppassword" id="txt_smtppassword" maxlength="70" value="<?php echo $data['smtppassword']; ?>"/>
			  <span id="error_txt_smtppassword" style="color:red" class="error_label"></span>
            </div>
		</div>

		<div class="form-group">
            <label class="control-label col-md-2">Server:</label>
            <div class="col-md-7">
			<div id="rates">
              <label class="radio-inline"><input onclick="validateMsgHide('txt_img')" type="radio" value="0" <?php if($data['img_store_locate']==0){ echo 'checked'; } ?> name="txt_img" id="txt_img1"><span>Server</span></label>
			  
			  <label class="radio-inline"><input type="radio" onclick="validateMsgHide('txt_img2')" value="1" <?php if($data['img_store_locate']==1){ echo 'checked'; } ?> name="txt_img" id="txt_img2"><span>s3</span></label>
			  <input type="hidden" value="<?php echo '1'; ?>"  name="txt_hiddimg" id="txt_hiddimg">
			  <span id="error_txt_mail_type" style="color:red" class="error_label"></span>
			 </div>
            </div>
          </div>
		<div class="form-group">
			<label class="control-label col-md-2"> Copyright Text </label>
            <div class="col-md-7">
				<input class="form-control" type="text" name="txt_addcopyrighttext" id="txt_addcopyrighttext" maxlength="150" value="<?php echo $data['copyright_text']; ?>"/>
				<span id="error_txt_addcopyrighttext" style="color:red" class="error_label"></span>
            </div>
		</div>	
		<!-- <div class="form-group">
            <label class="control-label col-md-2">Facebook URL </label>
            <div class="col-md-7">
				<input class="form-control" type="text" name="txt_addfacebook" id="txt_addfacebook" maxlength="250" value="<?php echo $data['facebook_url']; ?>"/>
				<span id="error_txt_addfacebook" style="color:red" class="error_label"></span>
            </div>
		</div>
		
		<div class="form-group">
            <label class="control-label col-md-2">Twitter URL </label>
            <div class="col-md-7">
				<input class="form-control" type="text" name="txt_addtwitter" id="txt_addtwitter" maxlength="250" value="<?php echo $data['twitter_url']; ?>"/>
				<span id="error_txt_addtwitter" style="color:red" class="error_label"></span>
            </div>
		</div>
		
		<div class="form-group">
            <label class="control-label col-md-2">Google Plus URL </label>
            <div class="col-md-7">
				<input class="form-control" type="text" name="txt_addgplus" id="txt_addgplus" maxlength="250" value="<?php echo $data['googleplus_url']; ?>"/>
				<span id="error_txt_addgplus" style="color:red" class="error_label"></span>
            </div>
		</div> -->
		<!-- 
		<div class="form-group">
            <label class="control-label col-md-2">Allow Free Chapter </label>
            <div class="col-md-7">
				<input class="form-control" type="text" name="txt_allow_free_chapter" id="txt_allow_free_chapter" maxlength="250" value="<?php echo $data['allow_free_chapter']; ?>"/>
				<span id="error_allow_free_chapter" style="color:red" class="error_label"></span>
            </div>
		</div>
		
		<div class="form-group">
            <label class="control-label col-md-2">Chapter Payment</label>
            <div class="col-md-7">
				<input class="form-control" type="text" name="txt_chapter_payment" id="txt_chapter_payment" maxlength="250" value="<?php echo $data['chapter_payment']; ?>"/>
				<span id="error_txt_chapter_payment" style="color:red" class="error_label"></span>
            </div>
		</div>
		
		<div class="form-group">
            <label class="control-label col-md-2">Currency</label>
            <div class="col-md-7">
				<input class="form-control" type="text" name="txt_currency" id="txt_currency" maxlength="250" value="<?php echo $data['currency']; ?>"/>
				<span id="error_txt_currency" style="color:red" class="error_label"></span>
            </div>
		</div>
			
			
			<div class="form-group">
				<label class="control-label col-md-2">Banner Image <font class="required_mark" color = "red">*</font></label>
				<div class="col-md-4">
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
					<?php if($data['banner']=='' ){?>
							<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
						<?php }else{?>
						<img src="<?=$_SESSION['FRNT_DOMAIN_NAME']?>upload/banner/<?php echo $data['banner'];?>">
						<?php } ?>
						<input type="hidden" id="userPicture" name="userPicture" value='<?php echo $data['banner'];?>'>
				</div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                <div>
					<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" id ="txt_banner" name="txt_banner" accept="image/*" value="<?php echo $data['banner'];?>"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="javascript:void(0);">Remove</a>
                </div>
				</div>
					 <span id="error_txt_banner" style="color:red" class="error_label"></span>

				</div>
			</div>
		
		<div class="form-group">
            <label class="control-label col-md-2">Banner Text</label>
            <div class="col-md-7">
				<input class="form-control" type="text" name="txt_banner_text" id="txt_banner_text" value="<?php echo $data['banner_text']; ?>"/>
				<span id="error_txt_banner_text" style="color:red" class="error_label"></span>
            </div>
		</div> -->
		
		<!-- <div class="form-group">
            <label class="control-label col-md-2">Android App Link</label>
            <div class="col-md-7">
				<input class="form-control" type="text" name="txt_android_link" id="txt_android_link" value="<?php echo $data['android_link']; ?>"/>
				<span id="error_txt_android_link" style="color:red" class="error_label"></span>
            </div>
		</div>
		
		<div class="form-group">
            <label class="control-label col-md-2">Iphone App Link</label>
            <div class="col-md-7">
				<input class="form-control" type="text" name="txt_iphone_link" id="txt_iphone_link" value="<?php echo $data['iphone_link']; ?>"/>
				<span id="error_txt_iphone_link" style="color:red" class="error_label"></span>
            </div>
		</div> -->
		
		<div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
				<input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data['Id']; ?>" />
				<input type="hidden" name="hid_update" id="hid_update" value="update" />
				<button type="submit" class="btn btn-primary" onclick="return updatedata()">Submit</button>
				<button type="button" class="btn btn-default-outline" onclick="newdata();">Cancel</button>
            </div>
		</div>        
        </form>
      </div>
    </div>
</div>
<?php } ?>
