<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$routes = app('router')->getRoutes();
$output = [];
foreach ($routes as $route) {
    if (strpos($route->uri(), 'trabajo') !== false) {
        $output[] = $route->uri() . ' | ' . implode(',', $route->middleware());
    }
}
echo implode("\n", $output);
