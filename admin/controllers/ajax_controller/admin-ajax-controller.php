<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/admin-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	include('../admin-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new CommonController();
	$upload_dir1 =$_SESSION['SITE_IMG_PATH']."admin/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."admin/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."admin/thumb/";
	

if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];

    $qry="SELECT * FROM admin where status!=2 and adminid='".$id."'";
    $result=$modelObj->fetchRow($qry);

    $query="SELECT * FROM tbl_usertype where id=".$result['user_type'];
    $results=$modelObj->fetchRow($query);
?>
<div class="col-md-12">
    

    <div class="widget-content padded">
        <dl><b>First Name : </b> <?php  echo urldecode($result['firstname']); ?></dl> 
        <dl><b>Last Name : </b> <?php echo urldecode($result['lastname']); ?></dl> 
        <dl><b>Username : </b> <?php echo urldecode($result['username']); ?></dl> 
        <dl><b>Passoword : </b> <?php echo $result['password']; ?></dl> 
        <dl><b>Email : </b> <?php echo urldecode($result['email']); ?></dl> 
        <dl><b>Phone : </b> <?php echo $result['phone']; ?></dl> 
        <dl><b>Address : </b> <?php echo urldecode($result['address']); ?></dl> 
       <?php if($result['image']!=''){ ?>
            <dl><b> Admin Image : </b> <img width="50" height="50" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>upload/admin/<?php echo $result['image'];?>" alt="No Image Found"/></dl>
        <?php } ?>
        <dl><b>User Type : </b> <?php echo   $results['usertypename']; ?></dl> 
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
        $TotalCountqry = $modelObj->numRows("select * FROM admin where status!=2");
        
        if($sSearch!=''){
            
            $user = $modelObj->fetchRows("SELECT id FROM tbl_usertype WHERE status!=2 and usertypename LIKE '%".$sSearch."%'");
            
            foreach($user as $k => $data){
                $user_id[]="'".$data['id']."'";
                
            }           
            $userids = implode(",",$user_id);   
            
            if($userids!=''){
                $query1= "OR user_type IN ($userids)";
            }
        }
        
        
        
        if($sSearch!=''){
            $Filteredqry = $modelObj->numRows("SELECT * FROM admin where status!=2 AND (username LIKE '%".$sSearch."%' $query1) ");
            
            $list_activity_log = $modelObj->fetchRows("SELECT * FROM admin where status!=2 AND (username LIKE '%".$sSearch."%' $query1) ORDER BY Created_date ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength.""); 
            } else {
            $Filteredqry = $modelObj->numRows("SELECT * FROM admin where status!=2 ");
            
            $list_activity_log = $modelObj->fetchRows("SELECT * FROM admin where status!=2  LIMIT ".$iDisplayStart.",".$iDisplayLength."");   
        }
        
        $stateMsg = '';  
        $Arr['sEcho'] = $_REQUEST['sEcho'];
        $Arr['iTotalRecords'] = $TotalCountqry;
        $Arr['iTotalDisplayRecords'] = $Filteredqry;
        $Arr['aaData'] = array();
        foreach($list_activity_log as $result){
           
            $query="SELECT * FROM tbl_usertype where id=".$result['user_type'];
            $results=$modelObj->fetchRow($query);
                    
            $cms_id = $result['adminid'];
            
            $cms_firstname = urldecode($result['firstname']);
            $cms_lastname= urldecode($result['lastname']);
            $cms_username = urldecode($result['username']);
            $cms_email = urldecode($result['email']);
            $cms_user_type = $results['usertypename'];
            $status = $result['status'];

        

    
          
            
        $checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
            
            $firstname='<td>'.$cms_firstname.'</td>';
            $lastname='<td>'.$cms_lastname.'</td>';
            $username='<td>'.$cms_username.'</td>';
            $email='<td>'.$cms_email.'</td>';
            $usertype='<td>'.$cms_user_type.'</td>';
        
            
                
            if($status==1)
            {
            $status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
            }
            elseif($status==0)
            {
            $status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
            }
            $option='<td class="actions">
            <div class="action-buttons">
            <a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
            <i class="icon-eye-open"></i>
            </a>
            <a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'admin\')" title="Edit">
            <i class="icon-pencil"></i>
            </a>
            
            <a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'admin\')" title="Delete">
            <i class="icon-trash"></i>
            </a>
            </div>
            </td>';
            
            $Arr['aaData'][] = array($checkbox,$firstname,$lastname,$username,$email,$usertype,$status_new,$option);
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
			$qry="UPDATE admin SET status=1 WHERE adminid=".($val);
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
			$qry="UPDATE admin SET status=0 WHERE adminid=".($val);
			$result =$modelObj->runQuery($qry);
		}
	}
