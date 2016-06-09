<?php
// 	This is Sales Agent Platform User Login Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 //require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."Autoloader.php");
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."app".DS."Autoloader.php");
// Get the return URL
 $returnURL = (isset($_POST['returnurl']) && !empty($_POST['returnurl'])) ? $_POST['returnurl']: USER_URL.'index';
//$returnURL = USER_URL.'index';

//Instantiate Functions_Utility Object
$usr = new Functions_User();

if(!$_POST['email'])
	{
	die(msg(0,"<i class='fa fa-envelope-o'></i> Email cannot be empty!","email_login"));
}
elseif(!$_POST['password'])
{
	die(msg(0,"<i class='fa fa-ellipsis-h'></i> Password cannot be empty!","password_login"));
}

else
	{
			$res = $usr->login($_POST['email'],$_POST['password']);
				if ($res == 1){
					die(msg(0,"<i class='fa fa-info-circle'></i> Login Details incorrect!",""));
				}

				if ($res == 2){
					die(msg(0,"<i class='fa fa-info-circle'></i> Sorry! Your account has been suspended!",""));
				}
				if ($res == 3){
					die(msg(0,"<i class='fa fa-info-circle'></i> Sorry! Your account has not been activated. Please check your inbox or spam folder for your activation link .",""));
				}
				if ($res == 4){
					die(msg(0,"<i class='fa fa-info-circle'></i> Please login on Admin page!",""));
				}
				if ($res == 99){
					echo(msg(1,$returnURL,""));
				}
		}

    function msg($status,$txt,$txt2)
  	{
  		return '{"status":'.$status.',"txt":"'.$txt.'","txt2":"'.$txt2.'"}';
  	}

?>
