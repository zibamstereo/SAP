<?php
// 	This is Sales Agent Platform User Login Processing Page Created By Ogunyemi Oludayo (Gentle) of Infinitelife Inc

// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

//include DBFunc and config.php via Autoloader
 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS."..".DS).DS."app".DS."Autoloader.php");

//Instantiate Functions_User Object
$usr = new Functions_User();

$usr->checkUserLogin('9');

$id = isset($_REQUEST['id']) && is_numeric($_REQUEST['id']) ? $usr->secureInput($_REQUEST['id']) : '';

	$action = isset($_REQUEST['action']) ? strip_tags($_REQUEST['action']): '';

  if ($action == 'delete'){
		$res = $usr->deleteImage($id);
		//if successful
		if ($res == 99){
			echo 'success';
		}
		if ($res == 1){
			echo 'fail';
		}
	}

  if (array_key_exists('addphoto', $_POST)) {
		$id = $_POST['id'];
		$imgpth = "profile_pic/";
		$res = $usr->uploadUserImage($imgpth, $_FILES["picture"]["name"], $_FILES["picture"]["tmp_name"], $_POST["max"], $_POST['id']);

		if ($res == 99) {
			header("Location: upload_photo.php?id=$id&message=Photo Uploaded Successfully.");
			} elseif ($res == 1) {
			header("Location: upload_photo.php?id=$id&error=Image field empty!");
			} elseif ($res == 2) {
			header("Location: upload_photo.php?id=$id&error=Your image has exceeded the 100kb size limit required. Please select a smaller image file.");
			} elseif ($res == 3) {
			header("Location: upload_photo.php?id=$id&error=Unknown image extension. Images must be in jpg, jpeg, gif or png formats.");
			} elseif ($res == 4) {
			header("Location: upload_photo.php?id=$id&error=Unable to save image file. Please try again or contact Site Admin.");
			} elseif ($res == 5) {
			header("Location: upload_photo.php?id=$id&error=Unable to save image file. Please try again or contact Site Admin.");
			} else {
			header("Location: upload_photo.php?id=$id&error=There was an error uploading your image. Please try again.");
		}
	}

	if (array_key_exists('updatephoto', $_POST)) {
		$id = $_POST['id'];
		$imgpth = "profile_pic/";
		$res = $usr->updateUserImage($imgpth, $_FILES["picture"]["name"], $_FILES["picture"]["tmp_name"], $_POST["max"], $_POST['id']);

		if ($res == 99) {
			header("Location: update_photo.php?id=$id&message=Photo Updated Successfully.");
			} elseif ($res == 1) {
			header("Location: update_photo.php?id=$id&error=Image field empty!");
			} elseif ($res == 2) {
			header("Location: update_photo.php?id=$id&error=Unknown image extension. Images must be in jpg, jpeg, gif or png formats.");
			} elseif ($res == 3) {
			header("Location: update_photo.php?id=$id&error=Your image has exceeded the 100kb size limit required. Please select a smaller image file.");
			} elseif ($res == 4) {
			header("Location: update_photo.php?id=$id&error=Unable to update image. Please try again, or contact the Site Administrator.");
			} else {
			header("Location: update_photo.php?id=$id&error=There was an error uploading your image. Please try again.");
		}
	}


	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}
?>
