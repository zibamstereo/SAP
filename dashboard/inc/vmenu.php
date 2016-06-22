<?php
$CurrentPage = basename($_SERVER['SCRIPT_NAME']);
?>
<div class"related">

  <div class="profile-pic">
<?php echo $img->displayProfilePicture($_SESSION['user_id'],'60%',130);?>
  </div>

   </div>

<div class="menu-mobile">
<ul class="nav-mobile animated fadeInDown">
  <li><a href="<?php echo USER_URL;?>index" <?php if ($CurrentPage == 'index.php') {echo 'class="activated"';} ?>> <i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li ><a href="<?php echo USER_URL;?>my_account" <?php if ($CurrentPage == 'my_account.php') {echo 'class="activated"';} ?>><i class="fa fa-user"></i> My Account</a> </li>

	<li ><a href="<?php echo USER_URL;?>manage_customers" <?php if ($CurrentPage == 'manage_customers.php') {echo 'class="activated"';} ?>><i class="fa fa-sitemap"></i> Manage Customers</a></li>

	<li ><a href="<?php echo USER_URL;?>manage_orders" <?php if ($CurrentPage == 'manage_orders.php') {echo 'class="activated"';} ?>><i class="fa fa-shopping-cart"></i> Manage Orders</a></li>

	<li ><a href="<?php echo USER_URL;?>statistics" <?php if ($CurrentPage == 'statistics.php') {echo 'class="activated"';} ?>> <i class="fa fa-bar-chart"></i> Statistics</a></li>

	<li ><a href="<?php echo USER_URL;?>log_off"><i class="fa fa-sign-out"></i> Logout</a></li>
</ul>

</div>
