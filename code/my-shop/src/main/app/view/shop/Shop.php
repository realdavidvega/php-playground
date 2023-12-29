<?php
session_start();

require_once '../../../../../vendor/autoload.php';

use product\model\ProductError;
use product\service\DefaultProductService;
use shared\Utils;
use user\model\UserError;
use user\model\UserId;
use user\service\DefaultUserService;

Utils::checkAuthentication();

try {
    $userService = new DefaultUserService();
    $id = new UserId($_SESSION['id']);
    $name = $userService->getUserInfo($id)->getName();
} catch (UserError $e) {
    $userError = $e->getMessage();
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}

try {
    $productService = new DefaultProductService();
    $products = $productService->getProducts();

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
} catch (ProductError $e) {
    $productsError = $e->getMessage();
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}

include "ShopView.php";
