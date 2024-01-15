<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MyShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h1>MyShop</h1>
<?php include "../../components/Menu.php" ?>
<h2>Cart</h2>

<?php
if (!empty($_SESSION['cart'])) {
    $total = 0;
    foreach ($_SESSION['cart'] as $id_product => $data) {
        $product = $data['product'];
        $price = $product->getPrice();
        $total += $price;
        ?>
        <p>ID: <?= $id_product; ?></p>
        <p>Name: <?= $product->getName(); ?></p>
        <p>Price: $<?= $price; ?></p>
        <br>
        <button onclick="location.href = '../cart/Cart.php?delete_product=' + '<?= $id_product ?>';">Delete</button>
        <br>
        <?php
    }
    ?>
    <p>Total: $<?= $total ?></p>
    <br>
    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <input type="submit" name="buy" value="Buy">
    </form>
    <br>
    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <input type="submit" name="clean_cart" value="Clean Cart">
    </form>
    <br>
    <?php
} else {
    ?>
    <p>Your cart is empty.</p>
    <?php
}
?>

<br>
<a href="../shop/Shop.php">Keep Shopping</a>
<br>
<a href="../logout/Logout.php">Logout</a>
</body>
</html>
