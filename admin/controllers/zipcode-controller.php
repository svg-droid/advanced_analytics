<?php
	class ZipcodeController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new ZipcodeModel();
			$this->getzipcode = $this->getZipcode();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getZipcode(){
		  $qry="SELECT * FROM tbl_zipcode where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_zipcode where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>