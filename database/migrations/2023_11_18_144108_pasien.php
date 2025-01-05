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
        // kolom pasien
        Schema::create('pasien', function (Blueprint $table) {
            $table->string('NIK', 16)->primary();
            $table->string('password', 25);
            $table->string('nama', 50);
            $table->string('nobpjs', 13);
            $table->string('notlp', 13);
            $table->string('email', 50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('alamat', 100);
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
