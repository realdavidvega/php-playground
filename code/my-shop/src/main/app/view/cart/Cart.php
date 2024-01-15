<?php

require_once '../../../../../vendor/autoload.php';

use order\model\OrderError;
use order\service\OrderServiceInterpreter;
use product\model\ProductError;
use product\model\ProductId;
use product\service\ProductServiceInterpreter;
use shared\Either;
use shared\Utils;

function initCart(): void
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
}

function addToCartAction(): string
{
    initCart();

    try {
        $productService = new ProductServiceInterpreter();
        $products = $productService->getProducts();
    } catch (ProductError $e) {
        return $e->getMessage();
    } catch (Exception $e) {
        echo 'An error occurred: ' . $e->getMessage();
        die ("Error: " . $e->getMessage());
    }

    $productId = $_POST['id'];
    $product = array_filter($products, function ($item) use ($productId) {
        return $item->getId() == $productId;
    });

    if (!empty($product)) {
        $product = reset($product);
        $_SESSION['cart'][$productId] = [
            'id' => count($_SESSION['cart']) + 1,
            'date' => date('Y-m-d H:i:s'),
            'product' => $product
        ];
        return 'Product added to cart.';
    } else {
        return 'Product not found, please try again later.';
    }
}

function buyAction(): string
{
    try {
        $orderService = new OrderServiceInterpreter();
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $orderService->insertOrder(new ProductId($product_id));
        }
        $_SESSION['cart'] = [];
        return 'Your order has been placed successfully.';
    } catch (OrderError $e) {
        return $e->getMessage();
    } catch (Exception $e) {
        echo 'An error occurred: ' . $e->getMessage();
        die ("Error: " . $e->getMessage());
    }
}

function deleteAction(): string
{
    $productId = $_POST['id'];
    unset($_SESSION['cart'][$productId]);
    return 'Product deleted from cart';
}

function cleanCartAction(): string
{
    unset($_SESSION['cart']);
    return 'Cart cleaned';
}

session_start();
Utils::checkAuthentication();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_to_cart'])) {
        $orderMessage = addToCartAction();
    } elseif (isset($_POST['buy'])) {
        $orderMessage = buyAction();
    } elseif (isset($_POST['delete_product'])) {
        $orderMessage = deleteAction();
    } elseif (isset($_POST['clean_cart'])) {
        $orderMessage = cleanCartAction();
    }
}

include "CartView.php";
