<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('found_items', function (Blueprint $table) {
            $table->id();

            // User who found/reported the item
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Item category
            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('cascade');

            // Where the item was found
            $table->foreignId('location_id')
                ->constrained('locations')
                ->onDelete('cascade');

            // Admin who received the item
            $table->foreignId('received_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->string('item_name');
            $table->text('description');
            $table->decimal('suggested_compensation', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->date('found_date');

            $table->string('status')->default('awaiting_surrender');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('found_items');
    }
};