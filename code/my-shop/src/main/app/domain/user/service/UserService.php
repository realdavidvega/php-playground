<?php

namespace user\service;

use user\model\User;
use user\model\UserId;

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
