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
	$assessmentsid = $_REQUEST['assessmentsid'];
	$answer = $_REQUEST['answer'];
	$usertempid = $_REQUEST['usertempid'];
	$statuscheck = '1';
	        $row=fetchRows("SELECT * FROM tbl_userassessment WHERE  fk_userid='".$userid."' and fk_assessmentsid=".$assessmentsid." and usertempid='".$usertempid."'");
					if($row)
					{
				   	$update= runQuery("UPDATE tbl_userassessment SET useranswer='".$answer."' WHERE usertempid='".$usertempid."' and fk_userid='".$userid."' and fk_assessmentsid =".$assessmentsid." and fk_category_id =".$categoryid."");
						$array_final=array();
						$array_temp['code']=2;
						$array_temp['message']="User Answer Updated Successfully.";
						$array_temp2['categoryid']=$categoryid;
						$array_temp2['assessmentsid']=$assessmentsid;
						$array_temp2['userid']=$userid;
						$array_temp2['usertempid']=$usertempid;

						$array_final1[]=$array_temp2;
				    $array_temp['result']=$array_final1;
						$array_final[]=$array_temp;
					echo json_encode($array_final);

					}
					else
					{
				    	$insert= runQuery("insert into tbl_userassessment(fk_category_id,fk_assessmentsid,fk_userid,useranswer,usertempid,statuscheck) values ('".$categoryid."','".$assessmentsid."','".$userid."','".$answer."','".$usertempid."','".$statuscheck."')");
				    	$lastId=getInsertedId($insert);
				    	$array_final=array();
				    	$array_temp['code']=1;
						//	$array_temp1['message']="Success";
				      $array_temp['message']="User Answer Submitted Successfully.";
							$array_temp2['categoryid']=$categoryid;
							$array_temp2['assessmentsid']=$assessmentsid;
							$array_temp2['userid']=$userid;
							$array_temp2['usertempid']=$usertempid;
							$array_final1[]=$array_temp2;
					    $array_temp['result']=$array_final1;
							$array_final[]=$array_temp;
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
