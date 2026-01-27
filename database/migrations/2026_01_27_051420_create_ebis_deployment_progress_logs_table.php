<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ebis_deployment_progress_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ebis_manual_input_id')->constrained('ebis_manual_inputs')->cascadeOnDelete();

            $table->string('progres', 50);
            $table->json('data')->nullable(); // snapshot input progres
            $table->timestamp('created_at'); // waktu progres terjadi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebis_deployment_progress_logs');
    }
};
