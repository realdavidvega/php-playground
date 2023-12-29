<?php

require_once '../../../../../vendor/autoload.php';

use user\model\UserError;
use user\service\DefaultUserService;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $service = new DefaultUserService();

    try {
        $service->login($email, $password);
        $_SESSION['email'] = $email;
        header("Location: ../shop/Shop.php");
        exit();
    } catch (UserError $e) {
        $registerError = $e->getMessage();
    } catch (Exception $e) {
        echo 'An error occurred: ' . $e->getMessage();
    }
}
$loginMessage = "If you are not registered, <a href='../register/Register.php'> register</a>.";

include "LoginView.php";
