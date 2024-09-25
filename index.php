<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Check if the application is in the public folder
if (file_exists(__DIR__.'/public/index.php')) {
    require __DIR__.'/public/index.php';
} else {
    // If not, we'll create our own bootstrap
    require __DIR__.'/vendor/autoload.php';

    $app = require_once __DIR__.'/bootstrap/app.php';

    $kernel = $app->make(Kernel::class);

    $response = tap($kernel->handle(
        $request = Request::capture()
    ))->send();

    $kernel->terminate($request, $response);
}
