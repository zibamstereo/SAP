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
    <title> Home-S.A.P</title>

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




  </head>

  <body>

    <div class="header">
      <span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $usr->addImg('ajebo.png', 90, 45, 'Ajebo Market'); ?></span>
      <span style="width:auto;float:left;margin:0.65em 0 0 1em;"><i class="fa fa-th"></i> SALES AGENT PLATFORM <span style="width:auto;color:#ee3d43; font-size:0.8em;" > <i class="fa  fa-chevron-right"></i> HOME </span></span>
       </div>

<br>

<div class="wrapper">
<div class="sap-welcome">


<div class="welcome">

</div>
</div>
</div>


     <?php
        echo $usr->addJs('jquery.min'); // Add jquery
        echo $usr->addJs('index'); // Add js for the index.php in the root folder
      ?>




  </body>
</html>