?>
<?php
	if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
		$id=explode("," ,$_POST['delete']);
		foreach($id as $k => $val){
			$qry="UPDATE admin SET status=2 WHERE adminid='".$val."'";
			$result=$modelObj->runQuery($qry);
		}
	}
?>
	
<?php
    if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){        
    $checkexists="SELECT adminid FROM admin where status!=2 and username='".($_POST['username'])."'";      
    

        $result_checkexists=$modelObj->numRows($checkexists);
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
          
            $post['firstname']=urlencode($_POST['firstname']);
            $post['lastname']=urlencode($_POST['lastname']);
            $post['username']=urlencode($_POST['username']);
            $post['password']=md5($_POST['password']);
            $post['email']=urlencode($_POST['email']);
            $post['phone']=strip_tags($_POST['phone']);
            $post['address']=urlencode($_POST['address']);
            $post['image']=$insertimage;
            $post['user_type']=strip_tags($_POST['AddUser']);
            $post['Created_date']=date("Y-m-d H:i:s", time());
            $post['Modify_date']=date("Y-m-d H:i:s", time());
            $post['Created_id']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
            $post['Modify_id']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
            $post['status']='1';
            
        
           
            $addfaq=$controller_class->addData('admin',$post);
        
            echo '1';                                    
        }
    }
?>

