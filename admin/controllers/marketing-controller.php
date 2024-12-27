<?php
	class MarketingController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new MarketingModel();
			$this->getmarketing = $this->getMarketing();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getMarketing(){
		  $qry="SELECT * FROM tbl_marketing_offer order by id desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_marketing_offer";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>