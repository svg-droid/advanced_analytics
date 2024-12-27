<?php
include('config.php');

//$id= $_REQUEST['cms_id'];
$userid = $_REQUEST['userid'];
$device_token = $_REQUEST['device_token'];
$checkuser=numRows("SELECT * FROM `tbl_users` WHERE id=".$userid." and status = 1");
if($checkuser>0)
{
	$token=numRows("SELECT * FROM `tbl_users` WHERE id=".$userid." and 	device_token='".$device_token."' and  status = 1");
	/*if($token>0)
    {*/
	$row=fetchRows("SELECT * FROM tbl_breakdown left join tbl_breakdown_image on tbl_breakdown_image.fk_breakdownid = tbl_breakdown.breakdownid WHERE statuscheck = 1");
	if($row)
	{
	$array_final=array();
	$array_final1=array();
	$array_temp['code']=1;
	$array_temp['message']="Success";
	foreach($row as $fragnets)
	{
		$array_temp1['title']=strip_tags(urldecode($fragnets['breakdowntitle']));
		//$array_temp1['image']=COFIG_SITE_URL_IMG."breakdown_img/".$fragnets['image'];
		$array_temp1['mainimage']=COFIG_SITE_URL_IMG."breakdown_img/".$fragnets['image'];
		$array_temp1['thumbimage']=COFIG_SITE_URL_IMG."breakdown_img/thumb/".$fragnets['thumbimage'];
		$array_final1[]=$array_temp1;
		$array_temp['result']=$array_final1;

	}
	  $array_final[]=$array_temp;
		echo json_encode($array_final);
}
else
{
    	$array_final=array();
    	$array_temp1['code']=0;
      $array_temp1['message']="No Data Found.";
      $array_final[]=$array_temp1;
		echo json_encode($array_final);
}
	/*}
	else {
	$array_final=array();
	$array_temp1['code']=3;
	$array_temp1['message']="Invalid Token.";
	$array_final[]=$array_temp1;
	echo json_encode($array_final);
	}*/
}
else {
$array_final=array();
$array_temp1['code']=2;
$array_temp1['message']="Invalid User.";
$array_final[]=$array_temp1;
echo json_encode($array_final);
}
?>
