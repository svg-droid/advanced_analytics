<?php
	class NotificationController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new NotificationModel();
			$this->getnotification = $this->getNotification();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getNotification(){
		  $qry="SELECT * FROM tbl_notification where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_notification where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>