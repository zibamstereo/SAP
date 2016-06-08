<?php 
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."Autoloader.php");



$usr = new Functions_User();
$getuser = $usr->getUserRecords($_SESSION['user_id']);
$usr->logoff($getuser[0]['id']);


?>