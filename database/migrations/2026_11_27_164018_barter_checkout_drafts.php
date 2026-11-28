<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barter_checkout_drafts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('listing_id')->constrained('listings');
            $table->enum('delivery_method', ['cod', 'shipping']);
            $table->text('delivery_address');
            $table->text('notes')->nullable();
            $table->enum('status', ['draft', 'submitted', 'expired'])->default('draft');
            $table->timestamp('expires_at');
            $table->timestamps();
            $table->index(['user_id', 'listing_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barter_checkout_drafts');
    }
};
