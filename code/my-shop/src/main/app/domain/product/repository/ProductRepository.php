<?php

namespace product\service;

use product\model\Product;

interface ProductRepository
{
    /**
     * @return Product[]|null
     */
    public function findAll(): ?array;
}
