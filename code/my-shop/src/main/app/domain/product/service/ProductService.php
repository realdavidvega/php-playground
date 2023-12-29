<?php

namespace product\service;

use product\model\Product;

interface ProductService
{
    /**
     * @return Product[]
     */
    public function getProducts(): array;
}
