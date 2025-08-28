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
        Schema::create('matieres', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // ex: Mathématiques, Français, Anglais, Physics, Chemistry
            $table->string('nom_en')->nullable(); // Traduction anglaise
            $table->string('code')->unique(); // ex: MATH, FR, ANG, PHYS, CHEM
            $table->string('couleur')->default('#007bff'); // Couleur pour l'affichage
            $table->integer('coefficient')->default(1);
            $table->boolean('tp_requis')->default(false); // Nécessite travaux pratiques
            $table->string('type_salle')->nullable(); // normal, labo, informatique, gymnase
            $table->text('description')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matieres');
    }
};
