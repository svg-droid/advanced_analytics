<?php 
    @session_start();
    include('../../models/db.php');
    include('../../models/common-model.php');
    include('../../models/productattribute-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
    include('../productattribute-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
    $controller_class = new CommonController();
    $upload_dir1 =$_SESSION['SITE_IMG_PATH']."productattribute/";
    $upload_dir =$_SESSION['SITE_IMG_PATH']."productattribute/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."productattribute/thumb/";
    

if(isset($_POST['view']) && $_POST['view'] != ''):
    $id = $_POST['id'];
    $qry="SELECT * FROM tbl_productattributeset where status!=2 and id='".$id."'";
    $result=$modelObj->fetchRow($qry);
  
     $query="SELECT * FROM tbl_product where id=".$result['productid'];
    $results=$modelObj->fetchRow($query);
     $qury="SELECT * FROM tbl_language where id=".$result['fk_language_id'];
    $resul=$modelObj->fetchRow($qury);
    
?>
<div class="col-md-12">
    <div class="widget-content padded">

     <!-- <dl><b>Language Name </b> <?php echo  $resul['languagename']; ?></dl>  -->
        <dl><b>Attributes : </b> <?php echo  $result['attributename']; ?></dl> 
        <!-- <?php $getCurrencyById=$controller_class->getCurrencyById($result['fk_currency_id']); ?>
        <dl><b>Currency : </b> <?php echo  $getCurrencyById['currencyname']; ?></dl>  -->
        <dl><b>Price Bahrain(BHD): </b> <?php echo  $result['val_bh']; ?></dl>
        <dl><b>Price Kuwait (KD): </b> <?php echo  $result['val_kw']; ?></dl>
        <dl><b>Price UAE (AED): </b> <?php echo  $result['val_ue']; ?></dl>
        <dl><b>Price Qatar(QAR): </b> <?php echo  $result['val_qt']; ?></dl>
        <dl><b>Price Saudi Arebia(SAR): </b> <?php echo  $result['val_sa']; ?></dl>
        
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
  $TotalCountqry = $modelObj->numRows("select * FROM tbl_productattributeset WHERE status!=2");
  if($sSearch!=''){
            
            $user = $modelObj->fetchRows("SELECT id FROM tbl_productattributeset WHERE status!=2 and val_bh LIKE '%".$sSearch."%'");
            
            foreach($user as $k => $data){
                $user_id[]="'".$data['id']."'";
                
            }           
            $userids = implode(",",$user_id);   
            
            if($userids!=''){
                $query1= "OR id IN ($userids)";
            }
        }
  
  if($sSearch!=''){
            
            $user = $modelObj->fetchRows("SELECT id FROM tbl_productattributeset WHERE status!=2 and val_kw LIKE '%".$sSearch."%'");
            
            foreach($user as $k => $data){
                $user_id[]="'".$data['id']."'";
                
            }           
            $userids = implode(",",$user_id);   
            
            if($userids!=''){
                $query2= "OR id IN ($userids)";
            }
        }
 
    if($sSearch!=''){
        $Filteredqry = $modelObj->numRows("SELECT * FROM tbl_productattributeset WHERE status!=2 AND (attributename like '%".$sSearch."%' OR  attributevalues like '%".$sSearch."%' $query1 $query2)");
        
        $list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_productattributeset WHERE status!=2 AND (attributename LIKE '%".$sSearch."%' OR  attributevalues LIKE '%".$sSearch."%'  $query1 $query2) ORDER BY createdatetime ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");   
    } else {
        $Filteredqry = $modelObj->numRows("SELECT * FROM tbl_productattributeset WHERE pattributeparentid=0 AND status!=2");
        
        $list_activity_log = $modelObj->fetchRows("SELECT * FROM tbl_productattributeset WHERE pattributeparentid=0 AND status!=2 ORDER BY createdatetime ".$SortBy." LIMIT ".$iDisplayStart.",".$iDisplayLength."");   
    }
  
  $countryMsg = '';  
  $Arr['sEcho'] = $_REQUEST['sEcho'];
  $Arr['iTotalRecords'] = $TotalCountqry;
  $Arr['iTotalDisplayRecords'] = $Filteredqry;
  $Arr['aaData'] = array();
  foreach($list_activity_log as $result){   


             $qury="SELECT * FROM tbl_language where status=1";
            $resul=$modelObj->fetchRows($qury);

        
            $cms_id = $result['id'];

            $cms_name = $result['attributename'];
           /* $getCurrencyById=$controller_class->getCurrencyById($result['fk_currency_id']);
            $cms_currency = $getCurrencyById['currencyname'];*/
            $cms_attributevalues1= $result['val_bh'];
            $cms_attributevalues2= $result['val_kw'];
            $cms_attributevalues3= $result['val_ue'];
            $cms_attributevalues4= $result['val_qt'];
            $cms_attributevalues5= $result['val_sa'];
            $status = $result['status'];
 
        $checkbox='<td class="check hidden-xs"><label><input name="chk_id" id="chk_id" type="checkbox" value="'.$cms_id.'"><span></span></label></td>';
        
        $name='<td>'.$cms_name.'</td>';
        $currency='<td>'.$cms_currency.'</td>';
        $attributevalues1='<td>'.$cms_attributevalues1.'</td>';
        $attributevalues2='<td>'.$cms_attributevalues2.'</td>';
        $attributevalues3='<td>'.$cms_attributevalues3.'</td>';
        $attributevalues4='<td>'.$cms_attributevalues4.'</td>';
        $attributevalues5='<td>'.$cms_attributevalues5.'</td>';


        if($status==1)
            {
            $status_new ='<td class="hidden-xs"><span class="label label-success">Active</span></td>';
            }
            elseif($status==0)
            {
            $status_new ='<td class="hidden-xs"><span class="label label-danger">Inactive</span></td>';
            }
            $selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 16 ORDER BY id ASC";
        $moduleresult=$modelObj->fetchRow($selectmodule); 
        if($moduleresult['p_field3'] == 1 && $moduleresult['p_field4'] == 1){

            $option='<td class="actions">
            <div class="action-buttons">
            <a class="table-actions" href="javascript:void(0)" onclick="view('.$cms_id.')" title="View">
            <i class="icon-eye-open"></i>
            </a>
            <a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'productattribute\')" title="Edit">
            <i class="icon-pencil"></i>
            </a>            
            
            <a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'productattribute?\')" title="Delete">
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
            <a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'productattribute\')" title="Edit">
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
            <a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'productattribute\')" title="Delete">
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
            <a class="table-actions" href="javascript:void(0)" onclick="edit('.$cms_id.',\'productattribute\')" title="Edit">
            <i class="icon-pencil"></i>
            </a>
            
            <a class="table-actions" href="javascript:void(0)" onclick="deleteuser('.$cms_id.', \'delete\', \'productattribute\')" title="Delete">
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
   
   $Arr['aaData'][] = array($checkbox,$name,$attributevalues1,$attributevalues2,$attributevalues3,$attributevalues4,$attributevalues5,$status_new,$option);
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
            $qry="UPDATE tbl_productattributeset SET status=1 WHERE id=".($val);
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
            $qry="UPDATE tbl_productattributeset SET status=0 WHERE id=".($val);
            $result =$modelObj->runQuery($qry);
        }
    }
?>
<?php
    if(isset($_POST['deleselected']) && $_POST['deleselected'] != ''){
        $id=explode("," ,$_POST['delete']);
        foreach($id as $k => $val){
            $qry="UPDATE tbl_productattributeset SET status=2 WHERE id='".$val."'";
            $result=$modelObj->runQuery($qry);
        }
    }
?>
    
<?php
    if(isset($_POST['hid_add']) && $_POST['hid_add'] != ''){

    $checkexists="SELECT * FROM tbl_productattributeset where status!=2 and attributename='".($_POST['txt_attributename']);        
    

        $result_checkexists=$modelObj->numRows($checkexists);
        if($result_checkexists>0){
            $flag=0;
            echo "0";
            }else {
            $flag=1;
        }
        
        if($flag==1)
        {
            $post['fk_language_id']=strip_tags($_POST['AddLang']);
            $post['attributename']=strip_tags($_POST['txt_attributename']);
            /*$post['fk_currency_id']=strip_tags($_POST['addcurrency']);*/
            $post['val_bh']=strip_tags($_POST['pricebahrain']);
            $post['val_kw']=strip_tags($_POST['pricekuwait']);
            $post['val_ue']=strip_tags($_POST['priceuae']);
            $post['val_qt']=strip_tags($_POST['priceqatar']);
            $post['val_sa']=strip_tags($_POST['pricesaudi']);
            $post['status']='1';
            $post['createdatetime']=date("Y-m-d H:i:s", time());
            $post['updatedatetime']=date("Y-m-d H:i:s", time());
            $post['createdby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
            $post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
            
         
           
            $addfaq=$controller_class->addData('tbl_productattributeset',$post);
           
            
            echo '1';
        }
    }
?>

<?php
    if(isset($_POST['hid_update']) && $_POST['hid_update'] != ''){  
        
            $flag=1;    
            
            $post['id']=$_POST['hid_userid'];
            $post['fk_language_id']=strip_tags($_POST['AddLang']);
            $post['attributename']=strip_tags($_POST['txt_attributename']);
            /*$post['fk_currency_id']=strip_tags($_POST['addcurrency']);*/
            $post['val_bh']=strip_tags($_POST['pricebahrain']);
            $post['val_kw']=strip_tags($_POST['pricekuwait']);
            $post['val_ue']=strip_tags($_POST['priceuae']);
            $post['val_qt']=strip_tags($_POST['priceqatar']);
            $post['val_sa']=strip_tags($_POST['pricesaudi']);
            $post['updatedatetime']=date("Y-m-d H:i:s", time());
            $post['updatedby']=$_SESSION['TERRATROVE_ID']['ADMIN_ID'];
        
            $editcms=$controller_class->editData('tbl_productattributeset',$post,"id='".$post['id']."'");
            echo '1';
       
    }   
?>

<?php
    if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
    $start = $_POST['prevnext'];
    $end = $_POST['row'];
    $orderby = $_POST['orderby'];
    $qry = "SELECT * FROM tbl_productattributeset where status!=2 order by createdatetime desc";
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
        <div class="heading"> <i style="cursor:default;" class="icon-table"></i> Attribute List
        <?php
            $selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 16 ORDER BY id ASC";
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
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','productattribute?')"><i class="icon-ok-sign"></i>Active</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','productattribute?')"><i class="icon-ok-circle"></i>Inactive</a>
                        </li>
                         <?php if($moduleresult['p_field4'] == 1){ ?>
                        <li>
                            <a href="javascript:void(0)" onclick="deleteselected('Delete','delete','productattribute')"><i class="icon-remove"></i>Delete</a>
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
                        <th class="hidden-xs" style="color: #007aff;">Attributes </th>
                        <th class="hidden-xs" style="color: #007aff;">Bahrain(BHD)</th>
                        <th class="hidden-xs" style="color: #007aff;">Kuwait (KD)</th>
                        <th class="hidden-xs" style="color: #007aff;">UAE (AED)</th>
                        <th class="hidden-xs" style="color: #007aff;">Qatar(QAR)</th>
                        <th class="hidden-xs" style="color: #007aff;">Saudi Arebia(SAR)</th>
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
                'aTargets': [0, 7, 8]
            }],
            "aaSorting": [
                [0, "desc"]
            ],
            "sAjaxSource": site_url + 'controllers/ajax_controller/productattribute-ajax-controller.php?action=displaydata'
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
        
        $qry="UPDATE tbl_productattributeset SET status=2 WHERE id='".$_POST['id']."'";
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
       $qry="SELECT * FROM tbl_productattributeset WHERE  id=".$_POST['id'];
        $result_checkexists=$modelObj->numRows($qry);
        if($result_checkexists==0) {
            $qry="SELECT * FROM tbl_productattributeset WHERE  pattributeparentid=".$_POST['id'];
            $data=$modelObj->fetchRow($qry);
        } else {
            $data=$modelObj->fetchRow($qry);
        }
    }
    ?>
