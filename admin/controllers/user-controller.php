<?php
	class UserController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new UserModel();
			$this->getuser = $this->getUser();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getUser(){
		  $qry="SELECT * FROM tbl_users where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_users where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>