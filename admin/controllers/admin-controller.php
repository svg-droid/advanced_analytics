<?php
	class AdminController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new AdminModel();
			$this->getadmin = $this->getAdmin();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getAdmin(){
		  $qry="SELECT * FROM admin where status!=2 order by Created_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM admin where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>