<?php

namespace App\Helpers;

class Csrf {
    
    public static function start()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

    public static function token()
    {
        self::start();
        return $_SESSION['csrf_token'];
    }

    public static function validate($token)
    {
        self::start();
        if (!is_string($token) || empty($_SESSION['csrf_token'])) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }
}

// Fonctions globales pour compatibilité rétroactive
function csrf_start()
{
    Csrf::start();
}

function csrf_token()
{
    return Csrf::token();
}

function csrf_validate($token)
{
    return Csrf::validate($token);
}
