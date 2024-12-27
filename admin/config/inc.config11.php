<?php
include('../setting.php');

	if (isset($_SERVER['HTTPS']) &&
		($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
		isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
		$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		$protocol = 'https';
	}
	else {
		$protocol = 'http';
	}
	
    
	switch($_SERVER['DOCUMENT_ROOT'])
	{
		case '/home/mobileappws/public_html':
			$SITE_NAME						=	COFIG_FRONT_NAME;
			$SITE_ADMIN						=   COFIG_ADMIN_NAME;
			$SITE_SHORT_NAME				=	COFIG_SITE_NAME;
			$APP_FOLDER						=	''; 	
			$ADMIN_DOMAIN_NAME				=	$protocol."://".$_SERVER['HTTP_HOST'].COFIG_ADMIN_NAME;
			$FRNT_DOMAIN_NAME				=	$protocol."://".$_SERVER['HTTP_HOST'].COFIG_FRONT_NAME;

			$APP_PATH 						=	$_SERVER["DOCUMENT_ROOT"].COFIG_ADMIN_NAME;
			$ADMIN_APP_PATH 				=	$_SERVER["DOCUMENT_ROOT"].COFIG_ADMIN_NAME;
			$IMG_PATH 						=	$_SERVER["DOCUMENT_ROOT"].COFIG_UPLOAD_PATH;
			break;		
		default:
			$SITE_NAME						=	COFIG_FRONT_NAME;
			$SITE_ADMIN						=   COFIG_ADMIN_NAME;
			$SITE_SHORT_NAME				=	COFIG_SITE_NAME;
			$APP_FOLDER						=	''; 	
			$ADMIN_DOMAIN_NAME				=	$protocol."://".$_SERVER['HTTP_HOST'].COFIG_ADMIN_NAME;
			$FRNT_DOMAIN_NAME				=	$protocol."://".$_SERVER['HTTP_HOST'].COFIG_FRONT_NAME;
	
			$APP_PATH 						=	$_SERVER["DOCUMENT_ROOT"].COFIG_ADMIN_NAME;
			$ADMIN_APP_PATH 				=	$_SERVER["DOCUMENT_ROOT"].COFIG_ADMIN_NAME;
			$IMG_PATH 						=	$_SERVER["DOCUMENT_ROOT"].COFIG_UPLOAD_PATH;
			break;			 
	}		
			
	$IMAGES_PATH							=	$APP_FOLDER	.'images/';
	$STYLES_PATH							=	$APP_FOLDER	.'stylesheet/';
	$DISPLAY_MODELS_PATH					=	$APP_FOLDER .'models/';
	$DISPLAY_CONTROLLERS_PATH				=	$APP_FOLDER .'controllers/';
	
/* 	// $LOCATION	- global array with frequently used paths - to be used in templates  */
	global $LOCATION;
	
	$LOCATION['APP_FOLDER'] 				= $APP_FOLDER;
	$LOCATION['APP_PATH'] 					= $APP_PATH;
	$LOCATION['ADMIN_APP_PATH'] 			= $ADMIN_APP_PATH;
	$LOCATION['IMAGES_PATH'] 				= $IMAGES_PATH;
	$LOCATION['STYLES_PATH'] 				= $STYLES_PATH;
	$LOCATION['DISPLAY_MODELS_PATH'] 		= $DISPLAY_MODELS_PATH;
	$LOCATION['DISPLAY_CONTROLLERS_PATH'] 	= $DISPLAY_CONTROLLERS_PATH;
	$LOCATION['ADMIN_DOMAIN_NAME']			= $ADMIN_DOMAIN_NAME;
	
	$LOCATION['FRNT_DOMAIN_NAME']			= $FRNT_DOMAIN_NAME;

	$LOCATION['SITE_NAME']					= $SITE_NAME;
	$LOCATION['SITE_ADMIN']					= $SITE_ADMIN;
	$LOCATION['SITE_SHORT_NAME']			= $SITE_SHORT_NAME;
	$LOCATION['SITE_IMG_PATH']				= $IMG_PATH;

	
	$_SESSION['SITE_NAME']					= $LOCATION['SITE_NAME'];
	$_SESSION['SITE_ADMIN']					= $LOCATION['SITE_ADMIN']; 
	$_SESSION['APP_PATH']					= $LOCATION['APP_PATH']; 
	$_SESSION['ADMIN_DOMAIN_NAME']			= $LOCATION['ADMIN_DOMAIN_NAME'];
	$_SESSION['SITE_IMG_PATH']				= $LOCATION['SITE_IMG_PATH'];
	
	$_SESSION['FRNT_DOMAIN_NAME']			= $LOCATION['FRNT_DOMAIN_NAME'];
	
	$_SESSION['ADMIN_APP_PATH']				= $LOCATION['ADMIN_APP_PATH'];
	$_SESSION['databasename'] 				= COFIG_DB_NAME;
	$_SESSION['sitefoldername'] 			= COFIG_ADMIN_NAME;
		
	require_once($LOCATION['DISPLAY_MODELS_PATH'].'db.php');
?>