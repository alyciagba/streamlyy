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
        if (!Schema::hasTable('filme_user')) {
            Schema::create('filme_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('filme_id')->constrained()->onDelete('cascade');
                $table->tinyInteger('avaliacao')->nullable();
                $table->text('comentario')->nullable();
                $table->timestamps();
            });
            return;
        }

        // Add columns if missing
        if (!Schema::hasColumn('filme_user', 'user_id')) {
            Schema::table('filme_user', function (Blueprint $table) {
                $table->foreignId('user_id')->after('id')->nullable(false)->constrained()->onDelete('cascade');
            });
        }

        if (!Schema::hasColumn('filme_user', 'filme_id')) {
            Schema::table('filme_user', function (Blueprint $table) {
                $table->foreignId('filme_id')->after('user_id')->nullable(false)->constrained()->onDelete('cascade');
            });
        }

        if (!Schema::hasColumn('filme_user', 'avaliacao')) {
            Schema::table('filme_user', function (Blueprint $table) {
                $table->tinyInteger('avaliacao')->nullable();
            });
        }

        if (!Schema::hasColumn('filme_user', 'comentario')) {
            Schema::table('filme_user', function (Blueprint $table) {
                $table->text('comentario')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('filme_user')) {
            Schema::table('filme_user', function (Blueprint $table) {
                if (Schema::hasColumn('filme_user', 'comentario')) {
                    $table->dropColumn('comentario');
                }
                if (Schema::hasColumn('filme_user', 'avaliacao')) {
                    $table->dropColumn('avaliacao');
                }
                if (Schema::hasColumn('filme_user', 'filme_id')) {
                    $table->dropForeign(['filme_id']);
                    $table->dropColumn('filme_id');
                }
                if (Schema::hasColumn('filme_user', 'user_id')) {
                    $table->dropForeign(['user_id']);
                    $table->dropColumn('user_id');
                }
            });
        }
    }
};
