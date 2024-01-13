<?php

namespace order\repository;

use DateTime;
use order\model\OrderId;
use product\model\ProductId;
use user\model\UserId;

interface OrderRepository
{
    /**
     * Retrieves all the orders from the database.
     *
     * @return array|null an array of records or null if no records are found
     */
    public function findByUserId(UserId $userId): ?array;

    /**
     * Inserts an order into the system.
     *
     * @param DateTime $createdAt The creation date and time of the order.
     * @param UserId $userId The ID of the user placing the order.
     * @param ProductId $productId The ID of the product being ordered.
     * @return OrderId The created order ID.
     */
    public function insertOrder(
        DateTime $createdAt,
        UserId $userId,
        ProductId $productId
    ): OrderId;
}
