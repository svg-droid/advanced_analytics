<?php

//require('../aws/S3.php');

error_reporting(E_ALL);
class CommonController
{
	function __construct()
	{
		$this->modelObj = new CommonModel();
		unset($_SESSION['id']);

		if($_GET['pid'] != ''){
			$_SESSION['pid'] = $_GET['pid'];
		}

		$this->section = $this->getSection();
		if($this->section != ''){
		  $this->sectionlink($id);
		}
		if (isset($_POST['txt_username']) && $_POST['txt_username'] != '' && isset($_POST['txt_password']) && $_POST['txt_password'] != '' && $_SESSION['pid']!='client' && $_SESSION['pid']!='employeemanagement')
		{
			$this -> adminLogin();
		}
		$this -> seodata = $this -> getPagetTitleAndHeading();
		$array = explode('@',$this -> seodata);
		$this -> pageTitle = $array[0];
		$this -> h1 = $array[1];
		$this -> mainimage = $array[2];
		$this -> addpageArray = array('add-content', 'add-article', 'add-category', 'add-storyboard','add-storyboard-category','add-tabs','add-tab2details');

		$this->getsetting = $this->getSettings();
		$thetheme=$this->getsetting;
		$this->mytheme=$thetheme;
	}

	function getSection(){
	 if($_SESSION['TERRATROVE_USERTYPE']['USER_TYPE'] == 1 || $_SESSION['TERRATROVE_USERTYPE']['USER_TYPE'] == 2){
	    $qrysection = "select * from rollmanagement WHERE Emp_Id = '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."'";
	    $resultsection = $this -> modelObj -> fetchRows($qrysection);
		foreach($resultsection as $k => $val){
		    $id = $val['mainsection'].",".$id;
		}
		$finalid = substr($id,0,(strlen($id)-1));
		$qry = "select * from tbl_section  where Status='1'  and Section_Id IN  (".$finalid.") order by Order_no";
	 }else{
	     $qry = "select * from tbl_section  where Status='1' order by Order_no";
	 }
	  return $result = $this -> modelObj -> fetchRows($qry);
	}
	function sectionlink($id){
	  if($_SESSION['TERRATROVE_USERTYPE']['USER_TYPE'] == 1 || $_SESSION['TERRATROVE_USERTYPE']['USER_TYPE'] == 2){
	     $qrysubsection = "select * from rollmanagement WHERE Emp_Id = '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."'
		                        and mainsection = '".$id."'";
	    $resultsubsection = $this -> modelObj -> fetchRow($qrysubsection);
		  $subid = substr($resultsubsection['subsection'],0,(strlen($resultsubsection['subsection'])-1));
	    $qry = "SELECT * FROM tbl_sectionlink   WHERE status = '1' and Subsection_Id  IN (".$subid.") order by Order_no";
	  }else{
	    $qry = "SELECT * FROM tbl_sectionlink   WHERE status = '1' and Section_Id  ='".$id."' order by Order_no";
	  }

	  return $result = $this -> modelObj -> fetchRows($qry);
	}
	function setMessage($msg)
	{
		$_SESSION['Msg'] = $msg;
	}
	function setSuccessMessage($msg)
	{
		$_SESSION['Success_Msg'] = $msg;
	}



	function getMessage()
	{
		if(isset($_SESSION['Msg']) && $_SESSION['Msg']!='')
		{
		echo $_SESSION['Msg'];
		unset($_SESSION['Msg']);
		}
		elseif(isset($_SESSION['Success_Msg']) && $_SESSION['Success_Msg']!='')
		{
		echo $_SESSION['Success_Msg'];
		unset($_SESSION['Success_Msg']);
		}
	}
	function getPaginationString()
	{
		return $this -> modelObj -> renderFullNav();
	}
	function getPaginationString1()
	{
		return $this -> modelObj -> renderFullNav1();
	}

