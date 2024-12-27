<?php
	class TypeController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new TypeModel();
			$this->gettype = $this->getType();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getType(){
		  $qry="SELECT * FROM tbl_brand_type where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_brand_type where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>