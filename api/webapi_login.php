<?php
include('config.php');
$array_final=array();
$array_final1=array();
$array_temp['code']=1;
$array_temp['message']="You have successfully login";
if($_REQUEST['device_token'] != '')
{
$device_token=$_REQUEST['device_token'];
//$password=$_REQUEST['password'];


	$result = fetchRow("select * from tbl_users where device_token='".$device_token."'");
	$array_temp['result']=array();
//echo $result['status'];
		 if($result['status'] != '')
		 {
		    if($result['status']==0)
		  	{
		    	$array_final=array();
		    	$array_temp1['code']=0;
		      $array_temp1['message'] = "Your account is inactive.";
		      $array_final[]=$array_temp1;
		  		echo json_encode($array_final);
		     }
				 else if($result['status']==1){
					$array_final=array();
				 	$array_temp1['code']=1;
				 	$array_temp1['message'] = "User is successfully login";
					$array_temp2['email']=$result['email'];
					$array_temp2['userid']=$result['id'];
					$array_final1[]=$array_temp2;
					$array_temp1['result']=$array_final1;
				 	$array_final[]=$array_temp1;
			    echo json_encode($array_final);
				 }
				 else if($result['status']==2){
				  $array_final=array();
				 	$array_temp1['code']=2;
				 	$array_temp1['message'] = "User is removed by admin";
				 	$array_final[]=$array_temp1;
				  echo json_encode($array_final);
				 }
		 }
		 else {
			   $array_final=array();
		     $array_temp1['code']=3;
		     $array_temp1['message'] =  "User is not register.";
		     $array_final[]=$array_temp1;
		     echo json_encode($array_final);
		 }
 }
 else {
	 $array_final=array();
	 $array_temp1['code']=4;
	 $array_temp1['message'] = "Please try again letter.";
	 $array_final[]=$array_temp1;
	 echo json_encode($array_final);
 }
?>
