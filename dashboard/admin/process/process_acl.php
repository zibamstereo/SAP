<?php
// 	This is Sales Agent Platform User Login Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."app".DS."Autoloader.php");

//Instantiate Functions_Admin Object
$adm = new Functions_Admin();

// Check if the user logged in is admin
$adm->checkAdminLogin('1');
if(empty($_POST['acl_id']))
{
    die(msg(0,"Please Choose Access Control Level Id!."));
}

 $res = $adm->processAcl($_POST['acl_id'], $_POST['acl_name']);

		//if successful
		if ($res == 99){
			die(msg(1,"Access Control Level Updated successfully!"));
			}

		//if errors occured
		if($res == 1)
			{
			die(msg(0,"Unable to Update Access Control Level. Please contact the Web Developer."));
			}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
