<?php

namespace user\repository;

use user\model\User;
use user\model\UserId;

interface UserRepository
{
    public function insertUser(
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $email,
        string $password
    ): UserId;

    public function findUserById(int $id): ?User;

    public function findUserByEmail(string $email): ?User;

    public function validateUserAndPassword(string $email, string $password): ?UserId;
}
