<?php
//include DBFunc and config.php via Autoloader
 // directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

 //require_once (realpath(dirname(__FILE__)).DS."Autoloader.php");
 require_once (realpath(dirname(__FILE__)).DS."app".DS."Autoloader.php");

//Instantiate Functions_Utility Object
$usr = new Functions_User();
/**
    *  @Description:  Get Level Access, and Actication Key 
  */
  $level = isset($_REQUEST['level_access']) ? $_REQUEST['level_access'] : '';
  $activation_key = isset($_REQUEST['activation_key']) ? $_REQUEST['activation_key'] : '';
  
  /**
    *  @Description:  Define which login page to redirect to 
  */
  $login = APP_PATH.'login.php';
  
  
  
  
  $res = $usr->confirm_user_reg($activation_key);
  if ($res == 1){
    $error = "Failed to activate account. Please contact the site admin.";
  }
  if ($res == 2){
    $error = "Your account is already active!";
  }
  if ($res == 3){
    $error = "This user does not exist.";
  }
  if ($res == 99){
    $message = "Congratulations! Your account has been activated. You may now <a href='".$login."'>login</a> and start using it.";
  }
  


?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title> <?php echo $usr->addTitle(); ?></title>

        <?php
        echo "<link rel='shortcut icon' href='".IMG_URL."ajebo.ico'>"; // Add favicon
        // Add font css
        echo $usr->addCss('index'); // Add Infinitelife Css for this page 
        echo $usr->addCss('infinitelife'); // Add Infinitelife Css for this page 
        echo $usr->addFile('Css', 'dashboard/fonts/font-awesome/css/font-awesome.min.css'); 
        echo $usr->addFile('Css', 'dashboard/fonts/fonts.css');
        ?>


  </head>

  <body>

    <div class="header">
      <span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $usr->addImg('ajebo.png', 111, 45, 'Ajebo Market'); ?></span>
      <span style="width:auto;float:left;margin:0.8em 0 0 1em;"><i class="fa fa-th"></i> SALES AGENT PLATFORM </span>
       </div>

<br>

<div class="wrapper">

  <div class="sap-wrapper">

<div class="sap-wrapper-header">
 <i class="fa fa-group"> </i> ACTIVATION STATUS

</div>

  <div class="form">  
<table align='center' width='100%' style='border: 1px thin #8080FF;'>
    <tr>
      <td>
        <?php if(isset($error))
          {
            echo '<div class="error">' . $error . '</div>' . "\n";
          }
          else if(isset($message)) {
            echo '<div class="done">' . $message . '</div>' . "\n";
          } 
        ?>
      </td>
    </tr>
  </table>
  </div>
</div>

</div>
  </body>
</html>