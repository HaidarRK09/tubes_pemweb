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
        Schema::create('staffs', function (Blueprint $table) {
            $table->string('nip', 10)->primary();
            $table->string('username', 25);
            $table->string('password', 255);
            $table->rememberToken();
            $table->string('nama', 50);
            $table->string('notlp', 13);
            $table->string('email', 50);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('alamat', 100);
            $table->enum('role', ['dokter umum', 'dokter gigi', 'radiologi', 'apoteker', 'admin', 'superadmin']);
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
