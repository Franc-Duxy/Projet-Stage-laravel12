<?php

namespace App\Http\Controllers;

use App\Models\Etape;
use Illuminate\Http\Request;

class EtapeController extends Controller
{
    /**
     * Lister toutes les étapes.
     */
    public function index()
    {
        $etapes = Etape::with(['taches', 'etapesProjets', 'projets'])->get();
        return response()->json([
            'success' => true,
            'data' => $etapes
        ], 200);
    }

    /**
     * Créer une nouvelle étape.
     */
    public function store(Request $request)
    {
        $messages = [
            'nom.required' => 'Le nom de l\'étape est requis.',
            'nom.string' => 'Le nom de l\'étape doit être une chaîne de caractères.',
            'nom.max' => 'Le nom de l\'étape ne doit pas dépasser 100 caractères.',
            'ordre.required' => 'L\'ordre de l\'étape est requis.',
            'ordre.integer' => 'L\'ordre de l\'étape doit être un nombre entier.',
        ];

        $data = $request->validate([
            'nom' => ['required', 'string', 'max:100'],
            'ordre' => ['required', 'integer'],
        ], $messages);

        $etape = Etape::create($data);

        return response()->json([
            'success' => true,
            'data' => $etape->load(['taches', 'etapesProjets', 'projets']),
            'message' => 'Étape créée avec succès.'
        ], 201);
    }

    /**
     * Afficher une étape spécifique.
     */
    public function show(Etape $etape)
    {
        return response()->json([
            'success' => true,
            'data' => $etape->load(['taches', 'etapesProjets', 'projets'])
        ], 200);
    }

    /**
     * Mettre à jour une étape.
     */
    public function update(Request $request, Etape $etape)
    {
        $messages = [
            'nom.required' => 'Le nom de l\'étape est requis.',
            'nom.string' => 'Le nom de l\'étape doit être une chaîne de caractères.',
            'nom.max' => 'Le nom de l\'étape ne doit pas dépasser 100 caractères.',
            'ordre.required' => 'L\'ordre de l\'étape est requis.',
            'ordre.integer' => 'L\'ordre de l\'étape doit être un nombre entier.',
        ];

        $data = $request->validate([
            'nom' => ['required', 'string', 'max:100'],
            'ordre' => ['required', 'integer'],
        ], $messages);

        $etape->update($data);

        return response()->json([
            'success' => true,
            'data' => $etape->load(['taches', 'etapesProjets', 'projets']),
            'message' => 'Étape mise à jour avec succès.'
        ], 200);
    }

    /**
     * Supprimer une étape.
     */
    public function destroy(Etape $etape)
    {
        $etape->delete();

        return response()->json([
            'success' => true,
            'message' => 'Étape supprimée avec succès.'
        ], 200);
    }
}