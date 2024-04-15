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
        Schema::create('artisan_specialty', function (Blueprint $table) {
            $table->foreignUuid('artisan_id')->references('id')->on('artisans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('specialty_id')->references('id')->on('specialties')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artisan_specialty');
    }
};
