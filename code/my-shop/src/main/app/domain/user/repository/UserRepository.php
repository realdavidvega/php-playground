<?php

namespace user\repository;

use user\model\User;
use user\model\UserId;

interface UserRepository
{
    /**
     * Inserts a new user into the system.
     *
     * @param string $name The user's name.
     * @param string $surname The user's surname.
     * @param string $address The user's address.
     * @param string $phone The user's phone number.
     * @param string $email The user's email address.
     * @param string $password The user's password.
     * @return UserId The ID of the newly inserted user.
     */
    public function insertUser(
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $email,
        string $password
    ): UserId;

    /**
     * Finds a user by their ID.
     *
     * @param int $id The ID of the user.
     * @return User|null The user object, or null if not found.
     */
    public function findUserById(int $id): ?User;

    /**
     * A function to find a user by their email address.
     *
     * @param string $email The email address of the user to find.
     * @return User|null The found user or null if not found.
     */
    public function findUserByEmail(string $email): ?User;

    /**
     * Validates the user email and password.
     *
     * @param string $email The user's email address.
     * @param string $password The user's password.
     * @return UserId|null The ID of the user, or null if validation fails.
     */
    public function validateUserAndPassword(string $email, string $password): ?UserId;
}
