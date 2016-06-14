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


//Instantiate Functions_Sitesettings Object
$set = new Functions_Sitesettings();

// we check if everything is filled in and perform checks

	//$res = $set->updateSiteSet($_POST['site_name'], $_POST['site_url'], $_POST['admin_email'], $_POST['site_full_name'], $_POST['site_descr'], $_POST['site_address'], $_POST['site_emails'], $_POST['site_phone'], $_POST['records'], $_POST['level_access']);
  $res = $set->updateSiteSet($_POST['site_name'], $_POST['site_url'], $_POST['admin_email'], $_POST['site_full_name'], $_POST['site_descr'], $_POST['site_address'], $_POST['site_emails'], $_POST['site_phone'], $_POST['records']);

		//if successful
		if ($res == 99){
			die(msg(1,"Site Settings Updated Successfully!"));
			}

		//if errors occured
		if($res == 2)
			{
				die(msg(0,"An error occured while updating the site settings. Please contact the site admin."));
			}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
