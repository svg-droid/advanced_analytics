<?php
	class TemplateController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new TemplateModel();
			$this->gettemplate = $this->getTemplate();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getTemplate(){
		  $qry="SELECT * FROM tbl_template where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_template where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>