<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('filme_lista')) {
            return;
        }

        // If duplicates exist, do not attempt to add the unique constraint to avoid failing migrations.
        $duplicates = DB::table('filme_lista')
            ->select('lista_id', 'filme_id', DB::raw('COUNT(*) as c'))
            ->groupBy('lista_id', 'filme_id')
            ->having('c', '>', 1)
            ->first();

        if ($duplicates) {
            // There are duplicates; skip adding the constraint to avoid breaking the app.
            return;
        }

        Schema::table('filme_lista', function (Blueprint $table) {
            // Add unique constraint to prevent duplicate film/list entries
            $table->unique(['lista_id', 'filme_id'], 'filme_lista_unique');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('filme_lista')) {
            return;
        }

        Schema::table('filme_lista', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            // Attempt to drop the index if it exists
            try {
                $table->dropUnique('filme_lista_unique');
            } catch (\Throwable $e) {
                // ignore if index does not exist
            }
        });
    }
};
