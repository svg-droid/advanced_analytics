<?php
	class DownloadController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new DownloadModel();
			$this->getdownload = $this->getDownload();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getDownload(){
		  $qry="SELECT * FROM tbl_download where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_download where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>