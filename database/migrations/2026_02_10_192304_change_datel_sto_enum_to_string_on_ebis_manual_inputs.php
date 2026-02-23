<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom datel dari ENUM ke VARCHAR(50)
        DB::statement("ALTER TABLE ebis_manual_inputs MODIFY datel VARCHAR(50) NULL");

        // Ubah kolom sto dari ENUM ke VARCHAR(50)
        DB::statement("ALTER TABLE ebis_manual_inputs MODIFY sto VARCHAR(50) NULL");
    }

    public function down(): void
    {
        // Rollback ke ENUM (datel)
        DB::statement("ALTER TABLE ebis_manual_inputs MODIFY datel ENUM('CIREBON','INDRAMAYU','MAJALENGKA','KUNINGAN','SUBANG') NULL");

        // Rollback ke ENUM (sto)
        DB::statement("ALTER TABLE ebis_manual_inputs MODIFY sto ENUM('AWN','BON','CBN','CKI','HAR','IMY','JBN','JTB','JWG','KAD','CKC','KRA','KYM','KNG','LGJ','LSR','LOS','MJL','PAB','PTR','PLD','RGA','SDU','SUB','JCG','PMN','PGD','KIA','CAS','PBS') NULL");
    }
};
