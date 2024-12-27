<?php
	class ColorController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new ColorModel();
			$this->getcolor = $this->getColor();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getColor(){
		  $qry="SELECT * FROM tbl_color order by id desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_color";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>