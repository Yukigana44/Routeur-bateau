<?php
require __DIR__ . '/../controllers/AuthController.php';

$auth = new AuthController();
$auth->logout();