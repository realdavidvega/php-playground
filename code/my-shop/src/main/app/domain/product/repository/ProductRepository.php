<?php

namespace product\repository;

use product\model\Product;

interface ProductRepository
{
    /**
     * Finds all the products.
     *
     * @return array|null the found items.
     */
    public function findAll(): ?array;
}
