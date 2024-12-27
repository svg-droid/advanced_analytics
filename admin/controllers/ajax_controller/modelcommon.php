<?php
$ourFileName3 = $_SESSION['APP_PATH']."models/".strtolower($_POST['txt_pageid'])."-model.php";
if(!file_exists($ourFileName3))
{
	$ourFileHandle3 = fopen($ourFileName3, 'w');
	$stringData = "<?php \nclass ".ucfirst($_POST['txt_pageid'])."Model extends CommonModel\n{\n}\n?>\n";
	fwrite($ourFileHandle3, $stringData);
	fclose($ourFileHandle3);
}
?>