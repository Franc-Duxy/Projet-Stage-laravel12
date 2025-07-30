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
                'type_valeur' => 'date',
                'ordre' => 1,
            ],
            [
                'nom' => 'Num_enregistrement',
                'id_etape' => 1,
                'type_valeur' => 'string',
                'ordre' => 2,
            ],
            [
                'nom' => 'Enregistrement',
                'id_etape' => 1,
                'type_valeur' => 'date',
                'ordre' => 3,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 1,
                'type_valeur' => 'string',
                'ordre' => 4,
            ],
            [
                'nom' => 'Date debut',
                'id_etape' => 1,
                'type_valeur' => 'date',
                'ordre' => 5,
            ],
            [
                'nom' => 'Date fin',
                'id_etape' => 1,
                'type_valeur' => 'date',
                'ordre' => 6,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 1,
                'type_valeur' => 'text',
                'ordre' => 7,
            ],
            [
                'nom' => 'fichier_pdf',
                'id_etape' => 1,
                'type_valeur' => 'string',
                'ordre' => 8,
            ],
            // Étape 2: Etablissement de l'état parcellaire et plan parcellaire
            [
                'nom' => 'num visa',
                'id_etape' => 2,
                'type_valeur' => 'string',
                'ordre' => 1,
            ],
            [
                'nom' => 'VISA',
                'id_etape' => 2,
                'type_valeur' => 'date',
                'ordre' => 2,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 2,
                'type_valeur' => 'string',
                'ordre' => 3,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 2,
                'type_valeur' => 'text',
                'ordre' => 4,
            ],
            [
                'nom' => 'fichier_pdf',
                'id_etape' => 2,
                'type_valeur' => 'string',
                'ordre' => 5,
            ],
            // Étape 3: Décret Déclaratif d'Utilité Publique
            [
                'nom' => 'Approbation',
                'id_etape' => 3,
                'type_valeur' => 'date',
                'ordre' => 1,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 3,
                'type_valeur' => 'string',
                'ordre' => 2,
            ],
            [
                'nom' => 'num conseil',
                'id_etape' => 3,
                'type_valeur' => 'string',
                'ordre' => 3,
            ],
            [
                'nom' => 'Conseil de ministres',
                'id_etape' => 3,
                'type_valeur' => 'date',
                'ordre' => 4,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 3,
                'type_valeur' => 'text',
                'ordre' => 5,
            ],
            [
                'nom' => 'fichier_pdf',
                'id_etape' => 3,
                'type_valeur' => 'string',
                'ordre' => 6,
            ],
            // Étape 4: Arrêté de cessibilité
            [
                'nom' => 'Approbation',
                'id_etape' => 4,
                'type_valeur' => 'date',
                'ordre' => 1,
            ],
            [
                'nom' => 'num d\'enregistrement',
                'id_etape' => 4,
                'type_valeur' => 'string',
                'ordre' => 2,
            ],
            [
                'nom' => 'Enregistrement',
                'id_etape' => 4,
                'type_valeur' => 'date',
                'ordre' => 3,
            ],
            [
                'nom' => 'Date debut',
                'id_etape' => 4,
                'type_valeur' => 'date',
                'ordre' => 4,
            ],
            [
                'nom' => 'Date fin',
                'id_etape' => 4,
                'type_valeur' => 'date',
                'ordre' => 5,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 4,
                'type_valeur' => 'string',
                'ordre' => 6,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 4,
                'type_valeur' => 'text',
                'ordre' => 7,
            ],
            [
                'nom' => 'fichier_pdf',
                'id_etape' => 4,
                'type_valeur' => 'string',
                'ordre' => 8,
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
                'nom' => 'Déscente d\'évaluation',
                'id_etape' => 5,
                'type_valeur' => 'text',
                'ordre' => 3,
            ],
            [
                'nom' => 'Finalisation état des sommes et PV',
                'id_etape' => 5,
                'type_valeur' => 'text',
                'ordre' => 4,
            ],
            [
                'nom' => 'Transmission Dossier CAE',
                'id_etape' => 5,
                'type_valeur' => 'text',
                'ordre' => 5,
            ],
            [
                'nom' => 'Date debut',
                'id_etape' => 5,
                'type_valeur' => 'date',
                'ordre' => 6,
            ],
            [
                'nom' => 'Date fin',
                'id_etape' => 5,
                'type_valeur' => 'date',
                'ordre' => 7,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 5,
                'type_valeur' => 'text',
                'ordre' => 8,
            ],
            [
                'nom' => 'fichier_pdf',
                'id_etape' => 5,
                'type_valeur' => 'string',
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
            [
                'nom' => 'fichier_pdf',
                'id_etape' => 6,
                'type_valeur' => 'string',
                'ordre' => 7,
            ],
            // Étape 7: Notification des offres aux expropriés
            [
                'nom' => 'Notification',
                'id_etape' => 7,
                'type_valeur' => 'text',
                'ordre' => 1,
            ],
            [
                'nom' => 'Date debut',
                'id_etape' => 7,
                'type_valeur' => 'date',
                'ordre' => 2,
            ],
            [
                'nom' => 'Date fin',
                'id_etape' => 7,
                'type_valeur' => 'date',
                'ordre' => 3,
            ],
            [
                'nom' => 'Responsable',
                'id_etape' => 7,
                'type_valeur' => 'string',
                'ordre' => 4,
            ],
            [
                'nom' => 'Observations',
                'id_etape' => 7,
                'type_valeur' => 'text',
                'ordre' => 5,
            ],
            [
                'nom' => 'fichier_pdf',
                'id_etape' => 7,
                'type_valeur' => 'string',
                'ordre' => 6,
            ],
            // Étape 8: Requête aux fins d'ordonnance
            [
                'nom' => 'Requête',
                'id_etape' => 8,
                'type_valeur' => 'text',
                'ordre' => 1,
            ],
            [
                'nom' => 'Date debut',
                'id_etape' => 8,
                'type_valeur' => 'date',
                'ordre' => 2,
            ],
            [
                'nom' => 'Date fin',
                'id_etape' => 8,
                'type_valeur' => 'date',
                'ordre' => 3,
            ],
            [
                'nom' => 'fichier_pdf',
                'id_etape' => 8,
                'type_valeur' => 'string',
                'ordre' => 4,
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
            [
                'nom' => 'fichier_pdf',
                'id_etape' => 9,
                'type_valeur' => 'string',
                'ordre' => 5,
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
            [
                'nom' => 'fichier_pdf',
                'id_etape' => 10,
                'type_valeur' => 'string',
                'ordre' => 5,
            ],

        ]);
    }
}