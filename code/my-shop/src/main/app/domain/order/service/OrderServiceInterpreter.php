<?php

namespace order\service;

use DateException;
use DateTime;
use Exception;
use order\model\OrderError;
use order\model\OrderId;
use order\repository\OrderMysqlRepository;
use order\repository\OrderRepository;
use product\model\ProductId;
use user\model\UserId;

class OrderServiceInterpreter implements OrderService
{
    private OrderRepository $repository;

    public function __construct()
    {
        $this->repository = new OrderMysqlRepository();
    }

    public function getOrderForUser(): array
    {
        $userId = $_SESSION['userId'];
        try {
            $orderData = $this->repository->findByUserId($userId);
            if ($orderData != null) {
                return $orderData;
            } else {
                throw new OrderError("Failed fetching orders.");
            }
        } catch (DateException $e) {
            throw new OrderError("Invalid date format in orders: " . $e->getMessage());
        }
    }

    public function insertOrder(ProductId $productId): OrderId
    {
        $userId = $_SESSION['userId'];
        $createdAt = new DateTime();
        return $this->repository->insertOrder($createdAt, $userId, $productId);
    }
}
