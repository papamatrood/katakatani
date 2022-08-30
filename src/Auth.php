<?php
namespace App;

use Exception;

class Auth {


    public static function check() : void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['login'])) {
            throw new Exception('Accès interdit');
        }
    }

}