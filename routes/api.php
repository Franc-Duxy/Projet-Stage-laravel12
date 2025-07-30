<?php

use App\Http\Controllers\ProjetController;
use App\Http\Controllers\EtapeProjetController;
use App\Http\Controllers\TacheRemplieController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\EtapeController;
use App\Http\Controllers\TacheController;
use Illuminate\Support\Facades\Route;

/*
apiResource crée automatiquement les routes RESTful pour chaque contrôleur :
GET /projets : Liste tous les projets.
GET /projets/{id} : Affiche un projet.
POST /projets : Crée un projet.
PUT /projets/{id} : Met à jour un projet.
DELETE /projets/{id} : Supprime un projet.
Et ainsi de suite pour chaque ressource.
Les routes sont accessibles via /api/ (par exemple, /api/projets).
*/

Route::apiResource('utilisateur', UtilisateurController::class);
Route::apiResource('projets', ProjetController::class);
Route::apiResource('etapes', EtapeController::class);
Route::apiResource('taches', TacheController::class);
Route::apiResource('etape_projet', EtapeProjetController::class);
Route::apiResource('tache_remplie', TacheRemplieController::class);

            // Routes spécifiques pour les tâches remplies de l'étape 1 (Enquête de Commodo Incommodo)
Route::get('taches-remplies/etape1/{id_projet}', [TacheRemplieController::class, 'showEtape1']);
Route::post('taches-remplies/etape1', [TacheRemplieController::class, 'storeEtape1'])->name('taches-remplies.etape1');
Route::put('taches-remplies/etape1', [TacheRemplieController::class, 'updateEtape1'])->name('taches-remplies.updateEtape1');
Route::delete('taches-remplies/etape1/{id_projet}', [TacheRemplieController::class, 'deleteEtape1']);

            // Routes pour les taches remplies de l'etape 2 
Route::get('taches-remplies/etape2/{id_projet}', [TacheRemplieController::class, 'showEtape2']);
Route::post('taches-remplies/etape2', [TacheRemplieController::class, 'storeEtape2']);
Route::post('taches-remplies/etape2/update', [TacheRemplieController::class, 'updateEtape2']);
Route::delete('taches-remplies/etape2/{id_projet}', [TacheRemplieController::class, 'deleteEtape2']);


