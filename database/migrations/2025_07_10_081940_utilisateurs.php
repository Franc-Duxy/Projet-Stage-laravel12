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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id(); // SERIAL PRIMARY KEY
            $table->string('nom', 100); // VARCHAR(100) NOT NULL
            $table->string('prenom', 100); // VARCHAR(100) NOT NULL
            $table->string('email', 100)->unique(); // VARCHAR(100) UNIQUE NOT NULL
            $table->string('mot_de_passe', 255); // VARCHAR(255) NOT NULL
            $table->enum('role', ['admin', 'utilisateur'])->default('utilisateur'); // VARCHAR(20) CHECK (role IN ('admin', 'utilisateur'))
            $table->timestamp('created_at')->useCurrent(); // TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
