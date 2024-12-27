
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/contactscripts.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/js/jquery.form.js"></script>
<div class="page-title">
    <h1>Contact us  Management</h1>

</div>
<?php $_SESSION['pid'] =$_GET['pid']; ?>
<div class="row" id="<?php echo $_GET['pid']; ?>">
    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
            <div class="heading">
                <i style="cursor:default;" class="icon-table"></i> Contact List
               <!--  <a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('<?php echo $_REQUEST['pid']; ?>')"><i class="icon-plus"></i>Add New</a>-->
				
            </div>
            <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="tbl_data_display">
                    <thead>
                        <th class="check-header hidden-xs">
                            <label>
                                <input id="checkAll" name="checkAll" type="checkbox"><span></span>
                            </label>
                        </th>
                        <th class="hidden-xs" style="color: #007aff;">Name</th>
                        <th class="hidden-xs" style="color: #007aff;">Mobile No</th>
                        <th class="hidden-xs" style="color: #007aff;">Email</th>
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
                                'aTargets': [0,4]
                            }],
                            "aaSorting": [
                                [0, "desc"]
                            ],
                            "sAjaxSource": site_url + 'controllers/ajax_controller/contact-ajax-controller.php?action=displaydata'
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<script> 
	/* alert("Access denied"); */
	/* window.location.href='index.php?pid=dashboard';  */
</script>
