<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ebis_manual_inputs', function (Blueprint $table) {

            if (!Schema::hasColumn('ebis_manual_inputs', 'progres')) {
                $table->string('progres', 50)->nullable();
            }

            if (!Schema::hasColumn('ebis_manual_inputs', 'keterangan')) {
                $table->text('keterangan')->nullable();
            }

            if (!Schema::hasColumn('ebis_manual_inputs', 'data')) {
                $table->json('data')->nullable();
            }

            if (!Schema::hasColumn('ebis_manual_inputs', 'tanggal_update_progres')) {
                $table->dateTime('tanggal_update_progres')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('ebis_manual_inputs', function (Blueprint $table) {
            $table->dropColumn([
                'progres',
                'keterangan',
                'data',
                'tanggal_update_progres'
            ]);
        });
    }
};
