<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MyShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php
if (isset($userError)) {
    echo "<p>$userError</p>";
} else {
    echo "<h1>" . "Hi $name, welcome to MyShop!" . "</h1>";
    echo "<h2>" . "Products" . "</h2>";
}

if (isset($productsError)) {
    echo "<p>$productsError</p>";
} else {
foreach ($products as $product) {
?>
<h3>$product['id']</h3>
<h3>$product['name']</h3>
<h3>$product['price']</h3>
<img src="$product['image']" alt="$product['name']">
<form action="Shop.php" method="post">
    <input type="hidden" name="id" value="$product['id']">
    <input type="submit" value="add_to_cart">
</form>
<?php
}
}
?>
<a href="../logout/Logout.php">Logout</a>
</body>
</html>
