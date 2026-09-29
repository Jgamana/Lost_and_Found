<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('claims', function (Blueprint $table) {

            $table->date('release_date')
                ->nullable()
                ->after('status');

            $table->time('release_time')
                ->nullable()
                ->after('release_date');

            $table->string('release_location')
                ->nullable()
                ->after('release_time');

        });
    }

    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {

            $table->dropColumn([
                'release_date',
                'release_time',
                'release_location',
            ]);

        });
    }
};