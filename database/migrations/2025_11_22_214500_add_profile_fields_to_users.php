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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'data_nascimento')) {
                $table->date('data_nascimento')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'foto')) {
                $table->string('foto')->nullable()->after('data_nascimento');
            }
            // If users table still uses old columns 'nome' or 'senha', ensure compatibility is handled elsewhere.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'foto')) {
                $table->dropColumn('foto');
            }
            if (Schema::hasColumn('users', 'data_nascimento')) {
                $table->dropColumn('data_nascimento');
            }
        });
    }
};
