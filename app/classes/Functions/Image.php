<?php

/**
* This Class Functions_Image is made by Gentle of Infinitelife Inc.
* This class is responsible for adding into db, compresssing, showing users profile picture
*/


// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// include autoloader
require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."Autoloader.php");

// Create class Functions_SiteSettings etending Functions_Utility
//
Class Functions_Image extends Functions_Utility
{

    // Class Construct
        public function __construct()
    {
        parent::__construct();
    }

      /**
       *	This function Checks image size
       *
         * @param 		$tmpfile	The pictre temporal file before moved into folder
         * @param 		$max	The maximum file size required
         * @return 		Returns boolean true if the file is bigger than required or false if its not
       */

    	public function checkImageSize($tmpfile, $max)
    	{
    		//check the tmpimage file size and see if it is to big returns true if to large
    		$size = filesize($tmpfile);
    		if ($size > $max)
    		return true;
    		return false;
    	}

      /**
       *	This function Checks for allowed extension
       *
         * @param 		$file	The pictre file that carries the extention to be verified
         * @return 		Returns boolean true if the extension is allowed or false if its not
       */
    	public function checkAllowedExt($file)
    	{
    		$temp = strtolower($file);
    		$ext = pathinfo($temp, PATHINFO_EXTENSION);
    		$allowed = array('gif', 'jpg', 'jpeg', 'png');
    		if (!in_array($ext, $allowed))
    		return true;
    		return false;
    	}

       /**
        *	This function Opens image file and create a new image from the file
        *
        * @param 		$file	The pictre file that another image will be created from
        * @return 		Returns the new image created if successful and boolean false if not
        */
    public function openImage($file)
    	{
    		// Get extension and return it
    		$ext = pathinfo($file, PATHINFO_EXTENSION);
    		switch(strtolower($ext)) {
    			case 'jpg':
    			case 'jpeg':
    			$im = @imagecreatefromjpeg($file);
    			break;
    			case 'gif':
    			$im = @imagecreatefromgif($file);
    			break;
    			case 'png':
    			$im = @imagecreatefrompng($file);
    			break;
    			default:
    			$im = false;
    			break;
    		}
    		return $im;
    	}


      /**
       *	This function Creates thumbnail image for user
       *
       * @param 		$file	The pictre file from which thumbnail image will be created from
       * @param 		$ext	The exension of the picture
       * @param 		$width	The width of the picture
       * @return 		Returns the thumbnail image created if successful and boolean false if not
       */
    	public function createThumb($file, $ext, $width)
    	{
    		$im = '';
    		$im = $this->openImage($file);

    		if (empty($im)) {
    			return false;
    		}

    		$old_x = imagesx($im);
    		$old_y = imagesy($im);

    		$new_w = (int)$width;

    		if (($new_w <= 0) or ($new_w > $old_x)) {
    			$new_w = $old_x;
    		}

    		$new_h = ($old_x * ($new_w / $old_x));

    		if ($old_x > $old_y) {
    			$thumb_w = $new_w;
    			$thumb_h = $old_y * ($new_h / $old_x);
    		}
    		if ($old_x < $old_y) {
    			$thumb_w = $old_x * ($new_w / $old_y);
    			$thumb_h = $new_h;
    		}
    		if ($old_x == $old_y) {
    			$thumb_w = $new_w;
    			$thumb_h = $new_h;
    		}

    		$thumb = imagecreatetruecolor($thumb_w,$thumb_h);

    		if ($ext == 'png') {
    			imagealphablending($thumb, false);
    			$colorTransparent = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
    			imagefill($thumb, 0, 0, $colorTransparent);
    			imagesavealpha($thumb, true);
    			} elseif ($ext == 'gif') {
    			$trnprt_indx = imagecolortransparent($im);
    			if ($trnprt_indx >= 0) {
    				//its transparent
    				$trnprt_color = imagecolorsforindex($im, $trnprt_indx);
    				$trnprt_indx = imagecolorallocate($thumb, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
    				imagefill($thumb, 0, 0, $trnprt_indx);
    				imagecolortransparent($thumb, $trnprt_indx);
    			}
    		}

    		imagecopyresampled($thumb,$im,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);

    		//choose which image program to use
    		switch(strtolower($ext)) {
    			case 'jpg':
    			case 'jpeg':
    			imagejpeg($thumb,$file);
    			break;
    			case 'gif':
    			imagegif($thumb,$file);
    			break;
    			case 'png':
    			imagepng($thumb,$file);
    			break;
    			default:
    			return false;
    			break;
    		}

    		imagedestroy($im);
    		imagedestroy($thumb);
    	}

      /**
       *	This function Moves uploaded image file via normal php function move_uploaded_file with some modifications
       *
       * @param 		$path	The path to where the image is to be moved to
       * @param 		$file	The name to give the image file when moved successfully
       * @param 		$tmpfile	The temporal image file path
       * @param 		$max	The maximum size of the image file uploaded
       * @return 		Saves the uploaded image if successful or returns boolean false if not
       */
    public function moveUploadImage($path, $file, $tmpfile, $max)
    	{
    		//upload your image and give it a random name so no conflicts occur
    		$rand = rand(1000,9000);
    		$save_path = $path . $rand ."_". $file;

    		//prep file for db and gd manipulation
    		$bad_char_arr = array(' ', '&', '(', ')', '*', '[', ']', '<', '>', '{', '}');
    		$replace_char_arr = array('-', '_', '', '', '', '', '', '', '', '', '');
    		$db_data   = str_replace($bad_char_arr, $replace_char_arr, $save_path);
    		$save_path = ROOT_PATH.DASHBOARD_DIR.DS.str_replace($bad_char_arr, $replace_char_arr, $save_path);

    		//move the temp file to the proper place
    		if (move_uploaded_file($tmpfile, $save_path)) {
    			$ext = pathinfo($save_path, PATHINFO_EXTENSION);
    			$base = pathinfo($save_path, PATHINFO_FILENAME);
    			$dir = pathinfo($save_path, PATHINFO_DIRNAME);
    			$base_path = "$dir/$base";

    			copy($save_path, "$base_path" . "_thumb" . "." . "$ext");
    			$this->createThumb("$base_path" . "_thumb" . "." . "$ext", $ext, 150);
    			$this->createThumb("$base_path" . "." . "$ext", $ext, 640);

            //For Prod
    		    //chmod("$base_path" . "_thumb" . "." . "$ext", 0644);
    			  //chmod("$base_path" . "." . "$ext", 0644);
    			  //For Dev
            chmod("$base_path" . "_thumb" . "." . "$ext", 0777);
    			  chmod("$base_path" . "." . "$ext", 0777);
    			return $db_data;
    		}
    		unlink($tmpfile);
    		return false;
    	}

      /**
       *	This function is used to Upload User Image
       *
       * @param 		$path	The path to where the image is to be uploaded
       * @param 		$file	The name to give the image file when uploaded successfully
       * @param 		$tmpfile	The temporal image file path
       * @param 		$max	The maximum size of the image file uploaded
       * @param 		$id	User Id of the user who owns the image
       * @return 		Saves the image file into the database if successful or give error if not
       */
    	public function uploadUserImage($path, $file, $tmpfile, $max, $id)
    	{
    		$id = $this->secureInput($id);

    		if (empty($file))
    		return 1;
    		if (!getimagesize($tmpfile))
    		return false;
    		if ($this->checkImageSize($tmpfile, $max))
    		return 2;
    		if ($this->checkAllowedExt($file))
    		return 3;

    		$save_path = $this->moveUploadImage($path, $file, $tmpfile, $max);
    		if (!empty($save_path)) {
    			$ext = pathinfo($save_path, PATHINFO_EXTENSION);
    			$base = pathinfo($save_path, PATHINFO_FILENAME);
    			$dir = pathinfo($save_path, PATHINFO_DIRNAME);
    			$base_path = "$dir/$base";

    			$save_thumb_path = "$base_path" . "_thumb" . "." . "$ext";
    			//Uncomment the "unlink($save_path);" if you don't want the original pictures to be uploaded but if you want both original and thumb pictures to be uploaded then comment it
    			unlink(ROOT_PATH.DASHBOARD_DIR.DS.$save_path);

    			$sql = "UPDATE users SET thumb_path = '" . $save_thumb_path . "', img_path = '" . $save_path . "' WHERE id = '".$id."'";
    			$res = $this->processSql($sql);
    			if($res){return 99;} else {return 4;}
    		} else {return 5;}
    	}

      /**
       *	This function is used to Update User Image
       *
       * @param 		$path	The path to where the image is to be updated
       * @param 		$file	The name to give the image file when updated successfully
       * @param 		$tmpfile	The temporal image file path
       * @param 		$max	The maximum size of the image file updated
       * @param 		$id	User Id of the user who owns the image
       * @return 		Modifies the image data in the database if successful or give error if not
       */
    public function updateUserImage($path, $file, $tmpfile, $max, $id)
    	{
    		$id = $this->secureInput($id);

    		if (empty($file))
    		return 1;
    		if (!getimagesize($tmpfile))
    		return false;
    		if ($this->checkImageSize($tmpfile, $max))
    		return 2;
    		if ($this->checkAllowedExt($file))
    		return 3;

    		//look up old image path then remove the file before preceding with the new image upload
    		$sql = "SELECT thumb_path,img_path FROM users WHERE id = '" . $id . "'";
    		$row = $this->fetchOne($sql);
    		$del = $row["thumb_path"];
    		$delg = $row["img_path"];

    		if (!empty($del)) {
    			$dir = pathinfo($del, PATHINFO_DIRNAME);
    			$ext = pathinfo($del, PATHINFO_EXTENSION);
    			$base = pathinfo($del, PATHINFO_FILENAME);
    			$base_path = "$dir/$base";

    			@unlink(ROOT_PATH.DASHBOARD_DIR.DS."$del");
    			@unlink(ROOT_PATH.DASHBOARD_DIR.DS."$base_path" . "_thumb" . "." . "$ext");
    		}

    		if (!empty($delg)) {
    			$dirg = pathinfo($delg, PATHINFO_DIRNAME);
    			$extg = pathinfo($delg, PATHINFO_EXTENSION);
    			$baseg = pathinfo($delg, PATHINFO_FILENAME);
    			$gbase_path = "$dirg/$baseg";

    			@unlink(ROOT_PATH.DASHBOARD_DIR.DS."$delg");
    			@unlink(ROOT_PATH.DASHBOARD_DIR.DS."$gbase_path" . "." . "$extg");
    		}

    		$save_path = $this->moveUploadImage($path, $file, $tmpfile, $max, $id);
    		if (!empty($save_path)) {
    			$ext = pathinfo($save_path, PATHINFO_EXTENSION);
    			$base = pathinfo($save_path, PATHINFO_FILENAME);
    			$dir = pathinfo($save_path, PATHINFO_DIRNAME);
    			$base_path = "$dir/$base";

    			$save_thumb_path = "$base_path" . "_thumb" . "." . "$ext";
    			//Uncomment the "unlink($save_path);" if you don't want the original pictures to be uploaded but if you want both original and thumb pictures to be uploaded then comment it
    			unlink(ROOT_PATH.DASHBOARD_DIR.DS.$save_path);

    			$sql = "UPDATE users SET thumb_path = '" . $save_thumb_path . "', img_path = '" . $save_path . "' WHERE id = '" . $id . "'";
    			$res = $this->processSql($sql);
    		}
    		if ($res)
    		return 99;
    		return 4;
    	}

      /**
       *	This function is used to Delete User Image
       *
       * @param 		$id	User Id of the user who owns the image
       * @return 		Deletes the image data in the database if successful or give error if not
       */
    	public function deleteImage($id)
    	{
    		$id = $this->secureInput($id);

    		//look up old image path and remove image from image folder
    		$sql = "SELECT thumb_path,img_path FROM users WHERE id = '" . $id . "'";
    		$row = $tjis>fetchOne($sql);
    		$del = $row["thumb_path"];
    		$delg = $row["img_path"];

    		if (!empty($del)) {
    			$dir = pathinfo($del, PATHINFO_DIRNAME);
    			$ext = pathinfo($del, PATHINFO_EXTENSION);
    			$base = pathinfo($del, PATHINFO_FILENAME);
    			$base_path = "$dir/$base";

    			unlink("$base_path" . "." . "$ext");
    		}

    		if (!empty($delg)) {
    			$dirg = pathinfo($delg, PATHINFO_DIRNAME);
    			$extg = pathinfo($delg, PATHINFO_EXTENSION);
    			$baseg = pathinfo($delg, PATHINFO_FILENAME);
    			$gbase_path = "$dirg/$baseg";

    			//unlink("$gbase_path" . "." . "$extg");	// I Gentle purposely commented this line because of the jquery ajax request I made for users and moderators to delete their photos, it gives error since there was no img_path photo in the folder
    		}

    		$sql = "UPDATE users SET thumb_path = '', img_path = '' WHERE id = '" . $id . "'";
    		$res = $this->processSql($sql);
    		if ($res){return 99;} else {return 1;}
    	}

      /**
       *	This function displayProfilePicture is used to display user image anywhere
       *
       * @param 		$id	User Id of the user who owns the image
       * @param 		$w	The width size of the image
       * @param 		$h	The height size of the image
       * @return 		Shows image if successful
       */
    public function displayProfilePicture($id,$w='', $h='')
    	{
    		$sql = "SELECT thumb_path FROM users WHERE id = '".$id."'";
    		$row = $this->fetchOne($sql);
    		$w = !empty($w) ? $w : 150;
    		$h = !empty($h) ? $h : 150;
    		if (!empty($row['thumb_path'])){
          return $this->addFile('Img',DASHBOARD.$row["thumb_path"], $w, $h, '', '', '', '');
    			} else {
    			//display a default image if user image does not exist
          return $this->addFile('Img',USER_URL. "profile_pic/no_image.jpg", $w, $h, '', '', '', '');
    		}
    	}



}

?>
