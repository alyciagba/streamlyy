<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('filme_lista')) {
            Schema::create('filme_lista', function (Blueprint $table) {
                $table->id();
                $table->foreignId('lista_id')->constrained()->onDelete('cascade');
                $table->foreignId('filme_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
            return;
        }

        Schema::table('filme_lista', function (Blueprint $table) {
            if (!Schema::hasColumn('filme_lista', 'lista_id')) {
                $table->foreignId('lista_id')->nullable()->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('filme_lista', 'filme_id')) {
                $table->foreignId('filme_id')->nullable()->constrained()->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('filme_lista')) {
            return;
        }

        Schema::table('filme_lista', function (Blueprint $table) {
            if (Schema::hasColumn('filme_lista', 'filme_id')) {
                $table->dropForeign(['filme_id']);
                $table->dropColumn('filme_id');
            }
            if (Schema::hasColumn('filme_lista', 'lista_id')) {
                $table->dropForeign(['lista_id']);
                $table->dropColumn('lista_id');
            }
        });
    }
};
