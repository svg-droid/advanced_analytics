<?php
	class ShippingchargeController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new ShippingchargeModel();
			$this->getshippingcharge = $this->getShippingcharge();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getshippingcharge(){
		  $qry="SELECT * FROM tbl_shippingcharge order by id desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_shippingcharge";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>