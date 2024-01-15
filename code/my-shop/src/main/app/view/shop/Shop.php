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

session_start();
Utils::checkAuthentication();

$name = '';
$maybeName = getUserName();
if ($maybeName->isRight()) {
    $name = $maybeName->getValue();
} else {
    $userError = $maybeName->getValue();
}

$products = [];
$maybeProducts = getProducts();
if ($maybeProducts->isRight()) {
    $products = $maybeProducts->getValue();
} else {
    $productsError = $maybeProducts->getValue();
}

include "ShopView.php";
