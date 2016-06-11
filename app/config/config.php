<?php
// ========================== CONFIGURATION DATA==============================================================
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// path separator
defined("PS") || define("PS", PATH_SEPARATOR);//we are dynamically recognising the path seperator (: or ;) based on the system type if its windows linux or mac

// Load configuration Use the actual location of your configuration file
// Use DS."..".DS to go back root folder and enter config folder
$config = parse_ini_file(realpath(dirname(__FILE__) . DS."..".DS).DS.'config'.DS.'config.ini'); //
define('SERVER', $config['host']);				//Database hostname
define('USERNAME', $config['user']);			//Database username
define('PASSWORD', $config['pass']);			//Database password
define('DATABASE', $config['dbname']); 			//Database name
define('AFN', $config['app_folder']); 			//App Folder name

// ========================== CONFIGURATION DATA==============================================================

// ========================== URL PATH========================================================================
//Defining the website domain url
$_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https' : 'http';  // Set the http or https
defined("SITE_URL") || define("SITE_URL", $_protocol.'://'.$_SERVER['SERVER_NAME']. "/"); //assign the global site url www.yoursite.com/

// website domain url with Application Folder Path
defined("APP_PATH") || define("APP_PATH", SITE_URL.AFN);// www.yoursite.com/app_folder_name
// ========================== URL PATH========================================================================


// ========================== ROOT PATH=======================================================================
// root path
//defined("ROOT_PATH") || define("ROOT_PATH", realpath(dirname(__FILE__) . DS."..".DS));//we are dynamcially getting to root of our application like ../store/


if(!empty(AFN)){
// If app folder is not empty get root path as:
// root path
defined("ROOT_PATH") || define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . DS.str_replace("/", DS,AFN));//we are dynamcially getting to root of our application like ../store/

}else{
// root path
defined("ROOT_PATH") || define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . DS);//we are dynamcially getting to root of our application like ../
}

// ========================== ROOT PATH=======================================================================


// ========================== OTHER CONFIGURATIONS============================================================

// dashboard folder
defined("APP_DIR") || define("APP_DIR", "app");

// dashboard folder
defined("DASHBOARD_DIR") || define("DASHBOARD_DIR", "dashboard");

// classes folder
defined("CLASSES_DIR") || define("CLASSES_DIR", APP_DIR.DS."classes");

// config folder
defined("CONFIG_DIR") || define("CONFIG_DIR", APP_DIR.DS."config");

// css directory
defined("CSS_DIR") || define("CSS_DIR", DASHBOARD_DIR.DS."css");

  // fonts directory
defined("FONTS_DIR") || define("FONTS_DIR", DASHBOARD_DIR.DS."fonts");


// JS directory
defined("JS_DIR") || define("JS_DIR", DASHBOARD_DIR.DS."js");

// pages directory
defined("PAGES_DIR") || define("PAGES_DIR", "pages");

// modules folder
defined("MOD_DIR") || define("MOD_DIR", DASHBOARD_DIR.DS."mod");


// library folder
defined("LIB_DIR") || define("LIB_DIR", APP_DIR.DS."lib");

// inc folder
defined("INC_DIR") || define("INC_DIR", DASHBOARD_DIR.DS."inc");

// inc folder
defined("USER_DIR") || define("USER_DIR", DASHBOARD_DIR.DS."users");

// inc folder
defined("ADMIN_DIR") || define("ADMIN_DIR", DASHBOARD_DIR.DS."admin");

// templates folder
defined("TEMPLATE_DIR") || define("TEMPLATE_DIR", DASHBOARD_DIR.DS."template");

// emails path
defined("EMAILS_PATH") || define("EMAILS_PATH", ROOT_PATH.DS."emails");

// catalogue images path
defined("CATALOGUE_PATH") || define("CATALOGUE_PATH", ROOT_PATH.DS."media".DS."catalogue");


// ====================URL PATHS=============================================================================

// Define DASHBOARD URL PATH
defined("DASHBOARD") || define("DASHBOARD", APP_PATH.DASHBOARD_DIR."/");
// Define JS URL PATH
defined("JS_URL") || define("JS_URL", APP_PATH.DASHBOARD_DIR."/js/");

// Define CSS URL PATH
defined("CSS_URL") || define("CSS_URL", APP_PATH.DASHBOARD_DIR."/css/");

// Define IMAGES URL PATH
defined("IMG_URL") || define("IMG_URL", APP_PATH.DASHBOARD_DIR."/images/");

// Define USER URL PATH
defined("USER_URL") || define("USER_URL", APP_PATH.DASHBOARD_DIR."/users/");

// Define ADMIN URL PATH
defined("ADM_URL") || define("ADM_URL", APP_PATH.DASHBOARD_DIR."/admin/");

// ========================== OTHER CONFIGURATIONS============================================================



// ========================== PHP SET INCLUDE PATH============================================================
// add all above directories to the include path
set_include_path(implode(PS, array(
	realpath(ROOT_PATH.DS.CLASSES_DIR), //eg /store/Classes/
	realpath(ROOT_PATH.DS.APP_DIR), //eg /store/app/
	realpath(ROOT_PATH.DS.CONFIG_DIR), //eg /store/config/
	realpath(ROOT_PATH.DS.LIB_DIR), //eg /store/lib/
	realpath(ROOT_PATH.DS.INC_DIR), //eg /store/dashboard/inc/
	//realpath(ROOT_PATH.DS.ADMIN_DIR), //eg /store/dashboard/admin/
	//realpath(ROOT_PATH.DS.CSS_DIR),//eg /store/Css/
	//realpath(ROOT_PATH.DS.FONTS_DIR),//eg /fonts/Css/
	//realpath(ROOT_PATH.DS.DASHBOARD_DIR), //eg /store/dashboard/
	//realpath(ROOT_PATH.DS.PAGES_DIR),//eg /store/Pages/
	//realpath(ROOT_PATH.DS.JS_DIR), //eg /store/Js/
	//realpath(ROOT_PATH.DS.MOD_DIR), //eg /store/Mod/
	//realpath(ROOT_PATH.DS.TEMPLATE_DIR), //eg /store/Templates/
	//realpath(ROOT_PATH.DS.USER_DIR), //eg /store/dashboard/users/
	get_include_path()//function to get the current path before adding other directories
)));

// ========================== PHP SET INCLUDE PATH============================================================
