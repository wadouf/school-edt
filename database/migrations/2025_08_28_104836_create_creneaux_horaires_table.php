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
        Schema::create('creneaux_horaires', function (Blueprint $table) {
            $table->id();
            $table->enum('jour_semaine', ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi']);
            $table->time('heure_debut'); // ex: 07:30
            $table->time('heure_fin'); // ex: 08:25
            $table->integer('ordre'); // Position dans la journée (1, 2, 3, ...)
            $table->boolean('est_pause')->default(false); // Récréation, pause déjeuner
            $table->string('nom')->nullable(); // ex: "1ère heure", "Récréation", "Pause déjeuner"
            $table->boolean('actif')->default(true);
            $table->unique(['jour_semaine', 'heure_debut']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creneaux_horaires');
    }
};
