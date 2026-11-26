
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            // Primary Key
            $table->id();

            // Foreign Key ke tabel users
            $table->foreignId('seller_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Foreign Key ke tabel categories
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            // Informasi barang
            $table->string('title', 150);
            $table->text('description');

            // Kondisi barang
            $table->enum('item_condition', [
                'like_new',
                'good',
                'fair',
                'needs_repair'
            ]);

            // Lokasi barang
            $table->string('location', 150);

            // Mode penjualan
            $table->enum('sale_mode', [
                'direct',
                'auction',
                'barter'
            ]);

            // Harga barang
            $table->decimal('price', 10, 2)->nullable();

            // Status listing
            $table->enum('status', [
                'draft',
                'active',
                'in_transaction',
                'sold',
                'closed'
            ])->default('active');

            // Soft Delete
            $table->softDeletes();

            // Timestamp
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
