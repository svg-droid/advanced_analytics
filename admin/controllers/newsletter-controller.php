<?php
	class NewsletterController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new NewsletterModel();
			$this->getnewsletter = $this->getNewsletter();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getNewsletter(){
		  $qry="SELECT * FROM tbl_newletter where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_newletter where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>