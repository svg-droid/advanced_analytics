<?php
	class CategoryController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new CategoryModel();
			$this->getcategory = $this->getCategory();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getCategory(){
		  $qry="SELECT * FROM tbl_category where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_category where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>