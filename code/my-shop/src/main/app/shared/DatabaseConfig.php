<?php

namespace shared;

use PDO;
use PDOException;

abstract class DatabaseConfig
{
    private static string $server = 'localhost:3306';
    private static string $db = 'myShop';
    private static string $user = 'someUser';
    private static string $password = 'somePassword';

    public static function openConnection()
    {
        try {
            $connection = new PDO(
                "mysql:host=" . self::$server . ";dbname=" . self::$db . ";charset=utf8",
                self::$user,
                self::$password
            );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "A connection to the database server could not be established.<br>";
            die ("Error: " . $e->getMessage());
        }
        return $connection;
    }
}
