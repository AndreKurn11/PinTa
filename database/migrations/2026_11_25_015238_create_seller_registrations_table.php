<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_registrations', function (Blueprint $table) {

            // Primary key
            $table->id();

            // User yang mengajukan pendaftaran
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Informasi toko yang diajukan
            $table->string('store_name', 100);
            $table->text('description')->nullable();
            $table->string('phone', 20);
            $table->text('address');

            // Status pengajuan
            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            // Admin yang memproses pengajuan
            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Waktu pemeriksaan
            $table->dateTime('reviewed_at')->nullable();

            // Alasan penolakan
            $table->text('rejection_reason')->nullable();

            // Timestamps
            $table->timestamps();

            // Index untuk pencarian berdasarkan user dan status
            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_registrations');
    }
};
