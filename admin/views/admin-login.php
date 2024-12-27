<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php if (isset($_SESSION['TERRATROVE_ID']['ADMIN_ID']) && $_SESSION['TERRATROVE_ID']['ADMIN_ID'] != ''){ header('location: index.php?pid=dashboard'); } ?>
		<title> Login - <?php echo $controller_class->getOurSiteName();?></title>

		<link rel="icon" type="image/png" href="<?php echo $LOCATION['SITE_ADMIN']; ?>images/favicon-16x16.png?<?php echo time(); ?>">

		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

		<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
		<link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
		<link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/font-awesome.css" media="all" rel="stylesheet" type="text/css" />
		<link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
		<link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
		<script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript">    </script>
		<script src="http://jamesallardice.github.io/Placeholders.js/assets/js/placeholders.min.js" type="text/javascript"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
		<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/modernizr.custom.js" type="text/javascript"></script>
		<!-- Newly Added Starts -->
		<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/loginscripts.js"></script>
		<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/defaultscript.js"></script>
		<!-- Newly Added Ends -->

</head>
<body class="login2">
	<!-- Login Screen -->
	<div class="login-wrapper" id="dyDivForgot">
		<a  href="./"><img src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>admin/images/logo-220.png?123456"  /></a>

		<form name="Form_login" id="Form_login" action="" enctype="multipart/form-data" method="post">
		<div class="form-group">
		<div class="input-group">
		<span class="input-group-addon">
		<i class="icon-envelope"></i></span>
		<input name="txt_username" id="txt_username" class="form-control" placeholder="Username" type="text" value="<?php echo isset($_COOKIE['adminfausername']) && $_COOKIE['adminfausername'] != '' ? $_COOKIE['adminfausername'] : "";?>" />
		</div>
		</div>
		<div class="form-group">
		<div class="input-group">
		<span class="input-group-addon">
		<i class="icon-lock"></i></span>
		<input class="form-control" placeholder="Password" type="password" name="txt_password" id="txt_password" value="<?php echo isset($_COOKIE['adminfapswd']) && $_COOKIE['adminfapswd'] != '' ? $_COOKIE['adminfapswd'] : "";?>">
		</div>
		</div>
		<a href="javascript:void(0)" onClick="getForgotPassword()" class="pull-right">Forgot password ?</a>
		<div class="text-left">
		<label class="checkbox">
		<input type="checkbox" id="login-check" name="login-check"  value="1" <?php echo isset($_COOKIE['adminfapswd']) && $_COOKIE['adminfapswd'] != '' ? "checked='checked'" : "";?>>
		<span>Keep me logged in </span></label>
		</div>

		<div id="aj_error_div" style="" class="text-left">
		<label id="aj_error_content" style="text-align:center !important; width:100%; color:red; font-size:16px; <?php echo isset($_SESSION['Msg']) && $_SESSION['Msg'] != '' ? "" : "display: none;"; ?>"> <?php echo isset($_SESSION['Msg']) && $_SESSION['Msg'] != '' ? $_SESSION['Msg'] : ""; unset($_SESSION['Msg']); ?></label>
		</div>
		<input class="btn btn-lg btn-primary btn-block" type="submit" value="Log In" id="btn_login" name="button" onclick="return validatelogin();">
		<div class="social-login clearfix">
		</div>
		</form>
	</div>
</body>
</html>
