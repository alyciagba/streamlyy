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
        // Safely add missing columns if they don't already exist
        if (!Schema::hasTable('filmes')) {
            // If the table truly doesn't exist, create it minimally to avoid errors
            Schema::create('filmes', function (Blueprint $table) {
                $table->id();
                $table->string('titulo')->nullable();
                $table->string('diretor')->nullable();
                $table->string('ano_lancamento')->nullable();
                $table->text('descricao')->nullable();
                $table->string('poster')->nullable();
                $table->integer('ranking')->nullable();
                $table->timestamps();
            });
            return;
        }

        if (!Schema::hasColumn('filmes', 'titulo')) {
            Schema::table('filmes', function (Blueprint $table) {
                $table->string('titulo')->nullable();
            });
        }

        if (!Schema::hasColumn('filmes', 'diretor')) {
            Schema::table('filmes', function (Blueprint $table) {
                $table->string('diretor')->nullable();
            });
        }

        if (!Schema::hasColumn('filmes', 'ano_lancamento')) {
            Schema::table('filmes', function (Blueprint $table) {
                $table->string('ano_lancamento')->nullable();
            });
        }

        if (!Schema::hasColumn('filmes', 'descricao')) {
            Schema::table('filmes', function (Blueprint $table) {
                $table->text('descricao')->nullable();
            });
        }

        if (!Schema::hasColumn('filmes', 'poster')) {
            Schema::table('filmes', function (Blueprint $table) {
                $table->string('poster')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('filmes')) {
            Schema::table('filmes', function (Blueprint $table) {
                if (Schema::hasColumn('filmes', 'poster')) {
                    $table->dropColumn('poster');
                }
                if (Schema::hasColumn('filmes', 'descricao')) {
                    $table->dropColumn('descricao');
                }
                if (Schema::hasColumn('filmes', 'ano_lancamento')) {
                    $table->dropColumn('ano_lancamento');
                }
                if (Schema::hasColumn('filmes', 'diretor')) {
                    $table->dropColumn('diretor');
                }
                if (Schema::hasColumn('filmes', 'titulo')) {
                    $table->dropColumn('titulo');
                }
            });
        }
    }
};
