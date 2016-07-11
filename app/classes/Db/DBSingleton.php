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

    /**
     *  Create A Class for Database in a singleton way
     *
     */
class Db_DBSingleton
{
    private static $instance;					//An instance of the Mysqli Singleton to initiate 
    private $con;								// Mysqli Connection itself

    
     /**
     *  Create a constructor for the DB connection
     *
     * @param       N/A
     * @return      Returns the database connection
     */
    private function __construct()
    {
        //  Get mysqli authetication data from config.php via autoloder.php
        $this->con = new mysqli(SERVER,USERNAME,PASSWORD,DATABASE);
    }

    
     /**
     *  Create a function to initiate the DB instance
     *
     * @param       N/A
     * @return      Returns the database initiation
     */
    public static function init()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new Db_DBSingleton();
        }

        return self::$instance;
    }
    
    
    /**
     *  Create a magic method __call() to trigger error when undefined method is called
     *
     * @param       $name is the name of the of the method called
     * @param       $args is the names of the arguments used in the fuction
     * @return      Triggers error if method does not exist
     */
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