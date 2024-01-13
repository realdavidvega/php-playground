<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MyShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php
echo isset($userError) ? "<p>$userError</p>" : "<h1>Hi $name, welcome to MyShop!</h1><h2>Products</h2>";
if (isset($productsError)) {
    echo "<p>$productsError</p>";
} else {
    foreach ($products as $product) {
        ?>
        <h3><?= $product->getId() ?></h3>
        <h3><?= $product->getName() ?></h3>
        <h3><?= $product->getPrice() ?></h3>
        <img src="../../../public/images/<?= $product->getImage() ?>.png" alt="<?= $product->getName() ?>">
        <form action="Shop.php" method="post">
            <input type="hidden" name="id" value="<?= $product->getId() ?>">
            <input type="submit" value="Add to cart">
        </form>
        <?php
    }
}
?>
<br>
<a href="../logout/Logout.php">Logout</a>
</body>
</html>
