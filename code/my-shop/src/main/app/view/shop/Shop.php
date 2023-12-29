<?php



if (isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
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
