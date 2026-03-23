<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$all = App\Models\EbisManualInput::count();
$selesai = App\Models\EbisManualInput::whereNotNull('progres')->whereIn('progres', ['GOLIVE', 'PS', 'UJI TERIMA', 'REKON', 'SELESAI FISIK'])->count();

// Calculate Global Overdue
$overdueGlobal = App\Models\EbisManualInput::whereHas('planning', function($q) {
    $q->whereNotIn('status_order', ['Success', 'Gagal', 'Cancel']);
})
->whereNotNull('data')
->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.commitment_date')) IS NOT NULL")
->whereRaw("STR_TO_DATE(JSON_UNQUOTE(JSON_EXTRACT(data, '$.commitment_date')), '%Y-%m-%d') < ?", [now()->startOfDay()->format('Y-m-d')])
->count();

$onTrackExpected = $all - $selesai - $overdueGlobal;

echo "All: " . $all . "\n";
echo "Selesai: " . $selesai . "\n";
echo "OverdueGlobal: " . $overdueGlobal . "\n";
echo "OnTrackExpected: " . $onTrackExpected . "\n";
