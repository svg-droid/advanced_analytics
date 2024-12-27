<?php
	class RiskController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new RiskModel();
			$this->getRisk = $this->getRisk();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getRisk(){
		  $qry="SELECT * FROM tbl_risk LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_risk";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>