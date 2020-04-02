<?php

namespace OCFram;

class PDOFactory
{

    // METHOD //
    
    public static function getMysqlConnexion()
    {
        $db = new \PDO('mysql:host=localhost;dbname=systemenews', 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}

