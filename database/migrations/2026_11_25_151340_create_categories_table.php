
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            // Primary Key
            $table->id();

            // Foreign Key untuk kategori induk
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('categories');

            // Nama kategori
            $table->string('name', 80);

            // Slug kategori (unik)
            $table->string('slug', 100)->unique();

            // Timestamp
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
