<?php
include('config.php');

$array_final=array();
$array_final1=array();

$name = urlencode($_REQUEST['name']);
$email = urlencode($_REQUEST['email']);
$contact_no = urlencode($_REQUEST['mobile']);
$msg = urlencode($_REQUEST['message']);
$current_date = date('Y-m-d H:i:s');


$getSettings= fetchRow("select * from tbl_settings where Id=1");

$loginEmail= fetchRow("select * from admin where adminid=20 and status=1");

if($msg != '')
      {
        $msg = $msg; 
      }else{
        $msg=''; 
      }
      
      $userdata = array(
               "name"=>$name,
               "email"=>$email,
               "mobile"=>$contact_no,
               "message"=>$msg,
               "status"=>1,
               "created_date"=>date('Y-m-d H:i:s'),
               "modified_date"=>date('Y-m-d H:i:s'),
               "ip_address"=>'App');  

     /* echo "INSERT INTO tbl_contact (name,email,mobile,message,status,created_date,modified_date) values 
    ('".$name."','".$email."','".$contact_no."','".$message."','1','".$current_date."','".$current_date."')";
     exit;*/
              
      $insertuser = runQuery("INSERT INTO tbl_contact (name,email,mobile,message,status,created_date,modified_date) values 
    ('".$name."','".$email."','".$contact_no."','".$msg."','1','".$current_date."','".$current_date."')");
      //$insertuser = $cmsObj->InsertRecordContact($userdata);  
      if($insertuser)
      {
        $array_temp['code']=1;  
        $array_temp['message']="Success";
        
        
        $name = urldecode($name);
        $subject = 'Contact Us From '.urldecode($getSettings['websiteName']);
        
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:solid 2px #d6d6d6; text-align:left; margin:0px auto;">
    <tr>
    <th bgcolor="#314e7d" style="padding-top:10px;" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
     
      <tr>
      <th scope="row" align="center" ><img width="50%" height="150" src="'.COFIG_SITE_URL.'admin/images/logo-220.png" alt=""  /></th>
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
                  <td height="20" colspan="2" align="left" valign="top" style="font-size:17px; line-height:25px;">Dear '.urldecode($name).', <br />
                  </td>
                  </tr>
              <tr>
                  
                  
                  
                  <tr>                   
                      <td height="30" colspan="2" style="font:normal 16px Calibri, Arial, Tahoma; line-height:20px; ">
                     Contact Us Details
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
                                        <td width="16%" align="left" valign="top"><strong>Name :</strong></td>
                                        <td width="84%" align="left" valign="top"><a >'.urldecode($name).'</a></td>
                                      </tr>
                                      <tr>
                                        <td width="16%" align="left" valign="top"><strong>Email :</strong></td>
                                        <td width="84%" align="left" valign="top"><a >'.urldecode($email).'</a></td>
                                      </tr>
                                      <tr>
                                        <td width="16%" align="left" valign="top"><strong>Mobile No. :</strong></td>
                                        <td width="84%" align="left" valign="top"><a >'.urldecode($contact_no).'</a></td>
                                      </tr>
                                      <tr>
                                        <td width="16%" align="left" valign="top"><strong>Message :</strong></td>
                                        <td width="84%" align="left" valign="top"><a >'.urldecode($msg).'</a></td>
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
                                  '.urldecode($getSettings['websiteName']).'
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

      $message1 = '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:solid 2px #d6d6d6; text-align:left; margin:0px auto;">
  <tr>
    <th bgcolor="#314e7d" style="padding-top:10px;" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
     
      <tr>
        <th scope="row" align="center" ><img src="'.COFIG_SITE_URL.'admin/images/logo-220.png" alt=""  /></th>
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
                      <td height="20" colspan="2" align="left" valign="top" style="font-size:17px; line-height:25px;">Dear Advanced Planning Analytics, <br />
                          </td>
                      </tr>
                  <tr>
                      
                      
                      
                      <tr>                   
                          <td height="30" colspan="2" style="font:normal 16px Calibri, Arial, Tahoma; line-height:20px; ">
                                     Please find details from Advanced Planning Analytics Application Contact Details 
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
                                            <td width="16%" align="left" valign="top"><strong>Name :</strong></td>
                                            <td width="84%" align="left" valign="top"><a >'.urldecode($name).'</a></td>
                                          </tr>
                                    <tr>
                                            <td width="16%" align="left" valign="top"><strong>Email :</strong></td>
                                            <td width="84%" align="left" valign="top"><a >'.urldecode($email).'</a></td>
                                          </tr>
                                    <tr>
                                            <td width="16%" align="left" valign="top"><strong>Mobile No. :</strong></td>
                                            <td width="84%" align="left" valign="top"><a >'.$contact_no.'</a></td>
                                          </tr>
                                    <tr>
                                            <td width="16%" align="left" valign="top"><strong>Message :</strong></td>
                                            <td width="84%" align="left" valign="top"><a >'.urldecode($msg).'</a></td>
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


        $toUser = urldecode($email);
        $toCompany = urldecode($loginEmail['email']);
        $toAdmin = urldecode($getSettings['email']);
        if($getSettings['mail_type'] == 1)
        {
          $sentmailUser = sendSMTPMail($toUser,$subject,$message);      
          // $sentmailCompany = $cmsObj->sendSMTPMail($toCompany,$subject,$message);       
          $sentmailAdmin = sendSMTPMail($toAdmin,$subject,$message1);   
        }else
        {
           $adminemail = $getSettings['websiteName'].' <'.urldecode($getSettings['email']).'>' ;
           $headers  = 'MIME-Version: 1.0' . "\r\n";
           $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
           $headers .= "From: $adminemail\r\n";
           $sentmailUser = mail($toUser,$subject,$message,$headers);
          // $sentmailCompany = mail($toCompany,$subject,$message,$headers);
           $sentmailAdmin = mail($toAdmin,$subject,$message1,$headers);
        }
      }
    
  

$array_final[]=$array_temp; 
echo json_encode($array_final);

?>