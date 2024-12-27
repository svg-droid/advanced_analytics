<?php
	class DashboardController extends CommonController{
		function __construct(){	
			parent::__construct();	
			$this -> modelObj = new DashboardModel();
		}
	}
?>