<?php
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// require header
 require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."admin_header.php");
?>
<script type="text/javascript">
	$(document).ready(function(){

		$('#config').submit(function(e) {
			config();
			e.preventDefault();
		});
	});

</script>
<body>

  <div class="header">
    <span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $adm->addImg('ajebo.png', 90, 45, 'Ajebo Market'); ?></span>
    <span style="width:auto;float:left;margin:0.65em 0 0 1em;"><i class="fa fa-th"></i> SALES AGENT PLATFORM  <span style="width:auto;color:#ee3d43; font-size:0.8em;" > <i class="fa  fa-chevron-right"></i> CONFIGURATION </span>

  </div>

  <br>

  <div class="wrapper">

    <div class="sap-wrapper">

      <div class="sap-wrapper-header">
        <i class="fa fa-cogs"> </i> CONFIGURATION

      </div>

      <div class="form">

<div style="widht:50%; float:left;">

  <form id="config" class="address-form" action="<?php echo ADMIN_URL; ?>process/configuration" method="POST">

    <input type="text" id="site_name" name="site_name" placeholder="Website Name"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
    <input type="text" id="site_url" name="site_url" placeholder="Website URL"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
    <input type="text" id="admin_email" name="admin_email" placeholder="Admin Email"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
    <input type="text" id="site_full_name" name="site_full_name" placeholder="Website Full Name"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
    <textarea name="site_descr" id="site_descr" placeholder="Website Description"></textarea><span class="form-icon"> <i class="fa fa-map"> </i></span>
    <textarea name="site_address" id="site_address" placeholder="Website Address"></textarea><span class="form-icon"> <i class="fa fa-map"> </i></span>
    <textarea name="site_emails" id="site_emails" placeholder="Website Emails"></textarea><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
    <textarea name="site_phone" id="site_phone" placeholder="Website Phone Contacts"></textarea><span class="form-icon"> <i class="fa fa-tablet"> </i></span>
</div>

<div style="widht:50%; float:left;">

  <span class="form-icon"> <i class="fa fa-get-pocket"> </i></span> <select name="records">
    <option value="Records"> Records</option>
    <option value="5"> 5</option>
    <option value="7"> 7</option>
    <option value="10">10</option>
    <option value="12">12</option>
    <option value="15"> 15</option>
    <option value="17">20</option>
    <option value="15"> 22</option>
    <option value="17">25</option>
  </select>


  <input class="button" type='submit' name="configuration" value="Configure"> <?php echo $adm->addImg('loading.gif','','','loading..','','loading') ?>
</form>

</div>

      </div>
    </div>

  </div>
</body>
</html>
