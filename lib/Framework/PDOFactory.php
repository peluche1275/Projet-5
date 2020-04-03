<?php

namespace Framework;

class PDOFactory
{

    // METHOD //
    
    public static function getMysqlConnexion()
    {
        $db = new \PDO('mysql:host=localhost;dbname=projet5', 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}

