<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$order = App\Models\EbisManualInput::latest()->first();
if (!$order) {
    echo "No manual input found.\n";
    exit;
}

echo "Found Order: StarClick ID {$order->star_click_id}\n";
$planning = $order->planning;

if ($planning) {
    echo "Found Planning ID: {$planning->id}\n";
    $logsCount = App\Models\EbisPlanningProgressLog::where('ebis_planning_order_id', $planning->id)->count();
    echo "Logs Count: {$logsCount}\n";
    
    // Simulate the exact query from TelegramService
    $logs = App\Models\EbisPlanningProgressLog::where('ebis_planning_order_id', $planning->id)
                ->with('user')
                ->orderBy('created_at', 'asc')
                ->get();
    
    foreach ($logs as $i => $log) {
        $no = $i + 1;
        $date = $log->created_at->format('d M Y');
        $user = $log->user->name ?? 'System';
        echo "{$no}. {$log->progres} - {$date} ({$user})\n";
    }
} else {
    echo "No planning found for this order.\n";
}
