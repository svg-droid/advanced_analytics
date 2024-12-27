<?php
include('config.php');

$userid = $_REQUEST['userid'];
$device_token = $_REQUEST['device_token'];
$checkuser=numRows("SELECT * FROM `tbl_users` WHERE id=".$userid." and status = 1");
if($checkuser>0)
{
	$token=numRows("SELECT * FROM `tbl_users` WHERE id=".$userid." and 	device_token='".$device_token."' and  status = 1");
	/*if($token>0)
    {*/
				$categoryid = $_REQUEST['categoryid'];
				$usertempid = $_REQUEST['usertempid'];
				$statuscheck = '1';

		      $row=fetchRows("SELECT tbl_userassessment.useranswer,tbl_assessments_tests.rightanswer FROM tbl_userassessment inner join tbl_assessments_tests on tbl_assessments_tests.assessmentsid = tbl_userassessment.fk_assessmentsid WHERE  tbl_userassessment.fk_userid='".$userid."' and  tbl_userassessment.fk_category_id=".$categoryid." and tbl_userassessment.usertempid='".$usertempid."'");
		      if($row)
					{
					$totalquestions =  count($row);

		      $i=0;
				  foreach($row as $data)
					{
					$useranswer	= $data['useranswer'];
		      $rightanswer	= $data['rightanswer'];
						if($useranswer == $rightanswer)
						{
			       $i++;
						}
					}
					$totalquestions =  ''.count($row).'';
					$totalrightanswer =  ''.$i.'';
					$rowcheckdata=fetchRows("SELECT * FROM tbl_userresults WHERE  fk_userid='".$userid."' and usertempid='".$usertempid."'");

					if(empty($rowcheckdata))
					{
					$insert= runQuery("insert into tbl_userresults(fk_category_id,fk_userid,totalnoquestions,totalrightanswer,usertempid,statuscheck) values ('".$categoryid."','".$userid."','".$totalquestions."','".$totalrightanswer."','".$usertempid."','1')");
		      $lastId=getInsertedId($insert);
					if($lastId != '')
				  	{
						$update= runQuery("UPDATE tbl_userassessment SET fk_userresultid='".$lastId."' WHERE usertempid='".$usertempid."' and fk_userid='".$userid."'  and fk_category_id =".$categoryid."");
					  }
					}
		    	$array_final=array();
		    	$array_temp['code']=1;
					$array_temp['message']="Success";
		    //  $array_temp['message']="User Final Assessment Results.";
					$array_temp2['totalquestions']=$totalquestions;
					$array_temp2['totalrightanswer']=$totalrightanswer;
					$array_temp2['userid']=$userid;
					$array_temp2['usertempid']=$usertempid;
				//	$array_temp['result'] = $array_temp2;
				//	$array_final[]=$array_data;
		    //  $array_final[]=$array_temp;

					$array_final1[]=$array_temp2;
					$array_temp['result']=$array_final1;
					$array_final[]=$array_temp;
				echo json_encode($array_final);
			}
			else {
				$array_final=array();
				$array_temp1['code']=0;
				$array_temp1['message']="No data Found";
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
