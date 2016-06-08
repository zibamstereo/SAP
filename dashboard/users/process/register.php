<?php
// 	This is Sales Agent Platform User Registration Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."Autoloader.php");
 //Instantiate Db_DBFunc Object
//$db = new Db_DBFunc();

//Instantiate Functions_Utility  and Functions_SiteSettings Object
$usr = new Functions_User();
$set = new Functions_Sitesettings();


// Get thr site setting methods
$sitesettings = $set->getSiteSettings();
$site_url = $sitesettings[0]['site_url'];

	$level = !empty($_POST['level_access']) ? $_POST['level_access'] : 9 ;
	//For registration

	// we check if everything is filled in and perform checks

	/*if(!$_POST['username'])
	{
		die(msg(0,"Please enter a username."));
	}

	if(strlen($_POST['username'])<3 || strlen($_POST['username'])>15)
	{
		die(msg(0,"Username must be between 3 and 15 characters."));
	}

	elseif(uniqueUser($_POST['username']))
	{
		die(msg(0,"Username already taken."));
	}*/


	if(!$_POST['full_name'])
	{
		die(msg(0,"Please enter your full name","full_name"));
	}
	elseif(!$_POST['address'])
	{
		die(msg(0,"Please enter your full address.","address"));
	}
	elseif(!$_POST['phone'])
	{
		die(msg(0,"Please enter phone.","phone"));
	}
	elseif(!$_POST['email'])
	{
		die(msg(0,"Please enter an email address.","email"));
	}

	elseif(!$usr->validateEmail($_POST['email']))
	{
		die(msg(0,"Invalid email address.","email"));
	}

	elseif($usr->uniqueEmail($_POST['email']))
	{
		die(msg(0,"Email taken. create another email address.", "email"));
	}
	elseif(!$_POST['password'])
	{
		die(msg(0,"Please enter a password.", "password"));
	}
	elseif(strlen($_POST['password'])<5)
	{
		die(msg(0,"Password must be atleast 5 characters.", "password"));
	}
	elseif($_POST['password'] !== $_POST['cpassword'])
	{
		die(msg(0,"Password must match.", "cpassword"));
	}
	/*elseif(empty($_POST['answer']))
	{
		die(msg(0,"Captcha code not entered!"));
	}
	elseif(!PhpCaptcha::Validate($_POST['answer']))
	{
		die(msg(0,"Invalid Captcha Code!"));
	}*/

	else
		{
			$res = $usr->addUser(
			$_POST['email'],
			$_POST['password'],
			$_POST['full_name'],
			$_POST['address'],
			$_POST['phone'],
			$level,
			$site_url
			);
				if ($res == 1){
					die(msg(0,"Failed to send activation email. Please contact the site admin.",""));
				}
				if ($res == 2){
					die(msg(0,"There was an error registering your details. Please contact the site admin.",""));
				}
				if ($res == 99){
					echo(msg(1,"You have been succefully registered as a Sales Agent in Ajebom Market Ltd.<br/> Go to your inbox and activate your accout.",""));
				}
		}

	function msg($status,$txt,$txt2)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'","txt2":"'.$txt2.'"}';
	}



?>