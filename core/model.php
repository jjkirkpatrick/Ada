<?php

//use this as a base to extend models from
class model
{
    private static $_instance;
    private $_connection;
    private $DB_host = "192.168.0.2";
    private $DB_user_name = "Sa";
    private $DB_user_password = "Pa55word";
    private $DB_driver = "sqlsrv";
    private $DB_database = "WebServices";

    public $connection;
    public static function init()
    {
        try {
            if (is_null(self::$_instance) || empty(self::$_instance)) {
                self::$_instance = new self();
                return self::$_instance;
            }else{
                return self::$_instance;
            }
        } catch (Exception $e) {
            return self::class;
        }
    }

    function __construct()
    {
        try {
            if (is_null($this->_connection) || empty($this->_connection)) {
                $this->_connection = new \PDO($this->DB_driver.':server='.$this->DB_host.';Database='.$this->DB_database, $this->DB_user_name, $this->DB_user_password);
            }
        } catch (Exception $e) {
            $this->_connection = $e;
        }

        $this->connection = $this->connect();
    }

    public function connect()
    {
        return $this->_connection ? $this->_connection : null;
    }
}