<?php

namespace user\service;

use user\model\User;
use user\model\UserError;
use user\model\UserId;
use user\repository\UserMysqlRepository;
use user\repository\UserRepository;

class UserServiceInterpreter implements UserService
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserMysqlRepository();
    }

    /**
     * @throws UserError
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
            throw new UserError("The user already exists.");
        } else {
            return $this->repository->insertUser($name, $surname, $address, $phone, $email, $password);
        }
    }

    /**
     * @throws UserError
     */
    public function login(string $email, string $password): UserId
    {
        $loginData = $this->repository->validateUserAndPassword($email, $password);
        if ($loginData != null) {
            return $loginData;
        } else {
            throw new UserError("Login failed. Invalid credentials.");
        }
    }

    /**
     * @throws UserError
     */
    public function getUserInfo(UserId $id): User
    {
        $userData = $this->repository->findUserById($id->getId());
        if ($userData != null) {
            return $userData;
        } else {
            throw new UserError("Invalid user id.");
        }
    }
}
