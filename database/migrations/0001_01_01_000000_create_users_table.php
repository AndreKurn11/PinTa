<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Informasi user
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->string('password', 255);

            // Informasi tambahan
            $table->string('phone', 20)->nullable();
            $table->string('identity_number', 30)->nullable();
            $table->text('address')->nullable();
            $table->string('avatar_path', 255)->nullable();

            // Verifikasi
            $table->boolean('is_verified')->default(false);
            $table->dateTime('verified_at')->nullable();

            // Foreign key
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();

            // Status akun
            $table->enum('status', ['active', 'suspended'])->default('active');

            // Timestamps
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
