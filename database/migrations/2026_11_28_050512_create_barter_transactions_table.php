<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barter_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->unique()
                ->constrained('orders');

            // Pemeriksaan barang barter
            $table->enum('inspection_status', [
                'waiting',
                'passed',
                'failed'
            ])->default('waiting');

            $table->text('inspection_note')->nullable();

            $table->foreignId('inspected_by')
                ->nullable()
                ->constrained('users');

            $table->dateTime('inspected_at')->nullable();

            // Konfirmasi penerimaan barang
            $table->dateTime('seller_received_at')->nullable();
            $table->dateTime('buyer_received_at')->nullable();

            // Nomor resi pengiriman barter
            $table->string('seller_tracking_number', 100)->nullable();
            $table->string('buyer_tracking_number', 100)->nullable();

            // Waktu pengiriman barang
            $table->dateTime('seller_sent_at')->nullable();
            $table->dateTime('buyer_sent_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barter_transactions');
    }
};
