<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    /**
     * Lister toutes les tâches.
     */
    public function index()
    {
        $taches = Tache::with(['etape', 'tachesRemplies'])->get();
        return response()->json([
            'success' => true,
            'data' => $taches
        ], 200);
    }

    /**
     * Créer une nouvelle tâche.
     */
    public function store(Request $request)
    {
        $messages = [
            'nom.required' => 'Le nom de la tâche est requis.',
            'nom.string' => 'Le nom de la tâche doit être une chaîne de caractères.',
            'nom.max' => 'Le nom de la tâche ne doit pas dépasser 100 caractères.',
            'id_etape.required' => 'L\'identifiant de l\'étape est requis.',
            'id_etape.exists' => 'L\'étape spécifiée n\'existe pas.',
            'type_valeur.required' => 'Le type de valeur est requis.',
            'type_valeur.in' => 'Le type de valeur doit être l\'un des suivants : int, string, date, text.',
            'ordre.required' => 'L\'ordre de la tâche est requis.',
            'ordre.integer' => 'L\'ordre de la tâche doit être un nombre entier.',
        ];

        $data = $request->validate([
            'nom' => ['required', 'string', 'max:100'],
            'id_etape' => ['required', 'exists:etapes,id_etape'],
            'type_valeur' => ['required', 'in:int,string,date,text'],
            'ordre' => ['required', 'integer'],
        ], $messages);

        $tache = Tache::create($data);

        return response()->json([
            'success' => true,
            'data' => $tache->load(['etape', 'tachesRemplies']),
            'message' => 'Tâche créée avec succès.'
        ], 201);
    }

    /**
     * Afficher une tâche spécifique.
     */
    public function show(Tache $tache)
    {
        return response()->json([
            'success' => true,
            'data' => $tache->load(['etape', 'tachesRemplies'])
        ], 200);
    }

    /**
     * Mettre à jour une tâche.
     */
    public function update(Request $request, Tache $tache)
    {
        $messages = [
            'nom.required' => 'Le nom de la tâche est requis.',
            'nom.string' => 'Le nom de la tâche doit être une chaîne de caractères.',
            'nom.max' => 'Le nom de la tâche ne doit pas dépasser 100 caractères.',
            'id_etape.required' => 'L\'identifiant de l\'étape est requis.',
            'id_etape.exists' => 'L\'étape spécifiée n\'existe pas.',
            'type_valeur.required' => 'Le type de valeur est requis.',
            'type_valeur.in' => 'Le type de valeur doit être l\'un des suivants : int, string, date, text.',
            'ordre.required' => 'L\'ordre de la tâche est requis.',
            'ordre.integer' => 'L\'ordre de la tâche doit être un nombre entier.',
        ];

        $data = $request->validate([
            'nom' => ['required', 'string', 'max:100'],
            'id_etape' => ['required', 'exists:etapes,id_etape'],
            'type_valeur' => ['required', 'in:int,string,date,text'],
            'ordre' => ['required', 'integer'],
        ], $messages);

        $tache->update($data);

        return response()->json([
            'success' => true,
            'data' => $tache->load(['etape', 'tachesRemplies']),
            'message' => 'Tâche mise à jour avec succès.'
        ], 200);
    }

    /**
     * Supprimer une tâche.
     */
    public function destroy(Tache $tache)
    {
        $tache->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tâche supprimée avec succès.'
        ], 200);
    }
}