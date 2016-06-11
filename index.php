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
    <title> Home-S.A.P</title>

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




  </head>

  <body>
  <div class="header">
<span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $utils->addImg('ajebo.png', 90, 45, 'Ajebo Market'); ?></span>
<span style="width:auto;float:left;margin:0.65em 0 0 1em;"><i class="fa fa-th"></i> SALES AGENT PLATFORM <span style="width:auto;color:#ee3d43; font-size:0.8em;" > <i class="fa  fa-chevron-right"></i> HOME </span></span>
       </div>

<br>

<div class="wrapper">
<div class="sap-welcome">


<div class="welcome">
  Welcome to Ajebo Market Sales Agent Platform
</div>
</div>
</div>


     <?php
        echo $utils->addJs('jquery.min'); // Add jquery
        echo $utils->addJs('index'); // Add js for the index.php in the root folder
      ?>




  </body>
</html>
