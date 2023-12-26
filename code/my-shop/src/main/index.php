<?php
session_start();

$output = shell_exec('vendor/bin/phinx migrate -c ../phinx.yml');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyShop</title>
</head>
<body>
    <h2>Welcome to MyShop!</h2>
    <p>Please, select an option:</p>
    <ul>
        <li><a href="app/user/controller/Register.php">Register</a></li>
        <li><a href="app/user/controller/Login.php">Login</a></li>
    </ul>
</body>
</html>
