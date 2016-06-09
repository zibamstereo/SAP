<?php
//include DBFunc and config.php via Autoloader
 // directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

 require_once (realpath(dirname(__FILE__)).DS."Autoloader.php");

 //set redirect url if logged in before
 $url=isset($_REQUEST['returnurl']) ? SITE_URL.urldecode(base64_decode(htmlspecialchars($_REQUEST['returnurl']))) :'';

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
        echo $utils->addJs('jquery.min'); // Add jquery
        echo $utils->addCss('infinitelife'); // Add Infinitelife Css for this page
        echo $utils->addJs('infinitelife'); // Add Infinitelife Js for this page
        // Add font css
        echo $utils->addFile('Css', 'dashboard/fonts/font-awesome/css/font-awesome.min.css');
        echo $utils->addFile('Css', 'dashboard/fonts/fonts.css');
        ?>

<script type='text/javascript'>
  $(document).ready(function(){

    $('#loginForm').submit(function(e) {
      login();
      e.preventDefault();
    });
  });

</script>


  </head>

  <body>

    <div class="header">
      <span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $utils->addImg('ajebo.png', 90, 45, 'Ajebo Market'); ?></span>
      <span style="width:auto;float:left;margin:0.65em 0 0 1em;"><i class="fa fa-th"></i> SALES AGENT PLATFORM  <span style="width:auto;color:#ee3d43; font-size:0.8em;" > <i class="fa  fa-chevron-right"></i> Recover Password </span>
 </div>

<br>

<div class="wrapper">
  <br clear="all">
  <br clear="all">
  <br clear="all">
  <br clear="all">
  <br clear="all">

  <div class="sap-wrapper">

<div class="sap-wrapper-header">
 <i class="fa fa-unlock-alt"> </i> Recover Password

</div>

  <div class="form">
  <div id='msg'></div>
<!-- This is login form -->
    <form id="loginForm" class="address-form" action="<?php echo USER_URL; ?>process/recover" method="POST">
      <!--Call the $url variable -->
            <input  name='returnurl' type='hidden' value='<?php echo $url ;?>'/>
      <input type="text" id="email_login" name="email" placeholder="Email"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>

        </br>
        <!--<button class="button" name="Login" onClick="login_user();"> LOGIN</button>-->
        <input class="button" type='submit' name="recover" value="recover"> <?php echo $utils->addImg('loading.gif','','','loading..','','loading') ?>
        <p class="message">Recovered Your Password ? <i class="fa fa-chevron-circle-right"></i> <a href='login'> login </a></p>

        <p class="message">Not Registered ? <i class="fa fa-chevron-circle-right"></i> <a href='register'> Register </a></p>

    </form>

    <!-- This is login form -->
  </div>
</div>

</div>
  </body>
</html>