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
        echo $utils->addCss('index'); // Add css file for the index.php in the root folder

        // Add font css
        echo $utils->addFile('Css', 'dashboard/fonts/font-awesome/css/font-awesome.min.css'); 
        echo $utils->addFile('Css', 'dashboard/fonts/fonts.css');
        ?>




  </head>

  <body>

    <div class="header">
      <span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $utils->addImg('ajebo.png', 111, 45, 'Ajebo Market'); ?></span>
      <span style="width:auto;float:left;margin:0.8em 0 0 1em;"><i class="fa fa-th"></i> SALES AGENT PLATFORM </span>
       </div>

<br>

<div class="wrapper">

  <div class="sap-wrapper">

<div class="sap-wrapper-header">
 <i class="fa fa-group"> </i> REGISTER | LOGIN

</div>

  <div class="form">
<!-- This is login form -->
    <form id="loginForm" class="search-form" action="index.php">

      <input type="text" id="email_login" name="email_login" placeholder="Email"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
      <input type="password" id="password_login" name="password_login" placeholder="Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>

        </br>
        <div class="button" name="Login" onClick="login_user();"> LOGIN</div>
        <p class="message">Not Registered ? <span class="change">  <i class="fa fa-chevron-circle-right"></i> Register </span></p>


    </form>

    <!-- This is login form -->




<!-- This is registration form -->
    <form id="regForm" class="address-form" action="<?php echo USER_URL; ?>process/registration.php" method="POST">
  <input type="text" id="full_name" name="full_name" placeholder="Full Name"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
  <textarea name="address" id="address" placeholder="Address"></textarea><span class="form-icon"> <i class="fa fa-map"> </i></span>
  <input type="text" id="phone" name="phone" placeholder="Phone"/><span class="form-icon"> <i class="fa fa-tablet"> </i></span>
  <input type="text" id="email" name="email" placeholder="Email"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
  <input type="password" id="password" name="password" placeholder="Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>
  <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>

      </br>
      <!--<div class="button" name="register" onClick="create_account();"> Register</div>-->
      <button class="button" name="register">Register</button>
      <p class="message">Already Registered ? <span class="change">  <i class="fa fa-chevron-circle-right"></i> Login </span></p>
    </form>
    <!-- This is registration form -->
  </div>
</div>

</div>

     <?php
        echo $utils->addJs('jquery.min'); // Add jquery
        echo $utils->addJs('index'); // Add js for the index.php in the root folder
      ?>




  </body>
</html>
