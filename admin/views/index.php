<!DOCTYPE html>
<?php


	 session_start();
	/*function auto_logout($field){

		$t = time();
		$t0 = $_SESSION[$field];
		$diff = $t - $t0;

		if ($diff > 400 && isset($t0)){
			return true;
		} else {
			$_SESSION[$field] = time();
		}
	}
    if(auto_logout("user_time")){
        session_unset();
        session_destroy();
		echo "<script> window.location='index.php?pid=admin-login';</script>";
    } */

?>
<html>
  <head>
      <!-- Newly Added Starts -->
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <!-- Newly Added Ends -->

    <title>
      <?php echo $controller_class ->pageTitle;?> - <?php echo $controller_class->getOurSiteName();?>
    </title>
	<!-- Newly Added Starts -->

	<link rel="icon" type="image/png" href="<?php echo $LOCATION['SITE_ADMIN']; ?>images/favicon-16x16.png?<?php echo time(); ?>">

	<!-- Newly Added Ends -->
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />

    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />

    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/font-awesome.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/isotope.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/fullcalendar.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/wizard.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/select2.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/morris.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/datepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/timepicker.css" media="all" rel="stylesheet" type="text/css" />
    <!--<link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />-->
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/colorpicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/bootstrap-switch.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/daterange-picker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/typeahead.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/summernote.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/pygments.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/style.css?<?php echo time(); ?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" />
    <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/stylesheets/color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
	<script src="<?php echo $_SESSION['ADMIN_DOMAIN_NAME'];?>views/javascripts/default_validate.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/raphael.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/selectivizr-min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.mousewheel.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.vmap.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.vmap.sampledata.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.bootstrap.wizard.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/fullcalendar.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/gcal.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/datatable-editable.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.easy-pie-chart.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/excanvas.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.isotope.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/isotope_extras.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/modernizr.custom.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/select2.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/styleswitcher.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/wysiwyg.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/summernote.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/bootstrap-fileupload.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/bootstrap-timepicker.js" type="text/javascript"></script>
    <!--<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>-->
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/bootstrap-colorpicker.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/typeahead.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/daterange-picker.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/date.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/morris.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/skycons.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/fitvids.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/main.js" type="text/javascript"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>newTemplate/build/javascripts/respond.js" type="text/javascript"></script>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

    <link href="<?php echo $_SESSION['ADMIN_DOMAIN_NAME'];?>css/new_style_for_new_templete.css" media="all" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo $_SESSION['SITE_ADMIN'];?>views/javascripts/defaultscript.js?<?php echo time(); ?>"></script>
    <script type="text/javascript" src="http://demos.flesler.com/jquery/scrollTo/js/jquery.scrollTo-min.js"></script>
	<script type="text/javascript" src="<?php echo $LOCATION['SITE_ADMIN']; ?>ckeditor/ckeditor.js"></script>
	<link href="<?=$_SESSION['SITE_ADMIN']?>ckeditor/samples/sample.css" rel="stylesheet">


<script>
	CKEDITOR.on( 'instanceReady', function( ev ) {
	document.getElementById( 'eMessage' ).innerHTML = 'Instance <code>' + ev.editor.name + '<\/code> loaded.';

	document.getElementById( 'eButtons' ).style.display = 'block';
});

function InsertHTML() {
	var editor = CKEDITOR.instances.editor1;
	var value = document.getElementById( 'htmlArea' ).value;

	if ( editor.mode == 'wysiwyg' )
	{
		editor.insertHtml( value );
	}
	else
		alert( 'You must be in WYSIWYG mode!' );
}

function InsertText() {
	var editor = CKEDITOR.instances.editor1;
	var value = document.getElementById( 'txtArea' ).value;

	if ( editor.mode == 'wysiwyg' )
	{
		editor.insertText( value );
	}
	else
		alert( 'You must be in WYSIWYG mode!' );
}

function SetContents() {
	var editor = CKEDITOR.instances.editor1;
	var value = document.getElementById( 'htmlArea' ).value;

	editor.setData( value );
}

function GetContents() {
	var editor = CKEDITOR.instances.editor1;
	alert( editor.getData() );
}

