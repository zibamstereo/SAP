<?php
// 	This is Sales Agent Platform User Login Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."app".DS."Autoloader.php");

//Instantiate Functions_User Object
$usr = new Functions_User();

$usr->checkUserLogin('9');

    if (empty($_POST['oldpassword']))
		{
			die(msg(0,"Old password fields empty!"));
		}
    elseif(empty($_POST['newpassword']))
    {
      die(msg(0,"New password fields empty!"));
    }
    elseif(empty($_POST['cnewpassword']))
    {
      die(msg(0,"Confirmation password fields empty!"));
    }
		elseif(strlen($_POST['newpassword'])<5)
		{
			die(msg(0,"Password must contain more than 5 characters."));
		}
    elseif($_POST['newpassword'] !== $_POST['cnewpassword'])
    {
      die(msg(0,"Password do not match"));
    }
    else{
		  $res = $usr->updatePass($_SESSION['user_id'], $_POST['oldpassword'], $_POST['newpassword']);

			if($res == 2){
				die(msg(0,"Incorrect old password!"));
			}
			if($res == 3){
				die(msg(0,"An error occured saving your password. Please contact the site admin."));
			}
			if($res == 99){
				die(msg(1,"Password Changed Successfully."));
			}
    }

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}
?>
