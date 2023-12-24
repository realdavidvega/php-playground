<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    public function change(): void
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(45) NOT NULL,
            `surname` varchar(45) NOT NULL,
            `address` varchar(45) NOT NULL,
            `phone` varchar(9) NOT NULL,
            `email` varchar(45) NOT NULL,
            `password` varchar(60) NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `email` (`email`)
        ) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
        ";
        $this->execute($sql);
    }
}
