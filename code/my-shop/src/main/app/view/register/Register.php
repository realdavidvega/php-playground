<?php
session_start();

require_once '../../../../../vendor/autoload.php';

use user\model\UserError;
use user\service\DefaultUserService;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $name = trim($_POST["name"]);
    $surname = trim($_POST["surname"]);
    $address = trim($_POST["address"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if ($password !== $confirm_password) {
        $registerError = "The passwords doesn't match. Please try again.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        try {
            $service = new DefaultUserService();
            $service->register($name, $surname, $address, $phone, $email, $hashed_password);
            $registerSuccess = "User created successfully!";
        } catch (UserError $e) {
            $registerError = $e->getMessage();
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}
$registerMessage = "If you are registered, <a href='../login/Login.php'> login</a>.";

include 'RegisterView.php';
