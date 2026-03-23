<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$counts = App\Models\EbisManualInput::select('progres', DB::raw('count(*) as total'))->groupBy('progres')->get();
foreach($counts as $row) {
    echo $row->progres . ': ' . $row->total . "\n";
}
