<?php
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// require header
require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."admin_header.php");
$row = !empty($_POST) ? $_POST : $getAdmin[0];


//Instantiate Functions_SiteSettings Object
$set = new Functions_Sitesettings();

// Get thr site setting methods
$config = $set->getSiteSettings();

?>

<script type='text/javascript'>
    $(document).ready(function(){

      $('#config').submit(function(e) {
        config();
        e.preventDefault();
      });
    });

</script>
<script type='text/javascript'>
    $(document).ready(function(){

      $('#processAcl').submit(function(e) {
        processAcl();
        e.preventDefault();
      });
    });

</script>
<body>
  <div class="container">
    <button id="menu-toggle" class="menu-toggle"><span>Menu</span></button>
    <div id="theSidebar" class="sidebar">

      <section  class="one-head ">

        <span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $adm->addImg('ajebo.png', 111, 50, 'Ajebo Market'); ?></span>
        <span style="width:auto;float:left;margin:0.7em 0 0 0.5em;"> <i class="fa fa-th"></i> SALES AGENT PLATFORM </span>



      </section>

      <button class="close-button"><i class="fa fa-close"></i></button>


      <?php
      // require vertical menu
      require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."admin_vmenu.php");

      ?>

    </div>


    <div id="theGrid" class="main">

      <section class="top">
        <header class="top-bar">

          <div id="user_welcome" class="animated slideDown">

            <div class="icon">
              <i class="fa fa-cogs"></i> <h2 class="top-bar__headline"> Dashboard | Configuration </h2>

            </div>
          </div>


        </header>
      </section>

      <section class="grid">
        <div class="grid animated fadeInDown">
              <div id='config_msg'></div>
          <div class="grid__setting animated fadeInDown" id="view">
            <div class="grid__50 animated fadeInDown" >
              <div class="form">
                <form id="config" class="address-form" action="<?php echo ADMIN_URL; ?>process/configuration" method="POST">
                  <input type="text" id="site_name" name="site_name" value="<?php echo !empty($config[0]['site_name']) ? $config[0]['site_name'] : "NIL" ?>"/><span class="form-icon1"> <i class="fa fa-user"> </i></span>
                  <input type="text" id="site_url" name="site_url" value="<?php echo !empty($config[0]['site_url']) ? $config[0]['site_url'] : "NIL" ?>"/><span class="form-icon1"> <i class="fa fa-user"> </i></span>
                  <textarea name="site_descr" id="site_descr"><?php echo !empty($config[0]['site_descr']) ? $config[0]['site_descr'] : "NIL" ?></textarea><span class="form-icon1"> <i class="fa fa-map"> </i></span>
                  <textarea name="site_address" id="site_address"><?php echo !empty($config[0]['site_address']) ? $config[0]['site_address'] : "NIL" ?></textarea><span class="form-icon1"> <i class="fa fa-map"> </i></span>
                </div>
              </div>

              <div class="grid__50 animated fadeInDown" id="view">
                <div class="form">

                  <input type="text" id="admin_email" name="admin_email" value="<?php echo !empty($config[0]['admin_email']) ? $config[0]['admin_email'] : "NIL" ?>"/><span class="form-icon1"> <i class="fa fa-envelope-o"> </i></span>
                  <input type="text" id="site_full_name" name="site_full_name" value="<?php echo !empty($config[0]['site_full_name']) ? $config[0]['site_full_name'] : "NIL" ?>"/><span class="form-icon1"> <i class="fa fa-user"> </i></span>
                  <textarea name="site_emails" id="site_emails"><?php echo !empty($config[0]['site_emails']) ? $config[0]['site_emails'] : "NIL" ?></textarea><span class="form-icon1"> <i class="fa fa-envelope-o"> </i></span>
                  <textarea name="site_phone" id="site_phone"><?php echo !empty($config[0]['site_phone']) ? $config[0]['site_phone'] : "NIL" ?></textarea><span class="form-icon1"> <i class="fa fa-tablet"> </i></span>

                  <span class="form-icon1"> <i class="fa fa-get-pocket"> </i></span>
                   <select name="records">
                    <option value="<?php echo !empty($config[0]['records']) ? $config[0]['records'] : "NIL" ?>"><?php echo !empty($config[0]['records']) ? $config[0]['records'] : "NIL" ?></option>
                    <option value="">----------</option>
                    <option value="5"> 5</option>
                    <option value="7"> 7</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                    <option value="15"> 15</option>
                    <option value="17">20</option>
                    <option value="15"> 22</option>
                    <option value="17">25</option>
                  </select>
                  <input class="button" type="submit" name="configuration" value="Configure"> <?php echo $adm->addImg('loading.gif','','','loading..','','loading') ?>

                 </form>

              </div>


    </div>

            </div>
<!-- Viewing the access control level -->
<div class="show view_acl">
            <div class="grid__action animated fadeInDown" id="view">
                 <div class="form">
                     <p style="font-size:0.9em;">This configuration grid shows the Access Level Control (ALC) ranging from Admin to ACL 9 - Sales Agent, Other access control level can also be configured as deem fit </p>

                         <table id='viewAcl' width="100%" border="1"  style='font-size:0.9em;'>
                        <thead>
				<tr>
			<td>ACL Key</th>
			<th>ACL Name</th>
                            </tr>
			</thead>

                        <tbody>
                    <?php
                     $sql = "SELECT * FROM acl WHERE acl_name != ''";
                     $result = $adm->fetch($sql);
                     foreach ($result AS $row):
                     $key = $row['acl_id'];
                     $access = !empty($row['acl_name']) ? $row['acl_name'] : 'N/A' ;
                     ?>
                     <tr>
    <td><?php echo $key; ?></td>
    <td><?php echo $access; ?></td>
  </tr>
  <?php
   endforeach;
  ?>
  </tbody>
  </table>
  <br clear="all">
  <a href="javascript:void(0);" onclick="edit_acl();" class="toggle" style="color:#ee3d43;"> <i class="fa fa-plus-circle"></i> Add/<i class="fa fa-cogs"></i> Edit ACL</a>

   </div>


            </div>
            
        </div>

<!-- Editting the access control level -->

<div class="hide edit_acl">
            <div class="grid__action animated fadeInDown" id="view">
                 <div class="form">
                     <p style="font-size:0.9em;">This configuration grid shows the Access Level Control (ALC) ranging from Admin to ACL 9 - Sales Agent, Other access control level can also be configured as deem fit </p>
                       <div id='acl_msg'></div>
                     <form id="processAcl" class="address-form" action="<?php echo ADMIN_URL; ?>process/process_acl" method="POST">
                         <table id='editAcl' width="100%"  style='font-size:0.9em;'>
                          <tr>
    <td><span class="form-icon1"> <i class="fa fa-sort-numeric-asc"> </i></span><?php echo $adm->getAclId(); ?></td>
    <td>
        <input style="margin-left:5px;" type="text" id="acl_name" name="acl_name" placeholder="ACL Name" />
    </td>
  </tr>
  </table>
        <input class="button" type="submit" name="acl" value="Save ACL">
</form>
  <br clear="all">
  <a href="javascript:void(0);" onclick="view_acl();" class="toggle" style="color:#ee3d43;"> <i class="fa fa-eye"></i> Back to ACL list</a>

   </div>


            </div>
            
        </div>

          </div>



          <?php

          // require header
          require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."admin_footer.php");

          ?>
