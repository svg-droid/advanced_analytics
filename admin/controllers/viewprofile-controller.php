<?php
	class ViewprofileController extends CommonController{
		function __construct()	{ 
			parent::__construct(); 
			$this -> modelObj = new ViewprofileModel();
			$this->geteditprofile = $this->getEditprofile();
			$this->gettotalpageno = $this->gettotalpageno();
		}	
		
		function getEditprofile(){
			$qry="SELECT * FROM admin WHERE status!=2 And user_type!='3' order by adminid asc LIMIT 0,500"; 
			return $result=$this->modelObj->fetchRows($qry);
		}
		function gettotalpageno(){ 
			$qry="SELECT * FROM admin WHERE status!=2 And user_type!='3'";  
			return $result=$this->modelObj->numRows($qry);
		}
	}
?>