<?php
// 	This is Sales Agent Platform User Login Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."app".DS."Autoloader.php");

//Instantiate Functions_Admin Object
$adm = new Functions_Admin();

//Instantiate Functions_Sitesettings Object
$set = new Functions_Sitesettings();

// Store the method getSiteSettings in a variable called $setting
$config = $set->getSiteSettings();

// get the email from the site settings and store it in the variable called $site_email
$site_email = $config[0]['admin_email'];

	// we check if everything is filled in and perform checks
	$find = "/(content-type|bcc:|cc:)/i";
	
	if(!$_POST['full_name'])
	{
		die(msg(0,"Names field empty!"));
	}
	
	elseif(preg_match($find, $_POST['full_name'])){
		die(msg(0,"Invalid name characters!"));
	}

	elseif(!$_POST['email'] || !$adm->validateEmail($_POST['email']) || preg_match($find, $_POST['email']))
	{
		die(msg(0,"Invalid email!"));
	}
	elseif(!$_POST['phone'] || !$adm->validatePhone($_POST['phone']))
	{
		die(msg(0,"Phone number must be numeric of 7 or 10 digits."));
	}
        elseif(!$_POST['subject'] || preg_match($find, $_POST['subject']))
	{
		die(msg(0,"Invalid subject!"));
	}
	elseif(!$_POST['message'])
	{
		die(msg(0,"QMessage field is empty!"));
	}
	
	elseif(preg_match($find, $_POST['message']) || strpos($_POST['message'], "&") !== false || strlen(strip_tags($_POST['message'])) < strlen($_POST['message']))
	{
		die(msg(0,"Invalid message characters!"));
	}
	else
		{
		$res = $adm->contactUs($_POST['full_name'],$_POST['email'],$_POST['phone'],$_POST['subject'],$_POST['message'],$site_email);
				if ($res == 1){
					die(msg(0,"Cannot store data in the database. Please try again."));
				}
                                if ($res == 2){
					die(msg(0,"A problem occured sending your question/comment. Please try again."));
				}
				if ($res == 99){
					die(msg(1,"<H3>Thank you for your inquiry/comment.</H3> We will reply to you as soon as possible."));
				}
		}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
