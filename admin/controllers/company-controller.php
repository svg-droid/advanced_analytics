<?php
	class CompanyController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new CompanyModel();
			$this->getcompany = $this->getCompany();
			$this->getcompanylist = $this->getCompanyList();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getCompany(){
		  $qry="SELECT * FROM tbl_company where status!=2 order by created_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		function getCompanyList(){
			$qry="SELECT * FROM tbl_company WHERE status!=2  order by id asc LIMIT 0,500"; 
			return $result=$this->modelObj->numRows($qry);
		}
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_company where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>