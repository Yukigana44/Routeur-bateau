<?php
if (php_sapi_name() === 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = __DIR__ . $url;

    if ($url !== '/' && file_exists($file)) {
        return false;
    }
}

require_once __DIR__ . '/index.php';
