<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProductsTable extends AbstractMigration
{
    public function change(): void
    {
        $sql = "
            CREATE TABLE `products` (
              `id` int(11) NOT NULL,
              `name` varchar(45) NOT NULL,
              `price` double(10,2) NOT NULL,
              `image` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        $this->execute($sql);
    }
}
