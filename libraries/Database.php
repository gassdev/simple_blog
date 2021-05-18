<?php

use PDO;

class Database
{
    private static $_instance = null;

    /**
     * Retourne une connexion
     *
     * @return PDO
     */
    public static function getPdo(): PDO
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new PDO(
                'mysql:host=localhost;dbname=blogpoo;charset=utf8',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }

        return self::$_instance;
    }
}