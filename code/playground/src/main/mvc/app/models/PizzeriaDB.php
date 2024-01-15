<?php

namespace models;
use PDOException;

abstract class PizzeriaDB
{
    private static $server = 'localhost:3306';
    private static $db = 'pizzeria';
    private static $user = 'root';
    private static $password = '';

    public static function connectDB()
    {
        try {
            $conn = new PDO("mysql:host=" . self::$server . ";dbname=" . self::$db . ";charset=utf8", self::$user, self::$password);
        } catch (PDOException $e) {
            echo "Could not connect to database.<br>";
            die ("Error: " . $e->getMessage());
        }

        return $conn;
    }
}
