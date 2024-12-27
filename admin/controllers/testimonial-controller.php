<?php
	class TestimonialController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new TestimonialModel();
			$this->gettestimonial = $this->getTestimonial();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getTestimonial(){
		  $qry="SELECT * FROM tbl_testimonial where status!=2 order by createdatetime desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_testimonial where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
		
	}
	?>