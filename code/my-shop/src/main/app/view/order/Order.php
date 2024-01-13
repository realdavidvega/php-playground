<?php

use order\model\OrderError;
use order\service\OrderServiceInterpreter;
use shared\Either;
use shared\Utils;

require_once '../../../../../vendor/autoload.php';

function getOrders()
{
    try {
        $orderService = new OrderServiceInterpreter();
        $orders = $orderService->getOrderForUser();
        return Either::right($orders);
    } catch (OrderError $e) {
        $orderError = $e->getMessage();
        return Either::left($orderError);
    } catch (Exception $e) {
        echo 'An error occurred: ' . $e->getMessage();
        die ("Error: " . $e->getMessage());
    }
}

session_start();
Utils::checkAuthentication();

$maybeOrders = getOrders();
if ($maybeOrders->isRight()) {
    $orders = $maybeOrders->getValue();
} else {
    $ordersError = $maybeOrders->getValue();
}

include "OrderView.php";
