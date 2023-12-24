<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class V2__CreateOrdersTable extends AbstractMigration
{
    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS `orders` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `date` date NOT NULL,
              `user_id` int(11) NOT NULL,
              `product_id` int(11) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `product_id` (`product_id`),
              KEY `order_id` (`user_id`,`product_id`) USING BTREE,
              KEY `order_idx` (`order_id`),
              CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
              CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
            ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
        ";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS `orders`";
        $this->execute($sql);
    }
}
