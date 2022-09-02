<?php
namespace App\Help;

use Exception;

class NumberHelper {


    public static function getInt(string $page, int $default = 1) : int
    {
        if(!isset($_GET[$page])) return $default;

        if (!FILTER_VAR($_GET[$page], FILTER_VALIDATE_INT)) {
            throw new Exception("Le paramètre $page dans l'url doit être un entier !");
        }

        return (int) $_GET[$page];
    } 

    public static function getPositive(string $page, int $default = 1) : int
    {
        $number = self::getInt($page, $default);

        if($number <= 0) throw new Exception("Le paramètre $page dans l'url doit être un entier positif !");

        return $number;
    } 

}