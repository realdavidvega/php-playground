<?php

namespace order\model;

use DateTime;
use product\model\ProductId;
use user\model\UserId;

class Order
{
    private OrderId $id;
    private DateTime $createdAt;
    private UserId $userId;
    private ProductId $productId;

    public function __construct(
        OrderId   $id,
        DateTime  $createdAt,
        UserId    $userId,
        ProductId $productId
    )
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->userId = $userId;
        $this->productId = $productId;
    }

    public function getId(): OrderId
    {
        return $this->id;
    }

    public function setId(OrderId $id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function setUserId(UserId $userId): void
    {
        $this->userId = $userId;
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    public function setProductId(ProductId $productId): void
    {
        $this->productId = $productId;
    }
}
