<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE ebis_manual_inputs
            MODIFY nama_mitra ENUM(
                'PT UPAYA TEKNIK',
                'PT SARANA MITRA PERSADA',
                'PT LINEA',
                'PT TRIPOLA'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE ebis_manual_inputs
            MODIFY nama_mitra VARCHAR(255)
        ");
    }
};
