<?php
include('config.php');
$array_final=array();
$array_final1=array();
$array_temp['code']=1;
$array_temp['message']="Success";

$class_id = $_REQUEST['class_id'];
$user_id = $_REQUEST['user_id'];

$main_qry=("select fk_class_id,subject_name,id,status,subject_image from tbl_subject where status=1 and fk_class_id='".$class_id."'");
$qry = numRows($main_qry);
if($qry>0)
{
	if($user_id !='')
	{
		$str=fetchRows($main_qry);
		$com = numRows("SELECT id,read_status,fk_user_id FROM tbl_notification WHERE read_status=0 AND fk_user_id=".$user_id );
		$array_temp['notification_count']="$com";
		$array_temp['result']=array();
		foreach($str as $row)
		{
			$array_temp1['subject_id']=$row['id'];
			$array_temp1['subject_image_url']=COFIG_SITE_URL."upload/subject/thumb/".$row['subject_image'];
			$array_temp1['subject_name']=$row['subject_name'];

			$array_final1[]=$array_temp1;	
			$array_temp['result']=$array_final1;
		}
	}
	else
	{
		$array_temp['code']=-1;
		$array_temp['message']="cannot connect to server";
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