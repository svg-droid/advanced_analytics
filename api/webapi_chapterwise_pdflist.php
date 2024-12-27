<?php
include('config.php');
$array_final=array();
$array_final1=array();
$array_temp['code']=1;
$array_temp['message']="Success";

$user_id = $_REQUEST['user_id'];
$class_id = $_REQUEST['class_id'];
$sub_id = $_REQUEST['subject_id'];
$is_examSpecial = $_REQUEST['is_examSpecial'];

if($is_examSpecial=='1')
	$sSearchSpecial = "and specialfor='".$is_examSpecial."'";
elseif($is_examSpecial=='0')
	$sSearchSpecial = "and specialfor='".$is_examSpecial."'";
else
	$sSearchSpecial = "";	

$main_qry = ("select id,fk_subject_id,chapter_name,pdf_file,specialfor,fk_class_id from tbl_chapter where status=1 and fk_subject_id='".$sub_id."' and fk_class_id=".$class_id." ".$sSearchSpecial." ORDER BY chapter_name ASC");

$qry =  numRows($main_qry);
if($qry>0)
{
	if($user_id!='')
	{
		$com = numRows("SELECT id,read_status,fk_user_id FROM tbl_notification WHERE read_status=0 AND fk_user_id=".$user_id);
		$array_temp['notification_count']="$com";
		$array_temp['result']=array();
		$str= fetchRows($main_qry);
		foreach($str as $row)
		{
			$array_temp1['pdf_name']=$row['chapter_name'];
			$qry = numRows("SELECT id,fk_user_id,fk_chapter_id FROM tbl_order WHERE fk_chapter_id=".$row['id']." AND fk_user_id=".$user_id);
			if($qry==0)
				$array_temp1['is_purchase']="0";
			else
				$array_temp1['is_purchase']="1";
			$array_temp1['pdf_id']=$row['id'];
			$array_temp1['pdf_url']=COFIG_SITE_URL."upload/chapter/".$row['pdf_file'];

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
    $array_temp['message']="No record found";
}
$array_final[]=$array_temp;	
echo json_encode($array_final);
?>