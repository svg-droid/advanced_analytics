<?php
	@session_start();
	include('../../models/db.php');
	include('../../models/common-model.php');
	include('../../includes/thumb_new.php');
	include('../../includes/resize-class.php');
	include('../common-controller.php');
	$database = new Connection();
	include('../../models/ajax-model.php');
	$modelObj = new AjaxModel();
	$controller_class = new CommonController();
?>
<?php if(isset($_POST['getForgotForm']) && $_POST['getForgotForm']!=''){ ?>
	<a href="./">
	<img style="!important; width:220px;" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>admin/images/logo-220.png" />
		</a>

	<form name="form_ForgotPwdAdd" id="form_ForgotPwdAdd" action="" enctype="multipart/form-data" method="post">
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="icon-envelope"></i></span>
				<input name="txt_addforemail" id="txt_addforemail" class="form-control" placeholder="Email Address" type="text" />
			</div>
		</div>

		<div id="aj_error_div" style="" class="text-left">
			<label id="aj_error_content" style="text-align:center !important; width:100%; color:red; font-size:16px;"></label>
		</div>
		<!--<div id="aj_error_div" style="" class="text-left" class="setUI">
			<label id="aj_error_finc" style="text-align:center !important; width:100%; color:red; font-size:14px;"></label>
		</div>-->
		<div class="social-login clearfix">
			<input type="button" value="Cancel" class="btn btn-default-outline btn-block" style="float:right;padding:13px 0px;" onClick="getCancel()"/>
			<input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit" onClick="return addForgotPassword();" />
		</div>
	</form>

<?php } ?>
<?php
	if(isset($_POST['forgotVal']) && $_POST['forgotVal']==1){

		$myEmail=urlencode($_POST['email']);

		$checkexists="SELECT * FROM admin where status=1 and email='".($myEmail)."'";
		$result_checkexists=$modelObj->fetchRow($checkexists);
		if($result_checkexists['email']){
			$myFlag=1;
		} else {
			$flag=0;
			echo '0';
		}
		if($myFlag==1){
			$nowDate = date('Y-m-d h:i:s');
			$compareDate = $result_checkexists['modified_date'];

			$myResult=$controller_class->gettimedifference($nowDate,$compareDate);

			if($myResult==24 || $myResult>24){
				$qryUS="UPDATE admin SET status=1 WHERE email='".($myEmail)."'";
				$result1=$modelObj->runQuery($qryUS);
				$getFirst=1;
			} else {
				echo "3";
			}
		}

		if($getFirst==1 && $result_checkexists['status']==1){
			if(!isset($_SESSION['CHECK_ATTEMPT'])){
				$_SESSION['CHECK_ATTEMPT']=0;
			} else {
				$_SESSION['CHECK_ATTEMPT']=$_SESSION['CHECK_ATTEMPT']+1;
			}
			if($_SESSION['CHECK_ATTEMPT']==3 || $_SESSION['CHECK_ATTEMPT']>3){
				$flagImar=3;
				unset($_SESSION['CHECK_ATTEMPT']);
			}
			$flag=1;
		} else if($getFirst==1 && $result_checkexists['status']==0){
			$flag=2;
			echo '2';
        }
		if($flag==1){
			if($flagImar==3){
				$qryU="UPDATE admin SET status=0, modified_date=NOW() WHERE email='".($myEmail)."'";
				$result11=$modelObj->runQuery($qryU);
				echo '3';
			} else {

				$newPasword='Im@'.rand(1111111,9999999);

				$qry="UPDATE admin SET status='1', password='".(md5($newPasword))."' WHERE email='".($myEmail)."'";
					$result=$modelObj->runQuery($qry);

				if($result){
					$Newpassword=5;
					/*echo '1';*/
				}
			}
			if($Newpassword==5){
				$to=urldecode($myEmail);
				$sqlsetting="SELECT * FROM tbl_settings";
				$result_setting=$modelObj->fetchRow($sqlsetting);

				$subject='Password Reset from '.$result_setting['websiteName'];
				$headers='From: '.$result_setting['websiteName'].' <'.$result_setting['email'].'>' . "\r\n";
				$headers.="Reply-To: ".$result_setting['feedback_email']." \r\n";
				$headers.="MIME-Version: 1.0\r\n";
				$headers.="Content-Type: text/html; charset=ISO-8859-1\r\n";
				$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<style type="text/css">
				.ExternalClass{display:block !important;}
				body {font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:14px;padding-top:10px; padding-bottom:30px;}
				</style>
				</head>
				<body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" bgcolor="#ffffff" align="left">
				<table style="width: 100%;" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
				<tbody>
				<tr>
				<td>
				<table style="width: 600px;" border="0"cellpadding="0" cellspacing="0">
				<tbody>
				<tr>
				<td width="600" style="border:1px solid #333333;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td height="73" style="background: white; padding-left:20px;"><a href="'.$_SESSION['FRNT_DOMAIN_NAME'].'"><img style="width: 70px; float: left; margin:10px;" src="'.$_SESSION['FRNT_DOMAIN_NAME'].'admin/images/logo-220.png" border="0" alt="" style="display:block;"/></a></td>
				</tr>
				<tr>
				<td height="10" style="background: green;"></td>
				</tr>
				<tr>
				<td height="10"></td>
				</tr>
				<tr>
				<td style="font-size:22px; color:#2F8807; font-family:Arial, Helvetica, sans-serif; padding:0px 20px;">'.$subject.'</td>
				</tr>
				<tr>
				<td height="20"></td>
				</tr>
				<tr>
				<td height="20" style="font-size:14px; color:#4d4d4d; font-family:Arial, Helvetica, sans-serif; padding:0px 20px;"> Dear '.urldecode($myEmail).', </td>
				</tr>
				<tr>
				<td height="20" style="font-size:14px; color:#4d4d4d; font-family:Arial, Helvetica, sans-serif; padding:0px 20px;"> You have requested to reset the password, your changed password is mentioned below : </td>
				</tr>
				<tr>
				<td height="20"></td>
				</tr>
				<tr>
				<td height="20" style="font-size:14px; color:#4d4d4d; font-family:Arial, Helvetica, sans-serif; padding:0px 20px;">New Username : '.$result_checkexists['username'].'</td>
				</tr>
				<tr>
				<td height="20" style="font-size:14px; color:#4d4d4d; font-family:Arial, Helvetica, sans-serif; padding:0px 20px;">New Password : '.$newPasword.'</td>
				</tr>
				<tr>
				<td height="20"></td>
				</tr>
				<tr>
				<td height="20" style="font-size:14px; color:#4d4d4d; font-family:Arial, Helvetica, sans-serif; padding:0px 20px;"><strong>Thank you, </strong></td>
				</tr>
				<tr>
				<td height="20" style="font-size:14px; color:#4d4d4d; font-family:Arial, Helvetica, sans-serif; padding:0px 20px;"><strong>'.$result_setting['websiteName'].'</strong></td>
				</tr>
				<tr>
				<td height="20"></td>
				</tr>
				</table></td>
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

				if($result_setting['mail_type']==0){
					$ismail= mail($to, $subject, $message, $headers); 
				}else{
					$ismail=$controller_class->PHPMailer($to,$subject,$message);
					
				}
				if($ismail){

						echo "1";
				}
			}

		}
	}
?>
