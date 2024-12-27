<?php

include('config.php');
//$id= $_REQUEST['cms_id'];
  $userid = $_REQUEST['userid'];
  $device_token = $_REQUEST['device_token'];
  $wheeltype = $_REQUEST['wheeltype'];


$checkuser=numRows("SELECT * FROM `tbl_users` WHERE id=".$userid." and status = 1");
if($checkuser>0)
{
	$token=numRows("SELECT * FROM `tbl_users` WHERE id=".$userid." and 	device_token='".$device_token."' and  status = 1");
	/*if($token>0)
    {*/
//     echo "SELECT * FROM tbl_projectwheel inner join tbl_projectwheelcategory on tbl_projectwheelcategory.wheelcategoryid = tbl_projectwheel.fk_wheelcategoryid  where status ==1 and fk_wheelcategoryid=".$wheeltype."";
	$row=fetchRows("SELECT * FROM tbl_projectwheel inner join tbl_projectwheelcategory on tbl_projectwheelcategory.wheelcategoryid = tbl_projectwheel.fk_wheelcategoryid  where status =1 and fk_wheelcategoryid=".$wheeltype."");
	if($row)
	{
	$array_final=array();
	$array_final1=array();
	$array_temp['code']=1;
	$array_temp['message']="Success";
	foreach($row as $fragnets)
	{
    $array_temp1['wheelid']=$fragnets['wheelid'];
		$array_temp1['wheeltype']=$fragnets['wheeltype'];
		$array_temp1['title']=strip_tags(urldecode($fragnets['title']));
    $array_temp1['adress']=strip_tags(urldecode($fragnets['adress']));
    $array_temp1['description']=strip_tags(urldecode($fragnets['description']));
    $array_temp1['email']=strip_tags(urldecode($fragnets['email']));
    $array_temp1['office']=strip_tags(urldecode($fragnets['office']));
    $array_temp1['mobile']=strip_tags(urldecode($fragnets['mobile']));
    $array_temp1['fax']=strip_tags(urldecode($fragnets['fax']));
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
