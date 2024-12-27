<?php
	class UsertypeController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new UsertypeModel();
			$this->getusertype = $this->getUsertype();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getUsertype(){
		  $qry="SELECT * FROM tbl_usertype where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_usertype where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>