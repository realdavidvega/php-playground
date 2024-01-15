<?php

namespace shared;

abstract class Utils
{
    public static function checkAuthentication(): void
    {
        if (empty($_SESSION['userId'])) {
            header('Location: ../../../index.php');
            die("Error: No client registered.");
        }
    }
}
