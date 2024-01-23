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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('imageUrl');
            $table->text('description');
            $table->integer('price');
            $table->integer('stock');
            $table->foreignUuid('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('size_id')->nullable()->references('id')->on('sizes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('color_id')->nullable()->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('artisan_id')->references('id')->on('artisans')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
