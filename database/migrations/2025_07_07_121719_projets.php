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
        Schema::create('projets', function (Blueprint $table) {
            $table->id('id_projet'); // SERIAL PRIMARY KEY
            $table->string('nom', 100); // VARCHAR(100) NOT NULL
            $table->text('description')->nullable(); // TEXT
            $table->date('date_debut')->nullable();
            $table->enum('statut', ['en_attente', 'en_cours', 'termine'])->default('en_attente'); // VARCHAR(20) CHECK
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
