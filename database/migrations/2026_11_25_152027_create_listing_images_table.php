
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listing_images', function (Blueprint $table) {
            // Primary Key
            $table->id();

            // Foreign Key ke tabel listings
            $table->foreignId('listing_id')
                ->constrained('listings')
                ->cascadeOnDelete();

            // Lokasi file gambar
            $table->string('image_path', 255);

            // Penanda foto utama
            $table->boolean('is_primary')->default(false);

            // Urutan tampilan foto
            $table->unsignedTinyInteger('sort_order')->default(0);

            // Waktu foto diunggah
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listing_images');
    }
};
