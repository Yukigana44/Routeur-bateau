<?php

define('ROOT', dirname(__DIR__));


require_once ROOT . '/../config/database.php';


require_once ROOT . '/src/Controller/AuthController.php';
require_once ROOT . '/src/Controller/TrajetController.php';
use App\Controller\AuthController;
use App\Controller\TrajetController;