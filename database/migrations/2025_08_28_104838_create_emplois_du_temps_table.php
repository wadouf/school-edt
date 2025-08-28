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
        Schema::create('emplois_du_temps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignId('matiere_id')->constrained('matieres')->cascadeOnDelete();
            $table->foreignId('enseignant_id')->constrained('enseignants')->cascadeOnDelete();
            $table->foreignId('salle_id')->nullable()->constrained('salles')->nullOnDelete();
            $table->foreignId('creneau_id')->constrained('creneaux_horaires')->cascadeOnDelete();
            $table->enum('jour_semaine', ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi']);
            $table->boolean('est_double_heure')->default(false); // Bloc de 2h consécutives
            $table->integer('semaine_type')->default(1); // Pour les emplois du temps alternés
            $table->date('date_debut')->nullable(); // Si cours spécifique à une période
            $table->date('date_fin')->nullable();
            $table->text('notes')->nullable();
            $table->unique(['classe_id', 'creneau_id', 'jour_semaine'], 'unique_classe_creneau');
            $table->unique(['enseignant_id', 'creneau_id', 'jour_semaine'], 'unique_enseignant_creneau');
            $table->unique(['salle_id', 'creneau_id', 'jour_semaine'], 'unique_salle_creneau');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emplois_du_temps');
    }
};
