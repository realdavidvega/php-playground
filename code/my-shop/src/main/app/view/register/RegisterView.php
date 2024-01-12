<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MyShop</title>
</head>
<body>
<?php
echo isset($registerError) ? "<p>$registerError</p>" : '';
echo isset($registerSuccess) ? "<p>$registerSuccess</p>" : '';
echo isset($registerMessage) ? "<p>$registerMessage</p>" : '';
?>

<h2>Register</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" placeholder="Name" required>
    <br>
    <label for="surname">Surname:</label>
    <input type="text" name="surname" id="surname" placeholder="Surname" required>
    <br>
    <label for="address">Address:</label>
    <input type="text" name="address" id="address" placeholder="Address" required>
    <br>
    <label for="phone">Phone:</label>
    <input type="tel" name="phone" id="phone" placeholder="Phone" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="Email" autocomplete="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" placeholder="Password" required autocomplete="password">
    <br>
    <label for="confirm_password">Confirm password:</label>
    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
    <br>
    <input type="submit" name="register" value="Register">
</form>
</body>
</html>
