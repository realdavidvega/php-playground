<?php

namespace repository;

require_once '../shared/DatabaseConfig.php';

use PDO;
use models\User;
use models\UserId;
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

    function findUserById(int $id): ?User;

    function findUserByEmail(string $email): ?User;

    function validateUserAndPassword(string $email, string $password): ?UserId;
}

class DefaultUserRepository implements UserRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DatabaseConfig::openConnection();
    }

    public function insertUser(
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $email,
        string $password
    ): UserId
    {
        $statement = $this->connection->prepare("
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

    public function findUserById(int $id): ?User
    {
        $statement = $this->connection->prepare("
            SELECT id, name, surname, address, phone, email FROM users WHERE id = :id
        ");
        $statement->bindParam(':id', $id);
        $statement->execute();

        $userData = $statement->fetchObject();
        if ($userData) {
            return new User(
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

    public function findUserByEmail(string $email): ?User
    {
        $statement = $this->connection->prepare("
            SELECT id, name, surname, address, phone, email FROM users WHERE email = :email
        ");
        $statement->bindParam(':email', $email);
        $statement->execute();

        $userData = $statement->fetchObject();
        if ($userData) {
            return new User(
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

    public function validateUserAndPassword(string $email, string $password): ?UserId
    {
        $statement = $this->connection->prepare("SELECT id, password FROM users WHERE email = :email");
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
