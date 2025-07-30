<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    /**
     * Lister (index) : Récupérer tous les enregistrements ou filtrer par critères
     */
    public function index()
    {
        $projets = Projet::with(['etapesProjets', 'tachesRemplies', 'etapes'])->get();
        return response()->json([
            'success' => true,
            'data' => $projets,
        ], 200);
    }

    /**
     * Afficher (show) : Récupérer un enregistrement spécifique
     */
    public function show($id)
    {
        $projet = Projet::with(['etapesProjets', 'tachesRemplies', 'etapes'])->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $projet,
        ], 200);
    }

    /**
     * Créer (store) : Ajouter un nouvel enregistrement avec validation
     */
    public function store(Request $request)
    {
        $messages = [
            'nom.required' => 'Le nom du projet est requis.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 100 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'statut.required' => 'Le statut est requis.',
            'statut.in' => 'Le statut doit être l\'un des suivants : en_attente, en_cours, termine.',
        ];

        $data = $request->validate([
            'nom' => 'required|string|max:100',
            'description' => 'nullable|string',
            'date_debut' => 'nullable|date',
            'statut' => 'required|in:en_attente,en_cours,termine',
        ], $messages);

        $projet = Projet::create($data);
        $projet->load(['etapesProjets', 'tachesRemplies', 'etapes']);

        return response()->json([
            'success' => true,
            'data' => $projet,
            'message' => 'Projet créé avec succès.',
        ], 201);
    }

    /**
     * Mettre à jour (update) : Modifier un enregistrement existant avec validation
     */
    public function update(Request $request, $id)
    {
        $projet = Projet::findOrFail($id);

        $messages = [
            'nom.required' => 'Le nom du projet est requis.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 100 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'statut.required' => 'Le statut est requis.',
            'statut.in' => 'Le statut doit être l\'un des suivants : en_attente, en_cours, termine.',
        ];

        $data = $request->validate([
            'nom' => 'required|string|max:100',
            'description' => 'nullable|string',
            'date_debut' => 'nullable|date',
            'statut' => 'required|in:en_attente,en_cours,termine',
        ], $messages);

        $projet->update($data);
        $projet->load(['etapesProjets', 'tachesRemplies', 'etapes']);

        return response()->json([
            'success' => true,
            'data' => $projet,
            'message' => 'Projet mis à jour avec succès.',
        ], 200);
    }

    /**
     * Supprimer (destroy) : Supprimer un enregistrement
     */
    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);
        $projet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Projet supprimé avec succès.',
        ], 200);
    }
}