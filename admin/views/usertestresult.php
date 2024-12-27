<?php
if(isset($_GET['user']))
{
$userid=decode($_GET['user']);
}
else { ?>
  <script>
    window.location.href='index.php?pid=userassessment';
    </script>
<?php }

    session_start();
    $selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 17 ORDER BY id ASC";


   $moduleresult=$controller_class->modelObj->fetchRow($selectmodule);
    if($moduleresult['p_field1'] == 1 || $moduleresult['p_field2'] == 1 || $moduleresult['p_field3'] == 1 || $moduleresult['p_field4'] == 1 || $_SESSION['TERRATROVE_ID']['ADMIN_ID']==1){

?>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/usertestresult.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/js/jquery.form.js"></script>
<div class="page-title">
    <h1>User Assessment Questions </h1>

</div>
<script type="text/javascript">
$(document).ready(function () {
            $("#tbl_data_display_filter").hide();  
        });
</script>
<div class="row" id="<?php echo $_GET['pid']; ?>">
    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
            <div class="heading">
                <i style="cursor:default;" class="icon-table"></i> User Assessment Questions List
                <a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="index.php?pid=user"> Back </a>
                <?php if($moduleresult['p_field2'] == 1){   ?>
                
                <?php } ?>
                
            </div>
              <?php if($moduleresult['p_field1'] == 1){   ?>
            <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="tbl_data_display">
                    <thead>
                        <th lass="hidden-xs" style="color: #007aff;">Attempted Questions</th>
                        <th lass="hidden-xs" style="color: #007aff;">User Answers</th>
                        <th lass="hidden-xs" style="color: #007aff;">Right Answers</th>
                        <th lass="hidden-xs" style="color: #007aff;">Result</th>
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
                                'aTargets': [0,1,2,3]
                            }],
                            "aaSorting": [
                                [0, "desc"]
                            ],
                            "sAjaxSource": site_url + 'controllers/ajax_controller/usertestresult-ajax-controller.php?action=displaydata&userviewid=<?php echo $_GET['user']; ?>'
                        });
                    });
                </script>
            </div>
               <?php } ?>
        </div>
    </div>
</div>
<?php  } else{ ?>
<script>
    /* alert("Access denied"); */
    window.location.href='index.php?pid=dashboard';
</script>
<?php  } ?>
