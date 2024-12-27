<div class="container-fluid top-bar">
  <div class="pull-right">
    <ul class="nav navbar-nav pull-right">
      <li class="dropdown settings hidden-xs">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-gear"></span>
          <div class="sr-only">
            Settings
          </div>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="settings-link blue" href="javascript:chooseStyle('none', 30)"><span></span>Blue</a>
          </li>
          <li>
            <a class="settings-link green" href="javascript:chooseStyle('green-theme', 30)"><span></span>Green</a>
          </li>
          <li>
            <a class="settings-link orange" href="javascript:chooseStyle('orange-theme', 30)"><span></span>Orange</a>
          </li>
          <li>
            <a class="settings-link magenta" href="javascript:chooseStyle('magenta-theme', 30)"><span></span>Magenta</a>
          </li>
          <li>
            <a class="settings-link gray" href="javascript:chooseStyle('gray-theme', 30)"><span></span>Gray</a>
          </li>
        </ul>
      </li>
      <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="">
        <?php
			$query=("SELECT * FROM admin WHERE status=1 and adminid='".$_SESSION['TERRATROVE_ID']['ADMIN_ID']."'");
			$resultI=$controller_class->modelObj->fetchRow($query);
		?>
		<?php if($resultI['image']==''){ ?>
			<img width="36" height="36" src="<?php echo $_SESSION['ADMIN_DOMAIN_NAME'];?>images/default.png" alt="No Image" />
		<?php } else { ?>
			<img width="36" height="36" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>upload/admin
		_profile/<?php echo $resultI['image']; ?>" alt="No Image" />
		<?php } ?>
		<?php echo urldecode($resultI['firstname'])." ".urldecode($resultI['lastname']) ;?><b class="caret"></b></a>
        <ul class="dropdown-menu">
			<li><a href="<?php echo $_SESSION['ADMIN_DOMAIN_NAME'];?>index.php?pid=editprofile" >
            <i class="icon-gear"></i>Edit Profile</a>
			</li>
			<li><a href="<?php echo $_SESSION['ADMIN_DOMAIN_NAME'];?>index.php?pid=viewprofile" >
            <i class="icon-eye-open"></i>View Profile</a>
			</li>
			<!--<li><a href="<?php echo $_SESSION['ADMIN_DOMAIN_NAME'];?>index.php?pid=changepassword"><i class="icon-bolt"></i>Change Password</a>
			</li>-->
			<!--onclick="getLogOut();-->
			<li><a href="<?php echo $_SESSION['ADMIN_DOMAIN_NAME'];?>index.php?pid=logout"><i class="icon-signout"></i>Logout</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>

	<button class="navbar-toggle">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button><a class="logo" href="index.php?pid=dashboard"></a>
</div>
<div class="container-fluid main-nav clearfix">
    <?php include_once('menu.php');?>
</div>
