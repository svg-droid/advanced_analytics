<?php
include('config.php');
$array_final=array();
$array_final1=array();
$array_temp['code']=1;
$array_temp['message']="Your account created successfully.";

$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$device_token=$_REQUEST['device_token'];
$ipaddress = $_REQUEST['ip_address'];



$selectexist= fetchRow("select * from tbl_users where email='".$email."' and status!=2");

$rowexist=numRows("select id from tbl_users where email='".$email."' and status!=2");



	if($rowexist>0)
	{

		$array_temp['result']=array();

		if($selectexist['status']==1)
		{

		$array_temp1['userid']=$selectexist['id'];
		$array_temp1['name']=$selectexist['name'];
		$array_temp1['email']=$selectexist['email'];

		//echo "UPDATE tbl_users SET name='".$name."' AND Created_Id='".$selectexist['id']."' WHERE id=".$selectexist['id'];
		$update= runQuery("UPDATE tbl_users SET name='".$_REQUEST['name']."' WHERE id=".$selectexist['id']);
		$select= fetchRow("select * from tbl_users where id='".$selectexist['id']."' and status=1");

		$array_temp2['userid']=$select['id'];
		$array_temp2['name']=$select['name'];
		$array_temp2['email']=$select['email'];

    	$array_final1[]=$array_temp2;

    	$array_temp['code']=1;
    	$array_temp['message']="login successfully";

    	$array_temp['result']=$array_final1;
		$array_final[]=$array_temp;
		echo json_encode($array_final);


		}else{



		
		

    	$array_final1[]=array();
    	$array_temp['code']=0;
    	$array_temp['message']="Your Acoount is Inactive";
    	
    	$array_temp['result']=$array_final1;

    	$array_temp['result']=$array_final1;
		$array_final[]=$array_temp;
		echo json_encode($array_final);

		}

		
		
		



	
	}else{
		
	//echo	"insert into tbl_users (name,email,device_type,device_token,ip_address) values ('".$name."','".$email."','0','".$device_token."','".$ipaddress."')";
		$insert= runQuery("insert into tbl_users (name,email,device_type,device_token,ip_address) values 
		('".$name."','".$email."','0','".$device_token."','".$ipaddress."')");
		$lastId=getInsertedId($insert);

		
		$to=$email;
		$subject = "Registration successfully has been completed";
		$base="http://" . $_SERVER['SERVER_NAME'];
	  $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style type="text/css">
		.ExternalClass{display:block !important;}
		body {font-family:Calibri; color:#333333; font-size:15px;}
		</style>
		</head>
		<body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" bgcolor="#ffffff">
		<table style="width: 100%;" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
		<td>
		<table style="width: 600px;" align="center" border="0"cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
		<td width="600" style="border:1px solid #333333;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td height="73" style="background:#FFFFFF; padding-left:20px;"><a href="'.COFIG_SITE_URL.'"><img src="'.COFIG_SITE_URL.'images/logo.png" border="0" alt="" style="display:block;"/></a></td>
		</tr>
		<tr>
		<td height="2" style="background:#000000;"></td>
		</tr>
		<tr>
		<td height="10"></td>
		</tr>
		<tr>
		<td style="font-size:24px; font-weight:bold; color:#000000; font-family:Calibri; padding:0px 20px;"><strong>Hello '.$name.',</strong> </td>
		</tr>
		<tr>
		<td height="30" style="font-size:15px; color:#4d4d4d; font-family:Calibri; padding:0px 20px;">Click on below link to active your Advance Analytics App account.</td>
		</tr>
		<tr>
		<td height="30" style="font-size:15px; color:#4d4d4d; font-family:Calibri; padding:0px 20px;">
		<a href="'.COFIG_SITE_URL.'index.php?pid=home&actid='.encodeInt($lastId).'">Click Here..</a></td>
		</tr>
		<tr>
		<td height="20"></td>
		</tr>
		<tr>
		<td style="font-size:15px; color:#000000; font-family:Arial; padding:0px 20px;">&nbsp;</td>
		</tr>
		<tr>
		<td height="45"></td>
		</tr>
		</table>
		</td>
		</tbody>
		</table>
		</body>
		</html>';


		if($result1['mail_type']==1)
		{
			sendSMTPMail($to,$subject,$message);
		}
		else
		{
			$result1 = getSettingData();
			$adminemail = $result1['email'];
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: $adminemail\r\n";
			mail($to,$subject,$message,$headers);
		}
	//	$com = numRows("SELECT id,read_status,fk_user_id FROM tbl_notification WHERE read_status=0 AND fk_user_id=".$lastId );
	//	$array_temp['notification_count']="$com";
		$array_temp['result']=array();
		$result = fetchRow("SELECT * FROM tbl_users WHERE id=".$lastId);
		$array_temp1['userid']=$result['id'];
		$array_temp1['name']=$result['name'];
		$array_temp1['email']=$result['email'];
		//$array_temp1['contact_number']=$result['contact_number'];
	//	$qry = fetchRow("SELECT id,email FROM tbl_class WHERE id=".$result['fk_class_id']);
  //  $array_temp1['name'] = $array_temp1['name'];


    	$array_final1[]=$array_temp1;
    	$array_temp['result']=$array_final1;
		$array_final[]=$array_temp;
		echo json_encode($array_final);
	}
	
 
?>