<?php
    if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){  
        $checkexists="SELECT adminid FROM admin WHERE username='".(trim($_POST['username']))."' and status!=2 and adminid!='".$_POST['hid_userid']."'";
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
                    
                    $getLastImg="SELECT image FROM admin WHERE adminid=".($_POST['hid_userid']);
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
                    $qry_img="UPDATE admin SET image='".($insertimage)."' where adminid='".($_POST['hid_userid'])."'";
                    $res_img= $modelObj->runQuery($qry_img);
                }
            }
            $flag=1;
            $post['adminid']=$_POST['hid_userid'];
            $post['firstname']=urlencode($_POST['firstname']);
            $post['lastname']=urlencode($_POST['lastname']);
            $post['username']=urlencode($_POST['username']);
            $post['password']=$_POST['password'];
            $post['email']=urlencode($_POST['email']);
            $post['phone']=strip_tags($_POST['phone']);
            $post['address']=urlencode($_POST['address']);
            $post['user_type']=strip_tags($_POST['AddUser']);
            $post['Modify_date']=date("Y-m-d H:i:s", time());
            $post['Modify_id']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];

            
            
            
            $editcms=$controller_class->editData('admin',$post,"adminid='".$post['adminid']."'");
            echo '1';
        }
    }   
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
    $start = $_POST['prevnext'];
    $end = $_POST['row'];
    $orderby = $_POST['orderby'];
    $qry = "SELECT * FROM admin where status!=2 order by Created_date desc";
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
        <div class="heading"> <i style="cursor:default;" class="icon-table"></i> Admin
 List
            <a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('<?php echo $_SESSION['pid']; ?>')"><i class="icon-plus"></i>Add New</a>
            <?php if($result !='' ): ?>
            <div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
                <button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown"> <i class="icon-check-sign"></i> Action <span class="caret"></span> </button>
                <ul class="dropdown-menu">
                    <li>
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','admin?')"><i class="icon-ok-sign"></i>Active</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','admin?')"><i class="icon-ok-circle"></i>Inactive</a>
                        </li>
                </ul>
            </div>
            <?php endif;?> </div>
        <div class="widget-content padded clearfix">
            <table class="table table-bordered table-striped" id="tbl_data_display">
                <thead>
                    <th class="check-header hidden-xs">
                        <label>
                            <input id="checkAll" name="checkAll" type="checkbox"><span></span> </label>
                    </th>
                       <th class="hidden-xs" style="color: #007aff;">First Name</th>
                        <th class="hidden-xs" style="color: #007aff;">Last Name</th>
                        <th class="hidden-xs" style="color: #007aff;">Username</th>
                        <th class="hidden-xs" style="color: #007aff;">Email</th>
                         <th class="hidden-xs" style="color: #007aff;">User Type</th>
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
                'aTargets': [0, 6, 7]
            }],
            "aaSorting": [
                [0, "desc"]
            ],
            "sAjaxSource": site_url + 'controllers/ajax_controller/admin-ajax-controller.php?action=displaydata'
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
<?php
	if(isset($_POST['delete']) && $_POST['delete'] != ''){
		
		$qry="UPDATE admin SET status=2 WHERE adminid='".$_POST['id']."'";
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
	$qry="SELECT * FROM admin WHERE adminid=".$_POST['id'];
	$data=$modelObj->fetchRow($qry);
?>
<div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
            <?php if($_POST[ 'id']!=0){ ?> Update Admin
            <?php } else { ?> Add Admin
            <?php } ?>
        </div>
        <div class="widget-content padded">
            <form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
               
               <div class="form-group">
                        <label class="control-label col-md-2"> User Type<font class="required_mark" color="red">*</font></label>
                        <div class="col-md-7">
                            <select id="AddUser" name="AddUser" class="form-control" >
                                <option value="">Select User Type</option>
                                <?php 
                                    $getUsersid=$controller_class->getUsersid();
                                    foreach($getUsersid as $k => $data1){ ?>
                                    
                                    <option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['user_type']){ echo "selected"; } ?>><?php echo urldecode($data1['usertypename']);?></option>
                                <?php } ?>
                            </select>
                            <span id="error_AddUser" style="color:red" class="error_label"></span>
                            
                        </div>
                    </div> 
               
                <div class="form-group">
                    <label class="control-label col-md-2">First Name <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="firstname" maxlength="40" id="firstname" value="<?php echo urldecode($data['firstname']); ?>" /> <span id="error_firstname" style="color:red" class="error_label"></span> </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Last Name <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="lastname" maxlength="40" id="lastname" value="<?php echo urldecode($data['lastname']); ?>" /> <span id="error_lastname" style="color:red" class="error_label"></span> </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2">Username
                  <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                      <input class="form-control" type="text" name="username" maxlength="40" id="username" 
                        value="<?php echo urldecode($data['username']); ?>" /> <span id="error_username" style="color:red" class="error_label"></span> </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Password
                  <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                      <input class="form-control" type="password" name="password" maxlength="40" id="password" 
                        value="<?php echo stripslashes($data['password']); ?>" /> <span id="error_password" style="color:red" class="error_label"></span> </div>
                </div>

                 <div class="form-group">
                    <label class="control-label col-md-2">Email
                  <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                      <input class="form-control" type="email" name="email" maxlength="40" id="email" 
                        value="<?php echo urldecode($data['email']); ?>" /> <span id="error_email" style="color:red" class="error_label"></span> </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Phone No
                  <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                      <input class="form-control" type="tel" name="phone" maxlength="40" id="phone" 
                        value="<?php echo stripslashes($data['phone']); ?>" /> <span id="error_phone" style="color:red" class="error_label"></span> </div>
                </div>

                
                    <div class="form-group">
                <label class="control-label col-md-2">Address<font class="required_mark" color="red">*</font>
                </label>
                 <div class="col-md-7">
                    <textarea class="form-control" name="address" id="address" rows="3"><?php echo urldecode($data['address']); ?></textarea><span id="error_address" style="color:red" class="error_label"></span>
                    
                 </div>
                 </div>


                <div class="form-group">
                        <label class="control-label col-md-2">Upload Admin Image <font class="required_mark" color = "red">*</font></label>
                        <div class="col-md-4">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <?php if($data['image']=='' ){?>
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
                                        <?php }else{?>
                                        <img src="<?=$_SESSION['FRNT_DOMAIN_NAME']?>upload/admin/<?php echo $data['image'];?>">
                                    <?php } ?>
                                    <input type="hidden" id="userimage" name="userimage" value='<?php echo $data['image'];?>'>
                                </div>
                                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" id ="image" name="image" accept="image/*" value='<?php echo $data['image'];?>'></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="javascript:void(0);">Remove</a>
                                </div>
                            </div>
                            <input type="hidden" name="image" id="image" value="<?php echo $data['image']; ?>">
                            <span id="error_image" style="color:red" class="error_label"></span>
                            
                        </div>
                    </div>
			
			
			
                <?php if($_POST[ 'id'] !=0):?>
                <div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-7">
                        <input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data['adminid']; ?>" />
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