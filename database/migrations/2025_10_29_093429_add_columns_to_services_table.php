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
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'titre')) {
                $table->string('titre')->after('id');
            }
            if (!Schema::hasColumn('services', 'slug')) {
                $table->string('slug')->unique()->after('titre');
            }
            if (!Schema::hasColumn('services', 'description')) {
                $table->text('description')->after('slug');
            }
            if (!Schema::hasColumn('services', 'icone_svg')) {
                $table->text('icone_svg')->after('description');
            }
            if (!Schema::hasColumn('services', 'actif')) {
                $table->boolean('actif')->default(true)->after('icone_svg');
            }
            if (!Schema::hasColumn('services', 'ordre')) {
                $table->integer('ordre')->default(0)->after('actif');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['titre', 'slug', 'description', 'icone_svg', 'actif', 'ordre']);
        });
    }
};
