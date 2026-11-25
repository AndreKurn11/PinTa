<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {

            // Primary key
            $table->id();

            // Relasi ke user (satu user maksimal satu toko)
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            // Informasi toko
            $table->string('store_name', 100);
            $table->string('slug', 120)->unique();
            $table->text('description')->nullable();
            $table->string('phone', 20);
            $table->text('address');
            $table->string('logo_path', 255)->nullable();

            // Status toko
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};