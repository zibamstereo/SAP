<?php
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 //require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."Autoloader.php");
  require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."app".DS."Autoloader.php");


$adm = new Functions_Admin();
$adm->checkAdminLogin('1');

 $getuser = $adm->getAdminRecords($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> <?php echo $adm->addTitle(); ?></title>

		<?php
		// Add Favicon
        echo "<link rel='shortcut icon' href='".IMG_URL."ajebo.ico'>";
        echo $adm->addJs('config'); // Add jquery
        echo $adm->addJs('jquery.min'); // Add jquery
        echo $adm->addCss('infinitelife'); // Add Infinitelife Css for this page
        echo $adm->addJs('infinitelife'); // Add Infinitelife Js for this page
        // Add Css files needed
        echo $adm->addCss('normalize'); // Add css file for the index.php in the root folder
        echo $adm->addFile('Css', '../../dashboard/fonts/font-awesome/css/font-awesome.min.css');
        echo $adm->addCss('user-panel'); // Add css file for user panel
        echo $adm->addFile('Css', '../../dashboard/fonts/fonts.css');
        echo $adm->addJs('modernizr.custom');
        ?>
</head>
