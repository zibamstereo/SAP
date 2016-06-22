<?php
// 	This is Sales Agent Platform User Login Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."app".DS."Autoloader.php");

//Instantiate Functions_Admin Object
$adm = new Functions_Admin();

$adm->checkAdminLogin('1');
// we check if everything is filled in and perform checks
  if(empty($_POST['title'])){
    	die(msg(0,"Please Choose title.",""));
  }
  elseif(empty($_POST['full_name']))
  {
    die(msg(0,"Please Enter Your Full Name.",""));
  }
  elseif(empty($_POST['dob']))
  {
    die(msg(0,"Please Date of Birth.",""));
  }
  elseif(empty($_POST['gender']))
  {
    die(msg(0,"Please Choose Gender.",""));
  }
  elseif(empty($_POST['address']))
  {
    die(msg(0,"Please Enter Your Full Address.",""));
  }
  elseif(empty($_POST['phone']))
  {
    die(msg(0,"Please Enter Your Phone Number.",""));
  }
	elseif(!$adm->validatePhone($_POST['phone']))
		{
			die(msg(0,"Phone numbers must be 7 or 10 or 11 digits.",""));
		}else{
		//$res = $adm->editProfile( $_SESSION['user_id'], $_POST['title'], $_POST['full_name'], $_POST['dob'], $_POST['gender'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['phone']);
	$res = $adm->adminEditUserProfile( $_POST['id'], $_POST['title'], $_POST['full_name'], $_POST['dob'], $_POST['gender'], $_POST['address'], $_POST['phone'] );

			if($res == 4){
				die(msg(0,"An internal error has occured. Please contact the site admin!",""));
			}
			if($res == 99){
				die(msg(1,"Profile Updated Successfully!",""));
			}
    }

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}
?>
