<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Vérifier si la colonne slug existe déjà
        $hasSlug = false;
        try {
            $columns = DB::select("PRAGMA table_info(portfolio_items)");
            foreach ($columns as $column) {
                if ($column->name === 'slug') {
                    $hasSlug = true;
                    break;
                }
            }
        } catch (\Exception $e) {
            // Si ce n'est pas SQLite, utiliser une autre méthode
            $hasSlug = Schema::hasColumn('portfolio_items', 'slug');
        }
        
        if (!$hasSlug) {
            Schema::table('portfolio_items', function (Blueprint $table) {
                $table->string('slug')->unique()->after('titre');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('portfolio_items', 'slug')) {
            Schema::table('portfolio_items', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
};

