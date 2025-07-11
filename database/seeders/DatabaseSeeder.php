<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appeler les seeders pour chaque table
        $this->call([
            UtilisateursSeeder::class,
            ProjetsSeeder::class,
            EtapesSeeder::class,
            TachesSeeder::class,
            EtapesProjetsSeeder::class,
            TacheRemplieSeeder::class,
        ]);
    }
}