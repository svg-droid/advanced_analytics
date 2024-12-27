<div class="footer" style="margin-bottom:20px;">
<div class="footer_bg">    
	<div class="bottom_content1">      
		<div style="float:right;margin-right:20px;">
			<?php echo ' Crafted by Vrinsoft.com '; ?>
		</div>
		<div class="bottom_left">        
			<div class="copy" style="margin-left:20px;">
				<?php $qry="SELECT * FROM tbl_settings";
						$result=$model_class->fetchRow($qry);?>
				<?php echo $result['copyright_text']; ?>
			</div>      
		</div>
		<div class="clear"></div>    
	</div>  
</div>  
<div class="clear"></div>
</div>