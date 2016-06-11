<?php
// 	This is Sales Agent Platform User Login Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."app".DS."Autoloader.php");

//Instantiate Functions_User Object
$usr = new Functions_User();

$usr->checkUserLogin('9');
// we check if everything is filled in and perform checks
	if($_POST['phone'] && !$usr->validatePhone($_POST['phone']))
		{
			die(msg(0,"Phone numbers must be 7 or 10 or 11 digits."));
		}
	if($_POST['email'] && !$usr->validateEmail($_POST['email']))
		{
			die(msg(0,"Invalid Email!"));
		}
		//$res = $usr->editProfile( $_SESSION['user_id'], $_POST['title'], $_POST['full_name'], $_POST['last_name'], $_POST['dob'], $_POST['gender'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['phone']);
	$res = $usr->editProfile( $_SESSION['user_id'], $_POST['title'], $_POST['full_name'], $_POST['last_name'], $_POST['dob'], $_POST['gender'], $_POST['address'], $_POST['phone'] );

			if($res == 4){
				die(msg(0,"An internal error has occured. Please contact the site admin!"));
			}
			if($res == 99){
				die(msg(1,"Profile Updated Successfully!"));
			}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}
?>
