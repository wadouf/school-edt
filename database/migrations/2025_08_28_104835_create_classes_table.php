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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // ex: 6ème A (Fr), Form 1 Science (En), Terminale D1
            $table->string('code')->unique(); // ex: 6A_FR, F1_SCI_EN, TD1_FR
            $table->foreignId('niveau_id')->constrained('niveaux')->cascadeOnDelete();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->integer('effectif')->default(0);
            $table->integer('capacite_max')->default(50);
            $table->string('salle_principale')->nullable(); // Salle attitrée
            $table->string('professeur_principal')->nullable();
            $table->boolean('actif')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
