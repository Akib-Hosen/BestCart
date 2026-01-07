<?php
// Session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Simple autoloader
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/'.$class.'.php',
        __DIR__ . '/../controllers/'.$class.'.php',
        __DIR__ . '/../models/'.$class.'.php',
    ];
    foreach ($paths as $p) {
        if (file_exists($p)) { require_once $p; return; }
    }
});

require_once __DIR__ . '/helpers.php';
