<?php

	ob_start();
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors',1);

	// ini_set('display_errors','off');
	require_once("admin/config/inc.config.php");
	

	$argument_string = $_SERVER['REQUEST_URI'];
	$arguments = explode("/", $argument_string);
   
	foreach ($arguments as $key => $value){
		$value=strtolower($value);
	}
	
	if(is_array($arguments)){
		if ($LOCATION['APP_FOLDER'] == '/'.$arguments[3]) array_shift($arguments);
		
		$class_name = $_GET['pid'];
		$controller_file_name = $class_name."-controller";
		$model_file_name = $class_name."-model";
		$view_path = $_SESSION['ADMIN_APP_PATH']."views/index.php";
		$commonControllerPath = $_SESSION['ADMIN_APP_PATH']."controllers/common-controller.php";
		$commonModelPath = $_SESSION['ADMIN_APP_PATH']."models/common-model.php";
		$controller_class_path = $_SESSION['ADMIN_APP_PATH']."controllers/".$controller_file_name.".php";
		$model_class_path = $_SESSION['ADMIN_APP_PATH']."models/".$model_file_name.".php";
		
			if ((is_file($controller_class_path) && $controller_file_name != '') && (is_file($model_class_path) && $model_file_name != '')){
			
				require_once($commonControllerPath);
				require_once($controller_class_path);
				require_once($commonModelPath);
				require_once($model_class_path);
				$controller_class_name = str_replace(' ','',ucwords(str_replace('-',' ',$controller_file_name)));
				$model_class_name = str_replace(' ','',ucwords(str_replace('-',' ',$model_file_name))); 
				$controller_class = new $controller_class_name;
				$model_class = new $model_class_name;
			}else{
				
				require_once($commonControllerPath);
				require_once($commonModelPath);
				$controller_class = new CommonController;
				$model_class = new CommonModel;
			}
			
		require_once($view_path); 
	}	
?>