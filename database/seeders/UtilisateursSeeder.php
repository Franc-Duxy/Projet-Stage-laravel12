<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtilisateursSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('utilisateurs')->insert([
            [
                'nom' => 'François',
                'prenom' => ' Xavier',
                'email' => 'francois@example.com',
                'CIN' => '111112212121',
                'departement' => 'DAI',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'utilisateur',
                'created_at' => now(),
            ],
            [
                'nom' => 'Giovanie',
                'prenom' => 'Gio',
                'email' => 'giovanie.admin@example.com',
                'CIN' => '222211112211',
                'departement' => '8bis',
                'mot_de_passe' => Hash::make('password456'),
                'role' => 'admin',
                'created_at' => now(),
            ],
        ]);
    }
}