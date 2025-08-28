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
        Schema::create('salles', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // ex: Salle 101, Labo Physique, Gymnase
            $table->string('code')->unique(); // ex: S101, LAB_PHYS, GYM
            $table->enum('type', ['normale', 'laboratoire', 'informatique', 'gymnase', 'autre']);
            $table->integer('capacite');
            $table->string('localisation')->nullable(); // Bâtiment, étage
            $table->json('equipements')->nullable(); // ["vidéoprojecteur", "tableau interactif"]
            $table->boolean('disponible')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salles');
    }
};
