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
        Schema::create('processing_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('processings_id')->nullable()->default(1);
            $table->unsignedBigInteger('products_id')->nullable()->default(1);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processing_statuses');
    }
};