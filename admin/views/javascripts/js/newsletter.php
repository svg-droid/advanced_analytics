<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/categoryscripts.js"></script>
<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script>
<div class="page-title">
<h1>
  Manage Category
</h1>
</div>
<!-- DataTables Example -->
<div class="row" id="<?php echo $_GET['pid'] ?>" >
<div class="col-lg-12">
  <div class="widget-container fluid-height clearfix">
    <div class="heading">
      <i class="icon-table"></i>
      Category List
      <a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('<?php echo $_REQUEST['pid'] ?>')"><i class="icon-plus"></i>Add row</a>
      <?php if($controller_class -> getcategory != ''):?>
      <div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
        <button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown">
            <i class="icon-check-sign"></i>
            Action
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li>
            <a href="javascript:void(0)" onclick="statusactive()"><i class="icon-ok-sign"></i>Active</a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="statusinactive()"><i class="icon-ok-circle"></i>Inactive</a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="deleteselected()"><i class="icon-remove"></i>Remove Item</a>
          </li>
        </ul>
      </div>
      <?php endif;?>
    </div>
    <div class="widget-content padded clearfix">
      <table class="table table-bordered table-striped" id="dataTable1">
        <thead>
          <th class="check-header hidden-xs">
            <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
          </th>
          <th class="hidden-xs">
            Category Name
          </th>  
			
		<th class="hidden-xs">
            Status
          </th>		  
          <th></th>
        </thead>
        <tbody>
            <?php if($controller_class -> getcategory != ''):
                foreach($controller_class -> getcategory  as $k => $data):?>
                    <tr>
                      <td class="check hidden-xs">
                        <label><input name="chk_id" id="chk_id" type="checkbox" value="<?php echo $data['id'];  ?>"><span></span></label>
                      </td>
                      
                      <td>
                          <?php echo $data['name']; ?>
                      </td>
					                       
                      <td class="hidden-xs">
                        <?php if($data['status'] == '1'):?>
                        <span class="label label-success">Active</span>
                        <?php else:?>
                        <span class="label label-danger">Inactive</span>
                        <?php endif;?>
                      </td>
                      <td class="actions">
                        <div class="action-buttons">
                            <a class="table-actions" href="javascript:void(0)" onclick="view('<?php echo $data['id'] ?>')">
                                <i class="icon-eye-open"></i>
                            </a>
                            <a class="table-actions" href="javascript:void(0)" onclick="edit('<?php echo $data['id'] ?>','<?php echo $_GET['pid']?>')">
                                <i class="icon-pencil"></i>
                            </a>
                            <a class="table-actions" href="javascript:void(0)" onclick="deleteuser('<?php echo $data['id'] ?>')">
                                <i class="icon-trash"></i>
                            </a>
                        </div>
                      </td>
                    </tr>
                <?php endforeach;
            endif;?>
          
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
	