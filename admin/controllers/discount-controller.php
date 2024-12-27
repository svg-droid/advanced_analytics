<?php
	class DiscountController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new DiscountModel();
			$this->getdiscount = $this->getDiscount();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getDiscount(){
		  $qry="SELECT * FROM tbl_discount where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_discount where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>