<?php
	class CountryController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new CountryModel();
			$this->getcountry = $this->getCountry();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getCountry(){
		  $qry="SELECT * FROM tbl_country where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_country where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>