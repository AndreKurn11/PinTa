<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 30)->unique();
            $table->foreignId('listing_id')->constrained('listings');
            $table->foreignId('buyer_id')->constrained('users');
            $table->foreignId('seller_id')->constrained('users');
            $table->enum('order_type', ['direct', 'auction', 'barter']);
            // FK auctions akan ditambahkan oleh modul lelang setelah tabel tersedia.
            $table->unsignedBigInteger('auction_id')->nullable()->unique();
            $table->foreignId('barter_offer_id')->nullable()->unique()->constrained('barter_offers');
            $table->decimal('item_amount', 12, 2);
            $table->decimal('platform_fee_rate', 5, 2);
            $table->decimal('platform_fee_amount', 12, 2);
            $table->decimal('total_amount', 12, 2);
            $table->decimal('seller_net_amount', 12, 2);
            $table->enum('payment_method', ['transfer', 'cod'])->nullable();
            $table->enum('status', ['awaiting_payment', 'paid', 'shipped', 'delivered', 'completed', 'cancelled', 'disputed'])->default('awaiting_payment');
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
            $table->index(['listing_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
