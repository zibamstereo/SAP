<?php
// 	This is Sales Agent Platform User Login Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."app".DS."Autoloader.php");

//Instantiate Functions_Admin Object
$adm = new Functions_Admin();

$adm->checkAdminLogin('1');

    if (empty($_POST['newpassword'])) 
		{
			die(msg(0,"New password field empty!"));
		}
		
		if(strlen($_POST['newpassword'])<5)
		{
			die(msg(0,"Must contain more than 5 characters."));
		}
				
		$res = $adm->adminUpdatePass($_POST['id'],$_POST['newpassword']);
				
			if($res == 1){
				die(msg(0,"An error occured saving the password. Please try again."));
			}
			if($res == 99){
				die(msg(1,"Password Changed Successfully."));
			}
	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}
?>
