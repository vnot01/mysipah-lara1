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
        Schema::enableForeignKeyConstraints();
        Schema::create('api_tokens', function (Blueprint $table) {
            $table->id()->unique()->index();
            $table->string('uuid')->nullable();
            $table->unsignedBigInteger('personal_access_id')->nullable();
            $table->string('api_tokens')->nullable();
            $table->string('token_type')->nullable()->default('Bearer');
            $table->timestamps();
        });
        Schema::table('api_tokens', function (Blueprint $table) {
            $table->foreignId('tokenable_id')->constrained(
                table: 'personal_access_tokens', indexName: 'personal_access_id'
            )->onDelete('cascade');
        });

        Schema::table('api_tokens', function (Blueprint $table) {
            $table->softDeletes();
        });
        // Schema::table('api_tokens', function (Blueprint $table) {
        //     $table->foreign('personal_access_id')
        //           ->references('tokenable_id')
        //           ->on('personal_access_tokens')
        //           ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_tokens');
    }
};