<?php
	class AttributeController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new AttributeModel();
			$this->getattribute = $this->getAttribute();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getAttribute(){
		  $qry="SELECT * FROM tbl_attribute where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_attribute where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>