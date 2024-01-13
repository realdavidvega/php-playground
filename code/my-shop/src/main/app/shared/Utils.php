<?php

namespace shared;

abstract class Utils
{
    public static function checkAuthentication(): void
    {
        if (!isset($_SESSION['userId'])) {
            header('Location: ../../../index.php');
        }
    }
}
