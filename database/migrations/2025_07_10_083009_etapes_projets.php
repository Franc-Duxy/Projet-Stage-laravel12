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
        Schema::create('etapes_projets', function (Blueprint $table) {
            $table->id(); // SERIAL PRIMARY KEY
            $table->foreignId('id_projet')->constrained('projets', 'id_projet')->onDelete('cascade'); // INTEGER NOT NULL REFERENCES projets
            $table->foreignId('id_etape')->constrained('etapes', 'id_etape')->onDelete('cascade'); // INTEGER NOT NULL REFERENCES etapes
            $table->enum('statut', ['en_attente', 'en_cours', 'termine'])->default('en_attente'); // VARCHAR(20) CHECK
            $table->date('date_debut')->nullable(); 
            $table->date('date_fin')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etapes_projets');
    }
};
