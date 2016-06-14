<?php
//include DBFunc and config.php via Autoloader
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//require_once (realpath(dirname(__FILE__)).DS."Autoloader.php");
require_once (realpath(dirname(__FILE__)).DS."app".DS."Autoloader.php");

//Instantiate Functions_Utility Object
$utils = new Functions_Utility();
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title> <?php echo $utils->addTitle(); ?></title>

  <?php
  echo "<link rel='shortcut icon' href='".IMG_URL."ajebo.ico'>"; // Add favicon
  echo $utils->addJs('config'); // Add jquery
  echo $utils->addCss('index'); // Add css file for the index.php in the root folder
  echo $utils->addJs('jquery.min'); // Add jquery
  echo $utils->addCss('infinitelife'); // Add Infinitelife Css for this page
  echo $utils->addJs('infinitelife'); // Add Infinitelife Js for this page
  // Add font css
  echo $utils->addFile('Css', 'dashboard/fonts/font-awesome/css/font-awesome.min.css');
  echo $utils->addFile('Css', 'dashboard/fonts/fonts.css');
  ?>


  <script type="text/javascript">
  $(document).ready(function(){

    $('#regForm').submit(function(e) {
      configuration();
      e.preventDefault();
    });
  });
  </script>


</head>

<body>

  <div class="header">
    <span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $utils->addImg('ajebo.png', 90, 45, 'Ajebo Market'); ?></span>
    <span style="width:auto;float:left;margin:0.65em 0 0 1em;"><i class="fa fa-th"></i> SALES AGENT PLATFORM  <span style="width:auto;color:#ee3d43; font-size:0.8em;" > <i class="fa  fa-chevron-right"></i> CONFIGURATION </span>

  </div>

  <br>

  <div class="wrapper">

    <div class="sap-wrapper">

      <div class="sap-wrapper-header">
        <i class="fa fa-cogs"> </i> CONFIGURATION

      </div>

      <div class="form">
        <div id='msg'></div>
        <!-- This is registration form -->
        <form id="regForm" class="address-form" action="<?php echo USER_URL; ?>process/configuration" method="POST">

          <input type="text" id="site_name" name="site_name" placeholder="Website Name"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
          <input type="text" id="site_url" name="site_url" placeholder="Website URL"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
          <input type="text" id="site_name" name="site_name" placeholder="Website Name"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
          <input type="text" id="site_email" name="site_email" placeholder="Website Email"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
          <input type="text" id="site_email2" name="site_email2" placeholder="Website Email 2"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>

          <input type="text" id="site_phone" name="site_phone" placeholder="Website Phone Contact"/><span class="form-icon"> <i class="fa fa-tablet"> </i></span>
          <textarea name="site_description" id="site_description" placeholder="Website Description"></textarea><span class="form-icon"> <i class="fa fa-map"> </i></span>
          <textarea name="site_address" id="site_address" placeholder="Website Address"></textarea><span class="form-icon"> <i class="fa fa-map"> </i></span>
          <input type="text" id="site_full_name" name="site_full_name" placeholder="Website Full Name"/><span class="form-icon"> <i class="fa fa-user"> </i></span>

          <span class="form-icon"> <i class="fa fa-get-pocket"> </i></span> <select name="Records">
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


          <input class="button" type='submit' name="configuration" value="Configure"> <?php echo $utils->addImg('loading.gif','','','loading..','','loading') ?>
          <!--<div class="button" name="configuration" onClick="create_account();"> configuration</div>-->
        </form>
        <!-- This is registration form -->
      </div>
    </div>

  </div>
</body>
</html>
