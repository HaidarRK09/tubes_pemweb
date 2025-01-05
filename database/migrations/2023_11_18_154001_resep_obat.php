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
        // kolom resep obat
        Schema::create('resep_obat', function (Blueprint $table) {
            $table->string('id_resep', 10);
            $table->string('id_obat', 10);

            $table->primary(['id_resep', 'id_obat']);
            $table->foreign('id_resep')->references('id_resep')->on('resep')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_obat')->references('id_obat')->on('obat')->onUpdate('cascade')->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
