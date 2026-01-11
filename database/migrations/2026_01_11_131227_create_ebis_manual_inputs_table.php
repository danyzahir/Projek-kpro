<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ebis_manual_inputs', function (Blueprint $table) {
            $table->id();

            $table->string('nde_jt')->nullable();
            $table->string('star_click_id')->nullable();
            $table->string('nama_customer')->nullable();
            $table->text('alamat_pelanggan')->nullable();
            $table->string('telepon_pelanggan')->nullable();
            $table->string('tikor_pelanggan')->nullable();

            $table->enum('datel', [
                'CIREBON',
                'INDRAMAYU',
                'MAJALENGKA',
                'KUNINGAN',
                'SUBANG'
            ])->nullable();

            $table->enum('sto', [
                'ARJAWINANGUN','BALONGAN','CIREBON','CIKIJING','HAURGEULIS',
                'INDRAMAYU','JAMBLANG','JATIBARANG','JATIWANGI','KADIPATEN',
                'KANCI','KARANGAMPEL','KARYAMULIA','KUNINGAN','CILIMUS',
                'LOSARANG','LOSARI','MAJALENGKA','PABUARAN','PATROL',
                'PLERED','RAJAGALUH','SINDANGLAUT','SUBANG','JALANCAGAK',
                'PAMANUKAN','PAGADEN','KALIJATI','CIASEM'
            ])->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ebis_manual_inputs');
    }
};
