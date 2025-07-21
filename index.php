<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Make sure this path matches your Laravel folder name!
require __DIR__ . '/../MediQTrack2/vendor/autoload.php';
$app = require_once __DIR__ . '/../MediQTrack2/bootstrap/app.php';


$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);