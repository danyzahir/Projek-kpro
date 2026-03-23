<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$orders = App\Models\EbisManualInput::whereNotNull('data')->get()
    ->filter(function($o) { 
        return isset($o->data['commitment_date']); 
    });

foreach($orders as $o) {
    $plan = $o->planning;
    echo "ID: " . $o->star_click_id . "\n";
    echo "Progres: " . $o->progres . "\n";
    echo "Status: " . ($plan ? $plan->status_order : 'null') . "\n";
    echo "Com-Date: " . $o->data['commitment_date'] . "\n";
    echo "By: " . ($o->data['commitment_updated_by'] ?? 'null') . "\n";
    echo "-------------------\n";
}