	function adminLogin()
	{
			$qry = "SELECT * FROM admin WHERE (username = '".$_POST['txt_username']."' OR email = '".$_POST['txt_username']."') AND
			         password = '".md5($_POST['txt_password'])."' and status!=2";
			$admin = $this -> modelObj -> fetchRow($qry);
			
			if ($admin != '')
			{
				$nowDate = date('Y-m-d h:i:s');
					$compareDate = $admin['modified_date'];
					$diff1=strtotime($nowDate)-strtotime($compareDate);
		$diff3=$diff1/3600;
		$myResult = round($diff3);

				if($myResult==24 || $myResult>24)
				{
					$qryUS="UPDATE admin SET status=1 WHERE adminid='".$admin['adminid']."'";
						$result1=$this -> modelObj->runQuery($qryUS);

						$_SESSION['TERRATROVE_ID']['ADMIN_ID'] = $admin['adminid'];
						$_SESSION['TERRATROVE_FIRSTNAME']['ADMIN_FIRSTNAME'] = $admin['firstname'];
						$_SESSION['TERRATROVE_LASTNAME']['ADMIN_LASTNAME'] = $admin['lastname'];
						$_SESSION['TERRATROVE_USERNAME']['ADMIN_USERNAME'] = $admin['username'];
						$_SESSION['TERRATROVE_USERTYPE']['USER_TYPE'] = $admin['user_type'];
						$_SESSION['TERRATROVE_LASTLOGIN']['LAST_LOGIN'] = date('Y-m-d H:i',strtotime($admin['logindate']));

						$qryupdate = "UPDATE admin SET logindate = '".trim(date('Y-m-d H:i'))."'
						              WHERE adminid = '".trim($_SESSION['TERRATROVE_ID']['ADMIN_ID'])."'";
						$resultupdate = $this->modelObj->runQuery($qryupdate);

						if(isset($_POST['login-check']) && $_POST['login-check']==1)
						{
							$name=$_POST['txt_username'];
							setcookie("adminfausername", $name,time()+60*60*24*30);
							$pswd=$_POST['txt_password'];
							setcookie("adminfapswd",$pswd,time()+60*60*24*30);
						}
						elseif(!isset($_POST['login-check']) && $_POST['login-check']!=1)
						{
							setcookie("adminfausername", "", time()-3600);
							setcookie("adminfapswd", "", time()-3600);
						}
						if($_SESSION['TERRATROVE_USERTYPE']['USER_TYPE'] == 1 || $_SESSION['TERRATROVE_USERTYPE']['USER_TYPE'] == 2){
						$qrysection = "select * from rollmanagement WHERE
						               Emp_Id = '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."'
						               limit 0,1";
						$resultsection = $this -> modelObj -> fetchRow($qrysection);
						 $id = explode(",",$resultsection['subsection']);
						$qry = "select Link from tbl_sectionlink
					        where Status='1'  and Subsection_Id =  ".$id[0]." order by Order_no limit 0,1";
						$qrylink = $this -> modelObj -> fetchRow($qry);
                                                echo $qrylink['Link'];
					       header('location: index.php?pid='.$qrylink['Link']);
						}else{
						   header('location: index.php?pid=dashboard');
						}
				}else{

				if ($admin['status'] == 1)
				{
						$_SESSION['TERRATROVE_ID']['ADMIN_ID'] = $admin['adminid'];
						$_SESSION['TERRATROVE_FIRSTNAME']['ADMIN_FIRSTNAME'] = $admin['firstname'];
						$_SESSION['TERRATROVE_FIRSTNAME']['ADMIN_LASTNAME'] = $admin['lastname'];
						$_SESSION['TERRATROVE_USERNAME']['ADMIN_USERNAME'] = $admin['username'];
						$_SESSION['TERRATROVE_USERTYPE']['USER_TYPE'] = $admin['user_type'];
						$_SESSION['TERRATROVE_LASTLOGIN']['LAST_LOGIN'] = date('Y-m-d H:i',strtotime($admin['logindate']));

						$qryupdate = "UPDATE admin SET logindate = '".trim(date('Y-m-d H:i'))."'
						              WHERE adminid = '".trim($_SESSION['TERRATROVE_ID']['ADMIN_ID'])."'";
						$resultupdate = $this->modelObj->runQuery($qryupdate);

						if(isset($_POST['login-check']) && $_POST['login-check']==1)
						{
							$name=$_POST['txt_username'];
							setcookie("adminfausername", $name,time()+60*60*24*30);
							$pswd=$_POST['txt_password'];
							setcookie("adminfapswd",$pswd,time()+60*60*24*30);
						}
						elseif(!isset($_POST['login-check']) && $_POST['login-check']!=1)
						{
							setcookie("adminfausername", "", time()-3600);
							setcookie("adminfapswd", "", time()-3600);
						}
						if($_SESSION['TERRATROVE_USERTYPE']['USER_TYPE'] == 1 || $_SESSION['TERRATROVE_USERTYPE']['USER_TYPE'] == 2){
						$qrysection = "select * from rollmanagement WHERE
						               Emp_Id = '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."'
						               limit 0,1";
						$resultsection = $this -> modelObj -> fetchRow($qrysection);
						 $id = explode(",",$resultsection['subsection']);
						$qry = "select Link from tbl_sectionlink
					        where Status='1'  and Subsection_Id =  ".$id[0]." order by Order_no limit 0,1";
						$qrylink = $this -> modelObj -> fetchRow($qry);
                                                echo $qrylink['Link'];
					       header('location: index.php?pid='.$qrylink['Link']);
						}else{
						   header('location: index.php?pid=dashboard');
						}
				}
                    else if($admin['status'] == 0){
                           $this -> setMessage('Your account has not been activated yet, Please contact super admin.');
                    }
				else
				{
					$this -> setMessage('Your account is suspended temporarily. Please contact super admin.');
				}
				}
			}
			else
			{
				$this -> setMessage('Please enter valid username or password.');
			}
	}
	function getPagetTitleAndHeading()
	{
		if($_GET['pid']=='editprofile' || $_GET['pid']=='viewprofile')
		{
			$pageTitle = "Manage Administrator";
			$h1 = "Manage Administrator";
			$image = "default.png";
		}
		else if($_GET['pid']=='changepassword')
		{
			$pageTitle = "Change Password";
			$h1 = "Change Password";
			$image = "default.png";
		}
		else if($_GET['pid']=='product')
		{
			$pageTitle = "Product";
			$h1 = "Product";
			$image = "users.png";
		}
		else if($_GET['pid']=='shipping')
		{
			$pageTitle = "Shipping";
			$h1 = "Shipping";
			$image = "users.png";
		}
		else if($_GET['pid']=='user')
		{
			$pageTitle = "Users";
			$h1 = "Users";
			$image = "users.png";
		}
		else if($_GET['pid']=='usertype')
		{
			$pageTitle = "User Type";
			$h1 = "User Type";
			$image = "users.png";
		}
		else if($_GET['pid']=='forensic')
		{
			$pageTitle = "Forensic Analytics";
			$h1 = "Forensic Analytics";
			$image = "users.png";
		}
		else if($_GET['pid']=='admin')
		{
			$pageTitle = "Admin";
			$h1 = "Admin";
			$image = "users.png";
		}
		else if($_GET['pid']=='testimonial')
		{
			$pageTitle = "Testimonial";
			$h1 = "Testimonial";
			$image = "users.png";
		}
		else if($_GET['pid']=='permission')
		{
			$pageTitle = "Permission";
			$h1 = "Permission";
			$image = "users.png";
		}
		else if($_GET['pid']=='label')
		{
			$pageTitle = "Label";
			$h1 = "Label";
			$image = "users.png";
		}
		else if($_GET['pid']=='newsletter')
		{
			$pageTitle = "News Letter";
			$h1 = "News Letter";
			$image = "users.png";
		}
		else if($_GET['pid']=='risk')
		{
			$pageTitle = "Risk";
			$h1 = "Risk";
			$image = "users.png";
		}
		else if($_GET['pid']=='projectwheel')
		{
			$pageTitle = "Project Wheel";
			$h1 = "Project Wheel";
			$image = "users.png";
		}
		else if($_GET['pid']=='testcategory')
		{
			$pageTitle = "Assessment Category";
			$h1 = "Assessment Category";
			$image = "users.png";
		}
		else if($_GET['pid']=='assessment')
		{
			$pageTitle = "Assessment";
			$h1 = "Assessment";
			$image = "users.png";
		}
		else if($_GET['pid']=='userassessment')
		{
			$pageTitle = "User Assessment";
			$h1 = "User Assessment";
			$image = "users.png";
		}
		else if($_GET['pid']=='fragnets')
		{
			$pageTitle = "Fragnets";
			$h1 = "Fragnets";
			$image = "users.png";
		}
		else if($_GET['pid']=='evm')
		{
			$pageTitle = "EVM";
			$h1 = "EVM";
			$image = "users.png";
		}
		else if($_GET['pid']=='breakdown')
		{
			$pageTitle = "WBS";
			$h1 = "WBS";
			$image = "businessuser.png";
		}
		else if($_GET['pid']=='analytics')
		{
			$pageTitle = "Schedule Analytics";
			$h1 = "Schedule Analytics";
			$image = "booking.png";
		}
		else if($_GET['pid']=='city')
		{
			$pageTitle = "City";
			$h1 = "City";
			$image = "booking.png";
		}
		else if($_GET['pid']=='state')
		{
			$pageTitle = "State";
			$h1 = "State";
			$image = "booking.png";
		}
		else if($_GET['pid']=='country')
		{
			$pageTitle = "Country";
			$h1 = "Country";
			$image = "booking.png";
		}
		else if($_GET['pid']=='template')
		{
			$pageTitle = "Template";
			$h1 = "Template";
			$image = "booking.png";
		}

       else if($_GET['pid']=='posttype')
		{
			$pageTitle = "Post Type";
			$h1 = "Post Type";
			$image = "booking.png";
		}
		else if($_GET['pid']=='banner')
		{
			$pageTitle = "Banner";
			$h1 = "Banner";
			$image = "booking.png";
		}

        else if($_GET['pid']=='language')
		{
			$pageTitle = "Language";
			$h1 = "Language";
			$image = "bookingmanagement.png";
		}
		else if($_GET['pid']=='email')
		{
			$pageTitle = "Email Template";
			$h1 = "Email Template";
			$image = "booking.png";
		}
       else if($_GET['pid']=='permissionmodule')
		{
			$pageTitle = "Permission Modulee";
			$h1 = "Permission Module";
			$image = "booking.png";
		}
		else if($_GET['pid']=='cms')
		{
			$pageTitle = "CMS";
			$h1 = "CMS";
			$image = "bookingmanagement.png";
		}
		else if($_GET['pid']=='setting')
		{
			$pageTitle = "Setting";
			$h1 = "Setting";
			$image = "bookingmanagement.png";
		}
		else if($_GET['pid']=='dashboard')
		{
			$pageTitle = "Dashboard";
			$h1 = "Dashboard";
			$image = "bookingmanagement.png";
		}
		else if($_GET['pid']=='test')
		{
			$pageTitle = "test";
			$h1 = "Dashboard";
			$image = "bookingmanagement.png";
		}
		else
		{

		}
		return $pageTitle."@".$h1."@".$image;
	}
	function getFormatedDate($input)
	{
		$array = explode(' ',$input);
		$date = $array[0];
		$time = $array[1];
		$date_array = explode('-',$date);
		$time_array = explode(':',$time);
		$year = substr($date_array[0],2,2);
		return $output = $time_array[0].":".$time_array[1]." ".$date_array[1]."/".$date_array[2]."/".$year;
	}
	function checkSequence($array) {
   /*  $inSequence = 1; */
	$sizeof = sizeof($array);
		$k=0;
		$l=1;
		$j=$array[$k];
		$wq[] = '';
		while($l <= $sizeof){
			$wq[] = ($array[$k]  == $j) ? '1' : '0' ;
			/* echo $array[$k].'  =='. $j.'<br>'; */
			$j++;
			$l++;
			$k++;
		}
		return $wq;

    }

