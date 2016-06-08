<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
    /**
    *  This Class Autoloader is made by Gentle of Infinitelife Inc.
    *  Include paths  set in config.php are: classes, css, fonts, inc, js, lib and pages these may be modified in the future 
    *   Note: Class names must be defined as relative path to the include folders then the filename Case-Sensitive
    *   E.g. Defining Class Registration in a file inside folder Functions which is in classes folder(One of the include folders)
    *   The class Name would Be called and initiated as Class Functions_Registration{} and $class = new Functions_Registration(); 
    *   And the file would be any of the include paths like include_path/Functions/Registration.php or .class.php or .inc.php
    */


// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// include the config file inside inc folder
require_once(realpath(dirname(__FILE__)).DS.'config'.DS.'config.php');

// Register the class referencing the static method made below with spl_autoload_register
spl_autoload_register('Autoloader::autoload');

// Create the class Autoloader
Class Autoloader{ 

// Create a static function autoload 
 static public function autoload($className)
    {
    // trim the whitespace from the left of the defined classname
    $className = ltrim($className, "\\");

    // Define a variable for filename
    $fileName  = "";

    // Define a variable for the namespaces
    $namespace = "";

    // Get the include paths
    $paths = explode(PS, get_include_path());

    // Define the array of the extensions classes should use
    $extensions = array(".php", ".class.php", ".inc.php");

    // Seoarate namespace from Classname to give file name
    if ($lastNsPos = strripos($className, "\\")) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace("\\", DS, $namespace) . DS;
    }

    // Replace "_" with Directory Separator
    $fileName .= str_replace("_", DS, $className);

    // Create a foreach loop on all the include paths to get different possible filenames
    foreach ($paths as $path) {
    $fileName = $path . DS . $fileName;

    // Create a foreach loop on the array of acceptable extensions defined above
    foreach ($extensions as $ext) {

        // If the filename concatinating any of the available extensions exist and readable
        if (is_readable($fileName . $ext)) {

            // Require the file once
             require_once $fileName . $ext;

             // then break the loop
             break;
        }
    }
}

} 

}