<?php

namespace user\repository;

use PDO;
use shared\DatabaseConfig;
use user\model\User;
use user\model\UserId;

interface UserRepository
{
    function insertUser(
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $email,
        string $password
    );

    function findUserById(int $id): ?User;

    function findUserByEmail(string $email): ?User;

    function validateUserAndPassword(string $email, string $password): ?UserId;
}
