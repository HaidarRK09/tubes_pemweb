<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // kolom daftar
        Schema::create('daftar', function (Blueprint $table) {
            $table->string('id_daftar', 10)->primary();
            $table->date('tgl');
            $table->string('id_booking', 10);
            $table->string('NIK', 16);
            $table->string('id_sesi', 5);
            
            $table->foreign('id_booking')->references('id_booking')->on('booking')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('NIK')->references('NIK')->on('pasien')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_sesi')->references('id_sesi')->on('sesi')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
    }
};
