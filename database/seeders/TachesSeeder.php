<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TachesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('taches')->insert([
            // Étape 1: Enquête de Commodo Incommodo
            [
                'nom' => 'Approbation',
                'id_etape' => 1,
                'type_valeur' => 'text',
                'ordre' => 1,
            ],
            [
                'nom' => 'Enregistrement',
                'id_etape' => 1,
                'type_valeur' => 'text',
                'ordre' => 2,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 1,
                'type_valeur' => 'string',
                'ordre' => 3,
            ],
            [
                'nom' => 'Délai',
                'id_etape' => 1,
                'type_valeur' => 'int',
                'ordre' => 4,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 1,
                'type_valeur' => 'text',
                'ordre' => 5,
            ],
            // Étape 2: Etablissement de l'état parcellaire et plan parcellaire
            [
                'nom' => 'VISA',
                'id_etape' => 2,
                'type_valeur' => 'text',
                'ordre' => 1,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 2,
                'type_valeur' => 'string',
                'ordre' => 2,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 2,
                'type_valeur' => 'text',
                'ordre' => 3,
            ],
            // Étape 3: Décret Déclaratif d'Utilité Publique
            [
                'nom' => 'Approbation',
                'id_etape' => 3,
                'type_valeur' => 'text',
                'ordre' => 1,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 3,
                'type_valeur' => 'string',
                'ordre' => 2,
            ],
            [
                'nom' => 'Conseil de ministres',
                'id_etape' => 3,
                'type_valeur' => 'text',
                'ordre' => 3,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 3,
                'type_valeur' => 'text',
                'ordre' => 4,
            ],
            // Étape 4: Arrêté de cessibilité
            [
                'nom' => 'Approbation',
                'id_etape' => 4,
                'type_valeur' => 'text',
                'ordre' => 1,
            ],
            [
                'nom' => 'Enregistrement',
                'id_etape' => 4,
                'type_valeur' => 'text',
                'ordre' => 2,
            ],
            [
                'nom' => 'Délai',
                'id_etape' => 4,
                'type_valeur' => 'int',
                'ordre' => 3,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 4,
                'type_valeur' => 'string',
                'ordre' => 4,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 4,
                'type_valeur' => 'text',
                'ordre' => 5,
            ],
            // Étape 5: Evaluation des indemnités d’expropriation
            [
                'nom' => 'Lettre de constitution',
                'id_etape' => 5,
                'type_valeur' => 'text',
                'ordre' => 1,
            ],
            [
                'nom' => 'Réunion CAE',
                'id_etape' => 5,
                'type_valeur' => 'text',
                'ordre' => 2,
            ],
            [
                'nom' => 'Délai',
                'id_etape' => 5,
                'type_valeur' => 'int',
                'ordre' => 3,
            ],
            [
                'nom' => 'Descente d\'évaluation',
                'id_etape' => 5,
                'type_valeur' => 'text',
                'ordre' => 4,
            ],
            [
                'nom' => 'Finalisation état des sommes et PV',
                'id_etape' => 5,
                'type_valeur' => 'text',
                'ordre' => 5,
            ],
            [
                'nom' => 'Délai',
                'id_etape' => 5,
                'type_valeur' => 'int',
                'ordre' => 6,
            ],
            [
                'nom' => 'Transmission Dossier CAE',
                'id_etape' => 5,
                'type_valeur' => 'text',
                'ordre' => 7,
            ],
            [
                'nom' => 'Délai',
                'id_etape' => 5,
                'type_valeur' => 'int',
                'ordre' => 8,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 5,
                'type_valeur' => 'text',
                'ordre' => 9,
            ],
            // Étape 6: Consignation des indemnités
            [
                'nom' => 'Lettre d\'ouverture de compte de consignation',
                'id_etape' => 6,
                'type_valeur' => 'text',
                'ordre' => 1,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 6,
                'type_valeur' => 'string',
                'ordre' => 2,
            ],
            [
                'nom' => 'Décision d\'ouverture',
                'id_etape' => 6,
                'type_valeur' => 'text',
                'ordre' => 3,
            ],
            [
                'nom' => 'Transfert de fonds',
                'id_etape' => 6,
                'type_valeur' => 'text',
                'ordre' => 4,
            ],
            [
                'nom' => 'Déclaration de recettes',
                'id_etape' => 6,
                'type_valeur' => 'text',
                'ordre' => 5,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 6,
                'type_valeur' => 'text',
                'ordre' => 6,
            ],
            // Étape 7: Notification des offres aux expropriés
            [
                'nom' => 'Notification',
                'id_etape' => 7,
                'type_valeur' => 'text',
                'ordre' => 1,
            ],
            [
                'nom' => 'Délai',
                'id_etape' => 7,
                'type_valeur' => 'int',
                'ordre' => 2,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 7,
                'type_valeur' => 'string',
                'ordre' => 3,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 7,
                'type_valeur' => 'text',
                'ordre' => 4,
            ],
            // Étape 8: Requête aux fins d'ordonnance
            [
                'nom' => 'Requête',
                'id_etape' => 8,
                'type_valeur' => 'text',
                'ordre' => 1,
            ],
            [
                'nom' => 'Délai',
                'id_etape' => 8,
                'type_valeur' => 'int',
                'ordre' => 2,
            ],
            // Étape 9: Inscription de l'ordonnance d'expropriation
            [
                'nom' => 'Inscription sur Livre Foncier',
                'id_etape' => 9,
                'type_valeur' => 'text',
                'ordre' => 1,
            ],
            [
                'nom' => 'CSJ avant et après',
                'id_etape' => 9,
                'type_valeur' => 'text',
                'ordre' => 2,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 9,
                'type_valeur' => 'string',
                'ordre' => 3,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 9,
                'type_valeur' => 'text',
                'ordre' => 4,
            ],
            // Étape 10: Paiement
            [
                'nom' => 'Inscription sur Salohy',
                'id_etape' => 10,
                'type_valeur' => 'string',
                'ordre' => 1,
            ],
            [
                'nom' => 'Transmission Dossier pour mandatemment',
                'id_etape' => 10,
                'type_valeur' => 'text',
                'ordre' => 2,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 10,
                'type_valeur' => 'string',
                'ordre' => 3,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 10,
                'type_valeur' => 'text',
                'ordre' => 4,
            ],
        ]);
    }
}