<?php
	class TestController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new CityModel();
			$this->getcity = $this->getTest();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getCity(){
		  $qry="SELECT * FROM tbl_test LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_test";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>