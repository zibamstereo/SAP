<?php
/**
*   This Class Db_DBFunc is made by Gentle of Infinitelife Inc.
*   All Database functions needed should have been redefined here for easier access from child classes
*/

    //include DBSingleton via Autoloader
     require_once (realpath(dirname(__FILE__) . DS."..".DS."..".DS).DS."Autoloader.php");

    /**
     *  Creating Class for DB Functions called DBFunc
     *
     */
class Db_DBFunc
{
    protected $db;

    /**
     *  Create a construct to initiate  Db_DBSingleton class
     *
     * @param       N/A
     * @return      Returns the database initiation
     */
    public function __construct()
    {
        $this->db = Db_DBSingleton::init();
    }


    /**
     *  Proccess sql queries
     *
     * @param       $query  the query to proccess
     * @return      Returns the result of the query
     */
    public function processSql($query)
	{
		$res = $this->db->query($query);
		return $res;
	}


    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function fetch($query) {
        $rows = array();
        $result = $this->processSql($query);
        if($result === false) {
            return false;
        }
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Fetch a row from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function fetchOne($query) {
        $result = $this->processSql($query);
        if($result === false) {
            return false;
        }
        $row = $result->fetch_assoc();
        return $row;
    }


    /**
     *  Get Num of Rows in a result
     *
     * @param $query The query string
     * @return Number of Rows in a result
     */
    public function resultNum($query) {
        $result = $this->processSql($query);
        return $result->num_rows;
    }



    /**
     * Fetch the last error from the database
     *
     * @return string Database error message
     */
    public function error() {
        return $this->db->error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        return $this->db->real_escape_string($value);
    }




}

?>
