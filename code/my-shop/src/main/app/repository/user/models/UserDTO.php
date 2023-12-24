<?php

namespace repository\user\models;

class UserId {
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): UserId
    {
        $this->id = $id;
        return $this;
    }
}

class UserDTO
{
    private UserId $id;
    private string $name;
    private string $surname;
    private string $address;
    private string $phone;
    private string $email;

    public function __construct(
        UserId $id,
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $email
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function setId(UserId $id): UserDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): UserDTO
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): UserDTO
    {
        $this->surname = $surname;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): UserDTO
    {
        $this->address = $address;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): UserDTO
    {
        $this->phone = $phone;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): UserDTO
    {
        $this->email = $email;
        return $this;
    }
}
