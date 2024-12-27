<?php
	class UsertestresultController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new UsertestresultModel();
			$this->getusertestresult = $this->getUsertestresult();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getUsertestresult(){
		  $qry="SELECT * FROM `tbl_userassessment LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM `tbl_userassessment";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>