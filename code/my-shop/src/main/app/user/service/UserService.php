<?php

namespace user\service;

use user\model\User;
use user\model\UserError;
use user\model\UserId;
use user\repository\DefaultUserRepository;
use user\repository\UserRepository;

interface UserService
{
    function register(
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $email,
        string $password
    ): UserId;

    function login(string $email, string $password): UserId;

    function getUserInfo(UserId $id): User;
}
