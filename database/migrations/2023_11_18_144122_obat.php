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
        // kolom obat
        Schema::create('obat', function (Blueprint $table) {
            $table->string('id_obat', 10)->primary();
            $table->string('nama', 30);
            $table->string('merk', 30);
            $table->string('deskripsi', 100);
            $table->integer('harga');
            $table->integer('qty');
            $table->enum('uom', ['botol','strip','pieces','box','tablet']);
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
