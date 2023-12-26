<?php

namespace model;

class User
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

    public function setId(UserId $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): User
    {
        $this->surname = $surname;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): User
    {
        $this->address = $address;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): User
    {
        $this->phone = $phone;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }
}
