<?php

class Database
{
    private static $dbc = null;

    public function __construct($host, $database, $user, $pass)
    {
        if(!isset(self::$dbc))
        {
            $dsn = "mysql:host=$host;dbname=$database";
        
            self::$dbc = new PDO($dsn, $user, $pass);
            self::$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);      
        }
    }

    public function getConnection()
    {
        return self::$dbc;
    }
}