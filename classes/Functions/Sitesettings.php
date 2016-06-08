<?php

/**
* This Class Functions_SiteSettings is made by Gentle of Infinitelife Inc.
* This class is responsible for adding users and editting users 
*/


// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// include autoloader
require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."Autoloader.php");

// Create class Functions_SiteSettings etending Functions_Utility
// 
Class Functions_Sitesettings extends Functions_Utility
{

    // Class Construct
        public function __construct()
    {
        parent::__construct();
    }



	/**
	 *	This function gets site settings
	 * 
     * @return 		returns site settings
	 */
	public function getSiteSettings()
	{			
		$sql = "SELECT id,site_name,site_url,site_email,site_f_name,site_descr,site_r_add,site_email2,site_phone,records,level_access FROM site_settings";		
		//return $this->fetch($sql);
		$rows = $this->fetch($sql);
		$c=0;
		foreach($rows AS $row){
		$sitesetting[$c] = $row;
		$c++;
		}
		return $sitesetting;
	}
	
	//----------Function for updating site settings----------
	function updateSiteSet($site_name,$site_url,$site_email,$site_f_name,$site_descr,$site_r_add,$site_email2,$site_phone,$records,$level_access)
	{		
		$site_name = secureInput($site_name);
		$site_url = secureInput($site_url);
		$site_email = secureInput($site_email);
		$site_f_name = secureInput($site_f_name);
		$site_descr = secureInput($site_descr);
		$site_r_add = secureInput($site_r_add);
		$site_email2 = secureInput($site_email2);
		$site_phone = secureInput($site_phone);
		$records = secureInput($records);
		$level_access = secureInput($level_access);
		
		$sql = "SELECT * FROM site_settings";
		$numRows = $this->resultNum($sql);
		
		if ($numRows == 0){
			$sql = "INSERT INTO site_settings (
			site_name,
			site_url,
			site_email,
			site_f_name,
			site_descr,
			site_r_add,
			site_email2,
			site_phone,
			records,
			level_access
			) 
			VALUES(
			'".$site_name."',
			'".$site_url."',
			'".$site_email."',
			'".$site_f_name."',
			'".$site_descr."',
			'".$site_r_add."',
			'".$site_email2."',
			'".$site_phone."',
			'".$records."',
			'".$level_access."'
			)";
			$res = $this->proccessSql($sql);
			if(!$res) return 1;
			return 99;
		}
		if ($numRows > 0){
			$sql = "UPDATE site_settings SET 
			site_name = '" . $site_name . "',
			site_url = '" . $site_url . "',
			site_email = '" . $site_email . "',
			site_f_name = '" . $site_f_name . "',
			site_descr = '" . $site_descr . "',
			site_r_add = '" . $site_r_add . "',
			site_email2 = '" . $site_email2 . "',
			site_phone = '" . $site_phone . "',
			records = '" . $records . "',
			level_access = '" . $level_access . "'
			";		
			$res = $this->proccessSql($sql);
			if(!$res) return 1;
			return 99;
		}
	}
	

}

?>