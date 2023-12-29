<?php

use product\model\ProductError;
use product\service\DefaultProductService;

require_once '../../../../../vendor/autoload.php';

$service = new DefaultProductService();

try {
    $products = $service->getProducts();
} catch (ProductError $e) {
    $productsError = $e->getMessage();
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}

if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['id'];
    $product = array_filter($products, function ($item) use ($productId) {
        return $item['id'] == $productId;
    });

    if (!empty($product)) {
        $product = reset($product);
        $_SESSION['cart'][] = [
            'id' => count($_SESSION['cart']) + 1,
            'date' => date('Y-m-d H:i:s'),
            'product' => $product
        ];
    }
}

include "ShopView.php";
