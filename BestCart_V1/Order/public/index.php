<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../app/core/helpers.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/View.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Router.php';

// Models (simple includes)
foreach (glob(__DIR__ . '/../app/models/*.php') as $f) { require_once $f; }

$route = $_GET['r'] ?? 'cart/index';
Router::dispatch($route);
