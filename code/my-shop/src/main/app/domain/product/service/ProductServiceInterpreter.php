<?php

namespace product\service;

use product\model\Product;
use product\model\ProductError;
use product\repository\ProductMysqlRepository;
use product\repository\ProductRepository;

class ProductServiceInterpreter implements ProductService
{
    private ProductRepository $repository;

    public function __construct()
    {
        $this->repository = new ProductMysqlRepository();
    }

    public function getProducts(): array
    {
        $productData = $this->repository->findAll();
        if ($productData != null) {
            return $productData;
        } else {
            throw new ProductError("Failed fetching products.");
        }
    }
}
