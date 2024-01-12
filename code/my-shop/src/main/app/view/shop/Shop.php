<?php
session_start();

require_once '../../../../../vendor/autoload.php';

use product\model\ProductError;
use product\service\DefaultProductService;
use shared\Either;
use shared\Utils;
use user\model\UserError;
use user\model\UserId;
use user\service\DefaultUserService;

Utils::checkAuthentication();

function getUserName(): Either
{
    try {
        $userService = new DefaultUserService();
        $id = new UserId($_SESSION['id']);
        $name = $userService->getUserInfo($id)->getName();
        return Either::right($name);
    } catch (UserError $e) {
        $userError = $e->getMessage();
        return Either::left($userError);
    } catch (Exception $e) {
        echo 'An error occurred: ' . $e->getMessage();
        die ("Error: " . $e->getMessage());
    }
}

function getProducts(): Either
{
    try {
        $productService = new DefaultProductService();
        $products = $productService->getProducts();
        return Either::right($products);
    } catch (ProductError $e) {
        $productsError = $e->getMessage();
        return Either::left($productsError);
    } catch (Exception $e) {
        echo 'An error occurred: ' . $e->getMessage();
        die ("Error: " . $e->getMessage());
    }
}

function checkAddToCardAction(array $products): void
{
    if (isset($_POST['Add to cart'])) {
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
}

$maybeName = getUserName();
if ($maybeName->isRight()) {
    $name = $maybeName->getValue();
} else {
    $userError = $maybeName->getValue();
}

$maybeProducts = getProducts();
if ($maybeProducts->isRight()) {
    $products = $maybeProducts->getValue();
    checkAddToCardAction((array)$products);
} else {
    $productsError = $maybeProducts->getValue();
}

include "ShopView.php";
