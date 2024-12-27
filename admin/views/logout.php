<?php
	ob_start();
	unset($_SESSION);
	session_destroy();
	header('location: ../admin');
	exit;
	//This logout file is not working just take a look in ajax file name 'logout-ajax-controllers.php'--- By Ravi Chaudhari 
?>