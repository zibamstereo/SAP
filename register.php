<?php
//include DBFunc and config.php via Autoloader
 // directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//require_once (realpath(dirname(__FILE__)).DS."Autoloader.php");
 require_once (realpath(dirname(__FILE__)).DS."app".DS."Autoloader.php");

//Instantiate Functions_User Object
$usr = new Functions_User();
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title> <?php echo $usr->addTitle(); ?></title>

        <?php
        echo "<link rel='shortcut icon' href='".IMG_URL."ajebo.ico'>"; // Add favicon
        echo $usr->addJs('config'); // Add jquery
        echo $usr->addCss('index'); // Add css file for the index.php in the root folder
        echo $usr->addJs('jquery.min'); // Add jquery
        echo $usr->addCss('infinitelife'); // Add Infinitelife Css for this page
        echo $usr->addJs('infinitelife'); // Add Infinitelife Js for this page
        // Add font css
        echo $usr->addFile('Css', 'dashboard/fonts/font-awesome/css/font-awesome.min.css');
        echo $usr->addFile('Css', 'dashboard/fonts/fonts.css');
        ?>


<script type="text/javascript">
  $(document).ready(function(){

    $('#regForm').submit(function(e) {
      register();
      e.preventDefault();
    });
  });
</script>


  </head>

  <body>

    <div class="header">
      <span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $usr->addImg('ajebo.png', 90, 45, 'Ajebo Market'); ?></span>
      <span style="width:auto;float:left;margin:0.65em 0 0 1em;"><i class="fa fa-th"></i> SALES AGENT PLATFORM  <span style="width:auto;color:#ee3d43; font-size:0.8em;" > <i class="fa  fa-chevron-right"></i> REGISTER </span>

       </div>

<br>

<div class="wrapper">

  <div class="sap-wrapper">

<div class="sap-wrapper-header">
 <i class="fa fa-user-plus"> </i> REGISTER

</div>

  <div class="form">
  <div id='msg'></div>
<!-- This is registration form -->
    <form id="regForm" class="address-form" action="<?php echo USER_URL; ?>process/register" method="POST">
  <input type="text" id="full_name" name="full_name" placeholder="Full Name"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
  <textarea name="address" id="address" placeholder="Address"></textarea><span class="form-icon"> <i class="fa fa-map"> </i></span>
  <input type="text" id="phone" name="phone" placeholder="Phone"/><span class="form-icon"> <i class="fa fa-tablet"> </i></span>
  <input type="text" id="email" name="email" placeholder="Email"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
  <input type="password" id="password" name="password" placeholder="Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>
  <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>
  <input class="button" type='submit' name="register" value="Register"> <?php echo $usr->addImg('loading.gif','','','loading..','','loading') ?>
  <p class="message">Already Registered ? <i class="fa fa-chevron-circle-right"></i> <a href='login'> login </a></p>

      <!--<div class="button" name="register" onClick="create_account();"> Register</div>-->
        </form>
    <!-- This is registration form -->
  </div>
</div>

</div>
  </body>
</html>
