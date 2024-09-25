<?php
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Clearing cache...\n";
$exitCode = Artisan::call('config:clear');
echo "Exit Code: " . $exitCode . "\n";

echo "Caching config...\n";
$exitCode = Artisan::call('config:cache');
echo "Exit Code: " . $exitCode . "\n";

echo "Done!";
