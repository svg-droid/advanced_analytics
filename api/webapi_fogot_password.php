<?php
include('config.php');
$array_final=array();
$array_final1=array();
$array_temp['code']=1;
$array_temp['message']="Email send successfully.";

$emailid=$_REQUEST['email'];

$main_qry= ("select id, name, status,email from tbl_user where email='".$emailid."' and status!=2");
$row_main=numRows($main_qry);

if($row_main==0)
{
	$array_final=array();		
    $array_temp['code']=0;
    $array_temp['message']="Email does not found in system.";
    $array_final[]=$array_temp;	
    echo json_encode($array_final);
}
else
{
	$result=fetchRow($main_qry);
    if($result['status']==0)
	{
		$array_final=array();		
        $array_temp['code']=-1;
        $array_temp['message']="Sorry, your account is pending email verification.";
        $array_final[]=$array_temp;	
        echo json_encode($array_final);
	}
	else
	{                           
		$password=date("dymHis");
		$insert= ("UPDATE tbl_user set password='".md5($password)."' where email='".$emailid."' and status!=2");
		$str= runQuery($insert);
		
		$to=$emailid;
		$subject = 'Reset Password '.COFIG_SITE_NAME;
		$message = '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:solid 2px #d6d6d6; text-align:left; margin:0px auto;">
  <tr>
    <th bgcolor="#314e7d" style="padding-top:10px;" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
     
      <tr>
        <th scope="row" align="center" ><img src="'.COFIG_SITE_URL.'images/logo.png" alt=""  /></th>
      		<td colspan="2">&nbsp;</td>
      </tr>
      
    </table></th>
  </tr>
  <tr>
    <th scope="row">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      

      <tr>
        <td width="20" bgcolor="#F2F2F2">&nbsp;</td>
        <td bgcolor="#F2F2F2">&nbsp;</td>
        <td bgcolor="#F2F2F2">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F2F2F2">&nbsp;</td>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" style="border:solid 1px #CCCCCC; background:#FFF;" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
          		<td>&nbsp;</td>
          		<td><table border="0" cellpadding="2" style="font:normal 13px Arial, Helvetica, sans-serif; color:#333333;" cellspacing="2" width="100%">
          				
          				<tr>
          						<td height="20" colspan="2" align="left" valign="top" style="font-size:17px; line-height:25px;">Dear '.$result['name'].',<br />
          								</td>
          						</tr>
          				<tr>
          						
          						
          						
          						<tr>                   
          								<td height="30" colspan="2" style="font:normal 16px Calibri, Arial, Tahoma; line-height:20px; ">
                                     Please find details New Password below.
                                     <br /><br />                                   
                                               										
          										
								</td>
          								</tr>
          				
          				<tr>
          				<td width="100%" height="20" colspan="2" style="font-size:14px; line-height:25px;">
          								
          					<table width="100%" border="0" cellspacing="0" cellpadding="0">
          										<tr>
          												<td align="left" valign="top" style="font:normal 15px Georgia, Times New Roman, Times, serif; font-style:italic;">&nbsp;</td>
          												</tr>
          										
          										<tr>
          												<td align="left" valign="top">
          														<table width="100%" border="0" cellspacing="0" cellpadding="0">
          																<tr>
          																	<td width="16%" align="left" valign="top"><strong>New Password :</strong></td>
          																	<td width="84%" align="left" valign="top"><a >'.$password.'</a></td>
          																</tr>
          																</table>
          														</td>
          												</tr>
                                                        <tr>
          												<td align="left" valign="top">&nbsp;
          														
          														</td>
          												</tr>
          										<tr>
          												<td align="left" valign="top">
          														Thank you,
          												</td>
          										</tr>
                                                <tr>
          												<td align="left" valign="top">
          														Regards,
          												</td>
          										</tr>
                                                <tr>
          												<td align="left" valign="top">
          														'.COFIG_SITE_NAME.'
          												</td>
          										</tr>
                                                
                                                
          										<tr>
          												
          												</tr>
          										<tr>
          												<td align="left" valign="top">&nbsp;</td>
          												</tr>
          										</table>
          								
          								</td>
          						</tr>
          				
          				
          				</table></td>
          		</tr>
          </table></td>
        <td width="20" bgcolor="#F2F2F2">&nbsp;</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table></th>
  </tr>
  <tr>
    <th scope="row" bgcolor="#f2f2f2">&nbsp;</th>
  </tr>
</table>';

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
		$array_final[]=$array_temp;	
		echo json_encode($array_final);         
	}
}

?>