<?php

/**
* This Class Functions_Admin is made by Gentle of Infinitelife Inc.
* This class is responsible for all Admin actions
*/


// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// include autoloader
require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."Autoloader.php");


Class Functions_Admin extends Functions_Utility
{
  // ==== If email and password are correct set Admin login sessions=================

  	/**
  	 *	This function is used for admin login, with email and password
  	 *
       * @param 		$email	Email address of the user that wants to login
       * @param 		$pass	The password the user
       * @return 		It redirects to the dashboard
  	 */
	public function adminLogin($email,$pass)
	{
    $email = $this->secureInput($email);
		$pass = $this->secureInput($pass);

    //Encrypt password for database
		$salt1 = 's+(_a*';
		$salt2 = '@-)(%#';
		$pass = md5($salt1.$pass.$salt2);

		$lastLogin = date("l, M j, Y, g:i a");
		$online= 'ON';

		//Use the input username and password and check against 'users' table
		$query = 'SELECT id, email, password, active, level_access,online FROM users WHERE email = "'.$email.'" AND password = "'.$pass.'" AND level_access = 1';

		if($this->resultNum($query) == 1)
		{
			$row = $this->fetchOne($query);
			$update = $this->processSql('UPDATE users SET last_login = "'.$lastLogin.'",online = "'.$online.'" WHERE id = "'.$row['id'].'"');
			if ($row['active'] == 1 ) {
				$this->setAdminLoginSessions( $row['id'], $row['password'] ? TRUE : FALSE );
				if ($row['level_access'] != 1) {
					return 1;
					} else{
					return 99;
				}
			}
			} else {
			return 2;
		}
	}


  /**
	 *	This function Sets Login Sessions
	 *
     * @param 		$userId	the Id of the user as stored in database
     * @param 		$pass	The password the user
     * @return 		It redirects to the dashboard
	 */
	public function setAdminLoginSessions ( $userId, $pass )
	{
		//start the session
		session_start();

		//set the sessions
		$_SESSION['user_id'] = $userId;
		$_SESSION['logged_in'] = TRUE;
	}

    // ==== If email and password are correct set Admin login sessions=================

    //==== Use the to check pages if user have access level to view them====================

    	/**
    	 *	This function Get the level access of the Admin
    	 *
         * @param 		$userId The user the access level is checked on
         * @return 		returns the level access
    	 */

    	public function getAdminLevelAccess ($userId)
    	{
    		$query = "SELECT `level_access` FROM `users` WHERE `id` = '" . 	$this->quote($userId) . "'";
    		if ( $this->resultNum($query) == 1 )
    		{
    			$row = $this->fetchOne($query);
    		}
    		return $row['level_access'];
    	}

    	/**
    	 *	This function Check the level access of the Admin
    	 *
       * @param 		$levels The user levels to determine access level of the user logging in
       * @return 		returns boolean true or false
    	 */
    	public function checkAdminLogin ( $levels )
    	{
    		session_start ();
    		$kt = explode ( ' ', $levels );

    		if ( ! $_SESSION['logged_in'] ) {

    			$access = FALSE;

    			if ( isset ( $_COOKIE['cookie_id'] ) ) {//if we have a cookie

    				$query = 'SELECT * FROM users WHERE id = "'.$this->quote($_COOKIE['cookie_id']).'"';

    				if($this->resultNum($query) == 1)
    				$row = $this->fetchOne($query);

    				if ( $_COOKIE['authenticate'] == md5 ( $this->getIP () . $row['password'] . $_SERVER['USER_AGENT'] ) ) {
    					//we set the sessions so we don't repeat this step over and over again
    					$_SESSION['user_id'] = $row['id'];
    					$_SESSION['logged_in'] = TRUE;

    					//now we check the level access, we might not have the permission
    					if ( in_array ( $this->getAdminLevelAccess( $_SESSION['user_id'] ), $kt ) ) {
    						//we do?! horray!
    						$access = TRUE;
    					}
    				}
    			}
    		}
    		else {
    			$access = FALSE;

    			if ( in_array ( $this->getAdminLevelAccess($_SESSION['user_id']), $kt ) ) {
    				$access = TRUE;
    			}
    		}

    		if ( $access == FALSE ) {
    			header("Location: ".APP_PATH."admin_login.php?returnurl=".base64_encode(urlencode($_SERVER['REQUEST_URI'])));
    		}
    	}

    	//==== Use the to check pages if user have access level to view them====================

      /**
    	 *	This function gets Admin records from the id
    	 *
         * @param 		$id The user id
         * @return 		returns user records
    	 */
    	public function getAdminRecords($id)
    	{

    		$sql = "SELECT * FROM users WHERE id = '". $id . "'";
    		//return $this->fetch($sql);
    		$rows = $this->fetch($sql);
    		$c=0;
    		foreach($rows AS $row){
    		$getuser[$c] = $row;
    		$c++;
    		}
    		return $getuser;
    	}


      /**
       *	This function logs off Admin using admin's id
       *
         * @param 		$id The user id
         * @return 		returns log out the user and set online off
       */
      public function logAdminOff()
      {
        //session must be started before anything
        session_start ();

        // Add the session name user_id to a variable $id
        $id = $_SESSION['user_id'];

        //if we have a valid session
        if ( $_SESSION['logged_in'] == TRUE )
        {
          $lastActive = date("l, M j, Y, g:i a");
          $online= 'OFF';
          $sql = "SELECT id,online, last_active FROM users WHERE id = '".$id."'";
          $res = $this->processSql($sql);
        if ($res){
          $update = "UPDATE users SET online ='".$online."', last_active ='".$lastActive."'  WHERE id = '".$id."'";
          $result = $this->processSql($update);
        }
          //unset the sessions (all of them - array given)
          unset ( $_SESSION );
          //destroy what's left
          session_destroy ();

          header("Location: ".APP_PATH."admin_login");
        }


        		//It is safest to set the cookies with a date that has already expired.
        		if ( isset ( $_COOKIE['cookie_id'] ) && isset ( $_COOKIE['authenticate'] ) ) {
        			/**
        				* uncomment the following line if you wish to remove all cookies
        				* (don't forget to comment or delete the following 2 lines if you decide to use clear_cookies)
        			*/
        			//clear_cookies ();
        			setcookie ( "cookie_id", '', time() - 3600);
        			setcookie ( "authenticate", '', time() - 3600 );
        		}

        	}


    /**
       *  This method  adminEditProfile is used to edit any admin level
       *
       * @param 		$title is the user's title to be edited eg. Mr, Mrs,
       * @param 		$dob is the user's date of birth
       * @param 		$full_name the user's full name
       * @param 		$address the user's address
       * @param 		$city the user's city
       * @param 		$state the user's state
       * @param 		$country the user's country
       * @param 		$phone the user's phone
       * @return 		Returns the random strings
       */
	//function adminEditProfile($id,$title,$full_name,$dob,$gender,$address,$city,$state,$country,$phone)
	public function adminEditProfile($id,$title,$full_name,$dob,$gender,$address,$phone)
	{
    $title = $this->secureInput($title);
    $full_name = $this->secureInput($full_name);
    $dob = $this->secureInput($dob);
    $gender = $this->secureInput($gender);
    $address = $this->secureInput($address);
    //$city = $this->secureInput($city);
    //$state = $this->secureInput($state);
    //$country = $this->secureInput($country);
    $phone = $this->secureInput($phone);

//$sql = "UPDATE users SET title = '" . $title . "', full_name = '" . $full_name . "', dob = '" . $dob . "', gender = '" . $gender . "', address = '" . $address . "', city = '" . $city . "', state = '" . $state . "', country = '" . $country . "', phone = '" . $phone . "' WHERE id = '" . $id . "'";

$sql = "UPDATE users SET title = '" . $title . "', full_name = '" . $full_name . "', dob = '" . $dob . "', gender = '" . $gender . "', address = '" . $address . "', phone = '" . $phone . "' WHERE id = '" . $id . "'";

    	$res = $this->processSql($sql);
			if(!$res) return 4;
			return 99;
	}



    /**
     *  This method  adminUpdatePass is used to change any admin level password and even user password
     *
     * @param 		$uid Admin or user id
     * @param 		$pas Admin Password
     * @return 		Changes the password in the database
     */
	public function adminUpdatePass($uid,$pass)
	{
		$uid = $this->secureInput($uid);
		$pass = $this->secureInput($pass);

                //Encrypt password for database
		$salt1 = 's+(_a*';
		$salt2 = '@-)(%#';
		$new_password = md5($salt1.$pass.$salt2);

		$sql = "UPDATE users SET password = '" . $new_password . "' WHERE id = '" . $uid . "'";
		$res = $this->processSql($sql);
		if($res) return 99;
		return 1;
	}


  /**
     *  This method  adminEditUserProfile is used to edit users in the Admin platform
     *
     * @param 		$title is the user's title to be edited eg. Mr, Mrs,
     * @param 		$dob is the user's date of birth
     * @param 		$full_name the user's full name
     * @param 		$address the user's address
     * @param 		$city the user's city
     * @param 		$state the user's state
     * @param 		$country the user's country
     * @param 		$phone the user's phone
     * @param 		$level_access the user's Access Level
     * @return 		Returns the random strings
     */
  //public function adminEditUser($id,$title,$full_name,$dob,$gender,$address,$city,$state,$country,$phone,$level_access)
  public function adminEditUserProfile($id,$title,$full_name,$dob,$gender,$address,$phone)
  {
    $title = $this->secureInput($title);
    $full_name = $this->secureInput($full_name);
    $dob = $this->secureInput($dob);
    $gender = $this->secureInput($gender);
    $address = $this->secureInput($address);
    //$city = $this->secureInput($city);
    //$state = $this->secureInput($state);
    //$country = $this->secureInput($country);
    $phone = $this->secureInput($phone);

//$sql = "UPDATE users SET title = '" . $title . "', full_name = '" . $full_name . "', dob = '" . $dob . "', gender = '" . $gender . "', address = '" . $address . "', city = '" . $city . "', state = '" . $state . "', country = '" . $country . "', phone = '" . $phone . "', level_access = '" . $level_access . "' WHERE id = '" . $id . "'";

$sql = "UPDATE users SET title = '" . $title . "', full_name = '" . $full_name . "', dob = '" . $dob . "', gender = '" . $gender . "', address = '" . $address . "', phone = '" . $phone . "' WHERE id = '" . $id . "'";

      $res = $this->processSql($sql);
      if(!$res) return 4;
      return 99;
  }



  /**
   *  This method  adminDeleteUser is used to delete user by the Admin
   *
   * @param 		$id  user id of the user to be deleted
   * @return 		Deletes the profile picture first and delete user from the database
   */
	public function adminDeleteUser($id)
	{
    $sql = "SELECT * FROM users WHERE id = '".$id."'";
    $row = $this->fetchOne($sql);

		if ($row){

			// Delete Profile Picure first
			if (!empty($row["thumb_path"]))
			{
				unlink(DASHBOARD.$row["thumb_path"]);
			}

			// Then delete user from the database
			$del = "DELETE FROM users WHERE id = '".$id."'";
			$result = $this->processSql($del);
			if($result)
			return 99;
			return 1;
		} else return 2;
	}

  /**
   *  This method  adminSuspendUser is used to suspend user by the Admin
   *
   * @param 		$id  user id of the user to be suspended
   * @return 		changes user from being active to being suspended in the database
   */
	public function adminSuspendUser($id)
	{
		$sql = "SELECT id,active FROM users WHERE id = '".$id."'";
		$res = $this->processSql($sql);
		if ($res){
			$update = "UPDATE users SET active = 2 WHERE id = '".$id."'";
			$result = $this->processSql($update);
			if ($result)
			return 99;
			return 1;
		} else return 2;
	}


  /**
   *  This method  adminUnsuspendUser is used to unsuspend user by the Admin
   *
   * @param 		$id  user id of the user to be unsuspended
   * @return 		changes user from being suspended to being active in the database
   */
	public function adminUnsuspendUser($id)
	{
		$sql = "SELECT id,active FROM users WHERE id = '".$id."'";
		$res = $this->processSql($sql);
		if ($res){
			$update = "UPDATE users SET active = 1 WHERE id = '".$id."'";
			$result = $this->processSql($update);
			if ($result)
			return 99;
			return 1;
		} else return 2;
	}


            /**
             *	This method allows admin to confirm users from the admin panel
             *
	     * @param 	$id The user id of the user to be activated
	     * @return 	returns log out the user and set online off
		 */
		public function adminConfirmUserReg($id)
		{
			$query = "SELECT id,active,act_key FROM users WHERE id = '".$id."' AND act_key !='' ";

			if($this->resultNum($query)==1)
			{
				$row = $this->fetchOne($query);
				$id = $row['id'];
				if($row['active']==0)
				{
					$update = $this->processSql("UPDATE users SET active=1,act_key='',online='OFF' WHERE id = '".$id."'");
					if($update){
						return 99;
					} else return 1;
				}
				if($row['active']==1)
				{
					return 2;
				}
			}
			else {
				return 3;
			}
		}


   /**
   *  This method  adminShowUserStatus is used to display the active status of the user in the Admin Panel
   *
   * @param 		$id  user id of the user to be shown
   * @return 		Return the text to display for each user status
   */
	public function adminShowUserActiveStatus($id)
	{
		$sql = "SELECT id,active FROM users WHERE id = '".$id."'";
		$row = $this->fetchOne($sql);
                if($row['active'] == 0){$active = "<em><span style='color:#f40000;'>Not Confirmed</span></em>";}
		if($row['active'] == 1){$active = "<em><span style='color:#008040;'>Active</span></em>";}
		if($row['active'] == 2){$active = "<em><span style='color:#DB7093;'>Suspended</span></em>";}
                return $active;

	}


      /**
   *  This method  adminShowUserOnlineStatus is used to display the online status of the user in the Admin Panel
   *
   * @param 		$id  user id of the user to be shown
   * @return 		Return the text to display for each user status
   */
	public function adminShowUserOnlineStatus($id)
	{
		$sql = "SELECT id,online FROM users WHERE id = '".$id."'";
		$row = $this->fetchOne($sql);
                if($row['online'] == "ON"){$online = "<span style='color:#008040;'>Online</span>";}
		if($row['online'] == "OFF" || $row['online'] == "0"){$online = "<span style='color:#B2BEB5;'>Offline</span>";}
                return $online;

	}


  /**
   *  This method  contactUs is used to recieve contact messages from the custmers
   *
   * @param 		$full_name  The name of the potential customer or current customer
   * @param 		$email  The email of the potential customer or current customer
   * @param 		$phone  The phone number of the potential customer or current customer
   * @param 		$subject  The subject of the intent or message
   * @param 		$message  The body of the message itself
   * @param 		$site_email  The organisation email the message is to be sent to
   * @return 		changes user from being suspended to being active in the database
   */
        public function contactUs($full_name,$email,$phone,$subject,$message,$site_email)
	{
		$full_name = $this->secureInput($full_name);
		$email = $this->secureInput($email);
		$phone = $this->secureInput($phone);
		$subject = $this->secureInput($subject);
		$message = $this->secureInput($message);
		$site_email = $this->secureInput($site_email);

		$contact_date = date("l, M j, Y, g:i a");

		$sql = "INSERT INTO contact_us ( full_name, email, phone, subject, message, reply,contact_date)
                        VALUES ('".$full_name."','".$email."','".$phone."', '".$subject."','".$message."','','".$contact_date."')";
		$res = $this->processSql($sql);
		if($res){
			//build email to be sent
			$to = $site_email;
			$subject = "New message from ".$email;

			$admin_message = "
			<html>
			<head>
			<title>New message from".$full_name."</title>
			</head>
			<body>
			<h3>Query / Comment</h3>
			<p>Hello Site Admin, ".$full_name." has sent a query/message. It is as below:</p>
			<p>".$message."</p>
			</body>
			</html>
			";

			// To send HTML mail, the Content-type header must be set
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: '".$full_name."'<".$email.">" . "\r\n";//Modified By GENTLE to show the FROM in the message

			$mail_send = mail($to, $subject, $admin_message, $headers );
			if ($mail_send):
			return 99;
                        else:
                            return 2;
                        endif;
			}else{
			return 1;
		}
	}

  /**
   * 	This is used to get the contact message sent by the user
   * 	@param  $id the mesaage id
   * 	@return it shows all the messages
   */
	public function contactInfo($id)
	{
		$sql = "SELECT * FROM contact_us WHERE id = '". $id . "'";
		//return $this->fetch($sql);
    $rows = $this->fetch($sql);
    $c=0;
    foreach($rows AS $row){
    $contactinfo[$c] = $row;
    $c++;
    }
    return $contactinfo;
	}
        
        
    
  /**
   * 	This is used to get Access Control Level and edit them
   * 	@param  $acl means access control level
   * 	@return it returns the select form with acl ids 
   */
	public function getAclId()
	{
	$sql = "SELECT * FROM acl WHERE id != 1 ";
    $rows = $this->fetch($sql);
    $acl = '<select name="acl_id">
           <option value="">ACL IDs</option>';
    foreach($rows AS $row){
    $acl .= "<option value=".$row['acl_id'].">".$row['acl_id']."</option>";
    }
    $acl .= '</select>';
    return $acl;
	}
        
        
     /**
   * 	This is used to process the access control level
   * 	@param  $acl_id the id of the access control level to process
   * 	@param  $acl_name the name of the access control level to process
   * 	@return it processes and store the access control level into the database
   */
	public function processAcl($acl_id,$acl_name)
	{
	$sql = "UPDATE acl SET acl_name='$acl_name' WHERE id = $acl_id ";
        $result = $this->processSql($sql);
			
        return $result ? 99 :  1;
       
        }

}
?>
