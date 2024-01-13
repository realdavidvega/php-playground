<?php

require_once '../../../../../vendor/autoload.php';

use shared\Either;
use user\model\UserError;
use user\service\UserServiceInterpreter;

function checkRegister(): Either
{
    $name = trim($_POST["name"]);
    $surname = trim($_POST["surname"]);
    $address = trim($_POST["address"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if ($password !== $confirm_password) {
        $registerError = "The passwords doesn't match. Please try again.";
        return Either::left($registerError);
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        try {
            $service = new UserServiceInterpreter();
            $service->register($name, $surname, $address, $phone, $email, $hashed_password);
            $registerSuccess = "User created successfully!";
            return Either::right($registerSuccess);
        } catch (UserError $e) {
            $registerError = $e->getMessage();
            return Either::left($registerError);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
            die ("Error: " . $e->getMessage());
        }
    }
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $maybeRegister = checkRegister();
    if ($maybeRegister->isRight()) {
        $registerSuccess = $maybeRegister->getValue();
    } else {
        $registerError = $maybeRegister->getValue();
    }
}

include 'RegisterView.php';
