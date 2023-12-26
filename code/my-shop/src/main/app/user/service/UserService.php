<?php

namespace service;

require_once '../repository/UserRepository.php';

use Exception;
use Throwable;
use model\User;
use model\UserId;
use repository\UserRepository;
use repository\DefaultUserRepository;

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

class DefaultUserService implements UserService
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new DefaultUserRepository();
    }

    /**
     * @throws \model\UserError
     */
    public function register(
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $email,
        string $password
    ): UserId
    {
        $existingUser = $this->repository->findUserByEmail($email);
        if ($existingUser) {
            throw new \model\UserError("The user already exists.");
        } else {
            return $this->repository->insertUser($name, $surname, $address, $phone, $email, $password);
        }
    }

    /**
     * @throws \model\UserError
     */
    public function login(string $email, string $password): UserId
    {
        $loginData = $this->repository->validateUserAndPassword($email, $password);
        if ($loginData != null) {
            return $loginData;
        } else {
            throw new \model\UserError("Login failed. Invalid credentials.");
        }
    }

    /**
     * @throws \model\UserError
     */
    public function getUserInfo(UserId $id): User
    {
        $userData = $this->repository->findUserById($id->getId());
        if ($userData != null) {
            return $userData;
        } else {
            throw new \model\UserError("Invalid user id.");
        }
    }
}
