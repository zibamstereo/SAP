<?php
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
  require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."app".DS."Autoloader.php");

//Instantiate Functions_User Object
$usr = new Functions_User();

//Instantiate Functions_Image Object
$img = new Functions_Image();

$usr->checkUserLogin('9');

 $getuser = $usr->getUserRecords($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> <?php echo $usr->addTitle(); ?></title>

		<?php
		// Add Favicon
        echo "<link rel='shortcut icon' href='".IMG_URL."ajebo.ico'>";
        echo $usr->addJs('config'); // Add jquery
        echo $usr->addJs('jquery.min'); // Add jquery
        echo $usr->addJs('index'); // Add Dika's Js script
        echo $usr->addCss('infinitelife'); // Add Infinitelife Css for this page
        echo $usr->addJs('infinitelife'); // Add Infinitelife Js for this page
        // Add Css files needed
        echo $usr->addCss('normalize'); // Add css file for the index.php in the root folder
        echo $usr->addFile('Css', '../../dashboard/fonts/font-awesome/css/font-awesome.min.css');
        echo $usr->addCss('user-panel'); // Add css file for user panel
        echo $usr->addFile('Css', '../../dashboard/fonts/fonts.css');
        echo $usr->addJs('modernizr.custom');
        ?>
</head>
