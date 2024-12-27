<?php
	class BlogController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new BlogModel();
			$this->getblog = $this->getBlog();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getBlog(){
		  $qry="SELECT * FROM tbl_blog where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_blog where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>