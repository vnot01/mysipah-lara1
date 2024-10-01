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
        Schema::create('status_alats', function (Blueprint $table) {
            $table->id();
            $table->integer('kode')->nullable();
            $table->string('nama')->nullable();
            $table->timestamps();
        });
        Schema::table('status_alats', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_alat');
    }
};
