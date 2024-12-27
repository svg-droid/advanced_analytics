<?php if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==1){  ?>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/module.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/js/jquery.form.js"></script>
<div class="page-title">
    <h1>Module Management</h1>

</div>
<div class="row" id="<?php echo $_GET['pid']; ?>">
    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
            <div class="heading">
                <i style="cursor:default;" class="icon-table"></i> Module List
                <a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('module')"><i class="icon-plus"></i>Add New</a>
                <div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
                    <button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-check-sign"></i>Action<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>module
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','module')"><i class="icon-ok-sign"></i>Active</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','module')"><i class="icon-ok-circle"></i>Inactive</a>
                        </li>
					  <li>
						<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','module')"><i class="icon-remove"></i>Delete</a>
					  </li>
                    </ul>
                </div>
            </div>
            <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="tbl_data_display">
                    <thead>
                        <th class="check-header hidden-xs">
                            <label>
                                <input id="checkAll" name="checkAll" type="checkbox"><span></span>
                            </label>
                        </th>
                         <th class="hidden-xs" style="color: #007aff;">Module Name</th>
                        <th class="hidden-xs" style="color: #007aff;">Section Name</th>
                       
                        <th class="hidden-xs" style="color: #007aff;">Status</th>
                        <th class="hidden-xs" style="color: #007aff;">Options</th>
                    </thead>
					<tbody>
						<tr></tr>
					</tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        $('#tbl_data_display').dataTable({
                            "bProcessing": true,
                            "bServerSide": true,
                            "aoColumnDefs": [{
                                'bSortable': false,
                                'aTargets': [0, 3, 4]
                            }],
                            "aaSorting": [
                                [0, "desc"]
                            ],
                            "sAjaxSource": site_url + 'controllers/ajax_controller/testimonial-ajax-controller.php?action=displaydata'
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?php  } else{ ?>
<script> 
	/* alert("Access denied"); */
	window.location.href='index.php?pid=dashboard'; 
</script>
<?php  } ?>