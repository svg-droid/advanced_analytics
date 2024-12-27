<?php 
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/contact-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	include('../contact-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new ContactController();
	
if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM tbl_contact where status!=2 and id='".$id."'";
    $result=$modelObj->fetchRow($qry);
?>
<div class="col-md-12">
    <div class="widget-content padded">
    <dl><b>Name: </b>  <?php echo urldecode($result["name"]);?></dl>
    <dl><b>Mobile No.: </b>  <?php echo urldecode($result["mobile"]);?></dl>
    <dl><b>Email: </b>  <?php echo urldecode($result["email"]);?></dl>
		<dl><b>Message: </b>  <?php echo urldecode($result["message"]);?></dl>
		
		<!-- <dl><b>Description : </b>  <?php echo urldecode(stripslashes($result["description"])); ?></dl>  -->
		
	</div>
  </div>
<?php endif; ?>
<?php

if(isset($_REQUEST['action']) && $_REQUEST['action'] == "displaydata"){
	
  $iDisplayStart = $_REQUEST['iDisplayStart'];
  $iDisplayLength = $_REQUEST['iDisplayLength'];
  $sSearch = $_REQUEST['sSearch'];
  $sSortDir_0 = $_REQUEST['sSortDir_0'];
  $iSortCol_0 = $_REQUEST['iSortCol_0'];
  if($sSortDir_0=='asc'){
   $SortBy = 'asc';
  }else{
   $SortBy = 'desc';
  }
  if($iSortCol_0=='1'){
		$sortfield = 'email';
	}else{
		$sortfield = 'id';
	}
  $TotalCountqry = $modelObj->numRows("select * FROM tbl_contact WHERE status!=2");
  
  
 
	if($sSearch!=''){
		$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_contact WHERE status!=2 AND email like '%".$sSearch."%'");
		
		$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_contact WHERE status!=2 AND email LIKE '%".$sSearch."%' ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
	} else {
		$Filteredqry = $modelObj->numRows("SELECT * FROM tbl_contact WHERE status!=2");
		
		$list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_contact WHERE status!=2 ORDER BY ".$sortfield." ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");	
	}
  
  $countryMsg = '';  
  $Arr['sEcho'] = $_REQUEST['sEcho'];
  $Arr['iTotalRecords'] = $TotalCountqry;
  $Arr['iTotalDisplayRecords'] = $Filteredqry;
  $Arr['aaData'] = array();
  foreach($list_activity_log as $result){
   $cms_id = $result['id'];
  
   $cms_page_name = urldecode($result['name']);
   $cms_page_mobile = urldecode($result['mobile']);
   $cms_page_email = urldecode($result['email']);
			
   $cms_status = $result['status'];
 
		$checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
		
    $name='<td>'.$cms_page_name.'</td>';
    $mob='<td>'.$cms_page_mobile.'</td>';
		$mail='<td>'.$cms_page_email.'</td>';
				
		/* if($cms_status==1){
		 $status='<td class="hidden-xs"><span class="label label-success">Active</span></td>';	
		} else {
		$status='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';	
		}	 */		
        
		$option='<td class="actions">
					<div class="action-buttons">
						<a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
						  <i class="icon-eye-open"></i>
						</a>

            <a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'contact\', \'delete\', \'1\')" title="Delete">
               <i class="icon-trash"></i>
            </a>
						
					</div>
				</td>';
   /*<a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'contact\')" title="Edit">
						 <i class="icon-pencil"></i>
						</a>*/
   $Arr['aaData'][] = array($checkbox,$name,$mob,$mail,$option);
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
			$qry="UPDATE tbl_contact SET status=1 WHERE id=".($val);
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
			$qry="UPDATE tbl_contact SET status=0 WHERE id=".($val);
			$result =$modelObj->runQuery($qry);
		}
	}
?>


<?php
	if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){	
		
					
			
			$pst["email"]=urlencode($_POST["txt_addemail"]);
			//$pst["description"]=urlencode($_POST["txt_description"]);
			
			$pst['modified_date']=date("Y-m-d H:i:s", time());
			/* $pst['Modify_Id']=$_SESSION['UNIVERSITY_ID']['ADMIN_ID']; */
			$pst['ip_address']=$_SERVER['REMOTE_ADDR'];
			$pst['id']=$_POST['hid_userid'];
			$editcms=$controller_class->editData('tbl_contact',$pst,"id='".$pst['id']."'");
			echo '1';

	}	
?>

<?php
	if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
    $start = $_POST['prevnext'];
    $end = $_POST['row'];
    $orderby = $_POST['orderby'];
    $qry = "SELECT * FROM tbl_contact where status!=2 order by created_date desc";
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
        <div class="heading"> <i style="cursor:default;" class="icon-table"></i> Contact List
           <!-- <a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('cms')"><i class="icon-plus"></i>Add New</a>  -->
			</div>
        <div class="widget-content padded clearfix">
            <table class="table table-bordered table-striped" id="tbl_data_display">
                <thead>
                    <th class="check-header hidden-xs">
                        <label>
                            <input id="checkAll" name="checkAll" type="checkbox"><span></span> </label>
                    </th>
                        <th class="hidden-xs" style="color: #007aff;">Name</th>
                        <th class="hidden-xs" style="color: #007aff;">Mobile No</th>
                        <th class="hidden-xs" style="color: #007aff;">Email</th>
                        <th class="hidden-xs" style="color: #007aff;">Options </th>
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
                'aTargets': [0, 4]
            }],
            "aaSorting": [
                [0, "desc"]
            ],
            "sAjaxSource": site_url + 'controllers/ajax_controller/contact-ajax-controller.php?action=displaydata'
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
if(isset($_POST['edit']) && $_POST['edit'] != ''){
	$qry="SELECT * FROM tbl_contact WHERE id=".$_POST['id'];
	$data=$modelObj->fetchRow($qry);
?>
<div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
            <?php if($_POST[ 'id']!=0){ ?> Update Contact
            <?php } else { ?> Add Contact
            <?php } ?>
        </div>
        <div class="widget-content padded">
            <form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
               
				<div class="form-group">
					
					<label class="control-label col-md-3"> Email
					<font class="required_mark" color="red">*</font></label>
						
					<div class="col-md-6">
						<input class="form-control" type="text" name="txt_addemail"
						maxlength="70" id="txt_addemail" value="<?php echo urldecode($data["email"]); ?>" />
					</div>
				</div>
                <?php if($_POST[ 'id'] !=0):?>
                <div class="form-group">
                    <label class="control-label col-md-3"></label>
                    <div class="col-md-7">
                        <input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data['id']; ?>" />
                        <input type="hidden" name="hid_update" id="hid_update" value="update" />
                        <button type="button" class="btn btn-primary" onclick="return updatedata()">Submit</button>
                        <button class="btn btn-default-outline" onclick="newdata();">Cancel</button>
                    </div>
                </div>
                <?php else:?>
                <div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-7">
                        <input type="hidden" name="hid_add" id="hid_add" value="add" />
                        <button type="button" class="btn btn-primary" onclick="return adddata()">Submit</button>
                        <button class="btn btn-default-outline" onclick="newdata();">Cancel</button>
                    </div>
                </div>
                <?php endif;?> </form>
        </div>
    </div>
</div>
<?php } ?>
<?php
  if(isset($_POST['delete']) && $_POST['delete'] != ''){
    
    $qry="UPDATE tbl_contact SET status=2 WHERE id='".$_POST['id']."'";
    $result=$modelObj->runQuery($qry);
    
    if($result){
      echo $successmsg='1';
    }else{
      echo $errmsg='0';
    }
  }
?>