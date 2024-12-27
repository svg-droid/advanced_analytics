<?php
	class CmsController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new CmsModel();
			$this->getcms = $this->getCms();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getCms(){
		  $qry="SELECT * FROM tbl_cms where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_cms where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>