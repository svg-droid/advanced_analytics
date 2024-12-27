<?php
	class ContactController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new ContactModel();
			$this->getcontact = $this->getContact();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getContact(){
		  $qry="SELECT * FROM tbl_contact where status!=2 order by created_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_contact where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>