<?php
require_once __DIR__ . '/../controllers/AuthController.php';
define('ROOT', dirname(__DIR__));
require ROOT . '/config/database.php';

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

header("Location: login.php");
exit;