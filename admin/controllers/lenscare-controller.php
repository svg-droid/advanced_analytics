<?php
	class LensCareController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new LensCareModel();
			$this->getlenscare = $this->getLensCare();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getLensCare(){
		  $qry="SELECT * FROM tbl_lenscare where status!=2 order by created_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_lenscare where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>
