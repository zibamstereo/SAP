<?php
// 	This is Sales Agent Platform User Login Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."app".DS."Autoloader.php");

//Instantiate Functions_Admin Object
$adm = new Functions_Admin();


//Instantiate Functions_Image Object
$img = new Functions_Image();

$adm->checkAdminLogin('1');
/*
$id = isset($_REQUEST['id']) && is_numeric($_REQUEST['id']) ? $usr->secureInput($_REQUEST['id']) : '';

	$action = isset($_REQUEST['action']) ? strip_tags($_REQUEST['action']): '';

  if ($action == 'delete'){
		$res = $img->deleteImage($id);
		//if successful
		if ($res == 99){
			echo 'success';
		}
		if ($res == 1){
			echo 'fail';
		}
	}
*/
############ Configuration ##############
$id = !empty($_POST['id']) ? $_POST['id'] :"";
$max_image_size  = 	100000;
$imgpth = "admin".DS."profile_pic".DS;
############ Configuration ##############

  if (array_key_exists('uploadphoto', $_POST)) {
		$res = $img->uploadUserImage($imgpth, $_FILES["picture"]["name"], $_FILES["picture"]["tmp_name"], $max_image_size , $id);

		if ($res == 99) {
      die(msg(1,"<i class='fa fa-info-circle'></i>Photo Uploaded Successfully."));
			} elseif ($res == 1) {
      die(msg(0,"<i class='fa fa-info-circle'></i>Image field empty!"));
			} elseif ($res == 2) {
      die(msg(0,"<i class='fa fa-info-circle'></i>Your image has exceeded the 100kb size limit required. Please select a smaller image file.."));
			} elseif ($res == 3) {
      die(msg(0,"<i class='fa fa-info-circle'></i>Unknown image extension. Images must be in jpg, jpeg, gif or png formats"));
			} elseif ($res == 4) {
      die(msg(0,"<i class='fa fa-info-circle'></i>Unable to save image. Please try again, or contact the Site Administrator."));
			} elseif ($res == 5) {
      die(msg(0,"<i class='fa fa-info-circle'></i>Unable to save image. Please try again, or contact the Site Administrator."));
			} else {
      die(msg(0,"<i class='fa fa-info-circle'></i>There was an error uploading your image. Please try again.."));
		}
	}

	if (array_key_exists('updatephoto', $_POST)) {
		$res = $img->updateUserImage($imgpth, $_FILES["picture"]["name"], $_FILES["picture"]["tmp_name"],$max_image_size , $id);

		if ($res == 99) {
      die(msg(1,"<i class='fa fa-info-circle'></i>Photo Updated Successfully."));
			} elseif ($res == 1) {
      die(msg(0,"<i class='fa fa-info-circle'></i>Image field empty!"));
			} elseif ($res == 2) {
      die(msg(0,"<i class='fa fa-info-circle'></i>Unknown image extension. Images must be in jpg, jpeg, gif or png formats"));
			} elseif ($res == 3) {
      die(msg(0,"<i class='fa fa-info-circle'></i>Your image has exceeded the 100kb size limit required. Please select a smaller image file.."));
			} elseif ($res == 4) {
      die(msg(0,"<i class='fa fa-info-circle'></i>Unable to update image. Please try again, or contact the Site Administrator."));
			} else {
      die(msg(0,"<i class='fa fa-info-circle'></i>There was an error updating your image. Please try again.."));
		}
	}


	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}
?>
