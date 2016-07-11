<?php

/**
* This Class Functions_SiteSettings is made by Gentle of Infinitelife Inc.
* This class is responsible all site configurations
*/


// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// include autoloader
require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."Autoloader.php");

// Create class Functions_SiteSettings etending Functions_Utility
//
Class Functions_Sitesettings extends Functions_Utility
{



	/**
	 *	This function gets site settings
	 *
     * @return 		returns site settings
	 */
	public function getSiteSettings()
	{
		$sql = "SELECT * FROM configurations";
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
	function updateSiteSet($site_name,$site_url,$admin_email,$site_full_name,$site_descr,$site_full_name,$site_emails,$site_phone,$records)
	{
		$site_name = $this->secureInput($site_name);
		$site_url = $this->secureInput($site_url);
		$admin_email = $this->secureInput($admin_email);
		$site_full_name = $this->secureInput($site_full_name);
		$site_descr = $this->secureInput($site_descr);
		$site_full_name = $this->secureInput($site_full_name);
		$site_emails = $this->secureInput($site_emails);
		$site_phone = $this->secureInput($site_phone);
		$records = $this->secureInput($records);
		//$level_access = $this->secureInput($level_access);

		$sql = "SELECT * FROM configurations";
		$numRows = $this->resultNum($sql);

		if ($numRows == 0){
		//	$sql = "INSERT INTO configurations (site_name, site_url, admin_email, site_full_name, site_descr, site_full_name, site_emails, site_phone, records, level_access)
			//VALUES('".$site_name."', '".$site_url."', '".$admin_email."', '".$site_full_name."', '".$site_descr."', '".$site_full_name."', '".$site_emails."', '".$site_phone."', '".$records."', '".$level_access."')";
			$sql = "INSERT INTO configurations (site_name, site_url, admin_email, site_full_name, site_descr, site_full_name, site_emails, site_phone, records)
			VALUES('".$site_name."', '".$site_url."', '".$admin_email."', '".$site_full_name."', '".$site_descr."', '".$site_full_name."', '".$site_emails."', '".$site_phone."', '".$records."')";

      $res = $this->processSql($sql);
			if(!$res) return 1;
			return 99;
		}
		if ($numRows > 0){
			//$sql = "UPDATE configurations SET site_name = '" . $site_name . "', site_url = '" . $site_url . "', admin_email = '" . $admin_email . "', site_full_name = '" . $site_full_name . "', site_descr = '" . $site_descr . "', site_full_name = '" . $site_full_name . "', site_emails = '" . $site_emails . "',site_phone = '" . $site_phone . "', records = '" . $records . "', level_access = '" . $level_access . "'";
			$sql = "UPDATE configurations SET site_name = '" . $site_name . "', site_url = '" . $site_url . "', admin_email = '" . $admin_email . "', site_full_name = '" . $site_full_name . "', site_descr = '" . $site_descr . "', site_full_name = '" . $site_full_name . "', site_emails = '" . $site_emails . "',site_phone = '" . $site_phone . "', records = '" . $records . "'";
			$res = $this->processSql($sql);
			if(!$res) return 1;
			return 99;
		}
	}


}

?>
