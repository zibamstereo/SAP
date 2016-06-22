<?php
// 	This is Sales Agent Platform User Login Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."app".DS."Autoloader.php");

//Instantiate Functions_Admin Object
$adm = new Functions_Admin();

$adm->checkAdminLogin('1');

	$id=0;
	if(isset($_POST['id'])){
		if(is_numeric($_POST['id'])){
			$id = strip_tags($_POST['id']);
		}
	}
	
	$action="";
	if(isset($_POST['action'])){
		$action = strip_tags($_POST['action']);
		$action = $adm->secureInput($_POST['action']);
	}
	if($action == "suspend"){
		$res = $adm->adminSuspendUser($id);
		
		if($res == 1){
			echo 'unknown error';
		}
		if($res == 2){
			echo 'no user';
		}
		if($res == 99){
			echo 'success';
		}
	}
	
	if($action == "unsuspend"){
		$res = $adm->adminUnsuspendUser($id);
		
		if($res == 1){
			echo 'unknown error';
		}
		if($res == 2){
			echo 'no user';
		}
		if($res == 99){
			echo 'success';
		}
	}
	
	if($action == "delete"){
		$res = $adm->adminDeleteUser($id);
		
		if($res == 1){
			echo 'unknown error';
		}
		if($res == 2){
			echo 'no user';
		}
		if($res == 99){
			echo 'success';
		}
	}

?>