function ExecuteCommand( commandName ) {
	var editor = CKEDITOR.instances.editor1;

	if ( editor.mode == 'wysiwyg' )
	{
		editor.execCommand( commandName );
	}
	else
		alert( 'You must be in WYSIWYG mode!' );
}

function CheckDirty() {
	var editor = CKEDITOR.instances.editor1;
	alert( editor.checkDirty() );
}

function ResetDirty() {
	var editor = CKEDITOR.instances.editor1;
	editor.resetDirty();
	alert( 'The "IsDirty" status has been reset' );
}

function Focus() {
	CKEDITOR.instances.editor1.focus();
}

function onFocus() {
	document.getElementById( 'eMessage' ).innerHTML = '<b>' + this.name + ' is focused </b>';
}

function onBlur() {
	document.getElementById( 'eMessage' ).innerHTML = this.name + ' lost focus';
}
</script>
<script type="text/javascript">
	var pid = "<?php echo $_GET['pid']; ?>";

	<?php if($_GET['pid']=='employeemanagement'):?>
	var pid_upper = "Employee";
	var pid_lower = "employee";
	<?php elseif($_GET['pid']=='user_management'):?>
	var pid_upper = "Patient";
	var pid_lower = "patient";
	<?php elseif($_GET['pid']=='appointment'):?>
	var pid_upper = "Appointment";
	var pid_lower = "appointment";
	<?php elseif($_GET['pid']=='pationt'):?>
	var pid_upper = "Patient";
	var pid_lower = "patient";
	<?php else:?>
	var pid_upper = "<?php echo ucfirst($_GET['pid']);?>";
	var pid_lower = "<?php echo $_GET['pid'];?>";
	<?php endif;?>
	var site_url = "<?php echo $_SESSION['ADMIN_DOMAIN_NAME'];?>";
	var site_url_front = "<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>";
	var rootpath = "<?php echo $_SERVER["DOCUMENT_ROOT"];?>";


    jQuery.extend({
        handleError: function (s, xhr, status, e) {
            if (s.error) {
                s.error.call(s.context, xhr, status, e);
            }

            if (s.global) {
                jQuery.triggerGlobal(s, "ajaxError", [xhr, s, e]);
            }
        },
        httpData: function( xhr, type, s ) {
            var ct = xhr.getResponseHeader("content-type") || "",
                xml = type === "xml" || !type && ct.indexOf("xml") >= 0,
                data = xml ? xhr.responseXML : xhr.responseText;

            if ( xml && data.documentElement.nodeName === "parsererror" ) {
                jQuery.error( "parsererror" );
            }

            if ( s && s.dataFilter ) {
                data = s.dataFilter( data, type );
            }

            if ( typeof data === "string" ) {
                if ( type === "json" || !type && ct.indexOf("json") >= 0 ) {
                    data = jQuery.parseJSON( data );

                } else if ( type === "script" || !type && ct.indexOf("javascript") >= 0 ) {
                    jQuery.globalEval( data );
                }
            }

            return data;
        }
    });


