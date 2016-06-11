<?php
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."app".DS."Autoloader.php");


// Instantiate new Functions_user Object
$usr = new Functions_User();

//Use object to get logoff method
$usr->logoff();


?>
