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
       Schema::create('tache_remplie', function (Blueprint $table) {
            $table->id(); // SERIAL PRIMARY KEY
            $table->foreignId('id_projet')->constrained('projets', 'id_projet')->onDelete('cascade'); // INTEGER NOT NULL REFERENCES projets
            $table->foreignId('id_tache')->constrained('taches', 'id_tache')->onDelete('cascade'); // INTEGER NOT NULL REFERENCES taches
            $table->foreignId('id_utilisateur')->nullable()->constrained('utilisateurs', 'id')->onDelete('set null'); // INTEGER REFERENCES utilisateurs
            $table->string('valeur_string', 255)->nullable(); // VARCHAR(255)
            $table->text('valeur_texte')->nullable(); // TEXT
            $table->integer('valeur_entier')->nullable(); // INTEGER
            $table->date('valeur_date')->nullable(); // DATE
            $table->timestamp('date_remplissage')->useCurrent(); // TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tache_remplie');
    }
};
