<?php

ob_start();
session_start();
error_reporting(0);
ini_set('display_errors',1);
//ini_set('sendmail_from','sales@fridaysapparel.com');
//ini_set('display_errors','Off');
// include the config file to load values

require_once("config/inc.config.php");

include_once('includes/thumbnail.php');
include_once('includes/thumb_new.php');
//include_once('includes/thumbnail1.php');
$argument_string = $_SERVER['REQUEST_URI'];

	//echo $argument_string;
	// break uri into individual parts - these are the arguments to the controller
	$arguments = explode("/", $argument_string);
	//print_r($arguments);
	//each requested argument is converted to lowercase
	foreach ($arguments as $key => $value)
	{
		$value = strtolower($value);
	}
	if(is_array($arguments))
	{
		// remove from array : the first empty element from the uri
		// remove from array : the folder name if the app is running from within a folder
		if ($LOCATION['APP_FOLDER'] == '/'.$arguments[3]) array_shift($arguments);
		// the fourth argument gives the file name.
		$class_name = $_GET['pid'];//$arguments[3];
		// name of the file suffixed with '-controller' gives the controller file name.
		 $controller_file_name = $class_name."-controller";
		// name of the file suffixed with '-model' gives the model file name.
		$model_file_name = $class_name."-model";
		// setting the path to the master page.
		$view_path = $LOCATION['ADMIN_APP_PATH']."views/index.php";
		// setting the path to the common-controller.
		$commonControllerPath = $LOCATION['ADMIN_APP_PATH']."controllers/common-controller.php";
		// setting the path to the common-model.
		$commonModelPath = $LOCATION['ADMIN_APP_PATH']."models/common-model.php";
		// setting the path to the controller file.
	 	 $controller_class_path = $LOCATION['ADMIN_APP_PATH']."controllers/".$controller_file_name.".php";
				// setting the path to the model file.
		$model_class_path = $LOCATION['ADMIN_APP_PATH']."models/".$model_file_name.".php";
		// if requested controller and model files exist, instantiate an object of that class
		// and pass the arguments using that file
		if ((is_file($controller_class_path) && $controller_file_name != '') && (is_file($model_class_path) && $model_file_name != ''))
		{
			// including the common-controller.
			require_once($commonControllerPath);
			// including the requested controller.
			require_once($controller_class_path);
			// including the common-model.
			require_once($commonModelPath);
			// including the requested model.
		//	echo $model_class_path."path";
			require_once($model_class_path);
			//the class names of each controller and model have upper case first letters and there is no -(hiphen) in the name of the class
			$controller_class_name = str_replace(' ','',ucwords(str_replace('-',' ',$controller_file_name)));
			$model_class_name = str_replace(' ','',ucwords(str_replace('-',' ',$model_file_name)));
			// instantiating controller class classe.
			$controller_class = new $controller_class_name;
			$model_class = new $model_class_name;
		}
		else
		{
			// including the common-controller.
			require_once($commonControllerPath);
			// including the common-model.
			require_once($commonModelPath);
			// instatntiating the CommonController classe.
			$controller_class = new CommonController;
		}
}
if(isset($_POST['txt_username']) && $_POST['txt_username'] != '' || $_SESSION['TERRATROVE_ID']['ADMIN_ID'] != '')
{
	// include the config file to load values
	// get the request uri - its the argument string
			// include index view
		if (!isset($_SESSION['TERRATROVE_ID']['ADMIN_ID']) && $_SESSION['TERRATROVE_ID']['ADMIN_ID'] == '')
		{
			if ($_GET['pid'] != '' && $_GET['pid'] != 'admin-login')
			{
				//echo $_GET['pid'];
				session_destroy();
				header('location: '.$LOCATION['SITE_ADMIN'].'index.php?pid=admin-login');
			}
			else
			{
				//require_once("http://192.168.1.98:1000/ipollister/admin/");
				header('location: '.$LOCATION['SITE_ADMIN'].'index.php?pid=admin-login');
			}
		}
		else
		{
			require_once($view_path);
		}
}
else
{
	/*echo $_SESSION['UNIVERSITY_ID']['ADMIN_ID']."in";
		exit;*/
	if ($_GET['pid'] != '')
	{
		header('location: ./');
	}
	else
	{
		require_once('views/admin-login.php');
	}
}
?>
