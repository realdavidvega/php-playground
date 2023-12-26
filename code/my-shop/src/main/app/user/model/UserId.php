<?php

namespace model;

class UserId
{
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