	function getSettings()
	{
		$qry="SELECT * FROM tbl_settings";
		$result = $this -> modelObj -> fetchRow($qry);
		return $result['theme'];
	}

	function getOurSiteName(){
		$qry = "SELECT * FROM tbl_settings WHERE Id=1";
		$result = $this->modelObj->fetchRow($qry);
		return $result['websiteName'];
	}





	function totalpage($totalrecord,$recordperpage)
	{
		$page=$totalrecord/$recordperpage;

		$ex_page=explode(".",$page);

		if($ex_page[1]>0)
		{
			$totalpage=$ex_page[0]+1;
		}
		else
		{
			$totalpage=$ex_page[0];
		}
		return $totalpage;
	}

    /************************* PHPMailer Function ***********************************/

	/*function PHPMailer($to,$subject,$message){
		require('../PHPMailer-master/PHPMailer-master/PHPMailerAutoload.php');
		$sqlsetting="SELECT * FROM tbl_settings";
		$result = $this -> modelObj -> fetchRows($sqlsetting);
		$mail = new PHPMailer(true);

		$mail->IsSMTP();

		$mail->SMTPAuth = true;

		$mail->Port = $result['smtpport'];

		$mail->Host = $result['smtphost'];

		$mail->Username = $result['smtpusername'];

		$mail->Password = $result['smtppassword'];

		$mail->From = $result['email'];

		$mail->FromName = $result['websiteName'];

		$mail->AddAddress($to);

		$mail->Subject = $subject;

		$mail->Body = $message;

		$mail->IsHTML(true);

		return $mail->Send();
	}*/
	function PHPMailer($to,$subject,$message)
	{

		$mail5 = new PHPMailer(true);
		$mail5->IsSMTP();
		$mail5->SMTPAuth = true;
		$mail5->SMTPSecure = "tls";
		$mail5->Port = 587;
		$mail5->Host = "smtp.gmail.com";
		$mail5->Username = "contato@ebmconsultoria.com";
		$mail5->Password = "Vu&JP%9C";
		$mail5->From = "contato@ebmconsultoria.com";
		$mail5->AddAddress($to);
		$mail5->Subject = $subject;
		$mail5->Body = $message;
		$mail5->IsHTML(true);


		$sent_mail = $mail5->Send();

		if($sent_mail){
			return 1;
		}else{
			return 0;
		}

	}

