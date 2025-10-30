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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('url')->index();
            $table->string('route_name')->nullable()->index();
            $table->string('method', 10)->default('GET');
            $table->string('referer')->nullable();
            $table->string('device_type')->nullable(); // mobile, desktop, tablet
            $table->string('browser')->nullable();
            $table->string('platform')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->integer('status_code')->default(200);
            $table->integer('response_time')->nullable(); // en millisecondes
            $table->timestamp('visited_at')->useCurrent()->index();
            $table->timestamps();
            
            // Index pour les requêtes de statistiques
            $table->index(['visited_at', 'route_name']);
            $table->index(['visited_at', 'url']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
