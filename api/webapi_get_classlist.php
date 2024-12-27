<?php
include('config.php');
$array_final=array();
$array_final1=array();
$array_temp['code']=1;
$array_temp['message']="Success";

$user_id=$_REQUEST['user_id'];

$qry = ("select id,class_name,status from tbl_class where status=1 order by id ASC");
$get = numRows($qry);
if($get)
{
	if($user_id!='')
	{
		$str=fetchRows($qry);
		$com = numRows("SELECT id,read_status,fk_user_id FROM tbl_notification WHERE read_status=0 AND fk_user_id=".$user_id);
		$array_temp['notification_count']="$com";
		$array_temp['result']=array();
		foreach($str as $row)
		{
			$array_temp1['class_id']=$row['id'];
			if($row['id']==11)
				$array_temp1['class_color_code']='#f7931d';
			if($row['id']==10)
				$array_temp1['class_color_code']='#fbc20f';
			if($row['id']==8)
				$array_temp1['class_color_code']='#fded1b';
			if($row['id']==11)
				$array_temp1['class_english']='8';
			if($row['id']==10)
				$array_temp1['class_english']='9';
			if($row['id']==8)
				$array_temp1['class_english']='10';
			if($row['id']==11)
				$array_temp1['class_name']='VII';
			if($row['id']==10)
				$array_temp1['class_name']='IX';
			if($row['id']==8)
				$array_temp1['class_name']='X';

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
