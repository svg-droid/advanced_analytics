<?php 
	@session_start();
	// include('../../models/db.php');
	include('../../models/common-model.php');
	include('../../includes/thumb_new.php');
	include('../../includes/resize-class.php');
	include('../common-controller.php');
	$database = new Connection();
	include('../../models/ajax-model.php');
	$modelObj = new AjaxModel();
	$controller_class = new CommonController();
?>
<?php
if(isset($_POST['logout']) && $_POST['logout'] != '') {
	ob_start();
	unset($_SESSION);
	session_destroy();
	header('location: ../../../admin');
}
?>