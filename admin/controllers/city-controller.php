<?php
	class CityController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new CityModel();
			$this->getcity = $this->getCity();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getCity(){
		  $qry="SELECT * FROM tbl_city where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_city where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>