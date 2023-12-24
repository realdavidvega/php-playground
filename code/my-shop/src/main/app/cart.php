<?php

session_start();

$conn = 'mysql:host=localhost:3306;dbname=camisetas';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($conn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Inicializar la sesión si no está configurada
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
    var_dump($_SESSION['carrito']);
}

// Agregar producto al carrito
if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];

    if (isset($_SESSION['carrito'][$codigo])) {
        // Incrementar el número de unidades si el producto ya está en el carrito
        $_SESSION['carrito'][$codigo]++;
    } else {
        // Agregar el producto al carrito con una unidad
        $_SESSION['carrito'][$codigo] = 1;
    }
    var_dump($_SESSION['carrito']);
}

// Mostrar el contenido del carrito
echo '<h2>Carrito de Compras</h2>';

$total = 0; // Inicializar el total a cero

foreach ($_SESSION['carrito'] as $codigo_carrito => $cantidad) {
    $stmt = $pdo->prepare('SELECT nombre, precio FROM productos WHERE codigo = ?');
    $stmt->execute([$codigo_carrito]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    $precio_total_producto = $producto['precio'] * $cantidad;
    $total += $precio_total_producto;

    echo '<p>' . $producto['nombre'] . ' - Cantidad: ' . $cantidad . ' - Precio: $' . $precio_total_producto . '</p>';

    // Formulario para eliminar producto del carrito
    echo '<form action="cart.php" method="post">';
    echo '<input type="hidden" name="eliminar_codigo" value="' . $codigo_carrito . '">';
    echo '<input type="submit" value="Eliminar">';
    echo '</form>';
}

echo '<p>Total: $' . $total . '</p>'; 
echo '<form action="orders.php" method="post">';
echo '<input type="submit" name="comprar" value="Comprar">';
echo '</form>';

echo '<p>';

var_dump($_SESSION['id_cliente']);


// Enlace para seguir comprando
echo '<a href="verify.php">Seguir Comprando</a>';

} catch (PDOException $e) {
    die('Error al conectarse a la base de datos: ' . $e->getMessage());
}

// Eliminar producto del carrito
if (isset($_POST['eliminar_codigo'])) {
    $eliminar_codigo = $_POST['eliminar_codigo'];
    unset($_SESSION['carrito'][$eliminar_codigo]);
}


?>

