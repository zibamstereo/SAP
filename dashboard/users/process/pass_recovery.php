<?php
// 	This is Sales Agent Platform User Registration Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 //require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."Autoloader.php");
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."app".DS."Autoloader.php");
 //Instantiate Db_DBFunc Object
//$db = new Db_DBFunc();

//Instantiate Functions_User  and Functions_SiteSettings Object
$usr = new Functions_User();
$set = new Functions_Sitesettings();


// Get thr site setting methods
$sitesettings = $set->getSiteSettings();
$site_url = $sitesettings[0]['site_url'];


//For password recovery

	// we check if everything is filled in and perform checks

	if(!$_POST['email'])
		{
			die(msg(0,"Please enter your email address."));
		}
    elseif(!$usr->validateEmail($_POST['email']))
  	{
  		die(msg(0,"<i class='fa fa-envelope-o'></i> Invalid Email Address.","email"));
  	}
		else{
			$res = $usr->passRecovery($_POST['email'],$site_url);
				if($res == 1){
					die(msg(0,"There was an error sending your new password. Please contact the site admin."));
				}
				if($res == 2){
					die(msg(0,"There was an error with the database. Please contact the site admin."));
				}
				if($res == 3){
					die(msg(0,"The email entered does not match any in our database. Please <a href='".APP_PATH."register'>Register Here</a> to start using our services."));
				}
				if($res == 99){
					die(msg(1,"A Password Reset Link has been sent to your Email Address <br />Check your inbox / junk mail folder."));
				}
		}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
