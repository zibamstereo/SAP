<?php
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// require header
require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."admin_header.php");
$row = !empty($_POST) ? $_POST : $getuser[0];
/**
* Add Jscal for purpose of date of birth input
*/
echo $adm->addFile("Js",LIB_URL."jscal/js/jscal2.js");
echo $adm->addFile("Js",LIB_URL."jscal/js/lang/en.js");
echo $adm->addFile("Css",LIB_URL."jscal/css/jscal2.css");
echo $adm->addFile("C",LIB_URL."jscal/css/border-radius.css");
?>
<script type='text/javascript'>
$(document).ready(function(){

  $('#editAdminForm').submit(function(e) {
    editAdminForm();
    e.preventDefault();
  });
});

</script>
<script type="text/javascript">
$(document).ready(function(){

  $('#changeAdminPass').submit(function(e) {
    changeAdminPass();
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
              <i class="fa fa-cogs"></i> <h2 class="top-bar__headline"> | Configuration </h2>

            </div>
          </div>


        </header>
      </section>

      <section class="grid">
        <div class="grid animated fadeInDown">
          <div class="grid__setting animated fadeInDown" id="view">
            <div class="grid__50 animated fadeInDown" >

              <div class="form">

                <form id="regForm" class="address-form" action="<?php echo ADMIN_URL; ?>process/configuration" method="POST">
                  <input type="text" id="site_name" name="site_name" placeholder="Website Name"/><span class="form-icon1"> <i class="fa fa-user"> </i></span>
                  <input type="text" id="site_url" name="site_url" placeholder="Website URL"/><span class="form-icon1"> <i class="fa fa-user"> </i></span>
                  <input type="text" id="site_name" name="site_name" placeholder="Website Name"/><span class="form-icon1"> <i class="fa fa-user"> </i></span>
                  <input type="text" id="site_email" name="site_email" placeholder="Website Email"/><span class="form-icon1"> <i class="fa fa-envelope-o"> </i></span>
                  <textarea name="site_email2" id="site_email2" placeholder="Website Email 2"></textarea><span class="form-icon1"> <i class="fa fa-envelope-o"> </i></span>


                </div>
              </div>

              <div class="grid__50 animated fadeInDown" id="view">
                <div class="form">

                  <textarea name="site_phone" id="site_phone" placeholder="Website Phone Contact"></textarea><span class="form-icon1"> <i class="fa fa-tablet"> </i></span>
                  <textarea name="site_description" id="site_description" placeholder="Website Description"></textarea><span class="form-icon1"> <i class="fa fa-map"> </i></span>
                  <textarea name="site_address" id="site_address" placeholder="Website Address"></textarea><span class="form-icon1"> <i class="fa fa-map"> </i></span>
                  <input type="text" id="site_full_name" name="site_full_name" placeholder="Website Full Name"/><span class="form-icon1"> <i class="fa fa-user"> </i></span>


                  <span class="form-icon1"> <i class="fa fa-get-pocket"> </i></span> <select name="Records">
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

            <div class="grid__action animated fadeInDown" id="view">

            </div>


          </div>



          <?php

          // require header
          require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."admin_footer.php");

          ?>
