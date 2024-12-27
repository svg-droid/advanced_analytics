<?php
include('config.php');
$num_rec_per_page=10;
$array_temp['code']=1;
$array_temp['message']="Notification List";
$array_final=array();

$userid=$_REQUEST['user_id'];  

if (isset($_GET["page_count"])) { $page  = $_GET["page_count"]; } else { $page=1; }; 
$start_from = ($page-1) * $num_rec_per_page; 

$row_count_data = numRows("select fk_user_id,fk_chapter_id,id,read_status from tbl_notification where fk_user_id='".$userid."'");

$total_records = $row_count_data; 
$total_pages = ceil($total_records / $num_rec_per_page); 

$main_qry = ("select id,fk_user_id,fk_chapter_id,id,read_status from tbl_notification where fk_user_id='".$userid."' ORDER BY id DESC LIMIT ".$start_from.",".$num_rec_per_page."");
$row_count=numRows($main_qry);
if($row_count)
{
	$str = fetchRows($main_qry);
	$array_temp['total_count']="$row_count_data";
	$array_temp['page_count']=$total_pages;
	$array_temp['result']=array();
	foreach($str as $res1)
	{
		$row = fetchRow("SELECT fk_class_id,id,status,fk_subject_id,chapter_name FROM tbl_chapter WHERE id=".$res1['fk_chapter_id']);
		$qry = fetchRow("SELECT id,class_name FROM tbl_class WHERE id=".$row['fk_class_id']);
		if($qry['id']==11)
			$array_temp1['class'] = 'VII';
		if($qry['id']==10)
			$array_temp1['class'] = 'IX';
		if($qry['id']==8)
			$array_temp1['class'] = 'V';
		if($qry['id']==11)
			$array_temp1['class_english']='8';
		if($qry['id']==10)
			$array_temp1['class_english']='9';
		if($qry['id']==8)
			$array_temp1['class_english']='10';
		$qry = fetchRow("SELECT id,subject_name FROM tbl_subject WHERE id=".$row['fk_subject_id']);
		$array_temp1['subject'] = $qry['subject_name'];
		$array_temp1['content'] = $row['chapter_name']." "."has updated";
		
		$update = runQuery("UPDATE tbl_notification SET read_status=1 where fk_user_id='".$userid."'");

		$array_final1[]=$array_temp1;
		$array_temp['result']=$array_final1;
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
 
 
 
 
		