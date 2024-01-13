<?php

require_once '../../../../../vendor/autoload.php';

use product\model\ProductError;
use product\service\ProductServiceInterpreter;
use shared\Either;
use shared\Utils;
use user\model\UserError;
use user\service\UserServiceInterpreter;

function getUserName(): Either
{
    try {
        $userService = new UserServiceInterpreter();
        $id = $_SESSION['userId'];
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
        $productService = new ProductServiceInterpreter();
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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Add to cart'])) {
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

session_start();
Utils::checkAuthentication();

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
