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
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname', 255)->nullable()->change();
            $table->string('lastname', 255)->nullable()->change();
            $table->date('birthdate')->nullable()->change();
            $table->foreignUuid('role_id')->default('9b294817-b6af-4c0a-8f07-c7986972d8be')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
