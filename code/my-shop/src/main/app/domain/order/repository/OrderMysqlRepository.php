<?php

namespace order\repository;

use DateTime;
use order\model\Order;
use order\model\OrderId;
use product\model\ProductId;
use user\model\UserId;
use config\DatabaseConfig;
use PDO;

class OrderMysqlRepository implements OrderRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DatabaseConfig::openConnection();
    }

    public function findByUserId(UserId $userId): ?array
    {
        $statement = $this->connection->prepare("
            SELECT id, created_at, user_id, product_id FROM orders WHERE user_id = :user_id
        ");

        $id = $userId->getId();
        $statement->bindParam(':user_id', $id);
        $statement->execute();

        $ordersData = $statement->fetchAll();
        if ($ordersData) {
            $createOrder = fn($orderData) => new Order(
                new OrderId($orderData['id']),
                $orderData['created_at'],
                $orderData['user_id'],
                $orderData['product_id']
            );
            return array_map($createOrder, $ordersData);
        } else {
            return null;
        }
    }

    public function insertOrder(
        DateTime $createdAt,
        UserId $userId,
        ProductId $productId
    ): OrderId {
        $statement = $this->connection->prepare("
            INSERT INTO orders (created_at, user_id, product_id) VALUES (:created_at, :user_id, :product_id)
        ");

        $createdAtFormatted = $createdAt->format('Y-m-d H:i:s');
        $idUser = $userId->getId();
        $idProduct = $productId->getId();

        $statement->bindParam(':created_at', $createdAtFormatted);
        $statement->bindParam(':user_id', $idUser);
        $statement->bindParam(':product_id', $idProduct);
        $statement->execute();

        $orderId = intval($this->connection->lastInsertId());
        return new OrderId($orderId);
    }
}
