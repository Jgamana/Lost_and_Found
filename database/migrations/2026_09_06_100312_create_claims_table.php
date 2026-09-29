<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();

            // Found item being claimed
            $table->foreignId('found_item_id')
                ->constrained('found_items')
                ->onDelete('cascade');

            // User who is claiming the item
            $table->foreignId('claimant_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Admin/user who verifies the claim
            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->text('proof')->nullable();

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};