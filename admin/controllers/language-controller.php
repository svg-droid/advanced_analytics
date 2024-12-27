<?php
	class LanguageController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new LanguageModel();
			$this->getlanguage = $this->getLanguage();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getLanguage(){
		  $qry="SELECT * FROM tbl_language  LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_language";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>