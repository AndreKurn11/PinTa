<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barter_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checkout_draft_id')->unique()->constrained('barter_checkout_drafts');
            $table->foreignId('listing_id')->constrained('listings');
            $table->foreignId('offerer_id')->constrained('users');
            $table->enum('offer_type', ['item', 'cash', 'mixed']);
            $table->decimal('cash_amount', 12, 2)->default(0);
            $table->decimal('price_difference', 12, 2)->default(0);
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected', 'cancelled', 'expired'])->default('pending');
            $table->dateTime('responded_at')->nullable();
            $table->timestamps();
            $table->index(['listing_id', 'status']);
            $table->index(['offerer_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barter_offers');
    }
};
