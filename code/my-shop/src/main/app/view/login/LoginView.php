<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MyShop</title>
</head>
<body>
<?php
if (isset($loginError)) {
    echo "<p>$loginError</p>";
}
if (isset($loginMessage)) {
    echo "<p>$loginMessage</p>";
}
?>
<h2>Login</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="Email" autocomplete="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" placeholder="password" autocomplete="current-password"
           required>
    <br>
    <input type="submit" name="login" value="Login">
</form>
</body>
</html>
