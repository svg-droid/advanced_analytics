<?php
    @session_start();
   	include('../../models/db.php');
    include('../../models/common-model.php');
	include('../../models/chapter-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
	include('../chapter-controller.php');
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
	$controller_class = new ChapterController();
	$sub_get_id = intval($_GET['q']);
?>
		   	<div class="form-group">
				<label class="control-label col-md-2"> Subject <font class="required_mark" color="red">*</font></label>
				<div class="col-md-7">
					<input type="hidden" id="txt_specialfor" name="txt_specialfor" value="" />
					<select id="subjectAdd" name="subjectAdd" class="form-control" onchange="setSpecialfor(this);" >
						<option value="">Select Subject</option>
						<?php 
                     		$getSubjectListById=$controller_class->getSubjectListById($sub_get_id);
							foreach($getSubjectListById as $k => $data1){ 
								$specialFor = explode(',',$data1['subject_specialize']);
								if(in_array('1',$specialFor)){ 
						?>
									<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['fk_subject_id']  && $data['specialfor'] == 1){ echo "selected"; } ?>><?php echo $data1['subject_name'].' - Chapterwise PDF';?></option>
							<?php } ?>	
							<?php if(in_array('2',$specialFor)){ ?>
									<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['fk_subject_id']  && $data['specialfor'] == 1){ echo "selected"; } ?>><?php echo $data1['subject_name'].' - Exam Special PDF';?></option>
							<?php } ?>	
							<?php if(in_array('0',$specialFor)){ ?>
									<option value='<?php echo $data1['id'];?>' <?php if($data1['id']==$data['fk_subject_id']  && $data['specialfor'] == 1){ echo "selected"; } ?>><?php echo $data1['subject_name'];?></option>
							<?php } ?>
						<?php } ?>
					</select>
					<span id="error_subjectAdd" style="color:red" class="error_label"></span>
					
				</div>
				</div>