<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\EbisManualInput;

$baseQuery = function() {
    return EbisManualInput::query();
};

$finishedOrders = (clone $baseQuery())
    ->whereIn('ebis_manual_inputs.progres', ['GOLIVE', 'PS', 'UJI TERIMA', 'REKON', 'SELESAI FISIK'])
    ->whereNotNull('ebis_manual_inputs.nama_mitra')
    ->where('ebis_manual_inputs.nama_mitra', '!=', '')
    ->with(['planning' => function($q) {
        $q->with(['logs' => function($q2) {
            $q2->whereIn('progres', ['GOLIVE', 'PS', 'UJI TERIMA', 'REKON', 'SELESAI FISIK'])
               ->orderBy('created_at', 'asc');
        }]);
    }])
    ->get(['ebis_manual_inputs.star_click_id', 'ebis_manual_inputs.nama_mitra', 'ebis_manual_inputs.created_at']);

echo "Finished Orders count: " . $finishedOrders->count() . "\n";

$mitraStats = [];
foreach ($finishedOrders as $order) {
    $firstLog = $order->planning?->logs->first();
    if ($firstLog && $order->created_at) {
        $minutes = abs($order->created_at->diffInMinutes($firstLog->created_at, false));
        $mitra = $order->nama_mitra;
        if (!isset($mitraStats[$mitra])) {
            $mitraStats[$mitra] = ['total_minutes' => 0, 'count' => 0];
        }
        $mitraStats[$mitra]['total_minutes'] += $minutes;
        $mitraStats[$mitra]['count']++;
        echo "Order {$order->star_click_id} | Mitra: {$mitra} | Minutes: {$minutes}\n";
    } else {
        echo "Order {$order->star_click_id} | Missing Planning or Logs\n";
    }
}

$mitraAvgArray = [];
foreach ($mitraStats as $mitra => $stat) {
    if ($stat['count'] > 0) {
        $avgMinutes = $stat['total_minutes'] / $stat['count'];
        $avgDaysRaw = $avgMinutes / 1440;
        $days = floor($avgMinutes / 1440);
        $hours = floor(($avgMinutes % 1440) / 60);
        $labelStr = "{$days} Hari";
        if ($hours > 0) $labelStr .= " {$hours} Jam";
        echo "Mitra: {$mitra} | AvgMinutes: {$avgMinutes} | Label: {$labelStr}\n";
    }
}
