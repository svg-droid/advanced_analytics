<?php if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==1){  ?>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/chapter.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/js/jquery.form.js"></script>
<div class="page-title">
    <h1>Download Management</h1>
</div>
<div class="row" id="<?php echo $_GET['pid']; ?>">
    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
            <div class="heading">
                <i style="cursor:default;" class="icon-table"></i> Download List
                <div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
                    <button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-check-sign"></i>Action<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
					  <li>
						<a href="javascript:void(0)" onclick="deleteselected('Delete','delete','download?')"><i class="icon-remove"></i>Delete</a>
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
                    	<th class="hidden-xs" style="color: #007aff;">Class Name</th>
                    	<th class="hidden-xs" style="color: #007aff;">Subject Name</th>
                    	<th class="hidden-xs" style="color: #007aff;">Chapter Name</th>
                    	<th class="hidden-xs" style="color: #007aff;">User Name</th>
                    	<th class="hidden-xs" style="color: #007aff;"> Download Date </th>
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
                                'aTargets': [0, 6]
                            }],
                            "aaSorting": [
                                [0, "desc"]
                            ],
                            "sAjaxSource": site_url + 'controllers/ajax_controller/download-ajax-controller.php?action=displaydata'
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