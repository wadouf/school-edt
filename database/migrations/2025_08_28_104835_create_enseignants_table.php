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
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->enum('type', ['permanent', 'vacataire']);
            $table->string('etablissement_attache')->nullable(); // Pour les vacataires
            $table->integer('heures_max_semaine')->default(18); // Charge horaire maximum
            $table->json('matieres_enseignees'); // IDs des matières
            $table->json('sections_autorisees')->nullable(); // ["FR", "EN"] ou null pour toutes
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
        Schema::dropIfExists('enseignants');
    }
};
