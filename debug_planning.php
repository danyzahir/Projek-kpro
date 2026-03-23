<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$orders = App\Models\EbisPlanningOrder::latest()->take(5)->get();
foreach($orders as $o) {
    echo "ID: " . $o->id . "\n";
    echo "StarClick: " . $o->star_click_id . "\n";
    echo "Track ID: " . $o->track_id . "\n";
    echo "Datel: " . $o->datel . "\n";
    echo "STO: " . $o->sto . "\n";
    echo "Status Order: " . $o->status_order . "\n";
    echo "Created: " . $o->created_at . "\n";
    echo "-------------------\n";
}
