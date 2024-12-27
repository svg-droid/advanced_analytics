<?php
include('config.php');

$id= $_REQUEST['cms_id'];
$userid = $_REQUEST['userid'];
$device_token = $_REQUEST['device_token'];
$checkuser=numRows("SELECT * FROM `tbl_users` WHERE id=".$userid." and status = 1");
if($checkuser>0)
{
	$token=numRows("SELECT * FROM `tbl_users` WHERE id=".$userid." and 	device_token='".$device_token."' and  status = 1");
	/*if($token>0)
    {*/
	$row=fetchRow("SELECT * FROM tbl_cms WHERE id = '".$id."' AND status = 1");
			   if($row)
				 {
				$array_final=array();
				$array_final1=array();
				$array_temp['code']=1;
				$array_temp['message']="Success";
				$array_temp['title']=urldecode($row['cms_page_name']);
				$array_temp['content']=strip_tags(urldecode($row['cms_page_content']));
				$array_final[]=$array_temp;
				echo json_encode($array_final);
			}
			else {

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
