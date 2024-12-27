<?php
$ourFileName5 = $_SESSION['APP_PATH']."controllers/ajax_controller/".strtolower($_POST['txt_pageid'])."-ajax-controller.php";
if(!file_exists($ourFileName5))
{
	$ourFileHandle5 = fopen($ourFileName5, 'w');
	$stringData = '<?php 
		@session_start();
		include(\'../../models/db.php\');
		include(\'../../models/common-model.php\');
		include(\'../../includes/thumb_new.php\');
		include(\'../../includes/resize-class.php\');
		include(\'../common-controller.php\');
		$database = new Connection();
		include(\'../../models/ajax-model.php\');
		$modelObj = new AjaxModel();
		$upload_dir =$_SERVER[\'SITE_IMG_PATH\']."upload/image/";
		$upload_dirthumb =$_SERVER[\'SITE_IMG_PATH\']."upload/image/thumb/";
	
	if(isset($_POST[\'view\']) && $_POST[\'view\'] != \'\'){
		$id = $_POST[\'id\'];
		$qry = "SELECT * FROM '.$mytables.' where id = \'".($id)."\'";
		$result = $modelObj->fetchRow($qry);
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px">';
		$j=0;
		foreach($myarray as $k => $tablefields)
		{
			$j++;
			if($j%2==0){
				$class="light_bg";
			}else{
				$class="white_bg";
			}
			if($tablefields['Field']!='password')
			{
				if(preg_match("/image/i", $tablefields['Field']))
				{					
					$stringData .='<tr class="'.$class.'">
						<td width="120" align="right" class="popup_listing_border"><strong>'.ucwords(str_replace("_"," ",$tablefields['Field'])).':</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><img src="<?=$LOCATION[\'SITE_ADMIN\']?>upload/image/thumb/<?php echo stripslashes($result[\''.$tablefields['Field'].'\']) ?>" height="50" width="50" /></td>
					  </tr>';
				}
				else if(preg_match("/country/i", $tablefields['Field']))
				{
					$stringData .='<?php $qry_country="SELECT * FROM tbl_country WHERE id=\'".$result[\''.$tablefields['Field'].'\']."\'";
					$result_crty = $modelObj->fetchRow($qry_country); ?>
					<tr class="'.$class.'">
						<td width="120" align="right" class="popup_listing_border"><strong>'.ucwords(str_replace("_"," ",$tablefields['Field'])).':</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo ucwords(stripslashes($result_crty[\'countryName\'])) ?></td>
					  </tr>';
				}
				else if(preg_match("/state/i", $tablefields['Field']))
				{
					$stringData .='<?php $qry_state="SELECT * FROM tbl_state WHERE id=\'".$result[\''.$tablefields['Field'].'\']."\'";
					$result_state = $modelObj->fetchRow($qry_state); ?>
					<tr class="'.$class.'">
						<td width="120" align="right" class="popup_listing_border"><strong>'.ucwords(str_replace("_"," ",$tablefields['Field'])).':</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo ucwords(stripslashes($result_state[\'stateName\'])) ?></td>
					  </tr>';
				}
				else if(preg_match("/city/i", $tablefields['Field']))
				{
					$stringData .='<?php $qry_city="SELECT * FROM tbl_city WHERE id=\'".$result[\''.$tablefields['Field'].'\']."\'";
					$result_city = $modelObj->fetchRow($qry_city); ?>
					<tr class="'.$class.'">
						<td width="120" align="right" class="popup_listing_border"><strong>'.ucwords(str_replace("_"," ",$tablefields['Field'])).':</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo ucwords(stripslashes($result_city[\'cityName\'])) ?></td>
					  </tr>';
				}
				else if(preg_match("/zip/i", $tablefields['Field']))
				{
					$stringData .='<?php $qry_zipcode="SELECT * FROM tbl_zipcode WHERE id=\'".$result[\''.$tablefields['Field'].'\']."\'";
					$result_zipcode = $modelObj->fetchRow($qry_zipcode); ?>
					<tr class="'.$class.'">
						<td width="120" align="right" class="popup_listing_border"><strong>'.ucwords(str_replace("_"," ",$tablefields['Field'])).':</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result_zipcode[\'zipCode\']) ?></td>
					  </tr>';
				}
				else
				{
					$stringData .='<tr class="'.$class.'">
						<td width="120" align="right" class="popup_listing_border"><strong>'.ucwords(str_replace("_"," ",$tablefields['Field'])).':</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result[\''.$tablefields['Field'].'\']) ?></td>
					  </tr>';
				}
			}
		}
		  $stringData .='</table>
	<?php 
	} 
	?>			
	<?php
	if(isset($_POST[\'statusactive\']) && $_POST[\'statusactive\'] != \'\')
	{
		$id = explode("," ,$_POST[\'active\']);
		foreach($id as $k => $val)
		{
			$qry = "UPDATE  '.$mytables.' SET status = 1 WHERE id = ".($val);
			$result =  $modelObj->runQuery($qry);
		}
	}
	?>
	<?php
	if(isset($_POST[\'statusinactive\']) && $_POST[\'statusinactive\'] != \'\')
	{
		$id = explode("," ,$_POST[\'inactive\']);
		foreach($id as $k => $val)
		{
			$qry = "UPDATE  '.$mytables.' SET status = 0 WHERE id = ".($val);
			$result =  $modelObj->runQuery($qry);
		}
	}
	?>
	<?php
	if(isset($_POST[\'deleselected\']) && $_POST[\'deleselected\'] != \'\'){
		$id = explode("," ,$_POST[\'delete\']);
		foreach($id as $k => $val)
		{
			$qry = "UPDATE  '.$mytables.' SET status = 2 WHERE id = ".($val);
			$result =  $modelObj->runQuery($qry);
		}
	}
	?>
	<?php
	if(isset($_POST[\'hid_add\']) && $_POST[\'hid_add\'] != \'\'){
		$qry = "SELECT * FROM '.$mytables.' WHERE '.$myarray[0]['Field'].' = \'".(trim($_POST[\'txt_add'.$myarray[0]['Field'].'\']))."\' and status!=2 ";
		$result = $modelObj -> fetchRow($qry);
		
		if(strtolower(trim($result[\''.$myarray[0]['Field'].'\'])) == strtolower(trim($_POST[\'txt_add'.$myarray[0]['Field'].'\'])))
		{
			$flag = 0;
		}
		else
		{
			$flag = 1;
		}
		
		if($flag == 1)
		{
			if(!dir($upload_dir))
			{
				mkdir($upload_dir);
			}
			if(!dir($upload_dirthumb))
			{
				mkdir($upload_dirthumb);
			}';
		foreach($myarray as $k => $tablefields)
		{
			if(preg_match("/image/i", $tablefields['Field']))
			{			
				$stringData .='if(isset($_FILES["txt_add'.$tablefields['Field'].'"]["tmp_name"]))
				{
					$tmpfile = $_FILES["txt_add'.$tablefields['Field'].'"]["tmp_name"];
					$newname = $_FILES["txt_add'.$tablefields['Field'].'"]["name"];				
					$insert'.$tablefields['Field'].'="";
					if($_FILES["txt_add'.$tablefields['Field'].'"]["tmp_name"] != \'\')
					{
						$abc=date("dmyHis");
						$insert'.$tablefields['Field'].'=$abc.$newname;
						if(move_uploaded_file($tmpfile, $upload_dir.$insert'.$tablefields['Field'].'))
						{
						  $resizeObj_20 = new resize($upload_dir.$insert'.$tablefields['Field'].'); 
						  $resizeObj_20 -> resizeImage(50, 50, \'exact\');
						  $resizeObj_20 -> saveImage($upload_dirthumb.$insert'.$tablefields['Field'].',$upload_dir.$insert'.$tablefields['Field'].', 100);
						}
					}
				}';
			}
		}
			$stringData .='$qry = "INSERT INTO '.$mytables.' (';
			$j=0;
			foreach($myarray as $k => $tablefields)
			{
				$j++;
				$stringData .=''.$tablefields['Field'].',';
			}
			$stringData .='cr_date,status)';
			$stringData .=' VALUES (';
			foreach($myarray as $k => $tablefields)
			{
				if($tablefields['Field']=='password')
				{
					$stringData .='\'".(trim(md5($_POST[\'txt_add'.$tablefields['Field'].'\'])))."\',';
				}
				else if(preg_match("/image/i", $tablefields['Field']))
				{
					$stringData .='\'".$insert'.$tablefields['Field'].'."\',';
				}
				else
				{
					$stringData .='\'".clear_input($_POST[\'txt_add'.$tablefields['Field'].'\'])."\',';
				}
				
			}			
			$stringData .='NOW(),1)";
			$result = $modelObj->runQuery($qry);
			echo "1";
	   }
	   else
	   {
		 echo "0";
	   }
	}
	?>
	<?php
	if(isset($_POST[\'statusid\']) && $_POST[\'statusid\'] != \'\'){
		$qry = "UPDATE  '.$mytables.' SET status = ".($_POST[\'status\'])." WHERE id = ".($_POST[\'statusid\']);
		$result =  $modelObj->runQuery($qry);
	}
	?>
	<?php
	if(isset($_POST[\'hid_update\']) && $_POST[\'hid_update\'] != \'\'){
		$qry = "SELECT * FROM '.$mytables.' WHERE '.$myarray[0]['Field'].' = \'".(trim($_POST[\'txt_add'.$myarray[0]['Field'].'\']))."\' and status!=2 and id != \'".$_POST[\'hid_userid\']."\'";
		$result = $modelObj -> fetchRow($qry);
		
		if(strtolower(trim($result[\''.$myarray[0]['Field'].'\'])) == strtolower(trim($_POST[\'txt_add'.$myarray[0]['Field'].'\'])))
		{
			echo $errmsg = "0";
			$flag = 0;
		}
		else
		{
			$flag = 1;
		}
		$flag = 1;
		
		if($flag == 1)
		{';
		foreach($myarray as $k => $tablefields)
		{
			if(preg_match("/image/i", $tablefields['Field']))
			{
				$stringData .= 'if(isset($_FILES["txt_add'.$tablefields['Field'].'"]["tmp_name"]))
				{
					$tmpfile = $_FILES["txt_add'.$tablefields['Field'].'"]["tmp_name"];
					$newname = $_FILES["txt_add'.$tablefields['Field'].'"]["name"];
					$imgname=\'\';
					
					if($_FILES["txt_add'.$tablefields['Field'].'"]["tmp_name"] != \'\')
					{
						$abc=date("dmyHis");
						$imgname=$abc.$newname;
						if(move_uploaded_file($tmpfile, $upload_dir.$imgname))
						{
						  $resizeObj_20 = new resize($upload_dir.$imgname); 
						  $resizeObj_20 -> resizeImage(50, 50, \'exact\');
						  $resizeObj_20 -> saveImage($upload_dirthumb.$imgname,$upload_dir.$imgname, 100);
						}
						$qry_img="UPDATE  '.$mytables.' SET '.$tablefields['Field'].'=\'".$imgname."\' where id=\'".($_POST[\'hid_userid\'])."\' ";
						$res_img= $modelObj->runQuery($qry_img);
					}
				}';
			}
		}
			$stringData .= '$qry = "UPDATE '.$mytables.' SET ';
			
			$j=0;
			foreach($myarray as $k => $tablefields)
			{
				$j++;
				if($tablefields['Field']=='password')
				{
					$stringData .='';
				}
				else if(preg_match("/image/i", $tablefields['Field']))
				{
					$stringData .='';
				}
				else
				{
					if($j==$totalrecord)
					{
						$stringData .=''.$tablefields['Field'].' = \'".clear_input($_POST[\'txt_add'.$tablefields['Field'].'\'])."\'';
					}
					else
					{
						$stringData .=''.$tablefields['Field'].' = \'".clear_input($_POST[\'txt_add'.$tablefields['Field'].'\'])."\',';
					}
				}
			}
			$stringData .='WHERE id = \'".($_POST[\'hid_userid\'])."\'";
			$result = $modelObj->runQuery($qry);
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	?>
	<?php
	if(isset($_POST[\'viewdiv\']) && $_POST[\'viewdiv\'] != \'\'){
		$start = $_POST[\'prevnext\'];
		$end = $_POST[\'row\'];
		$orderby=$_POST[\'orderby\'];
		
		if($_POST[\'search\'] != \'0\')
		{';
			foreach($myarray as $k => $tablefields)
			{
				if($tablefields['Field'] != 'password')
				{
					if(preg_match("/country/i", $tablefields['Field']) || preg_match("/state/i", $tablefields['Field']) || preg_match("/city/i", $tablefields['Field']) || preg_match("/zip/i", $tablefields['Field']) || preg_match("/image/i", $tablefields['Field']) || preg_match("/description/i", $tablefields['Field']) || preg_match("/date/i", $tablefields['Field']))
					{
						$stringData .= '';
					}
					else
					{
						$stringData .= 'if(trim($_POST[\'txt_src'.$tablefields['Field'].'\']) != \'\')
						{
							$searchqry .="and '.$tablefields['Field'].' LIKE \'%".(trim($_POST[\'txt_src'.$tablefields['Field'].'\']))."%\'";
							$_SESSION[\'srchqry\'] =  $searchqry; 
						}';
					}
				}
			}
			$stringData .= '$_SESSION[\'srchqry\'] =  $_SESSION[\'srchqry\']; 
			
			if($_POST[\'fieldname\'] == \'0\')
			{
				$qry = "SELECT * FROM '.$mytables.' where status!=2 ".$_SESSION[\'srchqry\']." order by cr_date desc LIMIT $start,$end ";
			}
			else
			{
				$qry = "SELECT * FROM '.$mytables.' where status!=2 ".$_SESSION[\'srchqry\']." ORDER BY ".$_POST[\'fieldname\']." ".$orderby." LIMIT $start,$end";
			}
			$qry11 = "SELECT * FROM '.$mytables.' where status!=2 ".$_SESSION[\'srchqry\']."";
		}
		else
		{
			if($_POST[\'fieldname\'] == \'0\')
			{
				$qry = "SELECT * FROM '.$mytables.' where status!=2 order by cr_date desc LIMIT $start,$end ";
			}
			else
			{
				$qry = "SELECT * FROM '.$mytables.' where status!=2 ORDER BY ".$_POST[\'fieldname\']." ".$orderby." LIMIT $start,$end";
			}	  
			$qry11 = "SELECT * FROM '.$mytables.' where status!=2 ";
		}
		$result = $modelObj->fetchRows($qry);
		$totalrecords = $this->numRows($qry11);
		$noofrows_k = $end;
		$noofpages = ceil($totalrecords/$noofrows_k);
		if($_POST[\'first\'] != 0)
		{
			$curr_page =   ceil($start/$noofrows_k);
		}
		else if($_POST[\'last\'] != 0)
		{
			$curr_page = 0;
		}
		else
		{
			$curr_page = $_POST[\'curr_page\'];
		}
		
	?>
	<script type="text/javascript">
	$(document).ready(function () {
		$(".showhide-account").click(function () {
			$(".account-content").slideToggle("fast");
			$(this).toggleClass("active");
			return false;
		});
	});
	
	$(document).ready(function () {
		$(".action-slider").click(function () {
			$("#actions-box-slider").slideToggle("fast");
			$(this).toggleClass("activated");
			return false;
		});
	});
	$(function(){
		$(\'input\').checkBox();
		$(\'#toggle-all\').click(function(){
		$(\'#toggle-all\').toggleClass(\'toggle-checked\');
		$(\'#form_'.strtolower($_POST['txt_pageid']).'view input[type=checkbox]\').checkBox(\'toggle\');
		return false;
		});
	});
	</script> 
	<form id="form_'.strtolower($_POST['txt_pageid']).'view" action="" name="form_'.strtolower($_POST['txt_pageid']).'view" method="post" enctype="multipart/form-data" onsubmit="return false">
	<div class="searchdiv">
	<table class="searchdiv" border="0" width="100%" cellpadding="0" cellspacing="0">
	   <tr>
		 <td width="13%" align="left">
		<?php
		if($result != \'\'){
		?>
		<div id="actions-box">
			<a href="" class="action-slider"></a>
			<div id="actions-box-slider">
				<a style="cursor:pointer" class="action-delete" onclick="deleteselected()" id="testCheck">Delete</a>
				<a style="cursor:pointer" class="action-delete" onclick="statusactive()" id="testCheck">Active</a>
				<a style="cursor:pointer" class="action-delete" onclick="statusinactive()" id="testCheck">Inactive</a>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		</td>
		<td width="16%">&nbsp;</td>
		<td width="64%">&nbsp;</td>
		<td width="7%" align="right" valign="bottom"><input class="button_bg" type="button" value="Search" name="btn_search" onclick="show_search()"></td>
	   </tr>
	</table>
	</div>
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
		<tr>
		  <th class="table-header-check"><a id="toggle-all" ></a> </th>';
		$j=0;
		foreach($myarray as $k => $tablefields)
		{
			$j++;
			if($j <= 5)
			{
				if($tablefields['Field'] == 'password' || preg_match("/country/i", $tablefields['Field']) || preg_match("/state/i", $tablefields['Field']) || preg_match("/city/i", $tablefields['Field']) || preg_match("/zip/i", $tablefields['Field']) || preg_match("/image/i", $tablefields['Field']) || preg_match("/description/i", $tablefields['Field']))
				{
					$j=$j-1;
				}
				else
				{
					$stringData .='<th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield(\''.$tablefields['Field'].'\',\'<?php if($orderby==\'asc\'){echo "desc";}else{echo "asc";} ?>\')" id="'.$tablefields['Field'].'" class="cursorpointer">'.ucwords(str_replace("_"," ",$tablefields['Field'])).'</a></th>';
				}
			}
		}
		  $stringData .='<th class="table-header-options line-left"><a>Options</a></th>
		</tr>
	<?php
	$i = 0;
	if($result != \'\'){
		foreach($result  as $k => $data){
		$i++;
	?>
		<tr id="<?php echo $data[\'id\']?>" class="<?php if($i%2==0){ echo "light_bg"; }else{ echo "white_bg"; } ?>" height="30">
			<td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data[\'id\'];  ?>"/></td>';
			$j=0;
			foreach($myarray as $k => $tablefields)
			{
				$j++;
				if($j==1)
				{
					if($tablefields['Field'] == 'password' || preg_match("/country/i", $tablefields['Field']) || preg_match("/state/i", $tablefields['Field']) || preg_match("/city/i", $tablefields['Field']) || preg_match("/zip/i", $tablefields['Field']) || preg_match("/image/i", $tablefields['Field']) || preg_match("/description/i", $tablefields['Field']))
					{
						$j=$j-1;
					}
					else if(preg_match("/date/i", $tablefields['Field']))
					{
						$stringData .='<td class="cursorpointer" onclick="edit(\'<?php echo $data[\'id\'] ?>\',\'<?php echo $_SESSION[\'pid\']?>\')"><?php echo date("d M Y",strtotime($data[\''.$tablefields['Field'].'\'])); ?></td>';
					}
					else
					{
						$stringData .='<td class="cursorpointer" onclick="edit(\'<?php echo $data[\'id\'] ?>\',\'<?php echo $_SESSION[\'pid\']?>\')"><?php echo stripslashes($data[\''.$tablefields['Field'].'\']); ?></td>';
					}
				}
				else
				{
					if($j <= 5)
					{
						if($tablefields['Field'] == 'password' || preg_match("/country/i", $tablefields['Field']) || preg_match("/state/i", $tablefields['Field']) || preg_match("/city/i", $tablefields['Field']) || preg_match("/zip/i", $tablefields['Field']) || preg_match("/image/i", $tablefields['Field']) || preg_match("/description/i", $tablefields['Field']))
						{
							$j=$j-1;
						}
						else if(preg_match("/date/i", $tablefields['Field']))
						{
							$stringData .='<td><?php echo date("d M Y",strtotime($data[\''.$tablefields['Field'].'\'])); ?></td>';
						}
						else
						{
							$stringData .='<td><?php echo stripslashes($data[\''.$tablefields['Field'].'\']); ?></td>';
						}
					}
				}
			}
			  $stringData .='<td class="options-width" >
				<table>
					<tr>
						<td>
							<?php
							if($data[\'status\'] == \'1\')
							{
							?>
							<div id="d_<?=$data[\'id\']?>">
							<a id="s_<?=$data[\'id\']?>" style="cursor:pointer;" title="Active" class="icon-active info-tooltip" onclick="changeStatus(\'<?=$data[\'id\']?>\');"></a>
							</div>
							<input type="hidden" id="status_<?=$data[\'id\']?>" name="status_<?=$data[\'id\']?>" value="Active" />						
							<?php
							}
							else
							{
							?>
							<div id="d_<?=$data[\'id\']?>">
							<a id="s_<?=$data[\'id\']?>" style="cursor:pointer;" title="Inactive" class="icon-inactive info-tooltip" onclick="changeStatus(\'<?=$data[\'id\']?>\');"></a>
							</div>
							<input type="hidden" id="status_<?=$data[\'id\']?>" name="status_<?=$data[\'id\']?>" value="Inactive" />						
							<?php
							}
							?>
						</td>
						<td><a style="cursor:pointer" title="View" class="icon-view info-tooltip" onclick="view(\'<?php echo $data[\'id\'] ?>\')"></a></td>
						<td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit(\'<?php echo $data[\'id\'] ?>\',\'<?php echo $_SESSION[\'pid\']?>\')"></a></td>
						<td><a style="cursor:pointer" title="Delete" class="icon-delete info-tooltip" onclick="deleteuser(\'<?php echo $data[\'id\'] ?>\')" ></a></td>
					</tr>
				</table>
			</td>
		</tr>
		<?php 
			} 
		 }
		 else
		 { 
		 ?>
			 <tr height="30">
			  <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No '.strtolower($_POST['txt_pageid']).' found."; ?></strong></td>
			</tr>
		 <?php 
		 }
		 ?>
		</table>
	
	<?php
	if($result != \'\'){
		echo $modelObj->ajaxpaging_advancesearch($start,$result_numrec,$curr_page,$noofpages,$noofrows_k,$end);
		
	  ?>
	<?php }else{ ?>
		<input type="hidden" name="sel_noofrow" id="sel_noofrow" value="5" />
	<?php } ?>
		<input type="hidden" name="hid_fieldname" id="hid_fieldname"    value="<?=$_POST[\'fieldname\']?>"  />
		<input type="hidden" name="hidsearch" id="hidsearch" 
		value="<?php if($_POST[\'search\'] != \'0\') echo \'1\'; else echo \'0\' ?>" />
		<input type="hidden" name="viewdiv" id="viewdiv" value="1" />
	</form>
	<?php 
	} ?>
	<?php
	if(isset($_POST[\'delete\']) && $_POST[\'delete\'] != \'\'){
			$qry = "UPDATE '.$mytables.' SET status = 2 WHERE id = \'".$_POST[\'id\']."\'";
			$result = $modelObj->runQuery($qry);
		  if($result){
			echo $successmsg = \'1\';
		  }else{
			echo $errmsg = \'0\';
		  }
	 }
	?>
	
	<?php
	if(isset($_POST[\'edit\']) && $_POST[\'edit\'] != \'\'){
		$qry = "SELECT * FROM '.$mytables.' WHERE id = \'".$_POST[\'id\']."\'";
		$data = $modelObj->fetchRow($qry);
		$qry_country="SELECT * FROM tbl_country WHERE status=1 order by countryName asc";
		$result_crty = $modelObj->fetchRows($qry_country);
		$qry_state="SELECT * FROM tbl_state WHERE status=1 order by stateName asc";
		$result_state= $modelObj->fetchRows($qry_state);
		$qry_city="SELECT * FROM tbl_city WHERE status=1 order by cityName asc";
		$result_city = $modelObj->fetchRows($qry_city);
		$qry_zcode="SELECT * FROM tbl_zipcode WHERE status=1 order by zipCode asc";
		$result_zcode = $modelObj->fetchRows($qry_zcode);
	?>
	<script type="text/javascript" src="<?=$LOCATION[\'SITE_ADMIN\']?>views/javascripts/js/jquery.form.js"></script>';
	foreach($myarray as $k => $tablefields)
	{
		if(preg_match("/description/i", $tablefields['Field']))
		{
			$stringData .='<script type="text/javascript">
			$(document).ready(function() {
				tinyMCE.init({
					mode : "exact",
					elements : "txt_add'.$tablefields['Field'].'",
					theme : "advanced",
					plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
			
					theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
					theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
					theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
					theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
			
					content_css : site_url+"tinymce/examples/css/content.css",
			
					template_external_list_url : site_url+"tinymce/examples/lists/template_list.js",
					external_link_list_url : site_url+"tinymce/examples/lists/link_list.js",
					external_image_list_url : site_url+"tinymce/examples/lists/image_list.js",
					media_external_list_url : site_url+"tinymce/examples/lists/media_list.js",
			
					style_formats : [
						{title : \'Bold text\', inline : \'b\'},
						{title : \'Red text\', inline : \'span\', styles : {color : \'#ff0000\'}},
						{title : \'Red header\', block : \'h1\', styles : {color : \'#ff0000\'}},
						{title : \'Example 1\', inline : \'span\', classes : \'example1\'},
						{title : \'Example 2\', inline : \'span\', classes : \'example2\'},
						{title : \'Table styles\'},
						{title : \'Table row 1\', selector : \'tr\', classes : \'tablerow1\'}
					],		
				});
				});
			</script>';
		}
		if(preg_match("/date/i", $tablefields['Field']))
		{
			$stringData .='<script type="text/javascript">
				Calendar.setup({
				inputField : "txt_add'.$tablefields['Field'].'",
				trigger    : "txt_add'.$tablefields['Field'].'",
				onSelect   : function() { this.hide() },
				showTime   : 12,
				dateFormat : "%Y-%m-%d"
			  });
			</script>';
		}
	}
	$stringData .='<form name="form_'.strtolower($_POST['txt_pageid']).'add" id="form_'.strtolower($_POST['txt_pageid']).'add" method="post" enctype="multipart/form-data" action="#" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%">';
			$j=0;
			foreach($myarray as $k => $tablefields)
			{
				$j++;
				if($j%2==0){
					$class="light_bg";
				}else{
					$class="white_bg";
				}
				if($tablefields['Field']=='password')
				{
					$stringData .='<?php
					if($_POST[\'id\']==\'0\'){
					?>';
					$stringData .='<tr class="'.$class.'">
						<th>'.ucwords(str_replace("_"," ",$tablefields['Field'])).' : </th>
						<td width="23%">
						<input class="input_box" type="password" name="txt_add'.$tablefields['Field'].'" id="txt_add'.$tablefields['Field'].'" value="<?php echo $data[\''.$tablefields['Field'].'\'] ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_add'.$tablefields['Field'].'" width="57%">
						<label class="removerror error_new" id="error-innertxt_add'.$tablefields['Field'].'"></label>
						</td>
					</tr>';
					$stringData .='<tr class="'.$class.'">
						<th>Confirm Password : </th>
						<td width="23%">
						<input class="input_box" type="password" name="txt_addc'.$tablefields['Field'].'" id="txt_addc'.$tablefields['Field'].'" value="<?php echo $data[\''.$tablefields['Field'].'\'] ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_addc'.$tablefields['Field'].'" width="57%">
						<label class="removerror error_new" id="error-innertxt_addc'.$tablefields['Field'].'"></label>
						</td>
					</tr>';
					$stringData .='<?php
					}
					?>';
				}
				else if(preg_match("/image/i", $tablefields['Field']))
				{
					$stringData .='<tr class="'.$class.'">
						<th>'.ucwords(str_replace("_"," ",$tablefields['Field'])).' : </th>
						<td width="23%">
						<input type="file" class="input_box" name="txt_add'.$tablefields['Field'].'" id="txt_add'.$tablefields['Field'].'" size="16" />
						</td>
						<td id="errortxt_add'.$tablefields['Field'].'" width="57%">
						<img src="<?=$LOCATION[\'SITE_ADMIN\']?>upload/image/thumb/<?php echo $data[\''.$tablefields['Field'].'\'] ?>" height="50" width="50" />
						<label class="removerror error_new" id="error-innertxt_add'.$tablefields['Field'].'"></label>
						</td>
					</tr>';
				}
				else if(preg_match("/country/i", $tablefields['Field']))
				{
					$stringData .='<tr class="'.$class.'">
					<th>'.ucwords(str_replace("_"," ",$tablefields['Field'])).' : </th>
					<td width="23%">
						<select class="select_box" name="txt_add'.$tablefields['Field'].'" id="txt_add'.$tablefields['Field'].'" onblur="checkfield(this)" onchange="getStates()">
							<option value="">Select Country</option>
							<?php
								if($result_crty != \'\')
								{
									foreach($result_crty  as $k => $data1)
									{
										if($data[\'country\']==$data1[\'id\'])
										{
											echo "<option selected=\'selected\' value=\'".$data1[\'id\']."\'>".ucwords(stripslashes($data1[\'countryName\']))."</option>";
										}
										else
										{
											echo "<option value=".$data1[\'id\'].">".ucwords(stripslashes($data1[\'countryName\']))."</option>";
										}
									}
								}
							?>
						</select><font class="required"> *</font>
					</td>
					<td id="errortxt_add'.$tablefields['Field'].'" width="57%">
					<label class="removerror error_new" id="error-innertxt_add'.$tablefields['Field'].'"></label>
					</td>
				</tr>';
				}
				else if(preg_match("/state/i", $tablefields['Field']))
				{
					$stringData .='<tr class="'.$class.'">
					<th>'.ucwords(str_replace("_"," ",$tablefields['Field'])).' : </th>
					<td id="stateajax" width="23%">
						<select class="select_box"  name="txt_add'.$tablefields['Field'].'" id="txt_add'.$tablefields['Field'].'" onblur="checkfield(this)" onchange="getCities()">
							<option value="">Select State</option>
							<?php
								if($result_state != \'\')
								{
									foreach($result_state  as $k => $data1)
									{
										if($data[\'state\']==$data1[\'id\'])
										{
											echo "<option selected=\'selected\' value=\'".$data1[\'id\']."\'>".ucwords(stripslashes($data1[\'stateName\'])."</option>";
										}
										else if($data[\'country\']==$data1[\'countryId\'])
										{
											echo "<option value=\'".$data1[\'id\']."\'>".ucwords(stripslashes($data1[\'stateName\']))."</option>";
										}
									}
								}
							?>
						</select><font class="required"> *</font>
					</td>
					<td id="errortxt_add'.$tablefields['Field'].'" width="57%">
					<label class="removerror error_new" id="error-innertxt_add'.$tablefields['Field'].'"></label>
					</td>
				</tr>';
				}
				else if(preg_match("/city/i", $tablefields['Field']))
				{
					$stringData .='<tr class="'.$class.'">
					<th>'.ucwords(str_replace("_"," ",$tablefields['Field'])).' : </th>
					<td id="cityajax" width="23%">
						<select class="select_box"  name="txt_add'.$tablefields['Field'].'" id="txt_add'.$tablefields['Field'].'" onblur="checkfield(this)" onchange="getZipCode()">
							<option value="">Select City</option>
							<?php
								if($result_city != \'\')
								{
									foreach($result_city  as $k => $data1)
									{
										if($data[\'city\']==$data1[\'id\'])
										{
											echo "<option selected=\'selected\' value=\'".$data1[\'id\']."\'>".ucwords(stripslashes($data1[\'cityName\']))."</option>";
										}
										else if($data[\'state\']==$data1[\'stateId\'])
										{
											echo "<option value=\'".$data1[\'id\']."\'>".ucwords(stripslashes($data1[\'cityName\']))."</option>";
										}
									}
								}
							?>
						</select><font class="required"> *</font>
						<td id="errortxt_add'.$tablefields['Field'].'" width="57%">
						<label class="removerror error_new" id="error-innertxt_add'.$tablefields['Field'].'"></label>
						</td>
					</tr>';
				}
				else if(preg_match("/zip/i", $tablefields['Field']))
				{
					$stringData .='<tr class="'.$class.'">
					<th>'.ucwords(str_replace("_"," ",$tablefields['Field'])).' : </th>
					<td id="zcodeajax" width="23%">
						<select class="select_box"  name="txt_add'.$tablefields['Field'].'" id="txt_add'.$tablefields['Field'].'" onblur="checkfield(this)">
							<option value="">Select Zipcode</option>
							<?php
								if($result_zcode != \'\')
								{
									foreach($result_zcode  as $k => $data1)
									{
										if($data[\'zipcode\']==$data1[\'id\'])
										{
											echo "<option selected=\'selected\' value=\'".$data1[\'id\']."\'>".stripslashes($data1[\'zipCode\'])."</option>";
										}
										else if($data[\'city\']==$data1[\'cityId\'])
										{
											echo "<option value=\'".$data1[\'id\']."\'>".stripslashes($data1[\'zipCode\'])."</option>";
										}
									}
								}
							?>
						</select><font class="required"> *</font>
						<td id="errortxt_add'.$tablefields['Field'].'" width="57%">
						<label class="removerror error_new" id="error-innertxt_add'.$tablefields['Field'].'"></label>
						</td>
					</tr>';
				}
				else if(preg_match("/date/i", $tablefields['Field']))
				{
					$stringData .='<tr class="'.$class.'">
						<th>'.ucwords(str_replace("_"," ",$tablefields['Field'])).' : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_add'.$tablefields['Field'].'" id="txt_add'.$tablefields['Field'].'" value="<?php if($data[\''.$tablefields['Field'].'\'] != \'\') { echo date("Y-m-d",strtotime($data[\''.$tablefields['Field'].'\'])); } ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_add'.$tablefields['Field'].'" width="57%">
						<label class="removerror error_new" id="error-innertxt_add'.$tablefields['Field'].'"></label>
						</td>
					</tr>';
				}
				else if(preg_match("/description/i", $tablefields['Field']))
				{
					$stringData .='<tr class="'.$class.'">
						<th>Description : </th>
						<td width="80%" colspan="2">
						<input class="input_box" type="text" name="txt_add'.$tablefields['Field'].'" id="txt_add'.$tablefields['Field'].'" value="<?php echo stripslashes($data[\''.$tablefields['Field'].'\']) ?>" onblur="checkfield(this)">
						</td>
					</tr>';
				}
				else if(preg_match("/ref_id/i", $tablefields['Field']))
				{
					$stringData .='';
					$j=$j-1;
				}
				else
				{
					$stringData .='<tr class="'.$class.'">
						<th>'.ucwords(str_replace("_"," ",$tablefields['Field'])).' : </th>
						<td width="23%">
						<input class="input_box" type="text" name="txt_add'.$tablefields['Field'].'" id="txt_add'.$tablefields['Field'].'" value="<?php echo stripslashes($data[\''.$tablefields['Field'].'\']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
						</td>
						<td id="errortxt_add'.$tablefields['Field'].'" width="57%">
						<label class="removerror error_new" id="error-innertxt_add'.$tablefields['Field'].'"></label>
						</td>
					</tr>';
				}
			}		
			if($j%2==0){
				$class2="white_bg";
			}else{
				$class2="light_bg";
			}
			$stringData .='<tr class="'.$class2.'">
				<th>&nbsp;</th>
				<td valign="top">
				<?php 
				if($_POST[\'id\'] !=0)
				{
				?>
					<input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data[\'id\'] ?>" />
					<input type="hidden" name="hid_update" id="hid_update" value="update" />
					<input class="button_bg" type="submit" value="Submit" name="btn_update" onclick="return updatedata()">
					<input class="button_bg" type="button" value="Cancel" name="btn_cancel" onclick="newdata()">
				<?php
				}
				else
				{
				?>
					<input type="hidden" name="hid_add" id="hid_add" value="add" />
					<input class="button_bg" type="submit" value="Submit" name="btn_save" onclick="return adddata()">
					<input class="button_bg" type="button" value="Cancel" name="btn_cancel" onclick="newdata()">
				<?php
				}
				?>
				</td>
				<td></td>
			</tr>
		</table>
		</form>
	<?php 
	  }
	?>
	<?php 
	if(isset($_POST[\'getstateid\'])){
	$qry_s="SELECT * FROM tbl_state WHERE status =1 and countryId=\'".$_POST[\'getstateid\']."\' order by stateName asc";
	$result_s = $modelObj->fetchRows($qry_s);
	?>
	<select class="select_box"  name="'.$states_name.'" id="'.$states_name.'" onblur="checkfield(this)" onchange="getCities()">
		<option value="">Select State</option>
		<?php
			if($result_s != \'\')
			{
				foreach($result_s  as $k => $data1)
				{
					echo "<option value=".$data1[\'id\'].">".ucwords(stripslashes($data1[\'stateName\']))."</option>";
				}
			}
		?>
	</select><font class="required"> *</font>
	<?php
	}
	?>
	<?php 
	if(isset($_POST[\'getcityid\'])){
	$qry_s="SELECT * FROM tbl_city WHERE status =1 and stateId=\'".$_POST[\'getcityid\']."\' order by cityName asc";
	$result_s = $modelObj->fetchRows($qry_s);
	?>
	<select class="select_box"  name="'.$cityy_name.'" id="'.$cityy_name.'" onblur="checkfield(this)" onchange="getZipCode()">
		<option value="">Select City</option>
		<?php
			if($result_s != \'\')
			{
				foreach($result_s  as $k => $data1)
				{
					echo "<option value=".$data1[\'id\'].">".ucwords(stripslashes($data1[\'cityName\']))."</option>";
				}
			}
		?>
	</select><font class="required"> *</font>
	<?php
	}
	?>
	<?php 
	if(isset($_POST[\'getzcodeid\'])){
	$qry_s="SELECT * FROM tbl_zipcode WHERE status =1 and cityId=\'".$_POST[\'getzcodeid\']."\' order by zipCode asc";
	$result_s = $modelObj->fetchRows($qry_s);
	?>
	<select class="select_box"  name="'.$zipp_name.'" id="'.$zipp_name.'" onblur="checkfield(this)">
		<option value="">Select Zipcode</option>
		<?php
			if($result_s != \'\')
			{
				foreach($result_s  as $k => $data1)
				{
					echo "<option value=".$data1[\'id\'].">".ucwords(stripslashes($data1[\'zipCode\']))."</option>";
				}
			}
		?>
	</select><font class="required"> *</font>
	<?php
	}
	?>';
	fwrite($ourFileHandle5, $stringData);
	fclose($ourFileHandle5);
}
?>