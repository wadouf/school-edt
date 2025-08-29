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
        Schema::table('classes', function (Blueprint $table) {
            // Ajouter une clé étrangère vers la table salles
            $table->foreignId('salle_principale_id')->nullable()->constrained('salles')->nullOnDelete()->after('salle_principale');
            
            // Garder le champ salle_principale pour compatibilité ascendante
            // Il sera déprécié mais permettra une transition en douceur
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['salle_principale_id']);
            $table->dropColumn('salle_principale_id');
        });
    }
};