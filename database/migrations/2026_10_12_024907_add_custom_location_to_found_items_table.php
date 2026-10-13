<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('found_items', function (Blueprint $table) {
            $table->string('custom_location')->nullable()->after('location_id');
        });
    }

    public function down(): void
    {
        Schema::table('found_items', function (Blueprint $table) {
            $table->dropColumn('custom_location');
        });
    }
};