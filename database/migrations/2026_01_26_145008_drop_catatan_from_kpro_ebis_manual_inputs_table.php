<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ebis_manual_inputs', function (Blueprint $table) {
            $table->dropColumn('catatan');
        });
    }

    public function down(): void
    {
        Schema::table('ebis_manual_inputs', function (Blueprint $table) {
            $table->text('catatan')->nullable();
        });
    }
};
