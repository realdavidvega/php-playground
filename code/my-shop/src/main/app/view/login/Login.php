<?php

require_once '../../../../../vendor/autoload.php';

use shared\Either;
use user\model\UserError;
use user\service\UserServiceInterpreter;

function checkLogin(): Either
{
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    try {
        $service = new UserServiceInterpreter();
        $userId = $service->login($email, $password);
        return Either::right($userId);
    } catch (UserError $e) {
        $loginError = $e->getMessage();
        return Either::left($loginError);
    } catch (Exception $e) {
        echo 'An error occurred: ' . $e->getMessage();
        die ("Error: " . $e->getMessage());
    }
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $maybeLogin = checkLogin();
    if ($maybeLogin->isRight()) {
        $_SESSION['userId'] = $maybeLogin->getValue();
        header("Location: ../shop/Shop.php");
        exit();
    } else {
        $loginError = $maybeLogin->getValue();
    }
}

include "LoginView.php";
