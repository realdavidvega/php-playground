<?php

namespace product\service;

use product\model\Product;
use product\model\ProductError;

interface ProductService
{
    /**
     * Retrieves an array of products.
     *
     * @throws ProductError Product type error.
     * @return array
     */
    public function getProducts(): array;
}
