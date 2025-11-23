<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('filmes', function (Blueprint $table) {
            // Add ranking without specifying a column position so migration
            // doesn't fail if the `poster` column is missing in some DBs.
            $table->integer('ranking')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('filmes', function (Blueprint $table) {
            $table->dropColumn('ranking');
        });
    }
};