<div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i style="cursor:default;" class="icon-reorder"></i>
            <?php if($_POST[ 'id']!=0){ ?> Update Product Attribute
            <?php } else { ?> Add Product Attribute
            <?php } ?>
        </div>
        <div class="widget-content padded">
            <form name="form_cmsadd" id="form_cmsadd" method="post" enctype="multipart/form-data" action="" class="form-horizontal">
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
                        <label class="control-label col-md-2"> Attributes <font class="required_mark" color="red">*</font></label>
                        <div class="col-md-7">
                            <select id="txt_attributename" name="txt_attributename" class="form-control" >
                                <option value="">Select Attributes</option>
                                <?php 
                                    $getAttributes=$controller_class->getAttributes();
                                    
                                    foreach($getAttributes as $k => $data1){ ?>
                                    
                                    <option value='<?php echo $data1['attributename'];?>' <?php if($data1['id']==$data['id']){ echo "selected"; } ?>><?php echo $data1['attributename'];?></option>
                                <?php } ?>
                            </select>
                            <span id="error_txt_attributename" style="color:red" class="error_label"></span>    
                        </div>
                    </div> 
               
                <!-- <div class="form-group">
                    <label class="control-label col-md-2">Attribute Name <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="attributename" maxlength="40" id="attributename" value="<?php echo stripslashes($data['attributename']); ?>" /> <span id="error_attributename" style="color:red" class="error_label"></span> </div>
                </div> -->
 
               <!--  <div class="form-group">
                        <label class="control-label col-md-2"> Currency <font class="required_mark" color="red">*</font></label>
                        <div class="col-md-7">
                            <select id="addcurrency" name="addcurrency" class="form-control" onclick="ShowHideDiv(this)">
                                <option value="">Select Currency</option>
                                <?php 
                                    $getCurrencyList=$controller_class->getCurrencyList();
                                    
                                    foreach($getCurrencyList as $k => $data1){ ?>
                                    
                                    <option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['fk_currency_id']){ echo "selected"; } ?>><?php echo $data1['currencyname'];?></option>
                                <?php } ?>
                            </select>
                            <span id="error_addcurrency" style="color:red" class="error_label"></span>    
                        </div>
                    </div>  -->
                 <div class="form-group" >
                    <label class="control-label col-md-2">Price Bahrain(BHD)<font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="pricebahrain" maxlength="40" id="pricebahrain" 
                        value="<?php echo stripslashes($data['val_bh']); ?>" /> <span id="error_pricebahrain" style="color:red" class="error_label"></span> </div>
                </div>
                <div class="form-group" >
                    <label class="control-label col-md-2">Price Kuwait (KD)<font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7"> 
                        <input class="form-control" type="text" name="pricekuwait" maxlength="40" id="pricekuwait" 
                        value="<?php echo stripslashes($data['val_kw']); ?>" /> <span id="error_pricekuwait" style="color:red" class="error_label"></span> </div>
                </div>
                 <div class="form-group" >
                    <label class="control-label col-md-2">Price UAE (AED) <font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="priceuae" maxlength="40" id="priceuae" 
                        value="<?php echo stripslashes($data['val_ue']); ?>" /> <span id="error_priceuae" style="color:red" class="error_label"></span> </div>
                </div>
                 <div class="form-group" >
                    <label class="control-label col-md-2">Price Qatar(QAR)<font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="priceqatar" maxlength="40" id="priceqatar" 
                        value="<?php echo stripslashes($data['val_qt']); ?>" /> <span id="error_priceqatar" style="color:red" class="error_label"></span> </div>
                </div>
                 <div class="form-group" >
                    <label class="control-label col-md-2">Price Saudi Arebia(SAR)<font class="required_mark" color="red">*</font>
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="pricesaudi" maxlength="40" id="pricesaudi" 
                        value="<?php echo stripslashes($data['val_sa']); ?>" /> <span id="error_pricesaudi" style="color:red" class="error_label"></span> </div>
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