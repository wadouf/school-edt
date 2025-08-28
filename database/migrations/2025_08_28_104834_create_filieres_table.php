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
        Schema::create('filieres', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // ex: Scientifique, Littéraire, Technique Commercial, TI, Science, Arts
            $table->string('nom_en')->nullable(); // Traduction anglaise
            $table->string('code')->unique(); // ex: SCI, LIT, TC, TI, SCI_EN, ART_EN
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
        Schema::dropIfExists('filieres');
    }
};
