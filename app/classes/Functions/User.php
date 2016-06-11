<?php

/**
* This Class Functions_User is made by Gentle of Infinitelife Inc.
* This class is responsible for adding users and editting users
*/


// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// include autoloader
require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."Autoloader.php");


Class Functions_User extends Functions_Utility
{



	//---------checks if record stored in db already exists or not--------
	/**
     *  Check if username already exist
     *
     * @param 		$user The username in check
     * @return 		Returns boolean true if it exist and false if not
     */
	public function uniqueUser($user)
	{
		$user = $this->secureInput($user);
		$sql = "SELECT username FROM users WHERE username = '" . $user ."' ";
		$num = $this->resultNum($sql);  // Method gotten from DBFunc

		if ($num > 0){
			return true;
		}else{
			return false;
		}
	}

	/**
     *  Check if user email already exist
     *
     * @param 		$email The user email in check
     * @return 		Returns boolean true if it exist and false if not
     */
	public function uniqueEmail($email)
	{
		$email = $this->secureInput($email);
		$sql = "SELECT email FROM users WHERE email = '" . $email ."' ";
		$num = $this->resultNum($sql);  // Method gotten from DBFunc

		if ($num > 0){
			return true;
		}else{
			return false;
		}
	}


	/**
     *  Function for checking existence of users
     *
     * @param 		$id The id of the user info in check
     * @return 		Returns boolean false if it exist and true if not
     */
	public function checkUserInfo($id)
	{
		$id = $this->secureInput($id);

		$sql = "SELECT id FROM users WHERE id='".$id."'";
		$num = $this->resultNum($sql);  // Method gotten from DBFunc

		if ($num == 0){
			return true;
		}else{
			return false;
		}
	}



	/**
     *  This method  addUser is used to add users to the platform
     *
     * @param 		$email is the user's email which is going to be used as the username
     * @param 		$password the user's password for authentication
     * @param 		$full_name the user's full name
     * @param 		$address the user's address
     * @param 		$city the user's city
     * @param 		$state the user's state
     * @param 		$country the user's country
     * @param 		$phone the user's phone
     * @param 		$level_access the user's Access Level
     * @param 		$site_url the URL of the address in used
     * @return 		Returns the random strings
     */
	//public function addUser($email,$password,$full_name,$address,$phone,$city,$state,$country,$level_access, $site_url)//Edit 1
	public function addUser($email,$pass,$full_name,$address,$phone,$level_access, $site_url)//Edit 1
	{
		// sanitize the user inputs with the method secureInput made in class Functions_Utility
		$email = $this->secureInput($email);
		$pass = $this->secureInput($pass);
		$full_name = $this->secureInput($full_name);
		$address = $this->secureInput($address);
		//$city = $this->secureInput($city);
		//$state = $this->secureInput($state);
		//$country = $this->secureInput($country);
		$phone = $this->secureInput($phone);

		//Encrypt password for database
		$salt1 = 's+(_a*';
		$salt2 = '@-)(%#';
		$pass = md5($salt1.$pass.$salt2);

		$rand_str = $this->random_string('alnum', 8);
		$activation_key = md5($salt1.$rand_str.$salt2);

		$reg_date = date("l, M j, Y, g:i a");

		/*$sql = "INSERT INTO users (email,password,full_name,address,city,state,country,phone,active,level_access,act_key,reg_date)
		VALUES ('".$email."','".$pass."','".$full_name."','".$address."','".$city."','".$state."','".$country."','".$phone."',0,'".$level_access."','".$activation_key."','".$reg_date."')"; */

		$sql = "INSERT INTO users (email,password,full_name,address,phone,active,level_access,act_key,reg_date)
		VALUES ('".$email."','".$pass."','".$full_name."','".$address."','".$phone."', 0,'".$level_access."','".$activation_key."','".$reg_date."')";

		$res = $this->processSql($sql);
		if($res){
			//build email to be sent
			$to = $email;
			$subject = $site_url;
			$subject .= ": Activate Your Account";

			$message = "
			<html>
			<head>
			<title>Account Activation</title>
			</head>
			<body>
			<h3>Account Activation</h3>
			<p>Dear ".$full_name.", thank you for registering at ".$site_url.".</p>
			<p>Please click on the link below to activate your account:</p>
			<a href='".$site_url."/confirm_user_reg.php?activation_key=".$activation_key."&level_access=".$level_access."'>http://www.".$site_url."</a>.
			<p>If the above link does not work, copy and paste the below URL to your browser's address bar:</p>
			<p><i>http://".$site_url."/confirm_user_reg.php?activation_key=".$activation_key."&level_access=".$level_access."</i></p><br/>
			<p>If you did not initiate this request, simply disregard this email, and we're sorry for bothering you.</p>
			<br/><br/>
			<p>Sincerely,</p>
			<p>The ".$site_url." Team.</p>
			</body>
			</html>
			";

			// To send HTML mail, the Content-type header must be set
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: SITE NAME<yourname@yoursite.com>" . "\r\n";//Modified By GENTLE to show the FROM in the message

			if($mail_send = mail($email, $subject, $message, $headers)) {
				return 99;
			}return 1;
		}else return 2;

	}


		/**
		 *	This function confirms user through email submitted
		 *
	     * @param 		$activation_key The activation key for activation
	     * @return 		returns log out the user and set online off
		 */
		public function confirm_user_reg($activation_key)
		{
			$activation_key = $this->quote($activation_key);

			$query = "SELECT id,active,act_key FROM users WHERE act_key = '".$activation_key."'";

			if($this->resultNum($query)==1)
			{
				$row = $this->fetchOne($query);
				$id = $row['id'];
				if($row['active']==0)
				{
					$update = $this->processSql("UPDATE users SET active=1,act_key='' WHERE id = '".$id."'");
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
     *  This method  editUser is used to edit users in the platform
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
	//public function editProfile($id,$title,$full_name,$dob,$gender,$address,$city,$state,$country,$phone,$level_access)
	public function editProfile($id,$title,$full_name,$dob,$gender,$address,$city,$state,$country,$phone)
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


// ==== If email and password are correct set login sessions=================

	/**
	 *	This function is used for user login, with email and password
	 *
     * @param 		$email	Email address of the user that wants to login
     * @param 		$pass	The password the user
     * @return 		It redirects to the dashboard
	 */

	public function login($email,$pass)
	{
		$email = $this->secureInput($email);
		$pass = $this->secureInput($pass);

		//Encrypt password for database
		$salt1 = 's+(_a*';
		$salt2 = '@-)(%#';
		$pass = md5($salt1.$pass.$salt2);

		$lastLogin = date("l, M j, Y, g:i a");
		$online= 'ON';

		//Use the input email and password and check against 'users' table
		$query = 'SELECT id, email, password, active, level_access, online FROM users WHERE email = "'.$email.'" AND password = "'.$pass.'" AND level_access != 0';

		if($this->resultNum($query) == 1)
		{
			$row = $this->fetchOne($query);
			if ($row['active'] == 1 ) {
				$this->set_login_sessions ( $row['id'], $row['password'] ? TRUE : FALSE );
				if ($row['level_access'] != 1)  {
				$update = $this->processSql('UPDATE users SET last_login = "'.$lastLogin.'",online = "'.$online.'" WHERE id = "'.$row['id'].'"');
					return 99;
					}else{
					return 4;
				}
			}
			if ($row['active'] == 2) {return 2;}
			if ($row['active'] == 0) {return 3;}
		} else return 1;
	}

	/**
	 *	This function Sets Login Sessions
	 *
     * @param 		$userId	the Id of the user as stored in database
     * @param 		$pass	The password the user
     * @return 		It redirects to the dashboard
	 */
	public function set_login_sessions ( $userId, $pass )
	{
		//start the session
		session_start();

		//set the sessions
		$_SESSION['user_id'] = $userId;
		$_SESSION['logged_in'] = TRUE;
	}


// ==== If email and password are correct set login sessions============================


//==== Use the to check pages if user have access level to view them====================

	/**
	 *	This function Get the level access of the user
	 *
     * @param 		$userId The user the access level is checked on
     * @return 		returns the level access
	 */

	public function get_level_access ($userId)
	{
		$query = "SELECT `level_access` FROM `users` WHERE `id` = '" . 	$this->quote($userId) . "'";
		if ( $this->resultNum($query) == 1 )
		{
			$row = $this->fetchOne($query);
		}
		return $row['level_access'];
	}

	/**
	 *	This function Check the level access of the user
	 *
     * @param 		$levels The user levels to determine access level of the user logging in
     * @return 		returns boolean true or false
	 */
	public function checkUserLogin ( $levels )
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
					if ( in_array ( $this->get_level_access( $_SESSION['user_id'] ), $kt ) ) {
						//we do?! horray!
						$access = TRUE;
					}
				}
			}
		}
		else {
			$access = FALSE;

			if ( in_array ( $this->get_level_access($_SESSION['user_id']), $kt ) ) {
				$access = TRUE;
			}
		}

		if ( $access == FALSE ) {
			header("Location: ".APP_PATH."login.php?returnurl=".base64_encode(urlencode($_SERVER['REQUEST_URI'])));
			//header("Location: ".APP_PATH."login.php");
		}
	}

	//==== Use the to check pages if user have access level to view them====================

