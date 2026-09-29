<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            // User who will receive the notification
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Notification message
            $table->string('title');
            $table->text('message');

            // Example: claim, found item, compensation
            $table->string('type')->nullable();

            // Whether the notification has been read
            $table->boolean('is_read')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};