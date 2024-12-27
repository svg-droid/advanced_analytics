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
	$tempid	= "temp".mt_rand();
//	echo "SELECT * FROM tbl_userassessment WHERE  usertempid='".$tempid."'";
  $rowdata=fetchRows("SELECT * FROM tbl_userassessment WHERE  usertempid='".$tempid."'");

	if($rowdata)
	{
		$tempid	= "temp".mt_rand();
	}


	$categoryid = $_REQUEST['categoryid'];
	$row=fetchRows("SELECT * FROM tbl_assessments_tests left join tbl_assessments_category on tbl_assessments_category.categoryid =tbl_assessments_tests.fk_category_id  WHERE tbl_assessments_category.status = 1 and tbl_assessments_tests.statuscheck = 1 and tbl_assessments_tests.fk_category_id=".$categoryid);
	if($row)
	{
	$array_final=array();
	$array_final1=array();
	$array_temp['code']=1;
	$array_temp['message']="Success";
	$array_temp['usertempid']=''.$tempid.'';
	$i = 1;
	foreach($row as $fragnets)
	{
		if(strip_tags(urldecode($fragnets['option1']))=='null'){
			$ans1='';
		}else{
			$ans1=strip_tags(urldecode($fragnets['option1']));
		}
		if(strip_tags(urldecode($fragnets['option2']))=='null'){
			$ans2='';
		}else{
			$ans2=strip_tags(urldecode($fragnets['option2']));
		}
		if(strip_tags(urldecode($fragnets['option3']))=='null'){
			$ans3='';
		}else{
			$ans3=strip_tags(urldecode($fragnets['option3']));
		}
		if(strip_tags(urldecode($fragnets['option4']))=='null'){
			$ans4='';
		}else{
			$ans4=strip_tags(urldecode($fragnets['option4']));
		}
		$array_temp1['questionsno']= ''.$i++.'';
		$array_temp1['assessmentsid']=$fragnets['assessmentsid'];
		$array_temp1['categoryid']=$fragnets['fk_category_id'];
		$array_temp1['categoryname']=$fragnets['categoryname'];
		$array_temp1['questions']=strip_tags(urldecode($fragnets['questions']));
		$array_temp1['option1']=$ans1;
		$array_temp1['option2']=$ans2;
		$array_temp1['option3']=$ans3;
		$array_temp1['option4']=$ans4;
		$array_temp1['rightanswer']="option".$fragnets['rightanswer'];
	  if($fragnets['image'] != '')
		{
		$array_temp1['image']=COFIG_SITE_URL_IMG."assessment_img/".$fragnets['image'];
    }
		else {
			$array_temp1['image']='';
		}
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
