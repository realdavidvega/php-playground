<?php

namespace user\repository;

use PDO;
use config\DatabaseConfig;
use user\model\User;
use user\model\UserId;

class UserMysqlRepository implements UserRepository
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

        $userId = intval($this->connection->lastInsertId());
        return new UserId($userId);
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
                return new UserId($userId);
            }
        }
        return null;
    }
}
