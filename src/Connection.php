<?php
namespace App;
use PDO;

class Connection {

    private static $pdo;

    public static function getPDO() : PDO
    {
        if (is_null(static::$pdo)) {
            static::$pdo = new PDO('mysql:dbname=katakatani;host=localhost:3308', 'root', null,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }

        return static::$pdo;
    }

}