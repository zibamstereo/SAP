<?php
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 //require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."Autoloader.php");
  require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."app".DS."Autoloader.php");

//Instantiate Functions_Utility Object
$utils = new Functions_Utility();
$usr = new Functions_User();
 $usr->checkLogin('9');

 $getuser = $usr->getUserRecords($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> <?php echo $utils->addTitle(); ?></title>

		<?php
		// Add Favicon
        echo "<link rel='shortcut icon' href='".IMG_URL."ajebo.ico'>";
        echo $utils->addJs('config'); // Add jquery
        echo $utils->addJs('jquery.min'); // Add jquery
        echo $utils->addJs('index'); // Add Dika's Js script
        echo $utils->addCss('infinitelife'); // Add Infinitelife Css for this page
        echo $utils->addJs('infinitelife'); // Add Infinitelife Js for this page
        // Add Css files needed
        echo $utils->addCss('normalize'); // Add css file for the index.php in the root folder
        echo $utils->addFile('Css', '../../dashboard/fonts/font-awesome/css/font-awesome.min.css');// Add Dika's icon encoding plugin by fontawesome
        echo $utils->addCss('user-panel'); // Add Dika's css framework for dashboard
        echo $utils->addFile('Css', '../../dashboard/fonts/fonts.css');// Add Dika's font framework for dashboard
        echo $utils->addJs('modernizr.custom'); // Add Dika's js for mobile menu toggle
        ?>
</head>
