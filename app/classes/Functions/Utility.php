<?php
/**
*   This Class Functions_Utility is made by Gentle of Infinitelife Inc.
*   if there is need to use any mysqli functions in this class connect true $this->db->mysqli_methodname
*   But most of this method would have being used to create methods in DBFunc class eg quote() for mysqli_real_escape_string
*   proccessSql() for mysqli_query, fetch() for mysqli_fecth_assoc etc for these use $this->methodname
*/


// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."Autoloader.php");

	/**
	* Creating Class for Utility Functions called Functions_Utility extending Db_DBfunc
	*
	*/

class Functions_Utility extends Db_DBFunc
{
    // Private Methods
    //===================================================

    /**
     *  IP functions
     *
     * @param 		$ips-The ips to return
     * @return 		Returns the ip
     */
	private function ip_first ( $ips ) 
	{
		if ( ( $pos = strpos ( $ips, ',' ) ) != false ) {
			return substr ( $ips, 0, $pos );
		} 
		else {
			return $ips;
		}
	}

	
	/**
     *  ip_valid - will try to determine if a given ip is valid or not
     *
     * @param 		$ips-The ips to validate. Gotten from $this->ip_first
     * @return 		Returns boolean
     */
	private function ip_valid ( $ips )
	{
		if ( isset( $ips ) ) {
			$ip    = $this->ip_first ( $ips );
			$ipnum = ip2long ( $ip );
			if ( $ipnum !== -1 && $ipnum !== false && ( long2ip ( $ipnum ) === $ip ) ) {
				if ( ( $ipnum < 167772160   || $ipnum > 184549375 ) && // Not in 10.0.0.0/8
				( $ipnum < - 1408237568 || $ipnum > - 1407188993 ) && // Not in 172.16.0.0/12
				( $ipnum < - 1062731776 || $ipnum > - 1062666241 ) )   // Not in 192.168.0.0/16
				return true;
			}
		}
		return false;
	}
	



    // Protected Methods
    //===================================================


	/**
     *  getIP - returns the IP of the visitor
     *
     * @param 		N/A
     * @return 		Returns visitor's IP
     */
	protected function getIP () 
	{
		$check = array(
		'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR',
		'HTTP_FORWARDED', 'HTTP_VIA', 'HTTP_X_COMING_FROM', 'HTTP_COMING_FROM',
		'HTTP_CLIENT_IP'
		);
		
		foreach ( $check as $c ) {
			if ( $this->ip_valid ( $_SERVER [ $c ] ) ) {
				return $this->ip_first ( $_SERVER [ $c ] );
			}
		}
		
		return $_SERVER['REMOTE_ADDR'];
	}




    // Public Methods
    //===================================================
    
    // Class Construct
        public function __construct()
    {
        parent::__construct();
    }

	
    /**
     *  This method add css files in the pages
     *  Just initiate the class $var = new Functions_Utility and echo $var->addCss('name_of_style'); without the .css
     *  Its relative to css folder i.e if css/file.css use $var->addCss('file'); if css/ie/file.css use $var->addCss('ie/file');
     *  Note that if the css file in not within the website css folder in the dashboadrd folder in the root use $var->addFile('absolute_path_to_js_file.css');
     *
     * @param       $styleName is the style name without the last .css extension because its already here
     * @return      Returns the css full path
     */
	public function addCss($styleName)
    {
        return "<link rel = 'stylesheet' type='text/css' href = '".CSS_URL.$styleName.".css'>";
    }

     /**
     *  This method add js files in the pages
     *  Just initiate the class $var = new Functions_Utility and echo $var->addJs('name_of_js'); without the .js
     *  Its relative to js folder i.e if js/file.js use $var->addJs('file'); if js/ie/file.js use $var->addJs('ie/file');
     *  Note that if the js file in not within the website js folder in the dashboadrd folder in the root use $var->addFile('absolute_path_to_js_file.js');
     *
     * @param       $jsName is the js name without the last .js extension because its already here
     * @return      Returns the js full path
     */
    public function addJs($jsName)
    {
        return "<script type ='text/javascript' src = '".JS_URL.$jsName.".js'></script>";
    }


    /**
     *  This method add image files in the pages
     *  Just initiate the class $var = new Functions_Utility and echo $var->addImg('name_of_image.ext'); 
     *  Its relative to images folder i.e if images/image_file.ext use $var->addJs('image_file.ext'); if images/ie/image_file.ext use $var->addJs('ie/image_file.ext');
     *  Note that if the image file is not within the website images folder in the dashboadrd in the root, use $var->addFile('absolute_path_to_image_file.ext');
     *
     * @param       $imgName is the image name with extention inclusive
     * @param       $w  its optional its for image's width 
     * @param       $h  its optional its for image's height 
     * @param       $alt  its optional its for image's alternative text 
     * @param       $title  its optional its for image's title 
     * @param       $id  its optional its for image's id  
     * @param       $class  its optional its for image's class
     * @return      Returns the image full path
     */
    public function addImg($imgName, $w='', $h='', $alt='', $title='',$id='', $class='')
    {
        return "<img src='".IMG_URL.$imgName."' width='".$w."px' heigth='".$h."px' alt='".$alt."' title='".$title."' id='".$id."' class='".$class."'>";
    }


