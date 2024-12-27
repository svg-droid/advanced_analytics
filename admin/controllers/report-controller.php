<?php
	class ReportController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new ReportModel();
			$this->getreport = $this->getReport();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getReport(){
		  $qry="SELECT * FROM tbl_order where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_order where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>