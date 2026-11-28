<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barter_offer_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('barter_offers');
            $table->foreignId('offered_listing_id')->nullable()->constrained('listings');
            $table->string('item_name', 150);
            $table->text('description')->nullable();
            $table->enum('item_condition', ['like_new', 'good', 'fair', 'needs_repair']);
            $table->decimal('estimated_value', 12, 2)->nullable();
            $table->string('image_path')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->unique(['offer_id', 'offered_listing_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barter_offer_items');
    }
};