//----------Function for getting user records----------

	/**
	 *	This function gets user records from the id
	 *
     * @param 		$id The user id
     * @return 		returns user records
	 */
	public function getUserRecords($id)
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
	 *	This function logs off user using user's id
	 *
     * @param 		$id The user id
     * @return 		returns log out the user and set online off
	 */
	public function logoff()
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

			header("Location: ".APP_PATH."login");
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
//== PAssword Recovery Process=================================================================
	/**
	 *	This function set password recovery process in case a user forgot his/her password
	 *
   * @param 		$email The email address of the user
   * @param			$site_url The web site URL
   * @return 		sends the recovery password to the user email address
	 */

	public function pass_recovery($email,$site_url)
	{
		$email = $this->secureInput($email);
		$site_url = $this->secureInput($site_url);

		$sql = "SELECT id,username,password,email,level_access FROM users WHERE email = '".$email."'";
		$num = $this->resultNum($sql);
		$row = $this->fetchOne($sql);

		if($num == 1)
		{
			$temp_password = $this->random_string('alnum', 8);
			//Encrypt password for database
			$salt1 = 's+(_a*';
			$salt2 = '@-)(%#';
			$temp_pass = md5($salt1.$temp_password.$salt2);

			$update = $this->processSql("UPDATE users SET password='".$temp_pass."',temp_pass='".$temp_password."',temp_pass_active=1 WHERE email='".$email."'");

			if($update){
				//build email to be sent
				$to = $row['email'];
				$subject = "Password Reset Request";

				$message = "
				<html>
				<head>
				<title>Password Reset</title>
				</head>
				<body>
				<h3>Your New Password</h3>
				<p>Dear ".$row['username'].", someone (presumably you), has requested a password reset.</p>
				<p>Your new temporary password is: ".$temp_password.".</p>
				<p>To confirm this change and activate your new password, please follow this link to our website:</p>
				<a href=\"".$site_url."/confirm_pass.php?id=".$row['id']."&new=".$temp_password."&level_access=".$row['level_access']."\">".$site_url."</a>.
				<p>If the above link does not work, copy and paste the below URL to your browser's address bar:</p>
				<b><i>http://".$site_url."/confirm_pass.php?id=".$row['id']."&new=".$temp_password."&level_access=".$row['level_access']."</b></i>
				<p>Don't forget to update your profile as well after confirming this change and create a new password.</p><br/>
				<p>If you did not initiate this request, simply disregard this email, and we're sorry for bothering you.</p>
				<br/><br/>
				<p>Sincerely,</p>
				<p>SiteName Team.</p>
				</body>
				</html>
				";

				// To send HTML mail, the Content-type header must be set
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "From: SITE NAME<yourname@yoursite.com>" . "\r\n";//Modified By GENTLE to show the FROM in the message

				if($mail_send = mail($row['email'], $subject, $message, $headers)) {
					return 99;
				} else { return 1;}
			} else {return 2;}
		} else {return 3;}
	}

	/**
	 *	This function confirms password based on pass_recovery above
	 *
   * @param 		$id The id of the user to confirm password for
   * @param			$new The new password sent to the user email address to know if the user is the one requesting for password recovery
   * @return 		confirms the password sent
	 */

	public function confirm_pass($id,$new)
	{
		$id = $this->secureInput($id);
		$new = $this->secureInput($new);

		$query = "SELECT password,temp_pass,temp_pass_active FROM users WHERE id = '".$id."'";

		if($this->resultNum($query)==1)
		{
			$row = $this->fetchOne($query);
			if($row['temp_pass']==$_GET['new'] && $row['temp_pass_active']==1)
			{
				$update = $this->processSql("UPDATE users SET temp_pass_active=0 WHERE id = '".$this->quote($_GET['id'])."'");
				if($update){
					return 99;
				} else return 1;
			}
			else
			{
				return 2;
			}
		}
		else {
			return 3;
		}
	}

	//== PAssword Recovery Process=================================================================

	/**
	 *	This function works when user has already logged in and wish to change his/her password for one reason or the other
	 *
	 * @param 		$id The id of the user changing his/her password
	 * @param			$opass The old password changed
	 * @param			$pass The new password changed to
	 * @return 		changes user password immediately
	 */
		public function updatePass($id,$opass,$pass)
		{
			$id = $this->ecureInput($id);
			$opass = $this->secureInput($opass);
			$pass = $this->secureInput($pass);

			//Encrypt password for database
			$salt1 = 's+(_a*';
			$salt2 = '@-)(%#';
			$opasssalt = md5($salt1.$opass.$salt2);

			$query = 'SELECT `password` FROM `users` WHERE `id` = "'.$id.'"';
			$row = $this->fetchOne($query);

			if ($opasssalt != $row['password']){
				return 2;
				}else{

				//Encrypt password for database
	 	 		//$salt1 = 's+(_a*';
	 	 		//$salt2 = '@-)(%#';
				$new_password = md5($salt1.$pass.$salt2);

				$sql = "UPDATE users SET password = '" . $new_password . "' WHERE id = '" . $id . "'";
				$res = $this->processSql($sql);
				if(!$res) return 3;
				return 99;
			}
		}

}

?>
