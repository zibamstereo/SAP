<?php
//include DBFunc and config.php via Autoloader
 // directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//require_once (realpath(dirname(__FILE__)).DS."Autoloader.php");
 require_once (realpath(dirname(__FILE__)).DS."app".DS."Autoloader.php");

 //set redirect url if logged in before
 $url=isset($_REQUEST['returnurl']) ? rtrim(SITE_URL,"/").urldecode(base64_decode(htmlspecialchars($_REQUEST['returnurl']))) :'';

//Instantiate Functions_Admin Object
$adm = new Functions_Admin();

?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $adm->addTitle(); ?></title>

        <?php
        echo "<link rel='shortcut icon' href='".IMG_URL."ajebo.ico'>"; // Add favicon
        echo $adm->addJs('config'); // Add jquery
        echo $adm->addCss('index'); // Add css file for the index.php in the root folder
        echo $adm->addJs('jquery.min'); // Add jquery
        echo $adm->addCss('infinitelife'); // Add Infinitelife Css for this page
        echo $adm->addJs('infinitelife'); // Add Infinitelife Js for this page
        // Add font css
        echo $adm->addFile('Css', 'dashboard/fonts/font-awesome/css/font-awesome.min.css');
        echo $adm->addFile('Css', 'dashboard/fonts/fonts.css');
        ?>

<script type='text/javascript'>
  $(document).ready(function(){

    $('#adminLogin').submit(function(e) {
      adminLogin();
      e.preventDefault();
    });
  });

</script>


  </head>

  <body>

    <div class="header">
      <span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $adm->addImg('ajebo.png', 90, 45, 'Ajebo Market'); ?></span>
      <span style="width:auto;float:left;margin:0.65em 0 0 1em;"><i class="fa fa-th"></i> SALES AGENT PLATFORM  <span style="width:auto;color:#ee3d43; font-size:0.8em;" > <i class="fa  fa-chevron-right"></i>ADMIN LOGIN </span>
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
 <i class="fa fa-sign-in"> </i> ADMIN LOGIN

</div>

  <div class="form">
  <div id='msg'></div>
<!-- This is login form -->
    <form id="adminLogin" class="address-form" action="<?php echo ADMIN_URL; ?>process/admin_login" method="POST">
      <!--Call the $url variable -->
            <input  name='returnurl' type='hidden' value='<?php echo $url ;?>'/>
      <input type="text" id="email_login" name="email" placeholder="Email"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
      <input type="password" id="password_login" name="password" placeholder="Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>

        </br>
        <input class="button" type='submit' name="login" value="Login"> <?php echo $adm->addImg('loading.gif','','','loading..','','loading') ?>
        <p class="message">Forgot Your Password ? <i class="fa fa-chevron-circle-right"></i> <a href='pass_recovery'> Recover </a></p>


    </form>

    <!-- This is login form -->
  </div>
</div>

</div>
  </body>
</html>
