<?php 
    session_start();
    $selectmodule="SELECT * FROM tbl_modules_permission WHERE status='1' AND fk_admin_id= '".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."' AND fk_permission_id = 16 ORDER BY id ASC";
    $moduleresult=$model_class->fetchRow($selectmodule); 
    if($moduleresult['p_field1'] == 1 || $moduleresult['p_field2'] == 1 || $moduleresult['p_field3'] == 1 || $moduleresult['p_field4'] == 1 || $_SESSION['TERRATROVE_ID']['ADMIN_ID']==1){
    
?>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/shippingcharge.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN'];?>views/javascripts/js/jquery.form.js"></script>
<div class="page-title">
    <h1>Shipping Management</h1>

</div>
<div class="row" id="<?php echo $_GET['pid']; ?>">
    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
            <div class="heading">
                <i style="cursor:default;" class="icon-table"></i> Shipping  List
                 <?php
                  if($moduleresult['p_field2'] == 1){
                     ?>

                 <!--<a class="btn btn-sm btn-primary pull-right ajesh_margin_right_0" href="javascript:void(0)" onclick="showadd1('shippingcharge')"><i class="icon-plus"></i>Add New</a>-->
                  <?php } ?>
             <!--   <div class="btn-group hidden-xs pull-right ajesh_margin_right_10">
                    <button class="btn btn-sm btn-primary pull-right dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-check-sign"></i>Action<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="javascript:void(0)" onclick="statusactive('Active','active','shippingcharge?')"><i class="icon-ok-sign"></i>Active</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="statusinactive('Inactive','inactive','shippingcharge?')"><i class="icon-ok-circle"></i>Inactive</a>
                        </li>
                         <?php if($moduleresult['p_field4'] == 1){ ?>
                      <li>
                        <a href="javascript:void(0)" onclick="deleteselected('Delete','delete','shippingcharge?')"><i class="icon-remove"></i>Delete</a>
                      </li>
                       <?php } ?>
                    </ul>
                </div>-->
            </div>
              <?php if($moduleresult['p_field1'] == 1){ ?>
            <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="tbl_data_display">
                    <thead>
                        <th class="check-header hidden-xs">
                            <label>
                                <input id="checkAll" name="checkAll" type="checkbox"><span></span>
                            </label>
                        </th>
                        <th class="hidden-xs" style="color: #007aff;">Shipping Title</th>
                        <th class="hidden-xs" style="color: #007aff;">Bahrain(BHD)</th>
                        <th class="hidden-xs" style="color: #007aff;">Kuwait (KD)</th>
                        <th class="hidden-xs" style="color: #007aff;">UAE (AED)</th>
                        <th class="hidden-xs" style="color: #007aff;">Qatar(QAR)</th>
                        <th class="hidden-xs" style="color: #007aff;">Saudi Arebia(SAR)</th>
                       
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
                                'aTargets': [0,1,2,3,4,5,6,7]
                            }],
                            "aaSorting": [
                                [0, "desc"]
                            ],
                            "sAjaxSource": site_url + 'controllers/ajax_controller/shippingcharge-ajax-controller.php?action=displaydata'
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