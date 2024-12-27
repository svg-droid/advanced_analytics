<?php 
	class SettingController extends CommonController{	
		function __construct()	{		
			parent::__construct();		
			$this -> modelObj = new SettingModel();		
			$this->getsetting = $this->getSetting();		
			$this->gettotalpageno = $this->gettotalpageno();	
		}	
	
		function getSetting(){	  
			$qry_setting="SELECT * FROM tbl_settings order by Id desc LIMIT 0,20";      
			return $result = $this->modelObj->fetchRows($qry_setting);	
		}	
	
		function gettotalpageno(){	  
			$qry = "SELECT * FROM tbl_settings";
			return $result = $this->modelObj->numRows($qry);
		}
	}
?>