<?php
$start = microtime(true);

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

$end = microtime(true);
echo "Total load time: " . ($end - $start) . " seconds\n";
echo "Status code: " . $response->getStatusCode() . "\n";