     /**
     *  This method add css, js, image files that are not within the css, js, image directories in the pages
     *  Just initiate the class $var = new Functions_Utility and echo $var->addFile('path_to_file/file name.ext', type, width, height, alt); 
     *  Its relative to the php, phtml file adding the file or absolute url path of the file itself
     *
     * @param       $type is the type of file adding which are Img, Js, Css
     * @param       $fileName is the  path_to_file/file name with extention inclusive
     * @param       $w  its optional its for image's width if the file is an image
     * @param       $h  its optional its for image's height if the file is an image
     * @param       $alt  its optional its for image's alternative text if the file is an image
     * @param       $title  its optional its for image's title if the file is an image
     * @param       $id  its optional its for image's id if the file is an image
     * @param       $class  its optional its for image's class if the file is an image
     * @return      Returns the file relative path to the php file or absolute path of the file itself (in case its from another domain)
     */
    public function addFile( $type, $fileName, $w='', $h='', $alt='', $title='',$id='', $class='')
    {
        if (strtoupper($type) === 'CSS' ){
        return "<link rel = 'stylesheet' type='text/css' href = '".$fileName."'>";
        }

        if (strtoupper($type) === 'JS' ){
        return "<script type ='text/javascript' src = '".$fileName."'></script>";
        }

        if (strtoupper($type) === 'IMG' ){
        return "<img src='".$fileName."' width='".$w."px' heigth='".$h."px' alt='".$alt."' title='".$title."' id='".$id."' class='".$class."'>";
        }
        
    }


    /**
     *  This method gets the current file name
     *  Checks if it is imploded with "_" or "-" and explode it with " "(space)
     *  
     * @return      Returns output the resule with function ucwords() i.e First  Cap
     */
    public function addTitle()
    {
        $filename = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
        if($filename == 'index' || $filename == 'home' || $filename == 'default')
        {
            return "Ajebo Market Sales Agent Platform";
        }else{
            $title = str_replace('_',' ',  $filename);
            $title = str_replace('-',' ',  $title);
            return "SAP-".ucwords($title);
        }
    }

	/**
     *  Check if magic qoutes is on then stripslashes if needed
     *
     * @param 		$var is the string to use striplashes with
     * @return 		Returns output after stripslashed
     */
	public function secureInput($var)
	{
		$output = '';
		if (is_array($var)){
			foreach($var as $key=>$val){
				$output[$key] = $this->secureInput($val);
			}
			} else {
			$var = strip_tags(trim($var));
			if (function_exists("get_magic_quotes_gpc")) {
				$output = $this->quote(get_magic_quotes_gpc() ? stripslashes($var) : $var);
				} else {
				$output = $this->quote($var);
			}
		}
		if (!empty($output))
		return $output;
	}

	/**
     *  Random string generation function
     *
     * @param 		$type is the type of strings to be generated randomly. Default Alphanumeric
     * @param 		$len is the length of the random strings. Default 5
     * @return 		Returns the random strings
     */
	public function random_string($type = 'alnum', $len = 5)
	{					
		switch($type)
		{
			case 'alnum'	:
			case 'numeric'	:
			case 'nozero'	:
			
			switch ($type)
			{
				case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
				case 'numeric'	:	$pool = '0123456789';
				break;
				case 'nozero'	:	$pool = '123456789';
				break;
			}
			
			$str = '';
			for ($i=0; $i < $len; $i++)
			{
				$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
			}
			return $str;
			break;
			case 'unique' : return md5(uniqid(mt_rand()));
			break;
		}
	}


	//*******************************Function for validating an email address**************************
	
	/**
     *  Validating an email address
     *
     * @param 		$email The email address to be validated
     * @return 		Returns boolean true if valid email address or false if not
     */
	public function validateEmail($email)
	{
		$email = $this->secureInput($email);
		return ( preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $email)) ? TRUE : FALSE;
	}

	//-----Function for Validating a given numeric characters----------

	/**
     *  Validating a given numeric characters
     *
     * @param 		$int The numeric input to be validated
     * @return 		Returns boolean true if valid number address or false if not
     */
	
	public function validateNum($int)
	{
		$int = $this->secureInput($int);
		return (filter_var($int, FILTER_VALIDATE_INT) === true) ? true : false;
	}
	

	/**
     *  Validating a given string against numeric characters
     *
     * @param 		$str The string input to be validated
     * @return 		Returns boolean true if valid number address or false if not
     */
	function validateStr($str)
	{
		$str = $this->secureInput($str);
		return ( preg_match("/^[+][ 0-9\.]+$/", $str)) ? true : false;
	}


}

?>