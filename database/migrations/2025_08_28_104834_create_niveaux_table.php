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
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // ex: 6ème, 5ème, 4ème, 3ème, 2nde, 1ère, Terminale, Form1, Form2, etc.
            $table->string('nom_en')->nullable(); // Traduction anglaise
            $table->string('code')->unique(); // ex: 6E, 5E, 4E, 3E, 2ND, 1ER, TLE, F1, F2, etc.
            $table->integer('ordre')->default(0); // Pour le classement
            $table->string('cycle'); // ex: Collège, Lycée, O-Levels, A-Levels
            $table->boolean('actif')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveaux');
    }
};
