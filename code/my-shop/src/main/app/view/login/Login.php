<?php
session_start();

require_once '../../../../../vendor/autoload.php';

use shared\Either;
use user\model\UserError;
use user\service\DefaultUserService;

function checkLogin(): Either
{
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    try {
        $service = new DefaultUserService();
        $id = $service->login($email, $password)->getId();
        return Either::right($id);
    } catch (UserError $e) {
        $loginError = $e->getMessage();
        return Either::left($loginError);
    } catch (Exception $e) {
        echo 'An error occurred: ' . $e->getMessage();
        die ("Error: " . $e->getMessage());
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $maybeLogin = checkLogin();
    if ($maybeLogin->isRight()) {
        $_SESSION['id'] = $maybeLogin->getValue();
        header("Location: ../shop/Shop.php");
        exit();
    } else {
        $loginError = $maybeLogin->getValue();
    }
}

$loginMessage = "If you are not registered, <a href='../register/Register.php'> register</a>.";

include "LoginView.php";