	/************************* IMAR QUERIES AND FUNCTIONS  **************************/

	function getClassStudentById($id){
		$qry="SELECT * FROM tbl_class where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
	function getCategory(){
		$qry="SELECT category_id,category_name FROM category WHERE status=1 ORDER BY category_name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getBrand(){
		$qry="SELECT id,brand_name FROM tbl_brand WHERE status!=2 ORDER BY brand_name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getBrandType(){
		$qry="SELECT id,name FROM tbl_brand_type WHERE status!=2 and typeparentid=0 ORDER BY name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getAttributes(){
		$qry="SELECT * FROM tbl_productattributeset WHERE status!=2 ORDER BY attributename ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getCat(){
		$qry="SELECT id,categoryname FROM tbl_category WHERE status=1 ORDER BY categoryname ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
    function getPosttype(){
    	$qry="SELECT id,posttypename FROM tbl_posttype WHERE status=1 ORDER BY posttypename ASC";
		return $result=$this->modelObj->fetchRows($qry);

	}

	 function getProductid(){
    	$qry="SELECT id,productname FROM tbl_product WHERE status=1 ORDER BY productname ASC";
		return $result=$this->modelObj->fetchRows($qry);

	}
	 function getPermission($id){
    	$qry="SELECT * FROM tbl_permission WHERE status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);


	}

	 function getAdmin(){
    	$qry="SELECT adminid,firstname,lastname FROM admin WHERE status=1 ORDER BY firstname,lastname ASC";
		return $result=$this->modelObj->fetchRows($qry);

	}

	 function getUsersid(){
    	$qry="SELECT id,usertypename FROM tbl_usertype WHERE status=1 ORDER BY usertypename ASC";
		return $result=$this->modelObj->fetchRows($qry);

	}


	   function getLang(){
    	$qry="SELECT id,languagename FROM tbl_language WHERE status=1 and fixdefault=1 ORDER BY languagename ASC";
		return $result=$this->modelObj->fetchRows($qry);

	}


	   function getLangByID($id){
    	 $qry="SELECT id,languagename FROM tbl_language WHERE status=1 and id='".$id."'";
		return $result=$this->modelObj->fetchRows($qry);

	}

	 // function getcontentbylangid($cid='',$lid='')
		// {
		// 	$qry ='Select * from `tbl_cms` where status = 1 and `cmsparentid` ='.$cid.' and `lang_id` ='.$lid; // select data from db
  //       	$arr = $this->db->query($qry)->result_array(); //echo sizeof($arr_cl);
		// 	if(sizeof($arr) != 0 ){
		// 		return $arr;
		// 	}
		// 	return false;
		// }

	function getAttribute(){
		$qry="SELECT attribute_category_id,attribute_category_name FROM attributecategory WHERE status=1 ORDER BY attribute_category_name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getCountry(){
		$qry="SELECT id,countryname FROM tbl_country WHERE status=1 ORDER BY countryname ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}

		function getSettingsaw()
	{
		$qry="SELECT * FROM tbl_settings";
		$result = $this -> modelObj -> fetchRow($qry);
		return $result;
	}


	function getPostById($id){
		$qry="SELECT * FROM tbl_posttype where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
	function getPostList(){
		$qry="SELECT id,posttypename FROM tbl_posttype WHERE status=1 ORDER BY posttypename ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}


	function getState(){
		$qry="SELECT id,state_name FROM tbl_state WHERE status=1 ORDER BY state_name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getType(){
		$qry="SELECT id,name FROM tbl_brand_type WHERE status=1 ORDER BY name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getTypeDetails($id){
		if($id!=0 && $id!='')
			$str_id=" and id='$id'";

		$qry="SELECT id,name FROM tbl_brand_type WHERE status=1 $str_id ORDER BY name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}

	function getSubjectById($id){
		$qry="SELECT * FROM tbl_subject where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
	function getSubjectList(){
		$qry="SELECT id,subject_name FROM tbl_subject WHERE status=1 ORDER BY subject_name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getSubjectListById($id){
		$qry="SELECT id,subject_name,subject_specialize FROM tbl_subject WHERE status=1 and fk_class_id='".$id."' ORDER BY subject_name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getChapterById($id){
		$qry="SELECT * FROM tbl_chapter where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
	function getChapterList(){
		$qry="SELECT id,chapter_name FROM tbl_chapter WHERE status=1 ORDER BY chapter_name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getUserById($id){
		$qry="SELECT * FROM tbl_user where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}

	function getUserList(){
		$qry="SELECT id,name FROM tbl_users WHERE status=1";
		return $result=$this->modelObj->fetchRows($qry);
	}

    function getBannerByBrand()
    {
        $qry =  "SELECT * FROM banner WHERE status != 2 ";
        return $result = $this->modelObj->fetchRows($qry);
    }
	/*function getBrandById(){
		$qry="SELECT * FROM tbl_brand WHERE status!=2 ";
		return $result=$this->modelObj->fetchRows($qry);
	}*/

	function getBrandTypeById($id){
		$qry="SELECT * FROM tbl_brand_type where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
	function getBrandTypeList(){
		$qry="SELECT id,name FROM tbl_brand_type WHERE status=1 AND typeparentid=0 ORDER BY name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}

	function getBannerById($id){
		$qry="SELECT * FROM banner where status!=2 and banner_id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
	function getBannerList(){
		$qry="SELECT * FROM banner WHERE status=1 ORDER BY banner_name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getBannerListById($id){
		$qry="SELECT * FROM banner WHERE status=1 AND brandtype_id='".$id."' ORDER BY banner_name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}

	function getBrandListById($id){
		$qry="SELECT id,brand_name FROM tbl_brand WHERE status=1 AND typeparentid=0 and brandtype_id='".$id."' ORDER BY brand_name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}

	function getCollectionListById($id){
		$qry="SELECT id,categoryname FROM tbl_category WHERE status=1 AND categoryparentid=0 and brand_id='".$id."' ORDER BY categoryname ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}

	function getProductListById($id){
		$qry="SELECT id,productname FROM tbl_product WHERE status=1 AND productparentid=0 and categoryid='".$id."' ORDER BY productname ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}

	function getBrandById($id){
		$qry="SELECT * FROM tbl_brand where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
	function getBrandList(){
		$qry="SELECT id,brand_name FROM tbl_brand WHERE status=1 AND typeparentid=0 ORDER BY brand_name ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}


	function getCollectionById($id){
		$qry="SELECT * FROM tbl_category where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
	function getCollectionList(){
		$qry="SELECT id,categoryname FROM tbl_category WHERE status=1 AND categoryparentid=0 ORDER BY categoryname ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getCollectionsList(){
		$qry="SELECT id,categoryname FROM tbl_category WHERE status=1 AND categoryparentid=0 ORDER BY categoryname ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}

	function getProductById($id){
		$qry="SELECT * FROM tbl_product where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
	function getProductList(){
		$qry="SELECT id,productname FROM tbl_product WHERE status=1 AND productparentid=0 ORDER BY productname ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getProduct(){
		$qry="SELECT id,productname FROM tbl_product WHERE status=1 ORDER BY productname ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getCurrencyList(){
		$qry="SELECT id,currencyname FROM tbl_currencys WHERE status=1 ORDER BY currencyname ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}

	function getCurrencyById($id){
		$qry="SELECT * FROM tbl_currencys where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
	function getCountryById($id){
		$qry="SELECT * FROM tbl_country where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
	function getCountryList(){
		$qry="SELECT id,countryname FROM tbl_country WHERE status=1 ORDER BY countryname ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
function getcolor(){
		$qry="SELECT * FROM tbl_color WHERE status=1 ORDER BY title ASC";
		return $result=$this->modelObj->fetchRows($qry);
	}
	function getCustomerById($id){
		$qry="SELECT * FROM tbl_users where status!=2 and id='".$id."' ";
		return $result=$this->modelObj->fetchRow($qry);
	}
function getTest(){
		$qry="SELECT * FROM tbl_test";
		return $result=$this->modelObj->fetchRow($qry);
	}

/*****************************Language Access***********************************/
 function languageAccess($values){
		$array = array(1, 2);
		if (in_array($values,$array))
		{
			echo 'disabled';
		}else{
		echo '';
		}
	}


	/****************Add Update Data to table*****************/

	function addData($tbl,$post){
		$dataInsert=$this->buildFields($post,',');
		return $result=$this->modelObj->insert($tbl,$dataInsert);
	}

	function editData($tbl,$post,$where){

		$fields=$this->buildFields($post, ", ");

		if($this->modelObj->update($tbl,$fields,$where)){
			return true;
		} else {
			return false;
		}
	}

	function editSettings($post){
		$fields=$this->buildFields($post, ", ");
		$id=$post['Id'];

		if($this->modelObj->update("tbl_settings",$fields,"Id='$id'")){
			return true;
		} else {
			return false;
		}
	}

	/***************** DYNAMIC INSERT FIELDS *****************/

	function getExtension($str) {
        $i = strrpos($str,".");
        if (!$i) { return ""; }

        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
	}

	function buildFields($post, $sep=" "){
        $fields="";
        foreach($post as $key => $value){
            if($i==0)
                $fields.= "$key='$value'";
            else
                $fields.= $sep . "$key='$value'";
            $i++;
        }
        return $fields;
    }
	function gettimedifference($cdate,$adate){
		$diff1=strtotime($cdate)-strtotime($adate);
		$diff3=$diff1/3600;
		return round($diff3);
	}



	/**************** AWS Fuction **************************/

	 function isAws(){

		$result = $this->getSettingsaw();

		if($result['img_store_locate']==1){
			return 1;

		}else{

			return 0;

		}

	}

	function awsObj(){
		if (!class_exists('S3'))include('../aws/S3.php');
		//$result = $this->getSettingsaw();
		//print_r($result); exit;
		  return $s3_bucket = new S3('AKIAJTHDWCVSDBDH4SIQ', 'zPSljMr092rA4b9oqg6iaFypirwwinNTmm/h51G');

	}




	function displayImage($image){

		$ext = substr($image, strrpos($image, '.') + 1);

		if(@getimagesize(str_replace($ext , 'jpg', $image))) {
		  	$image = str_replace($ext , 'jpg', $image);

		}else if(@getimagesize(str_replace($ext , 'jpeg', $image))) {
		  	$image = str_replace($ext , 'jpeg', $image);

		}else if(@getimagesize(str_replace($ext , 'png', $image))) {
		  	$image = str_replace($ext , 'png', $image);
		}

		return $image;

	}

	function getpriceformate($number,$precision = 3)
	{
		//return number_format($price, 2, '.', '');
		// Zero causes issues, and no need to truncate

	/*if ( 0 == (int)$number ) {
        return $number;
    }
    // Are we negative?
    $negative = $number / abs($number);
    // Cast the number to a positive to solve rounding
    $number = abs($number);
    // Calculate precision number for dividing / multiplying
    $precision = pow(10, $precision);
    // Run the math, re-applying the negative value to ensure returns correctly negative / positive
    return floor( $number * $precision ) / $precision * $negative;
	*/
	return $number;

	}






}


?>
