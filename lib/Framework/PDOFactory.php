<?php

namespace Framework;

class PDOFactory
{
    
    public static function getMysqlConnexion()
    {
        // $db = new \PDO('mysql:host=db5000389445.hosting-data.io;port=3306;dbname=dbs374657', 'dbu109460', '@Projet5');
        $db = new \PDO('mysql:host=localhost;dbname=projet5', 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}

