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
        // kolom sesi
        Schema::create('sesi', function (Blueprint $table) {
            $table->string('id_sesi', 5)->primary();
            $table->enum('hari', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('status', ['Aktif','Non Aktif']);
            $table->string('id_poli', 3);
            $table->string('nip', 10);

            $table->foreign('id_poli')->references('id_poli')->on('poli')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('nip')->references('nip')->on('staffs')->onUpdate('cascade')->onDelete('restrict');
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
