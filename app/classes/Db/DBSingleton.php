<?php
/**
*   This Class Db_DBSingleton is made by Gentle of Infinitelife Inc.
*   This is database connection in singleton way
*/


//include Config.php in inc folder via Autoloader
//require_once ("./Autoloader.php");
//// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

 require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."Autoloader.php");

class Db_DBSingleton
{
    private static $instance;					//An instance of the Mysqli Singleton to initiate 
    private $con;								// Mysqli Connection itself

    //Create a constructor for the DB connection
    private function __construct()
    {
        //  Get mysqli authetication data from config.php via autoloder.php
        $this->con = new mysqli(SERVER,USERNAME,PASSWORD,DATABASE);
    }

    //Create a function to initiate the DB instance
    public static function init()
    {
        if(is_null(SELF::$instance))
        {
            SELF::$instance = new Db_DBSingleton();
        }

        return SELF::$instance;
    }

    // Create a magic method __call() to call funtions
    public function __call($name, $args)
    {
        if(method_exists($this->con, $name))
        {
             return call_user_func_array(array($this->con, $name), $args);
        } else {
             trigger_error('Unknown Method ' . $name . '()', E_USER_WARNING);
             return false;
        }
    }
}

?>