<?php

namespace repository;

namespace repository\user;

use PDO;
use repository\user\models\UserDTO;
use repository\user\models\UserId;
use shared\DatabaseConfig;

interface UserRepository
{
    function insertUser(
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $email,
        string $password
    ): UserId;

    function getUserById(int $id): UserDTO | null;

    function validateUserAndPassword(string $email, string $password): UserId | null;
}

class DefaultUserRepository implements UserRepository
{
    public function insertUser(
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $email,
        string $password
    ): UserId
    {
        $connection = DatabaseConfig::openConnection();
        $statement = $connection->prepare("
            INSERT INTO users (name, surname, address, phone, email, password)
            VALUES (:name, :surname, :address, :phone, :email, :password)
        ");

        $statement->bindParam(":name", $name);
        $statement->bindParam(":surname", $surname);
        $statement->bindParam(":address", $address);
        $statement->bindParam(":phone", $phone);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->execute();

        $userData = $statement->fetchObject();
        return new UserId($userData->id);
    }

    public function getUserById(int $id): UserDTO | null
    {
        $connection = DatabaseConfig::openConnection();
        $statement = $connection->prepare("
            SELECT id, name, surname, address, phone, email FROM users WHERE id = : id
        ");
        $statement->bindParam(':id', $id);
        $statement->execute();

        $userData = $statement->fetchObject();
        if ($userData) {
            return new UserDTO(
                new UserId($userData->id),
                $userData->name,
                $userData->surname,
                $userData->address,
                $userData->phone,
                $userData->email
            );
        }
        return null;
    }

    public function validateUserAndPassword(string $email, string $password): UserId | null
    {
        $connection = DatabaseConfig::openConnection();
        $statement = $connection->prepare("SELECT id, password FROM users WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();

        $userData = $statement->fetchObject();
        if ($userData) {
            $hashedPasswordFromDB = $userData->password;
            $userId = $userData->id;
            if (password_verify($password, $hashedPasswordFromDB)) {
                return $userId;
            }
        }
        return null;
    }
}
