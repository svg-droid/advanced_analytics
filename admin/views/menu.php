<div class="container-fluid main-nav clearfix">
	<div class="nav-collapse">
		<ul class="nav">
			<li class="dropdown"><a data-toggle="dropdown1" <?php if($_REQUEST['pid']=='dashboard'){ echo 'class="current"';} ?> href="index.php?pid=dashboard">
			<span aria-hidden="true" class="icon-dashboard "></span>Dashboard</a>
			</li>
			<li width="100px" class="dropdown"><a data-toggle="dropdown1" <?php if($_REQUEST['pid']=='user'){ echo 'class="current"';} ?> href="index.php?pid=user">
                <span aria-hidden="true" class="icon-user"></span>Users</a>
			</li>
			<li class="dropdown"><a data-toggle="dropdown" <?php if($_REQUEST['pid']=='assessment' || $_REQUEST['pid']=='fragnets'  || $_REQUEST['pid']=='evm' || $_REQUEST['pid']=='breakdown' || $_REQUEST['pid']=='analytics' || $_REQUEST['pid']=='forensic' || $_REQUEST['pid']=='risk'){ echo 'class="current"';} ?> href=""><span aria-hidden="true" class="icon-list-alt "></span>Module<b class="caret"></b></a>
          <ul class="dropdown-menu">
						<li><a href="index.php?pid=projectwheel">Project Wheel Management</a></li>
				    <li><a href="index.php?pid=assessment">Assessment Management</a></li>
				    <li><a href="index.php?pid=fragnets">Fragnets Management</a></li>
					  <li><a href="index.php?pid=evm">EVM Management</a></li>
				    <li><a href="index.php?pid=breakdown">Work Breakdown Structure Management</a></li>
				    <li><a href="index.php?pid=analytics">Schedule Analytics Management</a></li>
				    <li><a href="index.php?pid=forensic">Forensic Analytics Management</a></li>
					<li><a href="index.php?pid=risk">Risk Management</a></li>

        </ul>
			</li>
			<li class="dropdown"><a data-toggle="dropdown" <?php if($_REQUEST['pid']=='cms' || $_REQUEST['pid']=='faq'){ echo 'class="current"';} ?> href=""><span aria-hidden="true" class="icon-table"></span>CMS<b class="caret"></b></a>
                <ul class="dropdown-menu">
				    <li><a href="index.php?pid=cms">CMS</a></li>
                </ul>
			</li>
      <?php //if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==1)
            //{  ?>
		 	<!--<li class="dropdown"><a data-toggle="dropdown" <?php if($_REQUEST['pid']=='admin' || $_REQUEST['pid']=='permission' || $_REQUEST['pid']=='permissionmodule' || $_REQUEST['pid']=='usertype'){ echo 'class="current"';} ?> href=""><span aria-hidden="true" class="icon-ticket "></span>Admin<b class="caret"></b></a>
                <ul class="dropdown-menu">

				    <li><a href="index.php?pid=admin">Super Admin</a></li>
				    <li><a href="index.php?pid=permission">Permission</a></li>
				     <li><a href="index.php?pid=permissionmodule">Module Permission </a></li>
				      <li><a href="index.php?pid=usertype">User Type</a></li>
                </ul>
			</li> -->

    <?php //} ?>
		<!--<li class="dropdown"><a data-toggle="dropdown" <?php if($_REQUEST['pid']=='city' || $_REQUEST['pid']=='state' || $_REQUEST['pid']=='country'  || $_REQUEST['pid']=='zipcode'){ echo 'class="current"';} ?> href=""><span aria-hidden="true" class="icon-map-marker"></span>Location
		<b class="caret"></b></a>
                <ul class="dropdown-menu">
				    <li><a href="index.php?pid=city">City</a></li>
				    <li><a href="index.php?pid=state">State</a></li>
				    <li><a href="index.php?pid=country">Country</a></li>
				     <li><a href="index.php?pid=zipcode">Zipcode</a></li>


                </ul>
			</li>-->

		<li class="dropdown"><a data-toggle="dropdown" <?php if($_REQUEST['pid']=='setting' || $_REQUEST['pid']=='testcategory' || $_REQUEST['pid']=='contact'){ echo 'class="current"';} ?> href=""><span aria-hidden="true" class="icon-gears"></span>Master<b class="caret"></b></a>
                <ul class="dropdown-menu">



				      <!-- <li><a href="index.php?pid=stock">Stock</a></li> -->

                     <!-- <li><a href="index.php?pid=blog">Blog</a></li>-->
                      <!-- <li><a href="index.php?pid=shipping">Shipping</a></li> -->
                      <!-- <li><a href="index.php?pid=currency">Currency</a></li> -->
                       <!--<li><a href="index.php?pid=newsletter">News Letter</a></li>
				      <li><a href="index.php?pid=template">Template</a></li>
				      <li><a href="index.php?pid=testimonial">Testimonial</a></li>-->
				      <!-- <li><a href="index.php?pid=cms">CMS</a></li> -->
					<li><a href="index.php?pid=setting">settings</a></li>
					<li><a href="index.php?pid=testcategory">Assessment Category</a></li>
					<li><a href="index.php?pid=contact">Contact Us</a></li>
                </ul>
			</li>





			 <?php if($_SESSION['TERRATROVE_ID']['ADMIN_ID']==1)
            {  ?>

			 <?php } ?>

        </ul>
	</div>
</div>
