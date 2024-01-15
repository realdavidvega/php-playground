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
<h2>Orders</h2>
<?php
if (isset($ordersError)) {
    echo "<p>$ordersError</p>";
} else {
?>
<table>
    <tr>
        <th>Id</th>
        <th>Created At</th>
        <th>ProductId</th>
    </tr>
    <?php
    foreach ($orders as $order) {
        ?>
        <tr>
            <td><?= $order->getId() ?></td>
            <td><?= $order->getCreatedAt()->format('Y-m-d H:i:s') ?></td>
            <td><?= $order->getProductId() ?></td>
        </tr>
        <?php
    }
    }
    ?>
</table>
<br>
<a href="../logout/Logout.php">Logout</a>
</body>
</html>
