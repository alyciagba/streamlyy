<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('listas')) {
            Schema::create('listas', function (Blueprint $table) {
                $table->id();
                $table->string('nome');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
            return;
        }

        if (!Schema::hasColumn('listas', 'nome')) {
            Schema::table('listas', function (Blueprint $table) {
                $table->string('nome')->nullable();
            });
        }

        if (!Schema::hasColumn('listas', 'user_id')) {
            Schema::table('listas', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('listas')) {
            return;
        }

        Schema::table('listas', function (Blueprint $table) {
            if (Schema::hasColumn('listas', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('listas', 'nome')) {
                $table->dropColumn('nome');
            }
        });
    }
};
