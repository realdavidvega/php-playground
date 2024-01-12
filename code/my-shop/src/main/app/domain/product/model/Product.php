<?php

namespace product\model;

class Product
{
    private ProductId $id;
    private string $name;
    private float $price;
    private ?string $image;

    public function __construct(ProductId $id, string $name, float $price, ?string $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
    }

    public function getId(): ProductId
    {
        return $this->id;
    }

    public function setId(ProductId $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }
}
