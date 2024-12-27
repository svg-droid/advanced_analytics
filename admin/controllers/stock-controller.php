<?php
	class StockController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new StockModel();
			$this->getstock = $this->getStock();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getStock(){
		  $qry="SELECT * FROM tbl_productattributes where status!=2 order by created_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_productattributes where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>
