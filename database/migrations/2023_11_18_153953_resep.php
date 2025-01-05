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
        //kolom resep
        Schema::create('resep', function (Blueprint $table) {
            $table->string('id_resep', 10)->primary();
            $table->string('id_daftar', 10);
            
            $table->foreign('id_daftar')->references('id_daftar')->on('daftar')->onUpdate('cascade')->onDelete('restrict');
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
