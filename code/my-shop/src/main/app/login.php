<?php
session_start();

// Verifica si se envió el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logarse"])) {
    $usuario = trim($_POST["email"]);
    $contrasenia = trim($_POST["contrasenia"]);

    // Conexion a BBDD
    try {
        $conexion = new PDO("mysql:host=localhost:3306;dbname=camisetas", "root", "");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL del correo en la bbdd. 
      
        $consulta = $conexion->prepare ("SELECT * FROM camisetas.clientes WHERE email = :email");
        $consulta->bindParam(":email", $usuario);
        $consulta->execute();

        $usuarioEncontrado = $consulta->fetch(PDO::FETCH_ASSOC);

        // Verifica si se encontro el correo y si la contrasenia coincide con la registrada.
        if ($usuarioEncontrado && password_verify($contrasenia, $usuarioEncontrado['contrasenia'])) {
            $_SESSION['email'] = $usuario;
            header("Location: verify.php");
            exit();
        } else {
            $mensajeError = "Usuario o contrasenia incorrectos.";
        }
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
}
// Mensaje con un enlace a la pagina de registro
$mensajeInicio = "No estas registrado <a href='register.php'> Ir a Registrarse </a>.";


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Feedback-TerezaFranco</title>
</head>

<body>


    <?php
    // Mostrar un mensaje de Inicio o un Mensaje en caso de Error.
    if (isset($mensajeError)) {
        echo "<p>$mensajeError</p>";
    }
    if (isset($mensajeInicio)) {
        echo "<p>$mensajeInicio</p>";
    }
    ?>
    <h2>Iniciar sesión</h2>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Usuario:</label>
        <input type="email" name="email" id="email" placeholder="Correo electrónico" required autocomplete="username">
        <br>

        <label for="contrasenia">contrasenia:</label>
        <input type="password" name="contrasenia" id="contrasenia" placeholder="contrasenia" required autocomplete="current-password">
        <br>

        <input type="submit" name="logarse" value="Iniciar sesión">
    </form>

</body>

</html>
