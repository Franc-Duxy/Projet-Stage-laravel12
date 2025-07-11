<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EtapesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('etapes')->insert([
            [
                'nom' => 'Enquête de Commodo Incommodo',
                'ordre' => 1,
            ],
            [
                'nom' => 'Etablissement de l\'état parcellaire et plan parcellaire',
                'ordre' => 2,
            ],
            [
                'nom' => 'Décret Déclaratif d\'Utilité Publique',
                'ordre' => 3,
            ],
            [
                'nom' => 'Arrêté de cessibilité',
                'ordre' => 4,
            ],
            [
                'nom' => 'Evaluation des indemnités d’expropriation',
                'ordre' => 5,
            ],
            [
                'nom' => 'Consignation des indemnités',
                'ordre' => 6,
            ],
            [
                'nom' => 'Notification des offres aux expropriés',
                'ordre' => 7,
            ],
            [
                'nom' => 'Requête aux fins d\'ordonnance',
                'ordre' => 8,
            ],
            [
                'nom' => 'Inscription de l\'ordonnance d\'expropriation',
                'ordre' => 9,
            ],
            [
                'nom' => 'Paiement',
                'ordre' => 10,
            ],
        ]);
    }
}
