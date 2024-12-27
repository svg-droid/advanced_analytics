<?php
	class ShopnowController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new ShopnowModel();
			$this->getshopnow = $this->getShopnow();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getShopnow(){
		  $qry="SELECT * FROM tbl_shopnow  LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_shopnow";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>