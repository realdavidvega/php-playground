<?php

namespace user\service;

use user\model\User;
use user\model\UserError;
use user\model\UserId;

interface UserService
{
    /**
     * Register a new user.
     *
     * @param string $name The user's name.
     * @param string $surname The user's surname.
     * @param string $address The user's address.
     * @param string $phone The user's phone number.
     * @param string $email The user's email address.
     * @param string $password The user's password.
     * @throws UserError User type error.
     * @return UserId The ID of the registered user.
     */
    function register(
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $email,
        string $password
    ): UserId;

    /**
     * A description of the login function.
     *
     * @param string $email The email address of the user.
     * @param string $password The password of the user.
     * @throws UserError User type error.
     * @return UserId The user ID of the logged-in user.
     */
    function login(string $email, string $password): UserId;

    /**
     * Retrieves the user information for a given user ID.
     *
     * @param UserId $id The ID of the user to retrieve information for.
     * @throws UserError User type error.
     * @return User The user information for the given user ID.
     */
    function getUserInfo(UserId $id): User;
}
