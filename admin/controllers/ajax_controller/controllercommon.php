<?php
$ourFileName4 = $_SESSION['APP_PATH']."controllers/".strtolower($_POST['txt_pageid'])."-controller.php";
if(!file_exists($ourFileName4))
{
	$ourFileHandle4 = fopen($ourFileName4, 'w');
	$stringData = '<?php
	class '.ucfirst($_POST['txt_pageid']).'Controller extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new '.ucfirst($_POST['txt_pageid']).'Model();
			$this->get'.strtolower($_POST['txt_pageid']).' = $this->get'.ucfirst($_POST['txt_pageid']).'();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function get'.ucfirst($_POST['txt_pageid']).'(){
		  $qry="SELECT * FROM '.$mytables.' where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM '.$mytables.' where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>';
	fwrite($ourFileHandle4, $stringData);
	fclose($ourFileHandle4);
}
?>