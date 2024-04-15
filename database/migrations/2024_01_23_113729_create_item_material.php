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
        Schema::create('item_material', function (Blueprint $table) {
            $table->foreignUuid('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('material_id')->references('id')->on('materials')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_material');
    }
};
