<?php

namespace shared;

abstract class Utils
{
    public static function checkAuthentication(): void
    {
        if (!isset($_SESSION['id'])) {
            header('Location: ../login/Login.php');
        }
    }
}
