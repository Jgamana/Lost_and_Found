<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compensations', function (Blueprint $table) {
            $table->id();

            // The approved claim connected to this compensation
            $table->foreignId('claim_id')
                ->constrained('claims')
                ->onDelete('cascade');

            // Person who found the item
            $table->foreignId('finder_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Owner/claimant who pays the compensation
            $table->foreignId('claimant_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Admin who confirms the compensation
            $table->foreignId('confirmed_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            // Actual compensation amount
            $table->decimal('amount', 10, 2);

            // Compensation status
            $table->string('status')->default('unpaid');

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compensations');
    }
};