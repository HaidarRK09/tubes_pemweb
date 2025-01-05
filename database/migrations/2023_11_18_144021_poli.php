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
        // kolom poli
        Schema::create('polis', function (Blueprint $table) {
            $table->string('id_poli', 3)->primary();
            $table->string('nama', 25);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
