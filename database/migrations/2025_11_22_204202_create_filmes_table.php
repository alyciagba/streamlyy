<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('filmes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('diretor')->nullable();
            $table->year('ano_lancamento')->nullable();
            $table->text('descricao')->nullable();
            $table->string('poster')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filmes');
    }
};
