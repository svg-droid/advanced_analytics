<?php
include('config.php');
$array_final=array();	
$array_final1=array();	
$array_temp['code']=1;
$array_temp['message']="Your profile edited successfully";

$id=$_REQUEST['user_id'];
$old_password=$_REQUEST['old_password'];
$new_password=$_REQUEST['new_password'];
$ipaddress = $_SERVER['REMOTE_ADDR'];
$current_date = date('Y-m-d H:i:s');


$pwdQry="";
if($new_password!='')
{
   	$pwdQry=", password='".md5($new_password)."'";
}
$result = fetchRow("select password,id,status,name,email,contact_number from tbl_user where status!=2 and id='".$id."'");
if($result['password']!=md5($old_password) || $new_password=='')
{
	$array_final=array();		
	$array_temp['code']=-2;
	$array_temp['message']="Your old password is wrong.";
	$array_final[]=$array_temp;	
	echo json_encode($array_final);
}
elseif($id != '')
{
	$insert= runQuery("UPDATE tbl_user SET modified_date = '".$current_date."',Modify_Id = '".$id."',ip_address = '".$ipaddress."'".$pwdQry." WHERE id = '".$id."' ");
	
	$com = numRows("SELECT id,read_status,fk_user_id FROM tbl_notification WHERE read_status=0 AND fk_user_id=".$result['id']);
	$array_temp['notification_count']="$com";
	$array_temp['result']=array();
	$array_temp1['user_id']=$result['id'];
	$array_temp1['name']=$result['name'];
	$array_temp1['email']=$result['email'];
	$array_temp1['contact_number']=$result['contact_number'];

    $array_final1[]=$array_temp1;	
    $array_temp['result']=$array_final1;
	$array_final[]=$array_temp;	
	echo json_encode($array_final);
}
else
{
	$array_final=array();		
	$array_temp['code']=0;
	$array_temp['message']="No data found";
	$array_final[]=$array_temp;	
	echo json_encode($array_final);
}
?>