<?php
	class PosttypeController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new PosttypeModel();
			$this->getposttype = $this->getPosttype();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getPosttype(){
		  $qry="SELECT * FROM tbl_posttype where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_posttype where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>