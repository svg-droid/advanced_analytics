<?php
	class LabelController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new LabelModel();
			$this->getlabel = $this->getLabel();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getLabel(){
		  $qry="SELECT * FROM tbl_label where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_label where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>