<?php

namespace product\service;

use product\model\Product;
use product\model\ProductError;
use product\repository\DefaultProductRepository;

class DefaultProductService implements ProductService
{
    private ProductRepository $repository;

    public function __construct()
    {
        $this->repository = new DefaultProductRepository();
    }


    /**
     * @throws ProductError
     * @return Product[]
     */
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
