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
        Schema::create('disponibilites_enseignants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enseignant_id')->constrained('enseignants')->cascadeOnDelete();
            $table->enum('jour_semaine', ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi']);
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->boolean('disponible')->default(true); // true = disponible, false = indisponible
            $table->string('motif')->nullable(); // Raison de l'indisponibilité
            $table->date('date_debut')->nullable(); // Pour les indisponibilités temporaires
            $table->date('date_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disponibilites_enseignants');
    }
};
