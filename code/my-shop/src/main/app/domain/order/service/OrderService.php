<?php

namespace order\service;

use order\model\OrderError;
use order\model\OrderId;
use product\model\ProductId;
use user\model\UserId;

interface OrderService
{
    /**
     * Retrieves the order data for a specific user.
     *
     * @throws OrderError If there was an error retrieving the order data.
     * @return array The order data for the user.
     */
    public function getOrdersForUser(): array;

    /**
     * Inserts a new order into the system.
     *
     * @param ProductId $productId The ID of the product being ordered.
     * @throws OrderError A description of the exception that can be thrown.
     * @return OrderId The ID of the newly inserted order.
     */
    public function insertOrder(ProductId $productId): OrderId;
}
