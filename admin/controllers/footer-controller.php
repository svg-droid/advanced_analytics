<?php
	class FooterController extends CommonController{
		function __construct()	{ 
			parent::__construct(); 
			$this -> modelObj = new FooterModel();
		}	
		
	}
?>