</script>
<script type="text/javascript">
$(document).ready(function(){
	$('img').on('dragstart', function(event) { event.preventDefault(); });
});
</script>
  </head>
  <body onkeypress="closepopup();">

    <!-- Loader Script Start  -->
    <script type="text/javascript">
        function loader_show()
        {
                var v = jQuery(document).height();
                var wheight=jQuery(window).height();
                var wheight=parseInt(wheight)/parseInt(2);
                var scrolling = jQuery(window).scrollTop();
                var $marginTop = parseInt(wheight)+parseInt(scrolling)-parseInt(50);

                var v2 = parseInt(v)-parseInt($marginTop);
                jQuery("#div_loader2").css({'margin-top': $marginTop});
                document.getElementById('div_loader').style.height=v+'px';
                jQuery('#div_loader').fadeIn();
        }
        function loader_hide()
        {
                jQuery('#div_loader').fadeOut();
        }
    </script>
    <style type="text/css">
            .block_innerdiv{background-image:url(<?php echo $_SESSION['ADMIN_DOMAIN_NAME'];?>images/AjaxLoader.gif);height:64px;width:64px;display:inline-block;z-index:99999999;}
            .block_outerdiv{width:100%;opacity:0.7;display:none;position:absolute;z-index:99999999;margin:0 auto;text-align:center;background-image:url(<?php echo $_SESSION['ADMIN_DOMAIN_NAME'];?>images/trans-bg_2.png);ackground-repeat:repeat;}
            .displayNone{display:none;};

    </style>
    <div class="block_outerdiv" id="div_loader">
      <div class="block_innerdiv" id="div_loader2"></div>
    </div>
    <!-- Loader Scripts End -->

    <!-- FancyBox Div Start -->
    <div id="fancybox-example" style="display: none;">
        <h2 id="fcbox_heading_tag">Validation</h2>
        <p id="fcbox_content_tag">Content</p>
    </div>
    <a class="fancybox fcbox_click_tag ajesh_display_none" href="#fancybox-example"></a>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
              <h4 class="modal-title" id="fcbox_delete_heading_tag">Delete</h4>
            </div>
            <div class="modal-body">
              <!--<h1>Heading</h1>-->
              <p id="fcbox_delete_content_tag">Content</p>
              <input type="hidden" id="h_delete" name="h_delete" />
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" onclick="delete_ok()">Delete</button>
				<button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
				<button class="btn btn-primary mailuser" id="mailuser"  type="button" onclick="delete_ok1()">ok</button>
            </div>
          </div>
        </div>
    </div>
    <a class="btn btn-primary btn fcbox_delete_tag ajesh_display_none" data-toggle="modal" href="#myModal"></a>

    <div class="modal fade" id="myModalDeleteSelected">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
              <h4 class="modal-title" id="fcbox_delete_selected_heading_tag"></h4>
            </div>
            <div class="modal-body">
              <!--<h1>Heading</h1>-->
              <p id="fcbox_delete_selected_content_tag">Content</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary fcbox_delete_selected_content_btn" type="button" onclick="">Delete</button>
                <button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
            </div>
          </div>
        </div>
    </div>
    <a class="btn btn-primary btn fcbox_delete_selected_tag ajesh_display_none" data-toggle="modal" href="#myModalDeleteSelected"></a>

    <div class="modal fade" id="myModalView">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
              <h4 class="modal-title" id="fcbox_view_heading_tag"><i class="icon-tags"></i> View Details</h4>
            </div>
            <div class="modal-body" id="fcbox_view_content_tag">
              <!--<h1>Heading</h1>-->
              <!--<p id="fcbox_view_content_tag">Content</p>-->
            </div>
            <div class="modal-footer">
                <button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
            </div>
          </div>
        </div>
    </div>
    <a class="btn btn-primary btn fcbox_view_tag ajesh_display_none" data-toggle="modal" href="#myModalView"></a>
    <!-- FancyBox Div End -->

    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <?php include_once('header.php');?>
      </div>
      <!-- End Navigation -->
      <div class="container-fluid main-content">
          <div class="page-title">
          <div class="alert alert-danger" id="message-red" style="display: none;">
              <button class="close" data-dismiss="alert" type="button">&times;</button><label id="err"></label>
            <div class="badge pull-right"></div>
          </div>
          <div class="alert alert-success" id="message-green" style="display: none;">
            <button class="close" data-dismiss="alert" type="button">&times;</button><label id="succ"></label>
            <div class="badge pull-right"></div>
          </div>
          </div>
		<?php
			if(isset($_SESSION['TERRATROVE_ID']['ADMIN_ID']) && $_SESSION['TERRATROVE_ID']['ADMIN_ID']!='0'){
				if (isset($_GET['pid']) && $_GET['pid'] != ''){
					if(isset($_GET['pid']) && is_file('views/'.$_GET['pid'].'.php')){
						require_once($_GET['pid'].'.php');
					} else {
						require_once('not-found.php');
					}
				} else {

					header('location: index.php?pid=dashboard');
				}
			}
		?>
		</div>
	<?php include 'footer.php'; ?>
    </div>
  </body>
</html>
