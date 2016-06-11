<?php
$CurrentPage = basename($_SERVER['SCRIPT_NAME']);
?>
<div class="menu-mobile">
<ul class="nav-mobile animated fadeInDown">
  <li><a href="<?php echo ADM_URL;?>index" <?php if ($CurrentPage == 'index.php') {echo 'class="activated"';} ?>> <i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li ><a href="<?php echo ADM_URL;?>admin_profile" <?php if ($CurrentPage == 'admin_profile.php') {echo 'class="activated"';} ?>><i class="fa fa-user"></i> Admin Profile</a> </li>

	<li ><a href="<?php echo ADM_URL;?>manage_sales_agents" <?php if ($CurrentPage == 'manage_sales_agents.php') {echo 'class="activated"';} ?>><i class="fa fa-sitemap"></i> Manage Sales Agents</a></li>

	<li ><a href="<?php echo ADM_URL;?>manage_orders" <?php if ($CurrentPage == 'manage_orders.php') {echo 'class="activated"';} ?>><i class="fa fa-shopping-cart"></i> Manage Orders</a></li>

	<li ><a href="<?php echo ADM_URL;?>configuration" <?php if ($CurrentPage == 'configuration.php') {echo 'class="activated"';} ?>> <i class="fa fa-bar-chart"></i> Configurations</a></li>

	<li ><a href="<?php echo ADM_URL;?>log_off"><i class="fa fa-sign-out"></i> Logout</a></li>
</ul>

</div>
