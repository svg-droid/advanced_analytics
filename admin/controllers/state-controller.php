<?php
	class StateController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new StateModel();
			$this->getstate = $this->getState();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getState(){
		  $qry="SELECT * FROM tbl_state where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_state where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>