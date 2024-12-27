<?php if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==20){  ?>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/settingscript.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/js/jquery.form.js"></script>
<div class="page-title">
    <h1>Settings</h1> </div>
	<?php $_SESSION['pid'] = $_GET['pid']; ?>
<div class="row" id="<?php echo $_GET['pid']; ?>">
    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
            <div class="heading"> <i style="cursor:default;" class="icon-table"></i>Settings List</div>
            <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="tbl_data_display">
                    <thead>
                        <th class="check-header hidden-xs">
                            <label>
                                <input id="checkAll" name="checkAll" type="checkbox"><span></span> </label>
                        </th>
                        <th>Email Address</th>
                        <th>Website Name</th>
                        <th style="color: #007aff;">Options</th>
                    </thead>
					<script>
                    $(document).ready(function() {
                        $('#tbl_data_display').dataTable({
                            "bProcessing": true,
                            "bServerSide": true,
                            "aoColumnDefs": [{
                                'bSortable': false,
                                'aTargets': [0, 3]
                            }],
                            "aaSorting": [
                                [0, "desc"]
                            ],
                            "sAjaxSource": site_url + 'controllers/ajax_controller/setting-ajax-controller.php?action=displaydata'
                        });
                    });
                </script>
                </table>
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
