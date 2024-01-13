<?php

namespace product\repository;

use config\DatabaseConfig;
use PDO;
use product\model\Product;
use product\model\ProductId;

class ProductMysqlRepository implements ProductRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DatabaseConfig::openConnection();
    }

    public function findAll(): ?array
    {
        $statement = $this->connection->prepare("
            SELECT id, name, price, image FROM products
        ");
        $statement->execute();

        $productsData = $statement->fetchAll();
        if ($productsData) {
            $createProduct = fn($productData) => new Product(
                new ProductId($productData['id']),
                $productData['name'],
                $productData['price'],
                $productData['image']
            );
            return array_map($createProduct, $productsData);
        } else {
            return null;
        }
    }
}
