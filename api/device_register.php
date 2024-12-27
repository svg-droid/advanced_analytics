<?php
include('config.php');
$array_final=array();
$array_final1=array();
$array_temp['code']=1;
$array_temp['message']="success";

$user_id = $_REQUEST['user_id'];
$device_token = $_REQUEST['device_token'];
$devicetype = $_REQUEST['device_type'];

$qry = fetchRow("select id,status from tbl_user where id=".$user_id);
if($qry)
{
	$str = fetchRow("select userid,id from tbl_deviceregister where userid=".$user_id);
	if($str)
	{
		$update = runQuery("UPDATE tbl_deviceregister SET devicetype='".$devicetype."', devicetoken='".$device_token."' WHERE userid=".$user_id);
	}
	else
	{
		$insert = runQuery("INSERT INTO tbl_deviceregister (userid, devicetype, devicetoken) VALUES ('".$user_id."', '".$devicetype."', '".$device_token."')");
	}
}
else
{
	$array_temp['code']=0;
	$array_temp['message']="No data found";
}
$array_final[]=$array_temp;
echo json_encode($array_final);
?>
