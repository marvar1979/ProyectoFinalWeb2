<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Modo mantenimiento
if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoloader de Composer
require __DIR__.'/vendor/autoload.php';

// Bootstrap de Laravel
/** @var Application $app */
$app = require_once __DIR__.'/bootstrap/app.php';

// Maneja la petición
$app->handleRequest(Request::capture());
