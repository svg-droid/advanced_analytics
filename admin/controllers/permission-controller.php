<?php
	class PermissionController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new PermissionModel();
			$this->getpermission = $this->getPermission();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getPermission(){
		  $qry="SELECT * FROM tbl_permission where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_permission where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>